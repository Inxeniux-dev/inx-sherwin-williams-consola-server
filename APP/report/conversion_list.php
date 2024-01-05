<?php

$ruta = $this->PATH."libs/PDF/fpdf.php";
require($ruta);

$GLOBALS["date_ini"] = $date_ini;
$GLOBALS["date_fin"] = $date_fin;

class PDF extends FPDF
{

function Header()
{
    // Logo
    $path_logo = $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/img/logo_comex.png";
    $RAZON =   $_SESSION["config"]["razon"];

    $this->Image($path_logo,10,8,33);
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->Cell(33);

    // Título
    $this->Cell(130, 8,$RAZON,0,0,'C');
    $this->SetFont('Arial','',8);
    $this->Cell(32,8, "Fecha:".fechaCortaAbreviada($_SESSION["config"]["date_corte"]),0,1,'R');

    $this->Ln(2);
    $this->SetFont('Arial','',8);
    $this->Cell(45, 6, substr("Suc. ".$_SESSION["config"]["key_suc"]." ".$_SESSION["config"]["name_suc"], 0 , 25), 0,0,'L');
    $this->SetFont('Arial','B',9);
    $this->Cell(105, 6, utf8_decode("Historial de conversiones del ".fechaCortaAbreviada($GLOBALS["date_ini"])." al ".fechaCortaAbreviada($GLOBALS["date_fin"])),0,0,'C');
    $this->SetFont('Arial','',7);
    $this->Cell(45, 6, utf8_decode(""),0,1,'R');

    $this->Ln(4);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',7);
    // Número de página
    $this->Cell(95,10,'P. '.$this->PageNo().' / {nb}',0,0,'R');
    $this->Cell(95,10, "Doc. Gen. ".date("Y-m-d H:i:s"),0,0,'R');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage("P", "Letter");

$pdf->SetFont('Arial','',7);

if($data)
{

  $pdf->SetFont('Arial','B',7);

  $data = to_object($data);

  $fecha = '';

  $total_global_entrada = 0;
  $count_entrada_global = 0;

  $total_global_salida = 0;
  $count_salida_global = 0;

  foreach ($data as $key => $value) {

        if($fecha != substr($value->fecha, 0, 10))
        {
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(145,5, utf8_decode("CONVERSIONES DEL ".fechaCastellanoSinDate($value->fecha)), 1, 1, "L");

            $fecha = substr($value->fecha, 0, 10);
        }

        $pdf->SetFont('Arial','',7);
        $pdf->Cell(90,7, utf8_decode("Folio conversion ".$value->folio), 0, 1, "L");


        $pdf->Cell(20,7, "MOV",'T', 0, "L");
        $pdf->Cell(20,7, "CODIGO",'T', 0, "L");
        $pdf->Cell(55,7, "DESCRIPCION",'T', 0, "L");
        $pdf->Cell(10,7, "ARTS",'T', 0, "R");
        $pdf->Cell(20,7, "PRECIO",'T', 0, "R");
        $pdf->Cell(20,7, "TOTAL",'T', 1, "R");


          $entradas = $value->entradas;

          $total_entrada = 0;
          $count_entrada = 0;
          foreach ($entradas as $k => $v) {
              $pdf->Cell(20,5, utf8_decode("Entrada"), 0, 0, "L");
              $pdf->Cell(20,5, utf8_decode($v->codigo), 0, 0, "L");
              $pdf->Cell(55,5, utf8_decode(substr($v->descripcion, 0, 30)), 0, 0, "L");
              $pdf->Cell(10,5, utf8_decode($v->cantidad), 0, 0, "R");
              $pdf->Cell(20,5, utf8_decode("$".number_format($v->precio,2)), 0, 0, "R");
              $pdf->Cell(20,5, "$".number_format(($v->precio * $v->cantidad),2), 0, 1, "R");
              $total_entrada += ($v->precio * $v->cantidad);
              $count_entrada += $v->cantidad;

              $total_global_entrada += ($v->precio * $v->cantidad);
              $count_entrada_global += $v->cantidad;
          }

          $salidas = $value->salidas;
          $total_salida = 0;
          $count_salida = 0;
          foreach ($salidas as $k => $v) {
              $pdf->Cell(20,5, utf8_decode("Salida"), 0, 0, "L");
              $pdf->Cell(20,5, utf8_decode($v->codigo), 0, 0, "L");
              $pdf->Cell(55,5, utf8_decode(substr($v->descripcion, 0, 30)), 0, 0, "L");
              $pdf->Cell(10,5, utf8_decode($v->cantidad), 0, 0, "R");
              $pdf->Cell(20,5, utf8_decode("$".number_format($v->precio,2)), 0, 0, "R");
              $pdf->Cell(20,5, "$".number_format(($v->precio * $v->cantidad),2), 0, 1, "R");
              $total_salida += ($v->precio * $v->cantidad);
              $count_salida += $v->cantidad;

              $total_global_salida += ($v->precio * $v->cantidad);
              $count_salida_global += $v->cantidad;
          }

            $pdf->Cell(75,5, utf8_decode(""), 0, 0, "R");
            $pdf->Cell(25,5, utf8_decode("Entradas Conv"), 0, 0, "R");
            $pdf->Cell(25,5, number_format($count_entrada,0)." Arts.", 0, 0, "R");
            $pdf->Cell(20,5, "$".number_format($total_entrada,2), 0, 1, "R");

            $pdf->Cell(75,5, utf8_decode(""), 0, 0, "L");
            $pdf->Cell(25,5, utf8_decode("Salidas Conv"), 0, 0, "R");
            $pdf->Cell(25,5, number_format($count_salida,0)." Arts.", 0, 0, "R");
            $pdf->Cell(20,5, "$".number_format($total_salida,2), 0, 1, "R");

            $pdf->Cell(75,5, utf8_decode(""), 0, 0, "L");
            $pdf->Cell(25,5, utf8_decode("Diferencia Conv"), 0, 0, "R");
            $pdf->Cell(25,5, "", 0, 0, "R");
            $pdf->Cell(20,5, "$".number_format($total_entrada-$total_salida,2), 0, 1, "R");

        $pdf->ln(3);
  }


  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(75,5, utf8_decode(""), 0, 0, "R");
  $pdf->Cell(25,5, utf8_decode("Total Entradas Conv"), 0, 0, "R");
  $pdf->Cell(25,5, number_format($count_entrada_global,0)." Arts.", 0, 0, "R");
  $pdf->Cell(20,5, "$".number_format($total_global_entrada,2), 0, 1, "R");

  $pdf->Cell(75,5, utf8_decode(""), 0, 0, "L");
  $pdf->Cell(25,5, utf8_decode("Total Salidas Conv"), 0, 0, "R");
  $pdf->Cell(25,5, number_format($count_salida_global,0)." Arts.", 0, 0, "R");
  $pdf->Cell(20,5, "$".number_format($total_global_salida,2), 0, 1, "R");

  $pdf->Cell(75,5, utf8_decode(""), 0, 0, "L");
  $pdf->Cell(25,5, utf8_decode("Total Diferencia Conv"), 0, 0, "R");
  $pdf->Cell(25,5, "", 0, 0, "R");
  $pdf->Cell(20,5, "$".number_format($total_global_entrada-$total_global_salida,2), 0, 1, "R");

}



$pdf->Output();

?>
