<?php 

$id_user = isset($_POST["id_user"]) ? $_POST["id_user"] : 0;

$res = $userModel->del_user($id_user);
$err = $res ? [] : ["Error al eliminar usuario"];

echo json_encode(["code" => 200, "status" => $res, "error" => [$err]]); return;

?>
