<?php

$ruta = $this->PATH."libs/PDF/fpdf.php";
require($ruta);
class PDF extends FPDF
{

function Header()
{
    // Logo
    //$path_logo = $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/img/logo_comex.png";

    //$this->Image($path_logo,10,8,33);
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    //$this->Cell(33);

    // Título
    $this->Cell(130, 8, COMPANY ,0,0,'L');
    $this->SetFont('Arial','',8);
    $this->Cell(32,8, "",0,1,'R');

    $this->Ln(2);
    $this->SetFont('Arial','',8);
    $this->Cell(45, 6, "Server Console", 0,0,'L');
    $this->SetFont('Arial','B',9);
    $this->Cell(105, 6, utf8_decode("Información de la versión "),0,0,'C');
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


if($version)
{

    $version = $version->fetch_object();

    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(190, 6, utf8_decode("PROYECTO"),'T', 1, "L");
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(8, 6, utf8_decode(strtoupper($version->nombre)), 0, 1, "L");
    $pdf->ln(4);

    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(190, 6, utf8_decode("VERSIÓN"), 0, 1, "L");
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(8, 6, utf8_decode($version->version), 0, 1, "L");
    $pdf->ln(4);

    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(190, 6, utf8_decode("FECHA DE LIBERACIÓN"), 0, 1, "L");
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(8, 6, utf8_decode(fechaCortaAbreviada($version->create_at)), 0, 1, "L");
    $pdf->ln(4);
}


if($detalle)
{

  $pdf->SetFont('Arial','B',7);
  $data = to_object($data);

  $fecha = '';


  $pdf->Cell(150,7, "DESCRIPCION", 0, 1, "L");

  $i = 0;
  while($row = $detalle->fetch_object()) {
    $i++;
    $pdf->SetFont('Arial','', 7);
    $pdf->Cell(8, 6, utf8_decode($i).")", 0, 0, "R");
    $pdf->Cell(150, 6, utf8_decode($row->detalle), 0, 1, "L");
  }


}



$pdf->Output();

?>
