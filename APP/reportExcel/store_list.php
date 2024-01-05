<?php

/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
/** Clases necesarias */
require_once($this->PATH.'libs/EXCEL/PHPExcel.php');
require_once($this->PATH.'libs/EXCEL/PHPExcel/Reader/Excel2007.php');

$objPHPExcel = new PHPExcel();
$columna     = array('A', 'B', 'C', 'D', 'E', 'F');

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

$sheet->mergeCells('A1:F1');
$sheet->getStyle('A1')->applyFromArray($styleArray);

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:F1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:F1')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet(0)->setCellValue('A1', "LISTADO DE SUCURSALES");

$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Calibri');
$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(8);

/**Contenido */
$objPHPExcel->getActiveSheet(0)->getStyle('A3:F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet(0)->getStyle('A3:F3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->getStyle('A3:F3')->getAlignment()->setWrapText(true);

$fila = 3;

$sheet->getStyle('A'.$fila.':G'.$fila)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, 'Sucursal');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, 'Versión');
$objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, 'Tipo');
$objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, 'Serie');
$objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, 'Ip Remota');
$objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, 'F. Actua');
$fila++;


if($data)
{
  $total = 0;
  while($row = $data->fetch_object())
  {
    if($row->status == 1)
    {
          $objPHPExcel->getActiveSheet()->getStyle('A'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
          $objPHPExcel->getActiveSheet()->getStyle('B'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
          $objPHPExcel->getActiveSheet()->getStyle('C'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
          $objPHPExcel->getActiveSheet()->getStyle('D'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
          $objPHPExcel->getActiveSheet()->getStyle('E'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
          $objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

          $version = $row->version == 0 ? 'Antiguo PDV' :  'Nuevo PDV';
          $tipo = "Tienda";
          if($row->almacen == 1){
              $tipo = 'Almacén';
              $version = $row->version == 0 ? 'Almacén' : 'Nuevo Almacén';
          }
          if($row->almacen == 3){ $tipo = 'Auditoría'; }


          if($row->version == 1)
          {
            $objPHPExcel->getActiveSheet(0)->getStyle('B'.$fila)->getFont()->setBold(true);
          }

          $objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, addCeros($row->idsucursal)."-".$row->nombre);
          $objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, $version);
          $objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, $tipo);
          $objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, $row->serie);
          $objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, $row->ip);
          $objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, $row->update_at);
          $fila++;
      }
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

$objPHPExcel->getActiveSheet()->setTitle('Listado de Sucursales');

header('Content-Type: application/vnd.openXMLformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Listado_de_sucursales'.$date.'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;

?>
