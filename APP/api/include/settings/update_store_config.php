<?php
$points_for_money = isset($_POST["points_for_money"]) ? $_POST["points_for_money"] : 0;
$points_percentage = isset($_POST["points_percentage"]) ? $_POST["points_percentage"] : 0;

$model->points_for_money = $points_for_money;
$model->points_percentage = $points_percentage;

$response = $model->updateStoreConfig();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["Error al actualizar información"];
echo json_encode(["code" => $code, "error" => $error]);
return;
?>


?>
