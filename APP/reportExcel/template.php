<?php

/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
/** Clases necesarias */
require_once($this->PATH.'libs/EXCEL/PHPExcel.php');
require_once($this->PATH.'libs/EXCEL/PHPExcel/Reader/Excel2007.php');


$objPHPExcel = new PHPExcel();
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(false);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(3);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(1);

$objPHPExcel->getActiveSheet(0)->getStyle('A3:D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet(0)->getStyle('A3:D3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->getStyle('A3:D3')->getAlignment()->setWrapText(true);

$columna     = array('A', 'B', 'C', 'D','E', 'F');

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
$objPHPExcel->getActiveSheet(0)->setCellValue('A1', "HISTORIAL DE CONVERSIONES DEL ".fechaCorta($date_ini)." AL ".fechaCorta($date_ini));

$objPHPExcel->
    getProperties()
        ->setCreator("Punto de Venta Web") 						// Autores
        ->setLastModifiedBy("Punto de Venta Web") 				// Guardado por
        ->setTitle("Reporte No ")								// Titulo
        ->setSubject("Documento de prueba")						// Asunto
        ->setDescription("Reporte: ") 							// Comentario
        ->setKeywords("Reporte") 								// Etiquetas
        ->setCategory("reportes");

$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Calibri');
$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(8);

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(false);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(3);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(1);

$objPHPExcel->getActiveSheet(0)->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:F1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:F1')->getAlignment()->setWrapText(true);

$fila = 4;

if($data)
{

  $data = to_object($data);
  $fecha = '';
  $total_global_entrada = 0;
  $count_entrada_global = 0;
  $total_global_salida = 0;
  $count_salida_global = 0;

  foreach ($data as $key => $value) {

      if($fecha != substr($value->fecha, 0, 10))
      {
          $sheet->mergeCells('A'.$fila.':C'.$fila);
          $objPHPExcel->getActiveSheet(0)->getStyle('A'.$fila)->getFont()->setBold(true);
          $objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, "CONVERSIONES DEL ".strtoupper(fechaCastellanoSinDate($value->fecha)));
          $fecha = substr($value->fecha, 0, 10);
          $fila++;
      }

      $sheet->mergeCells('A'.$fila.':C'.$fila);
      $objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, "Folio conversión: ".$value->folio);
      $fila++;


      $objPHPExcel->getActiveSheet(0)->getStyle('A'.$fila.':F'.$fila)->getFont()->setBold(true);
      $objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, "MOV");
      $objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, "CODIGO");
      $objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, "DESCRIPCION");
      $objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, "ARTS");
      $objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, "PRECIO");
      $objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, "TOTAL");
      $fila++;

      $entradas = $value->entradas;
      $total_entrada = 0;
      $count_entrada = 0;
      foreach ($entradas as $k => $v) {
          $objPHPExcel->getActiveSheet(0)->getStyle('D'.$fila.':F'.$fila)->getNumberFormat()->setFormatCode("#,##0.00");
          $objPHPExcel->getActiveSheet(0)->getStyle('D'.$fila.':F'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
          $objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, "Entrada");
          $objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, $v->codigo);
          $objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, $v->descripcion);
          $objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, $v->cantidad);
          $objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, "$".number_format($v->precio,2));
          $objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, "$".number_format(($v->precio * $v->cantidad), 2));

          $total_entrada += ($v->precio * $v->cantidad);
          $count_entrada += $v->cantidad;

          $total_global_entrada += ($v->precio * $v->cantidad);
          $count_entrada_global += $v->cantidad;
          $fila++;
      }



      $salidas = $value->salidas;
      $total_salida = 0;
      $count_salida = 0;
      foreach ($salidas as $k => $v) {
          $objPHPExcel->getActiveSheet(0)->getStyle('D'.$fila.':F'.$fila)->getNumberFormat()->setFormatCode("#,##0.00");
          $objPHPExcel->getActiveSheet(0)->getStyle('D'.$fila.':F'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
          $objPHPExcel->getActiveSheet(0)->setCellValue('A'.$fila, "Entrada");
          $objPHPExcel->getActiveSheet(0)->setCellValue('B'.$fila, $v->codigo);
          $objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, $v->descripcion);
          $objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, $v->cantidad);
          $objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, "$".number_format($v->precio,2));
          $objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, "$".number_format(($v->precio * $v->cantidad),2));

          $total_salida += ($v->precio * $v->cantidad);
          $count_salida += $v->cantidad;

          $total_global_salida += ($v->precio * $v->cantidad);
          $count_salida_global += $v->cantidad;
          $fila++;
      }

      $fila++;


      $objPHPExcel->getActiveSheet(0)->getStyle('E'.$fila.':F'.$fila)->getNumberFormat()->setFormatCode("#,##0.00");
      $objPHPExcel->getActiveSheet(0)->getStyle('E'.$fila.':F'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
      $objPHPExcel->getActiveSheet(0)->getStyle('D'.$fila.':F'.$fila)->getFont()->setBold(true);
      $objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, "Entradas Conv");
      $objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, $count_entrada);
      $objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, "$".number_format($total_entrada,2));
      $fila++;

      $objPHPExcel->getActiveSheet(0)->getStyle('E'.$fila.':F'.$fila)->getNumberFormat()->setFormatCode("#,##0.00");
      $objPHPExcel->getActiveSheet(0)->getStyle('E'.$fila.':F'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
      $objPHPExcel->getActiveSheet(0)->getStyle('D'.$fila.':F'.$fila)->getFont()->setBold(true);
      $objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, "Salidas Conv");
      $objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, $count_salida);
      $objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, "$".number_format($total_salida,2));
      $fila++;

      $objPHPExcel->getActiveSheet(0)->getStyle('E'.$fila.':F'.$fila)->getNumberFormat()->setFormatCode("#,##0.00");
      $objPHPExcel->getActiveSheet(0)->getStyle('E'.$fila.':F'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
      $objPHPExcel->getActiveSheet(0)->getStyle('D'.$fila.':F'.$fila)->getFont()->setBold(true);
      $objPHPExcel->getActiveSheet(0)->setCellValue('D'.$fila, "Diferencia Conv");
      $objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, $count_salida);
      $objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, "$".number_format(($total_entrada-$total_salida),2));
      $fila++;
  }
}


