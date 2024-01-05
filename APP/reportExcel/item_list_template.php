<?php

/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
/** Clases necesarias */
require_once($this->PATH.'libs/EXCEL/PHPExcel.php');
require_once($this->PATH.'libs/EXCEL/PHPExcel/Reader/Excel2007.php');

$objPHPExcel = new PHPExcel();
$columna     = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O');

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

$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Calibri');
$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(8);

$fila = 1;
/**Contenido */
$sheet->getStyle('A'.$fila.':O'.$fila)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, 'cod bar');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, 'codigo');
$objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, 'descripcion');
$objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, 'precio');
$objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, 'precio_especial');
$objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, 'es base (1=SI, 0=NO)');
$objPHPExcel->getActiveSheet(0)->setCellValue('G'.$fila, 'descuento');
$objPHPExcel->getActiveSheet(0)->setCellValue('H'.$fila, 'fecha_inicial');
$objPHPExcel->getActiveSheet(0)->setCellValue('I'.$fila, 'fecha_final');
$objPHPExcel->getActiveSheet(0)->setCellValue('J'.$fila, 'clave_sat');
$objPHPExcel->getActiveSheet(0)->setCellValue('K'.$fila, 'idlinea');
$objPHPExcel->getActiveSheet(0)->setCellValue('L'.$fila, 'idcapacidad');
$objPHPExcel->getActiveSheet(0)->setCellValue('M'.$fila, 'peso');
$objPHPExcel->getActiveSheet(0)->setCellValue('N'.$fila, 'codigo_asociado');
$objPHPExcel->getActiveSheet(0)->setCellValue('O'.$fila, 'idmarca');
$fila++;


if($data)
{
  $total = 0;
  while($row = $data->fetch_object())
  {
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':M'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, strval($row->barcode));
        $objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, strval($row->codigo));
        $objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, substr(trim($row->descripcion), 0, 38));
        $objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, $row->precio);
        $objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, $row->precio_especial);
        $objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, $row->es_base);
        $objPHPExcel->getActiveSheet(0)->setCellValue('G'.$fila, $row->descuento);
        $objPHPExcel->getActiveSheet(0)->setCellValue('H'.$fila, $row->fechini);
        $objPHPExcel->getActiveSheet(0)->setCellValue('I'.$fila, $row->fechfin);
        $objPHPExcel->getActiveSheet(0)->setCellValue('J'.$fila, $row->clave_sat);
        $objPHPExcel->getActiveSheet(0)->setCellValue('K'.$fila, $row->idlinea);
        $objPHPExcel->getActiveSheet(0)->setCellValue('L'.$fila, $row->idcapacidad);
        $objPHPExcel->getActiveSheet(0)->setCellValue('M'.$fila, $row->peso);
        $objPHPExcel->getActiveSheet(0)->setCellValue('N'.$fila, $row->codigo_asociado);
        $objPHPExcel->getActiveSheet(0)->setCellValue('O'.$fila, $row->idmarca);
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

$objPHPExcel->getActiveSheet()->setTitle('Template');

header('Content-Type: application/vnd.openXMLformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Plantilla_de_carga_'.$date.'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;

?>
