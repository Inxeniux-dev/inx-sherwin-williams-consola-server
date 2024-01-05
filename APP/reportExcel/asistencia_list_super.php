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


$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray( array(
    'font' => array(
        'size' => '7',
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


$sheet->mergeCells('A1:G1');
$sheet->getStyle('A1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet(0)->setCellValue('A1', "LISTADO DE ASISTENCIA DE SUPERVISORES DEL ".fechaCortaAbreviada($fecha)." AL ".fechaCortaAbreviada($fechafin));

$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Calibri');
$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(8);

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->getAlignment()->setWrapText(true);

$fila = 3;

/**Contenido */
$sheet->getStyle('A'.$fila.':I'.$fila)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, 'NOMBRE');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, 'SUC BASE');
$objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, 'SUC REPORTE');
$objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, 'MOV');
$objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, 'FECHA');
$objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, 'HORA');
$objPHPExcel->getActiveSheet(0)->setCellValue('G'.$fila, 'OBSERVACION');
$fila++;

foreach ($asistencia as $key => $value) {
        $value = to_object($value);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet(0)->getStyle('A'.$fila)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, strtoupper($value->nombre));
        $fila++;

          foreach ($value->groupeddata as $k => $v) {

            $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, 'A'.$fila.":G".$fila);
            $sucursal_base = $v->suc_base == 0 ? 'MATRIZ' : $v->nombre_base;
            $minutos = diferencia_en_fechas(substr($v->date_store, 0, 10)." 08:00:00", $v->date_store);
            $concepto = $v->idconcepto == 3 ? 'Entrada' : 'Salida';
            $observacion = $minutos >= 6 ? "Retardo de ".convertirMinutosAHoras($minutos)."" : '';
            $observacion = $v->idconcepto == 3 ? $observacion : '';

            $observacion .= $v->suc_base != $v->idsucursal ? "La sucursal de reporte es diferente a la base ": "";

            $objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, strtoupper($value->nombre.' '.$v->apellido));
            $objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, strtoupper($sucursal_base));
            $objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, strtoupper($v->nombre_sucursal));
            $objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, $concepto);
            $objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, fechaCortaAbreviada($v->date_store));
            $objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, substr($v->date_store, 11));
            $objPHPExcel->getActiveSheet(0)->setCellValue('G'.$fila, $observacion);
            $fila++;

          }

         $fila++;
}



/**End Contenido */


//Header
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L &C '.COMPANY.' &R Doc Gen: '.date("Y-m-d H:i:s"));
// Pie de Página
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R Página:&P / &N');
//Size columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);




$objPHPExcel->getActiveSheet()->setTitle('Listado de Asistencia');

header('Content-Type: application/vnd.openXMLformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Listado_de_asiscencia_'.$date.'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;

?>
