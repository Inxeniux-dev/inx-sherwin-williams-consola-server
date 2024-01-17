<?php

if(!isset($_FILES["file"]))
{
    echo json_encode(["code" => 200, "error" => ["Debe de cargar el archivo de descuentos de refuerzo"]]); return;
}


$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

if(in_array($_FILES["file"]["type"], $allowedFileType)){

  if (move_uploaded_file($_FILES["file"]["tmp_name"], "C:/console/".$_FILES['file']['name'])) {
   $archivo = "C:/console/".$_FILES['file']['name'];


   /** Incluir la ruta **/
   set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
   /** Clases necesarias */
   $PATH = $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/APP/";
   require_once($PATH.'libs/EXCEL/PHPExcel.php');
   require_once($PATH.'libs/EXCEL/PHPExcel/Reader/Excel2007.php');

    $inputFileType = PHPExcel_IOFactory::identify($archivo);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($archivo);
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();


    $num=0;
    $data = [];

    $update_at = date("Y-m-d H:i:s");
    
    for ($row = 2; $row <= $highestRow; $row++){
        $codigo = $sheet->getCell("A".$row)->getValue();
        $descripcion =  $sheet->getCell("B".$row)->getValue();
        $descuento =  $sheet->getCell("C".$row)->getValue();
        $fechini =  $sheet->getCell("D".$row)->getValue();
        $fechfin =  $sheet->getCell("E".$row)->getValue();
        $sucursales = $sheet->getCell("F".$row)->getValue();

        $descuento = null ? 0 : $descuento;
        $descuento = strlen($descuento) == 0 ? 0 : $descuento;

        $fechini = null ? 0 : $fechini;
        $fechini = strlen($fechini) == 0 ? date("Y-m-d") : $fechini;

        $fechfin = null ? 0 : $fechfin;
        $fechfin = strlen($fechfin) == 0 ? date("Y-m-d") : $fechfin;

        $response = $model->add_discount_reforcement($codigo, $descuento, $fechini, $fechfin, $update_at, $sucursales);

        if(!$response)
        {
          $error++;
          break;
        }
    }

   $status = $error > 0 ? false : true;
   $error = $error > 0 ? ["Error al registrar los descuentos, código: ".$codigo] : [];

   echo json_encode(["code" => 201, "status" => $status, "error" => $error]);
   return;
  } else {
      echo json_encode(["code" => 200, "error" => ["Error al procesar el archivo, verifique el formato indicado"]]); return;
  }

}

 echo json_encode(["code" => 200, "error" => ["Debe de cargar un archivo con el formato especificado"]]); return;

?>
