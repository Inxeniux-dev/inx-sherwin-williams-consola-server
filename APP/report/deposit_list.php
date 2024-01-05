<?php

$ruta = $this->PATH."libs/PDF/fpdf.php";
require($ruta);

$GLOBALS["fechini"] = $fechini;
$GLOBALS["fechfin"] = $fechfin;

class PDF extends FPDF
{

function Header()
{
    // Logo
    $path_logo = $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/img/logo_comex.png";
    $RAZON =   $_SESSION["config"]["razon"];

    $this->Image($path_logo,10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',12);
    // Movernos a la derecha
    $this->Cell(32);
    // Título
    $this->Cell(130, 8,$RAZON,0,0,'C');
    $this->SetFont('Arial','',10);
    $this->Cell(30,8, "Fecha:".fechaCortaAbreviada($_SESSION["config"]["date_corte"]),0,1,'R');
    $this->Ln(2);
    $this->SetFont('Arial','',10);
    $this->Cell(60, 6, "Suc. ".$_SESSION["config"]["key_suc"]." ".$_SESSION["config"]["name_suc"], 0,0,'L');
    $this->SetFont('Arial','B',9);
    $this->Cell(130, 6, "DEPOSITOS DEL: ".fechaCortaAbreviada($GLOBALS["fechini"])." AL ".fechaCortaAbreviada($GLOBALS["fechfin"]),0,1,'L');
    $this->Ln(4);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(95,10,'P. '.$this->PageNo().'/{nb}',0,0,'R');
    $this->Cell(95,10, "Doc. Gen. ".date("Y-m-d H:i:s"),0,0,'R');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage("P", "Letter");
$pdf->SetFont('Arial','',10);

for($x = 0; $x<count($list); $x++)
{
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(95,8, "DEPOSITOS DEL CORTE: ".fechaCortaAbreviada($list[$x]["fecha"]),'T', 0, "L");
    $pdf->Cell(95,8, "TOTAL A DEPOSITAR: $".number_format($list[$x]["deposito"],2),'T', 1,"R");
    
    $depositos = $list[$x]["depositos"];
    $saldo = $list[$x]["deposito"];
    $pdf->Cell(25,6, "FECH DEPOSITO", 0,0);
    $pdf->Cell(25,6, "FECH CAPTURA" ,0,0);
    $pdf->Cell(55,6, "CUENTA" ,0,0);
    $pdf->Cell(25,6, "TIPO" ,0,0);
    $pdf->Cell(30,6, "IMPORTE",0,0, "R");
    $pdf->Cell(30,6, "SALDO",0,1, "R");
    $pdf->SetFont('Arial','',8);
      $TOTAL = 0;
      for($y = 0; $y < count($depositos); $y++) {
          $saldo -= $depositos[$y]["importe"];
          $TOTAL += $depositos[$y]["importe"];
          $operacion = substr ($depositos[$y]["fecha_operacion"],0,10);
          $pdf->Cell(25,6, strtoupper($depositos[$y]["fecha_comprobante"]), 0,0, "C");
          $pdf->Cell(25,6, strtoupper($operacion) ,0,0,"C");
          $pdf->Cell(55,6, strtoupper("CTA ".$depositos[$y]["cuenta"]." ".$depositos[$y]["nombre_banco"]) ,0,0);
          $pdf->Cell(25,6, strtoupper($depositos[$y]["nombre"]) ,0,0);
          $pdf->Cell(30,6, "$".number_format($depositos[$y]["importe"], 2),0,0, "R");
          $pdf->Cell(30,6, "$".number_format($saldo, 2),0,1, "R");
      }
      $pdf->SetFont('Arial','B',8);
      $pdf->Cell(25,6, "", 0,0);
      $pdf->Cell(25,6, "" ,0,0);
      $pdf->Cell(55,6, "" ,0,0);
      $pdf->Cell(25,6, "TOTAL DEPOSITADO: " ,0,0, "R");
      $pdf->Cell(30,6, "$".number_format($TOTAL,2),0,0, "R");
      $pdf->Cell(30,6, "",0,1, "R");
      $pdf->Ln(5);
}
$pdf->Output();

?>
