<?php

/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
/** Clases necesarias */
require_once($this->PATH.'libs/EXCEL/PHPExcel.php');
require_once($this->PATH.'libs/EXCEL/PHPExcel/Reader/Excel2007.php');

$objPHPExcel = new PHPExcel();
$columna     = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I');

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

$sheet->mergeCells('A1:I1');
$sheet->getStyle('A1')->applyFromArray($styleArray);

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:I1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:I1')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet(0)->setCellValue('A1', "LISTADO DE TRANSFERENCIAS BANCARIAS DEL ".fechaCortaAbreviada($fech_ini)." AL ".fechaCortaAbreviada($fech_fin));

$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Calibri');
$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(8);

/**Contenido */
$objPHPExcel->getActiveSheet(0)->getStyle('A3:I3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet(0)->getStyle('A3:I3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->getStyle('A3:I3')->getAlignment()->setWrapText(true);

$fila = 3;

$sheet->getStyle('A'.$fila.':G'.$fila)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, 'Sucursal');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, 'Importe');
$objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, 'Cuenta');
$objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, 'No Aut');
$objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, 'F Transferencia');
$objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, 'F Solicitud');
$objPHPExcel->getActiveSheet(0)->setCellValue('G'.$fila, 'F Contabilidad');
$objPHPExcel->getActiveSheet(0)->setCellValue('H'.$fila, 'F Encargado');
$objPHPExcel->getActiveSheet(0)->setCellValue('I'.$fila, 'Estatus');

$fila++;

print_r($data);

if($data)
{
  $total = 0;
  while($row = $data->fetch_object())
  {
   
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$fila.":I".$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    $msg_status = $row->status == 3 ? "Pendiente" : "Cancelado";
    if($row->status == 0 || $row->status == 1) { 
        $msg_status = $row->status == 1 ? "Confirmado" : 'Finalizado';
    }

    $fecha_confirmacion = $row->fecha_confirmacion == "0000-00-00 00:00:00" ? "" : fechaCortaAbreviadaConHora($row->fecha_confirmacion);
    $fecha_confirmacion_store = ($row->fecha_confirmacion_store == "0000-00-00 00:00:00" || $row->fecha_confirmacion_store == null) ? "" : fechaCortaAbreviadaConHora($row->fecha_confirmacion_store);

          
          $objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, addCeros($row->idsucursal)."-".$row->nombre);
          $objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, number_format($row->importe, 2));
          $objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, $row->banco."_".$row->cuenta);
          $objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, $row->referencia);
          $objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, fechaCortaAbreviada($row->fecha_transferencia));
          $objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, fechaCortaAbreviadaConHora($row->create_at));
          $objPHPExcel->getActiveSheet(0)->setCellValue('G'.$fila, trim($fecha_confirmacion));
          $objPHPExcel->getActiveSheet(0)->setCellValue('H'.$fila, trim($fecha_confirmacion_store));
          $objPHPExcel->getActiveSheet(0)->setCellValue('I'.$fila, $msg_status);
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

$objPHPExcel->getActiveSheet()->setTitle('Listado de Transferencias');

header('Content-Type: application/vnd.openXMLformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Listado_de_transferencias'.$date.'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;

?>
