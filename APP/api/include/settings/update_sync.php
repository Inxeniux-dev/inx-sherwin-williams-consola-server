<?php
$sync_lines = isset($_POST["sync_lines"]) ? $_POST["sync_lines"] : 0;
$sync_cards = isset($_POST["sync_cards"]) ? $_POST["sync_cards"] : 0;
$sync_users = isset($_POST["sync_users"]) ? $_POST["sync_users"] : 0;
$sync_stores = isset($_POST["sync_stores"]) ? $_POST["sync_stores"] : 0;
$sync_sellers = isset($_POST["sync_sellers"]) ? $_POST["sync_sellers"] : 0;

$model->sync_lines = $sync_lines;
$model->sync_cards = $sync_cards;
$model->sync_users = $sync_users;
$model->sync_stores = $sync_stores;
$model->sync_sellers = $sync_sellers;

$response = $model->updateSync();
$code = $response > 0 ? 201 : 200;
$error = $response ? [] : ["Error al actualizar información"];
echo json_encode(["code" => $code, "error" => $error]);
return;
?>


?>
