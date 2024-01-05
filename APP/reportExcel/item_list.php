<?php

/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
/** Clases necesarias */
require_once($this->PATH.'libs/EXCEL/PHPExcel.php');
require_once($this->PATH.'libs/EXCEL/PHPExcel/Reader/Excel2007.php');

$objPHPExcel = new PHPExcel();
$objPHPExcel->getActiveSheet(0)->getStyle('A3:G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet(0)->getStyle('A3:G3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->getStyle('A3:G3')->getAlignment()->setWrapText(true);

$columna     = array('A', 'B', 'C', 'D', 'E', 'F', 'G');

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
$objPHPExcel->getActiveSheet(0)->setCellValue('B1', "LISTADO DE PRODUCTOS");

$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Calibri');
$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(8);

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->getAlignment()->setWrapText(true);

$fila = 3;

/**Contenido */
$sheet->getStyle('A'.$fila.':I'.$fila)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, 'Código');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, 'Descripción');
$objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, 'Precio');
$objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, 'Descuento');
$objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, 'Fech Ini');
$objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, 'Fech Fin');
$objPHPExcel->getActiveSheet(0)->setCellValue('G'.$fila, 'Linea');
$objPHPExcel->getActiveSheet(0)->setCellValue('H'.$fila, 'Clave SAT');
$objPHPExcel->getActiveSheet(0)->setCellValue('I'.$fila, 'Peso');
$fila++;


if($data)
{
  $total = 0;
  while($row = $data->fetch_object())
  {
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        $objPHPExcel->getActiveSheet()->getStyle('D'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, strval($row->codigo));
        $objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, substr(trim($row->descripcion), 0, 38));
        $objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, number_format($row->precio,2));
        $objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, number_format($row->descuento,0));
        $objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, $row->fechini);
        $objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, $row->fechfin);
        $objPHPExcel->getActiveSheet(0)->setCellValue('G'.$fila, substr($row->linea, 0, 14));
        $objPHPExcel->getActiveSheet(0)->setCellValue('H'.$fila, $row->clave_sat);
        $objPHPExcel->getActiveSheet(0)->setCellValue('I'.$fila, $row->peso);

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

$objPHPExcel->getActiveSheet()->setTitle('Listado de Productos');

header('Content-Type: application/vnd.openXMLformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Listado_de_productos'.$date.'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;

?>
