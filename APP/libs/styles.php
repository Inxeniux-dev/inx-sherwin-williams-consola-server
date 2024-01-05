<?php


		$estiloTituloReporte = array(
		    'font' => array(
		        'name'      => 'Arial',
		        'bold'      => true,
		        'italic'    => false,
		        'strike'    => false,
		        'size' =>12,
		        'color'     => array(
		            'rgb' => '000000'
		        )
		    ),
		 /*   'fill' => array(
		      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
		  ),*/
		    'borders' => array(
		        'allborders' => array(
		            'style' => PHPExcel_Style_Border::BORDER_NONE
		        )
		    ),
		    'alignment' => array(
		        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		        'rotation' => 0,
		        'wrap' => TRUE
		    )
		);

		$estiloTituloColumnas = array(
		    'font' => array(
		        'name'  => 'Arial',
						'size' => '8',
		        'bold'  => false,
		        'color' => array(
		            'rgb' => '000000'
		        )
		    ),
				'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        ),
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        ),
				'right' => array(
						'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
						'color' => array(
								'rgb' => '143860'
						)
				),
				'left' => array(
						'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
						'color' => array(
								'rgb' => '143860'
						)
				)
    ),
				'alignment' =>  array(
        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap'      => TRUE
    		)
		);


    $estiloTituloFooter = array(
        'font' => array(
            'name'  => 'Arial',
            'size' => '8',
            'bold'  => false,
            'color' => array(
                'rgb' => '000000'
            )
        ),
        'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        ),
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        ),
				'right' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        ),
				'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        )
    ),
        'alignment' =>  array(
        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        'vertical'  => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        'wrap'      => TRUE
        )
    );


	$estiloInformacion = new PHPExcel_Style();
	$estiloInformacion->applyFromArray( array(
	    'font' => array(
	        'name'  => 'Arial',
					'size' => '8',
	        'color' => array(
	            'rgb' => '000000'
	        )
	    ),
	    'borders' => array(
	        'left' => array(
	            'style' => PHPExcel_Style_Border::BORDER_THIN ,
	      			'color' => array(
	              'rgb' => '3a2a47'
	            )
	        ),
					'right' => array(
	            'style' => PHPExcel_Style_Border::BORDER_THIN ,
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


?>
