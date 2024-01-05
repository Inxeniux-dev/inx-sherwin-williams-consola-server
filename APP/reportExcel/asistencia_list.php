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

$sheet->mergeCells('A1:G1');
$sheet->getStyle('A1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet(0)->setCellValue('A1', "LISTADO DE ASISTENCIA DEL DIA ".fechaCortaAbreviada($fecha));

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


if($bitacora)
{
      $total = 0;
      while($row = $bitacora->fetch_object())
      {
            $objPHPExcel->getActiveSheet()->getStyle('A'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $concepto = $row->idconcepto == 3 ? 'Entrada' : 'Salida';
            $minutos = diferencia_en_fechas(substr($row->date_store, 0, 10)." 08:00:00", $row->date_store);
            $observacion = $minutos >= 6 ? "Retardo de ".convertirMinutosAHoras($minutos) : '';
            $observacion = $row->idconcepto == 3 ? $observacion : '';

            $observacion .= $row->suc_base != $row->idsucursal ? "\n La sucursal de reporte es diferente a la base ": "";
            $sucursal_base = $row->suc_base == 0 ? 'Matriz' : $row->nombre_base;

            $objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, strtoupper($row->nombre.' '.$row->apellido));
            $objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, strtoupper($sucursal_base));
            $objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, strtoupper($row->nombre_sucursal));
            $objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, $concepto);
            $objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, fechaCortaAbreviada($row->date_store));
            $objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, substr($row->date_store, 11));
            $objPHPExcel->getActiveSheet(0)->setCellValue('G'.$fila, $observacion);

            $fila++;
          }
}



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

/**End Contenido */

$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:G".($fila-1));
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
