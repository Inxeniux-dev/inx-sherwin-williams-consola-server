<?php

$ruta = $this->PATH."libs/PDF/fpdf.php";
$rotation = $this->PATH."libs/PDF/rotation.php";
require($ruta);
require($rotation);


$GLOBALS["data_venta"] = $data_venta;
$GLOBALS["identified"] = $identified;
$GLOBALS["location"] = $location;

class PDF extends PDF_Rotate
{

function Header()
{
    // Logo
    $path_logo = $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/img/logo_comex.png";
    $RAZON =   $_SESSION["config"]["razon"];
    $DATA_VENTA = $GLOBALS["data_venta"];
    $identified = $GLOBALS["identified"];

    $location = $GLOBALS["location"];

    $telefono = '';
    $correo = '';
    if($location)
    {
          $telefono = $location->telefono;
          $correo = $location->email;
    }



    // [direccion] => Conocida [colonia] => COL. YUCALPETEN [num_interior] => 1 [num_exterior] => 2 [municipio] => Comitán de Dominguez [estado] => Chiapas [pais] => Mexico [codigo_postal] => 30060
    $NUMERO = "NO. INT. ".$DATA_VENTA->num_interior;
    if(strlen($DATA_VENTA->num_interior) <= 0)
    {
      if(strlen($DATA_VENTA->num_exterior) > 0)
      {
         $NUMERO = "NO. EXT. ".$DATA_VENTA->num_exterior;
      }
      else {
         $NUMERO = " ";
      }
    }

    $DIRECCION_CLIENTE = $DATA_VENTA->direccion. " ".$DATA_VENTA->colonia." ".$NUMERO.". ".$DATA_VENTA->municipio. ", ".$DATA_VENTA->estado;


    $DATA_SUCURSAL = $_SESSION["config"]["data_sucursal"];
    $NUMERO = "NO. INT. ".$DATA_SUCURSAL["num_interior"];
    if(strlen($DATA_SUCURSAL["num_interior"]) <= 0)
    {
      if(strlen($DATA_SUCURSAL["num_exterior"]) > 0)
      {
         $NUMERO = "NO. EXT. ".$DATA_SUCURSAL["num_exterior"];
      }
      else {
         $NUMERO = " ";
      }
    }

    $DIRECCION_SUCURSAL = $DATA_SUCURSAL["direccion"]. " ".$DATA_SUCURSAL["colonia"]." ".$NUMERO.". ".$DATA_SUCURSAL["ciudad"]. ", ".$DATA_SUCURSAL["estado"].", ".$DATA_SUCURSAL["pais"];

    $this->Image($path_logo,4,2,70);
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->Cell(33);

    // Título
    $this->Cell(130, 8, "",0,0,'C');
    $this->SetFont('Arial','B', 15);
    $this->Cell(32,8, utf8_decode("COTIZACIÓN"),0,1,'R');

    $this->Ln(2);
    $this->SetFont('Arial','B',9);
    $this->Cell(45, 6, $RAZON, 0, 1,'L');
    $this->Ln(2);

    $this->SetFont('Arial','B',10);
    $this->Cell(97,  4, utf8_decode("LA PRESENTE COTIZACIÓN NO ES UNA NOTA DE VENTA"),0,1,'L');

    $this->SetFont('Arial','B',8);
    $this->SetFont('Arial','B',7);
    $this->Cell(160, 5, utf8_decode("SUCURSAL ".$_SESSION["config"]["name_suc"]),0,0,'L');
    $this->SetFont('Arial','B',7);
    $this->Cell(34,  4, utf8_decode("FECHA : "),0,1,'L');
    $this->SetFont('Arial','',7);

    $this->Cell(160,  4, utf8_decode($DIRECCION_SUCURSAL),0,0,'L');
    $this->SetFont('Arial','',7);
    $this->Cell(34,  4, utf8_decode(fechaCastellanoSinDate($_SESSION["config"]["date_corte"])),0,1,'L');
    $this->SetFont('Arial','',7);
    $this->Cell(160,  4, utf8_decode("Teléfono :  ".phoneformat($telefono). "    Correo : ".$correo),0,0,'L');
    $this->SetFont('Arial','B',7);
    $this->Cell(34,  4, utf8_decode("NO. DE COTIZACIÓN : "),0,1,'L');
    $this->SetFont('Arial','',7);
    $this->Cell(160, 4, "",0,0,'L');
    $this->Cell(34,  4, utf8_decode($identified),0,1,'L');


    $NOMBRE = $DATA_VENTA->tipo == 0 ? $DATA_VENTA->razon_social : $DATA_VENTA->nombre." ".$DATA_VENTA->apellido;

    $this->SetFont('Arial','B',8);
    $this->Cell(97,  4, utf8_decode("Cotización Para"),0,1,'L');
    $this->SetFont('Arial','',7);
    $this->Cell(97,  4, utf8_decode("Nombre :  ".$NOMBRE),0,1,'L');
    $this->Cell(97,  4, utf8_decode("Dirección : ".$DIRECCION_CLIENTE),0,1,'L');

    $this->Ln(5);
    $this->SetFont('Arial','B',8);


    $this->SetFont('Arial','B',50);
    $this->SetTextColor(255,192,203);
    $this->RotatedText(40, 170, utf8_decode('C O T I Z A C I Ó N '), 45);
    $this->RotatedText(50, 190, utf8_decode('SIN VALIDEZ FISCAL '), 45);

    $this->SetFont('Arial','B',15);
    $this->RotatedText(8, 95, utf8_decode('COTIZACIÓN SIN VALIDEZ FISCAL'), 90);
    //$this->RotatedText(198, 170, utf8_decode('COTIZACIÓN SIN VALIDEZ FISCAL'), 270);

    $this->Ln(1);


}


function RotatedText($x, $y, $txt, $angle)
{
  	//Text rotated around its origin
  	$this->Rotate($angle,$x,$y);
  	$this->Text($x,$y,$txt);
  	$this->Rotate(0);
}


    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-20);
        // Arial italic 8
        $this->SetFont('Arial','B',7);
        $this->Cell(80,5, "PRECIOS SUJETOS A CAMBIOS SIN PREVIO AVISO**", 0, 1, "L");
        $this->Cell(80,5, utf8_decode("ESTE DOCUMENTO NO ES UN COMPROBANTE FISCAL**"), 0, 0, "L");
        $this->SetFont('Arial','I',7);
        // Número de página
        $this->Cell(25,5,'P. '.$this->PageNo().' / {nb}',0,0,'R');
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage("P", "Letter");
$pdf->SetFont('Arial','',10);

