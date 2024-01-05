<?php

$comentario = isset($_POST["comentario"]) ? $_POST["comentario"] : '';
$idsucursal = isset($_POST["idsucursal"]) ? $_POST["idsucursal"] : '';

if($idsucursal < 10)
{
  $idsucursal = str_replace('0', '', $idsucursal);
}

$file = new Files();

$mov_img = false;
$nombre_img = '';

if(isset($_FILES["file"]))
{
    if($_FILES["file"]["size"] > 10000000) { echo json_encode(["code" => 200, "error" => ["El tamaño de la imagen excede los 10mb"]]); return; }
    $filesPermitidos = ['image/jpeg', 'image/png'];
    if(in_array($_FILES["file"]["type"], $filesPermitidos)){
        $directorio = $_SERVER['DOCUMENT_ROOT'].'/server/uploads/imgs/';
        $nombre_img = time().rand(0,50).'.jpg';
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $directorio.$nombre_img)) {
            $mov_img = true;
        }
    }
    else { echo json_encode(["code" => 200, "error" => ["La imagen debe de ser en formato jpg"]]); return; }
}

$bug = new Incidencia();
$bug->comentario = $comentario;
$bug->path_img = $mov_img ? $nombre_img : '';
$bug->create_at = date('Y-m-d H:i:s');
$bug->idsucursal = $idsucursal;
$id = $bug->create();
if($id > 0)
{
  echo json_encode(["code"=> 201]); return;
}

echo json_encode(["code"=> 200, "error" => ["Error al realizar el proceso"]]); return;
?>
