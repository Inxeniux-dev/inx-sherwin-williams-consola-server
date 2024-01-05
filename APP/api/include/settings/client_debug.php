<?php


if(!$_SESSION["permissions"][71]->status) {  echo json_encode(["code" => 200, "error" => ["No tienes permisos para realizar esta operación"]]); return; }


if(!isset($_FILES["file"]))
{
    echo json_encode(["code" => 200, "error" => ["Debe de cargar el archivo para depurar"]]); return; 
}


$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

if(in_array($_FILES["file"]["type"], $allowedFileType)){

  if (move_uploaded_file($_FILES["file"]["tmp_name"], "C:/Pruebas/".$_FILES['file']['name'])) {
   $archivo = "C:/Pruebas/".$_FILES['file']['name'];


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
    for ($row = 2; $row <= $highestRow; $row++){
        $rfc = $sheet->getCell("A".$row)->getValue();
        $name =  $sheet->getCell("B".$row)->getValue();
        $data[] = ["rfc" => $rfc, "name" => $name, "status" => false];
    }


    $clientModel = new CustomerModel();

    foreach ($data as $key => $value) {
        $value = to_object($value);
        $client = $clientModel->getClientByRFC($value->rfc);

        if($client)
        {
            while($row = $client->fetch_object())
            {
               $dataClient = $row;
               $response = $clientModel->dataClientById($dataClient->idcliente);

               if($response == 0)
               {
                  $data[$key]["status"] = true;
               }
            }
        }
    }


    $output = '<table class = "table table-hover">
                  <thead>
                      <th>RFC</th>
                      <th>Nombre o Razón</th>
                      <th>Estatus</th>
                  </thead>
                  <tbody>';

    $count_confirm = 0;
    foreach ($data as $key => $value) {
          $value = to_object($value);

          $icon = $value->status ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-exclamation-circle text-danger"></i>';
          if($value->status) { $count_confirm ++; }

          $output.= '<tr>
                        <td>'.$value->rfc.'</td>
                        <td>'.$value->name.'</td>
                        <td>'.$icon.'</td>
                    </tr>';
    }


    $output .= '</tbody></table>';


    $output .= '<div class = "mt-2">
                    <h5><b>Únicamente los clientes con el símbolo <i class="fas fa-check-circle text-success"></i> podrán ser depurados.</b></h5>
                </div>';

    $output .= '<div class = "mt-2">
                    <h5>En total se van a depurar <b>'.number_format($count_confirm,0).'</b> cliente(s)</h5>
                </div>';

   echo json_encode(["code" => 201, "data" => $output, "btn" => $count_confirm]);
   return;
  } else {
      echo json_encode(["code" => 200, "error" => ["Error al procesar el archivo, verifique el formato indicado"]]); return; 
  }

}

 echo json_encode(["code" => 200, "error" => ["Debe de cargar un archivo con el formato especificado"]]); return; 

?>
