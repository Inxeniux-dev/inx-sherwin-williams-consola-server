<?php

/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
/** Clases necesarias */
require_once($this->PATH.'libs/EXCEL/PHPExcel.php');
require_once($this->PATH.'libs/EXCEL/PHPExcel/Reader/Excel2007.php');

$objPHPExcel = new PHPExcel();
$objPHPExcel->getActiveSheet(0)->getStyle('A3:H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet(0)->getStyle('A3:H3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->getStyle('A3:H3')->getAlignment()->setWrapText(true);

$columna     = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H');

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

$sheet->mergeCells('B1:E1');
$sheet->getStyle('B1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet(0)->setCellValue('B1', "LISTADO DE CLIENTES");

$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Calibri');
$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(8);

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->getAlignment()->setWrapText(true);

$fila = 3;

/**Contenido */
$sheet->getStyle('A'.$fila.':I'.$fila)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, 'Id');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, 'Rfc');
$objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, 'Cliente');
$objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, 'Email');
$objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, 'Teléfono');
$objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, 'Saldo');
$objPHPExcel->getActiveSheet(0)->setCellValue('G'.$fila, 'No Cred');
$objPHPExcel->getActiveSheet(0)->setCellValue('H'.$fila, 'Descuento');
$fila++;


if($data)
{
  $total = 0;
  while($row = $data->fetch_object())
  {
        $nombre = $row->TIPO == 1 ? $row->NOMBRE." ".$row->APELLIDO : $row->RAZON_SOCIAL;

        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        $objPHPExcel->getActiveSheet()->getStyle('D'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, $row->IDCLIENTE);
        $objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, $row->RFC);
        $objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, $nombre);
        $objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, $row->EMAIL);
        $objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, $row->TELEFONO);
        $objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, number_format($row->SALDO,2));
        $objPHPExcel->getActiveSheet(0)->setCellValue('G'.$fila, number_format($row->NUM_CREDITO,2));
        $objPHPExcel->getActiveSheet(0)->setCellValue('H'.$fila, number_format($row->DESCUENTO,2));

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

$objPHPExcel->getActiveSheet()->setTitle('Listado de Clientes');

header('Content-Type: application/vnd.openXMLformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Listado_de_clientes'.$date.'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;

?>
