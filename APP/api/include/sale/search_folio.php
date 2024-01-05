<?php 

    $type = isset($_POST["type"]) ? $_POST["type"] : 0;
    $folio = isset($_POST["folio"]) ? $_POST["folio"] : 0;

    if($type == 0 || $folio == 0)
    {
        echo json_encode(["code" => 200, "status" => 200]); return;
    }

    $data = null;

    if($type == 1)
    {
         $data = $model->getDataByFol($folio);
    }
    if($type == 2)
    {
        $data = $model->getDataByFactura($folio);
    }
    
    if($data == null || $data->num_rows == 0)
    {
        echo json_encode(["code" => 200, "status" => 200, "error" => ["Folio no encontrado"]]); return;
    }
    
    $data = $data->fetch_object();
    echo json_encode(["code" => 200, "status" => 201, "id" => $data->idventa]); return;
?>