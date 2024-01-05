<?php
session_start();
require "../config/config.php";
require "../dao/Conection.php";
require "../utils/AppSettings.php";
require "../utils/AppUtils.php";

if(!isset($_GET["a"]))
{
    echo json_encode(["code" => 400, "message" => "Bad Request"]);
    return;
}

$action = $_GET["a"];

if(!isset($_SESSION["datauser"]["iduser"]) || $_SESSION["datauser"]["iduser"] <= 0)
{
    echo json_encode(["code" => 403, "message" => "Forbidden"]);
    return;
}

$permisos = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Sucursales;

require "../models/StoreModel.php";
$model = new StoreModel();

require "../services/StoreService.php";
$service = new StoreService();

switch ($action) {
    case 1:  /* LISTADO DE SUCURSALES */
        require("./include/store/list.php");
    break;
    case 2:  /* ACTUALIZA VERSION */
        require("./include/store/update_version.php");
    break;
    case 3:  /* EDITAR */
        require("./include/store/edit.php");
    break;
    case 4:  /* AGREGAR */
        require("./include/store/add.php");
    break;
    default:
        echo json_encode(["code" => 400, "message" => "Bad Request"]);
        return;
    break;
}

?>