$pdf->SetFont('Arial','B',7);

$pdf->Cell(15,6, "", 0, 0, "L");
$pdf->Cell(20,6, "CODIGO",'T', 0, "L");
$pdf->Cell(70,6, utf8_decode("DESCRIPCIÓN"),'T', 0, "L");
$pdf->Cell(20,6, "CANTIDAD",'T', 0, "R");
$pdf->Cell(20,6, "PRECIO",'T', 0, "R");
$pdf->Cell(20,6, "% DESC",'T', 0, "R");
$pdf->Cell(20,6, "SUBTOTAL",'T', 1, "R");

$pdf->SetFont('Arial','',7);

$SUMA = 0;
$IVA = 0;
$SUBTOTAL = 0;
$DESCUENTO = 0;
$TOTAL_VENTA = 0;

for($x = 0; $x <count($data_codes); $x++)
{
    $codigo = $data_codes[$x];
    $data_calculo = calcula_importe_por_producto($codigo["precio"], $codigo["cantidad"], $codigo["descuento"]);
    $DESCUENTO += $data_calculo["descuento"];
    $SUMA += $data_calculo["suma"];
    $IVA += $data_calculo["iva"];

    $pdf->Cell(15,5, "", 0, 0, "L");
    $pdf->Cell(20,5, utf8_decode($codigo["codigo"]), 0, 0, "L");
    $pdf->Cell(70,5, utf8_decode($codigo["descripcion"]), 0, 0, "L");
    $pdf->Cell(20,5, utf8_decode($codigo["cantidad"]), 0, 0, "R");
    $pdf->Cell(20,5, utf8_decode("$ ".number_format($codigo["precio"],2)), 0, 0, "R");
    $pdf->Cell(20,5, utf8_decode($codigo["descuento"]."%"), 0, 0, "R");
    $pdf->Cell(20,5, utf8_decode("$ ".number_format(($codigo["cantidad"] * ($codigo["precio"]- $data_calculo["descuento_individual"])),2)), 0, 1, "R");
}


$SUBTOTAL = $SUMA - $DESCUENTO;

$TOTAL = truncadoNoFormat($SUMA, 2) - truncadoNoFormat($DESCUENTO, 2) + number_format($IVA, 2, ".", "");

$pdf->Ln(3);

$pdf->Cell(145,5, "", 0, 0, "L");
$pdf->Cell(20,5, "SubTotal (Sin desc)", 0, 0, "R");
$pdf->Cell(20,5, "$ ".number_format($SUMA,2), 0, 1, "R");

$pdf->Cell(145,5, "", 0, 0, "L");
$pdf->Cell(20,5, "Descuento", 0, 0, "R");
$pdf->Cell(20,5, "$ ".number_format($DESCUENTO,2), 0, 1, "R");

$pdf->Cell(145,5, "", 0, 0, "L");
$pdf->Cell(20,5, "Subtotal", 0, 0, "R");
$pdf->Cell(20,5, "$ ".number_format($SUBTOTAL,2), 0, 1, "R");

$pdf->Cell(145,5, "", 0, 0, "L");
$pdf->Cell(20,5, "IVA (16%)", 0, 0, "R");
$pdf->Cell(20,5, "$ ".number_format($IVA,2), 0, 1, "R");

$pdf->SetFont('Arial','B',7);
$pdf->Cell(145,5, "", 0, 0, "L");
$pdf->Cell(20,5, "Total Neto", 0, 0, "R");
$pdf->Cell(20,5, "$ ".number_format($TOTAL,2), 0, 1, "R");

$pdf->ln(7);

$pdf->SetFont('Arial','',8);
$pdf->Cell(60,5, "", 0, 0, "L");
$pdf->Cell(90,5, utf8_decode(strtoupper("LE ATENDIÓ : ")), 0, 1, "C");
$pdf->Cell(60,5, "", 0, 0, "L");
$pdf->SetFont('Arial','B',8);
$pdf->Cell(90,5, utf8_decode(strtoupper($vendedor->nombre)), 0, 1, "C");


$pdf->ln(5);
$pdf->SetFont('Arial','B', 10);
$pdf->Cell(195,5, utf8_decode("ESTE DOCUMENTO NO ES UN COMPROBANTE DE PAGO VÁLIDO**"), 0, 1, "C");
$pdf->Cell(195,5, utf8_decode("¡EXIJA SU NOTA DE VENTA!"), 0, 1, "C");


$pdf->Output();

?>
