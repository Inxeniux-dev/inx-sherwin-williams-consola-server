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
    $this->Cell(105, 6, utf8_decode("Información de la versión en sucursales"),0,0,'C');
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


if(isset($_SESSION['DATA_VERSION']))
{
    $version = $version->fetch_object();
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(190, 6, utf8_decode("PROYECTO"),'T', 1, "L");
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(8, 6, utf8_decode(strtoupper($version->nombre)), 0, 1, "L");
    $pdf->ln(2);

    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(40, 6, utf8_decode("VERSIÓN"), 0, 0, "L");
    $pdf->Cell(40, 6, utf8_decode("FECHA DE LIBERACIÓN"), 0, 1, "L");
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(40, 6, utf8_decode($version->version), 0, 0, "L");
    $pdf->Cell(40, 6, utf8_decode(fechaCortaAbreviada($version->create_at)), 0, 1, "L");
    $pdf->ln(4);
}


if(isset($_SESSION['DATA_VERSION']))
{

  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(15,7, "CLAVE", 0, 0, "L");
  $pdf->Cell(50,7, "NOMBRE", 0, 0, "L");
  $pdf->Cell(35,7, "IP REMOTA", 0, 0, "L");
  $pdf->Cell(30,7, "VERSION PDV", 0, 0, "L");
  $pdf->Cell(30,7, "VERSION DB", 0, 0, "L");
  $pdf->Cell(40,7, "OBSERVACION", 0, 1, "L");

  $data = to_object($_SESSION['DATA_VERSION']);
  $pdf->SetFont('Arial','', 7);
  foreach ($data as $key => $value) {
    $pdf->Cell(15, 6, utf8_decode($value->clave), 0, 0, "L");
    $pdf->Cell(50, 6, utf8_decode($value->nombre), 0, 0, "L");
    $pdf->Cell(35, 6, utf8_decode($value->ip), 0, 0, "L");
    $pdf->Cell(30, 6, utf8_decode($value->version), 0, 0, "L");
    $pdf->Cell(30, 6, utf8_decode($value->version_db), 0, 0, "L");
    $pdf->Cell(40, 6, utf8_decode($value->observacion), 0, 1, "L");
  }


}



$pdf->Output();

?>
