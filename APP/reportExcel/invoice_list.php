<?php

/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
/** Clases necesarias */
require_once($this->PATH.'libs/EXCEL/PHPExcel.php');
require_once($this->PATH.'libs/EXCEL/PHPExcel/Reader/Excel2007.php');
require_once($this->PATH.'libs/styles.php');

$objPHPExcel = new PHPExcel();

$tituloReporte = strtoupper($proveedor->razon_social);
$titulosColumnas = array('Fecha', 'Fecha Factura', 'Doc','Folio', 'Importe Factura', 'Importe Venta', 'Fecha Pago', 'Margen');

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:G1');
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:D2');


		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					      ->setCellValue('A1', $tituloReporte)
                ->setCellValue('A2',  "Almacén: ". $almacen->clave."-".$almacen->nombre)
        		    ->setCellValue('A4',  $titulosColumnas[0])
		            ->setCellValue('B4',  $titulosColumnas[1])
                ->setCellValue('C4',  $titulosColumnas[2])
        		    ->setCellValue('D4',  $titulosColumnas[3])
            		->setCellValue('E4',  $titulosColumnas[4])
            		->setCellValue('F4',  $titulosColumnas[5])
            		->setCellValue('G4',  $titulosColumnas[6])
            		->setCellValue('H4',  $titulosColumnas[7]);

        //Se agregan los datos de los alumnos
		$i = 5;
		$total_facturas=0;
    $tota_prec_venta=0;
		while($row = $data->fetch_object()){

      $margen = $row->total_venta > 0 ? (($row->total_costo/$row->total_venta) * 100) : 0;
			$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue('A'.$i,  $row->fecha_corte)
								->setCellValue('B'.$i,  $row->fecha_factura)
                ->setCellValue('C'.$i,  $row->folio)
								->setCellValue('D'.$i,  $row->factura)
								->setCellValue('E'.$i,  number_format($row->total_costo ,2))
								->setCellValue('F'.$i,  number_format($row->total_venta, 2))
								->setCellValue('G'.$i,  $row->fecha_pago)
								->setCellValue('H'.$i,  truncateFloat($margen,2)."%");
					$i++;
					$total_facturas += $row->total_costo;
          $tota_prec_venta += $row->total_venta;
    }

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i,number_format($total_facturas,2,".",","));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i,number_format($tota_prec_venta,2,".",","));

		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Compras');




		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A4:H4')->applyFromArray($estiloTituloColumnas);
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A5:H".($i-1));
		$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':H'.$i)->applyFromArray($estiloTituloFooter);

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		//$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);


			$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L GRUPO COMERCIAL HYDRA SA DE CV &C Listado de Facturas &R '.date("Y-m-d H:i:s"));

			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
      $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(7);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(7);


		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Listado_de_facturas_'.date("Ymd_His").'.xls"');
        header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');


	function truncateFloat($number, $digitos)
	{
	    $raiz = 10;
	    $multiplicador = pow ($raiz,$digitos);
	    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
	    return number_format($resultado, $digitos);

	}
?>
