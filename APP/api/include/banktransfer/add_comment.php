<?php 

$id = isset($_POST["idtransfer"]) ? trim($_POST["idtransfer"]) : '';
$comment = isset($_POST["comment"]) ? trim($_POST["comment"]) : '';

if($id == "" || strlen($id) == 0 || !is_numeric($id)){ echo json_encode(["code" => 200, "error" => ["Transferencia no identificada"]]); return; }
if($comment == "" || strlen($comment) == 0){ echo json_encode(["code" => 200, "error" => ["El comentario es requerido"]]); return; }


$model->comentarios = $comment;
$model->id = $id;
$response = $model->updateComment();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["Error al agregar el comentario"];
echo json_encode(["code" => $code, "error" => $error]);
return;
?>