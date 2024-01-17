<?php

$ruta = $this->PATH."libs/PDF/fpdf.php";
require($ruta);

class PDF extends FPDF
{

function Header()
{
    // Logo
    // $path_logo = $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/img/logo_comex.png";
    $RAZON =   $_SESSION["config"]["razon"];

    // $this->Image($path_logo,10,8,33);
    // Arial bold 15
    $this->SetFont('Courier','B',12);
    // Movernos a la derecha
    $this->Cell(32);
    // Título
    $this->Cell(130, 8,$RAZON,0,0,'C');
    $this->SetFont('Courier','',10);
    $this->Cell(30,8, "Fecha:".fechaCortaAbreviada($_SESSION["config"]["date_corte"]),0,1,'R');
    $this->Ln(2);
    $this->SetFont('Courier','',10);
    $this->Cell(70, 6, "Suc. ".$_SESSION["config"]["key_suc"]." ".$_SESSION["config"]["name_suc"], 0,0,'L');
    $this->SetFont('Courier','B',9);
    $this->Cell(130, 6, "LISTADO DE CLIENTES",0,1,'L');
    $this->Ln(4);
    $this->SetFont('Courier','B',8);
    $this->Cell(55,5, "CLIENTE",'T', 0, "L");
    $this->Cell(30,5, "RFC",'T', 0, "L");
    $this->Cell(15,5, "TEL",'T', 0, "C");
    $this->Cell(15,5, "DESC",'T', 0, "C");
    $this->Cell(15,5, "SALDO",'T', 0, "C");
    $this->Cell(20,5, "EMAIL",'T', 0, "L");
    $this->Ln(4);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Courier','I',8);
    // Número de página
    $this->Cell(95,10,'P. '.$this->PageNo().'/{nb}',0,0,'R');
    $this->Cell(95,10, "Doc. Gen. ".date("Y-m-d H:i:s"),0,0,'R');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage("P", "Letter");
$pdf->SetFont('Courier','',10);

$pdf->SetFont('Courier','',7);

if($data)
{
  while($row = $data->fetch_object())
  {
    $nombre = $row->TIPO == 1 ? $row->NOMBRE." ".$row->APELLIDO : $row->RAZON_SOCIAL;

    $pdf->Cell(55,5, strtoupper(substr($nombre, 0, 40)), 0, 0, "L");
    $pdf->Cell(30,5, $row->RFC, 0, 0, "L");
    $pdf->Cell(15,5, $row->TELEFONO, 0, 0, "C");
    $pdf->Cell(15,5, $row->DESCUENTO, 0, 0, "C");
    $pdf->Cell(15,5, $row->SALDO, 0, 0, "C");
    $pdf->Cell(20,5, $row->EMAIL, 0, 1, "L");
  }
}

$pdf->Output();

?>
