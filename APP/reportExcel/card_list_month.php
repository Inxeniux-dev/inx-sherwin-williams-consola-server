<?php

/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
/** Clases necesarias */
require_once($this->PATH.'libs/EXCEL/PHPExcel.php');
require_once($this->PATH.'libs/EXCEL/PHPExcel/Reader/Excel2007.php');

$objPHPExcel = new PHPExcel();
$objPHPExcel->getActiveSheet(0)->getStyle('A3:M3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet(0)->getStyle('A3:M3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->getStyle('A3:M3')->getAlignment()->setWrapText(true);

$columna     = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', "K", "L", "M");

$sheet = $objPHPExcel->getActiveSheet();

$styleArray = array(
    'font' => array(
        'bold' => true
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    )
);

$styleArrayCancel = array(
    'font' => array(
        'bold' => true
    )
);

$sheet->mergeCells('B1:M1');
$sheet->getStyle('B1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet(0)->setCellValue('B1', "LISTADO DE TARJETA DE PUNTOS ACTIVAS DEL AÑO ".$year);

$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Calibri');
$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(8);

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->getAlignment()->setWrapText(true);

$fila = 3;
$enableMonth = enableMeses($year);
/**Contenido */
$sheet->getStyle('A'.$fila.':M'.$fila)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, 'Sucursal');

if($enableMonth[1])
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, 'Enero');

if($enableMonth[2])
$objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, 'Febero');

if($enableMonth[3])
$objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, 'Marzo');

if($enableMonth[4])
$objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, 'Abril');

if($enableMonth[5])
$objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, 'Mayo');

if($enableMonth[6])
$objPHPExcel->getActiveSheet(0)->setCellValue('G'.$fila, 'Junio');

if($enableMonth[7])
$objPHPExcel->getActiveSheet(0)->setCellValue('H'.$fila, 'Julio');

if($enableMonth[8])
$objPHPExcel->getActiveSheet(0)->setCellValue('I'.$fila, 'Agosto');

if($enableMonth[9])
$objPHPExcel->getActiveSheet(0)->setCellValue('J'.$fila, 'Septiembre');

if($enableMonth[10])
$objPHPExcel->getActiveSheet(0)->setCellValue('K'.$fila, 'Octubre');

if($enableMonth[11])
$objPHPExcel->getActiveSheet(0)->setCellValue('L'.$fila, 'Noviembre');

if($enableMonth[12])
$objPHPExcel->getActiveSheet(0)->setCellValue('M'.$fila, 'Diciembre');

$fila++;


if($data)
{
    while($row = $data->fetch_object())
    {
        $row = (object) $row;
            $objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, strval($row->id."-".$row->nombre));
            if($enableMonth[1])
            $objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, strval($row->enero == null ? 0 : $row->enero));

            if($enableMonth[2])
            $objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, strval($row->febrero == null ? 0 : $row->febrero));

            if($enableMonth[3])
            $objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, strval($row->marzo == null ? 0 : $row->marzo));

            if($enableMonth[4])
            $objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, strval($row->abril == null ? 0 : $row->abril));

            if($enableMonth[5])
            $objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, strval($row->mayo == null ? 0 : $row->mayo));

            if($enableMonth[6])
            $objPHPExcel->getActiveSheet(0)->setCellValue('G'.$fila, strval($row->junio == null ? 0 : $row->junio));

            if($enableMonth[7])
            $objPHPExcel->getActiveSheet(0)->setCellValue('H'.$fila, strval($row->julio == null ? 0 : $row->julio));

            if($enableMonth[8])
            $objPHPExcel->getActiveSheet(0)->setCellValue('I'.$fila, strval($row->agosto == null ? 0 : $row->agosto));

            if($enableMonth[9])
            $objPHPExcel->getActiveSheet(0)->setCellValue('J'.$fila, strval($row->septiembre == null ? 0 : $row->septiembre));

            if($enableMonth[10])
            $objPHPExcel->getActiveSheet(0)->setCellValue('K'.$fila, strval($row->octubre == null ? 0 : $row->octubre));

            if($enableMonth[11])
            $objPHPExcel->getActiveSheet(0)->setCellValue('L'.$fila, strval($row->noviembre == null ? 0 : $row->noviembre));

            if($enableMonth[12])
            $objPHPExcel->getActiveSheet(0)->setCellValue('M'.$fila, strval($row->diciembre == null ? 0 : $row->diciembre));
            
            $fila++;
    }
}

/**End Contenido */

//Header
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L &C '.COMPANY.' &R Doc Gen: '.date("Y-m-d H:i:s"));
// Pie de Página
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R Página:&P / &N');
//Size columnas
for ($i=0; $i < count($columna); $i++)
{
    $columnID = $columna[$i];
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
}

$objPHPExcel->getActiveSheet()->setTitle('Tarjetas Activas');

header('Content-Type: application/vnd.openXMLformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Listado_de_tarjetas_activas_'.$year.'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;

?>
