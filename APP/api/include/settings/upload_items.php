<?php

if(!isset($_FILES["file"]))
{
    echo json_encode(["code" => 200, "error" => ["Debe de cargar el archivo para depurar"]]); return;
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

    $itemModel->cleanAll();
    for ($row = 2; $row <= $highestRow; $row++){
        $barcode = $sheet->getCell("A".$row)->getValue();
        $codigo =  $sheet->getCell("B".$row)->getValue();
        $descripcion =  $sheet->getCell("C".$row)->getValue();
        $precio =  $sheet->getCell("D".$row)->getValue();
        $precio_especial =  $sheet->getCell("E".$row)->getValue();
        $es_base =  $sheet->getCell("F".$row)->getValue();
        $descuento =  $sheet->getCell("G".$row)->getValue();
        $fechini =  $sheet->getCell("H".$row)->getValue();
        $fechfin =  $sheet->getCell("I".$row)->getValue();
        $clave_sat =  $sheet->getCell("J".$row)->getValue();
        $idlinea =  $sheet->getCell("K".$row)->getValue();
        $idcapacidad =  $sheet->getCell("L".$row)->getValue();
        $peso =  $sheet->getCell("M".$row)->getValue();
        $codigo_asociado =  $sheet->getCell("N".$row)->getValue();
        $idmarca =  $sheet->getCell("O".$row)->getValue();

        $barcode = null ? 0 : $barcode;
        $barcode = strlen($barcode) == 0 ? '' : $barcode;

        $precio = null ? 0 : $precio;
        $precio = strlen($precio) == 0 ? 0 : $precio;

        $precio_especial = null ? 0 : $precio_especial;
        $precio_especial = strlen($precio_especial) == 0 ? 0 : $precio_especial;

        $descuento = null ? 0 : $descuento;
        $descuento = strlen($descuento) == 0 ? 0 : $descuento;

        $fechini = null ? 0 : $fechini;
        $fechini = strlen($fechini) == 0 ? date("Y-m-d") : $fechini;

        $fechfin = null ? 0 : $fechfin;
        $fechfin = strlen($fechfin) == 0 ? date("Y-m-d") : $fechfin;

        $peso = null ? 0 : $peso;
        $peso = strlen($peso) == 0 ? 1 : $peso;

        $codigo_asociado = null ? 0 : $codigo_asociado;
        $codigo_asociado = strlen($codigo_asociado) == 0 ? "" : $codigo_asociado;

        $idmarca = null ? 0 : $idmarca;
        $idmarca = strlen($idmarca) == 0 ? "0" : $idmarca;

        $descripcion = eliminarDobleEspacios($descripcion);

        $response = $itemModel->add($codigo, $barcode, $descripcion, $clave_sat, $precio, $idlinea, $idcapacidad, $descuento, $fechini, $fechfin, $es_base, $precio_especial, $peso, $codigo_asociado, $idmarca);

        if(!$response)
        {
          $error++;
          break;
        }
    }

   $status = $error > 0 ? false : true;
   $error = $error > 0 ? ["Error al registrar productos, código: ".$codigo] : [];

   echo json_encode(["code" => 201, "status" => $status, "error" => $error]);
   return;
  } else {
      echo json_encode(["code" => 200, "error" => ["Error al procesar el archivo, verifique el formato indicado"]]); return;
  }

}

 echo json_encode(["code" => 200, "error" => ["Debe de cargar un archivo con el formato especificado"]]); return;

?>
