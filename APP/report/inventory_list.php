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
    $this->Cell(105, 6, utf8_decode("Historial de inventarios del ".fechaCortaAbreviada($GLOBALS["date_ini"])." al ".fechaCortaAbreviada($GLOBALS["date_fin"])),0,0,'C');
    $this->SetFont('Arial','',7);
    $this->Cell(45, 6, utf8_decode(""),0,1,'R');

    $this->Ln(4);
    $this->SetFont('Arial','B',8);
    $this->Cell(26,5, "FECHA INICIO",'T', 0, "L");
    $this->Cell(26,5, "FECHA FINAL",'T', 0, "L");
    $this->Cell(35,5, "ENCARGADO",'T', 0, "L");
    $this->Cell(35,5, "AUDITOR",'T', 0, "L");
    $this->Cell(15,5, "ESTATUS", 'T', 0, "C");
    $this->Cell(30,5, "TOTAL ENTRADA",'T', 0, "R");
    $this->Cell(30,5, "TOTAL SALIDA",'T', 1, "R");
    $this->Ln(2);
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
    while($row = $data->fetch_object())
    {
        $status = $row->status == 0 ? "Cerrado":"Abierto";
        $pdf->Cell(26,5, $row->fecha_inicial, 0, 0, "L");
        $pdf->Cell(26,5, $row->fecha_final, 0, 0, "L");
        $pdf->Cell(35,5, utf8_decode(substr($row->encargado,0,21)), 0, 0, "L");
        $pdf->Cell(35,5, utf8_decode(substr($row->auditor,0,21)), 0, 0, "L");
        $pdf->Cell(15,5, $status, 0, 0, "C");
        $pdf->Cell(30,5, "$".number_format($row->total_entradas,2), 0, 0, "R");
        $pdf->Cell(30,5, "$".number_format($row->total_salidas,2), 0, 1, "R");
    }
}



$pdf->Output();

?>