$fila++;
$fila++;


$objPHPExcel->getActiveSheet(0)->getStyle('E'.$fila.':F'.$fila)->getNumberFormat()->setFormatCode("#,##0.00");
$objPHPExcel->getActiveSheet(0)->getStyle('E'.$fila.':F'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet(0)->getStyle('D'.$fila.':F'.$fila)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, "Total Entradas Conv");
$objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, $count_entrada_global);
$objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, "$".number_format($total_global_entrada,2));
$fila++;

$objPHPExcel->getActiveSheet(0)->getStyle('E'.$fila.':F'.$fila)->getNumberFormat()->setFormatCode("#,##0.00");
$objPHPExcel->getActiveSheet(0)->getStyle('E'.$fila.':F'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet(0)->getStyle('D'.$fila.':F'.$fila)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, "Total Salidas Conv");
$objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, $count_salida_global);
$objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, "$".number_format($total_global_salida,2));
$fila++;

$objPHPExcel->getActiveSheet(0)->getStyle('E'.$fila.':F'.$fila)->getNumberFormat()->setFormatCode("#,##0.00");
$objPHPExcel->getActiveSheet(0)->getStyle('E'.$fila.':F'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet(0)->getStyle('D'.$fila.':F'.$fila)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet(0)->setCellValue('C'.$fila, "Total Diferencia Conv");
$objPHPExcel->getActiveSheet(0)->setCellValue('E'.$fila, "");
$objPHPExcel->getActiveSheet(0)->setCellValue('F'.$fila, "$".number_format(($total_global_entrada-$total_global_salida),2));
$fila++;



/**End Contenido */

//Header
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L '.$_SESSION["config"]["razon"].' &C Listado de depositos '.fechaCorta($date).' &R '.$_SESSION["config"]["date_corte"]);
// Pie de Página
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R Página:&P / &N');
//Size columnas
for ($i=0; $i < count($columna); $i++)
{
    $columnID = $columna[$i];
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
}

$objPHPExcel->getActiveSheet()->setTitle('Listado de Conversiones');

header('Content-Type: application/vnd.openXMLformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="listado_de_conversiones.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;

?>
