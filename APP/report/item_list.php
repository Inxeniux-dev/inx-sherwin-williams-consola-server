<?php

$ruta = $this->PATH."libs/PDF/fpdf.php";
require($ruta);

class PDF extends FPDF
{

function Header()
{
    // Logo
    $path_logo = $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/img/logo_comex.png";
    $RAZON =   $_SESSION["config"]["razon"];

    $this->Image($path_logo,10,8,33);
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
    $this->Cell(130, 6, "LISTADO DE ARTICULOS",0,1,'L');
    $this->Ln(4);
    $this->SetFont('Courier','B',8);
    $this->Cell(25,5, "CODIGO",'T', 0, "L");
    $this->Cell(25,5, "COD BARRAS",'T', 0, "L");
    $this->Cell(70,5, "DESCRIPCION",'T', 0, "L");
    $this->Cell(25,5, "PRECIO",'T', 0, "R");
    $this->Cell(17,5, "EXIST",'T', 0, "R");
    $this->Cell(34,5, "LINEA",'T', 1, "R");
    $this->Ln(2);
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
    $pdf->Cell(25,5, $row->codigo, 0, 0, "L");
    $pdf->Cell(25,5, $row->codigo_barras, 0, 0, "L");
    $pdf->Cell(70,5, substr($row->descripcion,0,45), 0, 0, "L");
    $pdf->Cell(25,5, "$".number_format($row->precio,2), 0, 0, "R");
    $pdf->Cell(17,5, number_format($row->existencia, 0, "", ","), 0, 0, "R");
    $pdf->Cell(34,5, substr($row->desclinea,0,22), 0, 1, "L");
  }
}


$pdf->Output();

?>
