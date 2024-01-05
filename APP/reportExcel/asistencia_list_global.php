<?php

/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
/** Clases necesarias */
require_once($this->PATH.'libs/EXCEL/PHPExcel.php');
require_once($this->PATH.'libs/EXCEL/PHPExcel/Reader/Excel2007.php');

$objPHPExcel = new PHPExcel();
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

$sheet->mergeCells('A1:G1');
$sheet->getStyle('A1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet(0)->setCellValue('A1', "LISTADO DE ASISTENCIA GLOBAL DEL MES ".name_mes($mes)." DEL ".$anio);

$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Calibri');
$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(9);

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->getAlignment()->setWrapText(true);

$fila = 3;

/**Contenido */
$sheet->getStyle('A'.$fila.':AZ'.$fila)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, 'VA');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, '#');
$objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, 'NOMBRE');

$index  = 4;
foreach ($encabezados as $key => $value) {
    $value = to_object($value);
    $INDICE = genera_letra_celda($index);
    $objPHPExcel->getActiveSheet(0)->setCellValue($INDICE.$fila, $value->nombre." ".$value->numero);
    $index++;
}

$INDICE = genera_letra_celda($index);
$objPHPExcel->getActiveSheet(0)->setCellValue($INDICE.$fila, "Re");
$index++;

$INDICE = genera_letra_celda($index);
$objPHPExcel->getActiveSheet(0)->setCellValue($INDICE.$fila, "Min");
$index++;

$INDICE = genera_letra_celda($index);
$objPHPExcel->getActiveSheet(0)->setCellValue($INDICE.$fila, "Va");
$index++;

$fila++;

$ULT_INDICE = "AZ";
foreach ($data_procesada as $key => $value) {
      $value = to_object($value);

      $objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, $value->no_empleado);
      $objPHPExcel->getActiveSheet(0)->getStyle('C'.$fila)->getFont()->setBold(true);
      $objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, $value->nombre);

      $index  = 4;
      $count = count($value->dias);
      $i = 0;
      foreach ($value->dias as $k => $val) {
          $asistencia = to_object($val)->asistencia;

          if($count ==  ($i + 1)){
             $objPHPExcel->getActiveSheet(0)->setCellValue("A".$fila, $asistencia->hora);
          }
          else{
            $LETRA = genera_letra_celda($index);
            $objPHPExcel->getActiveSheet(0)->setCellValue($LETRA.$fila, $asistencia->hora);
          }

          $index++;
          $i++;
      }

      $fila++;
}



$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray( array(
    'font' => array(
        'size' => '9',
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'borders' => array(
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE ,
      'color' => array(
              'rgb' => '3a2a47'
            )
        )
    ),
    'alignment' =>  array(
    'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
    'vertical'  => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
    'wrap'      => TRUE
    )
));

/**End Contenido */

$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:AZ".($fila-1));
//Header
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L &C '.COMPANY.' &R Doc Gen: '.date("Y-m-d H:i:s"));
// Pie de Página
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R Página:&P / &N');
//Size columnas

$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);


$objPHPExcel->getActiveSheet()->setTitle('Asistencia Global');

header('Content-Type: application/vnd.openXMLformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Listado_de_asiscencia_global_'.$mes.'_'.$anio.'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;

?>
