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

$permisos = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Tarjeta_Puntos;

require "../models/CardModel.php";
require "../models/CardBitacora.php";

$model = new CardModel();

switch ($action) {
    case 1:  /* LISTADO DE TARJETA PUNTOS */
        require("./include/card/list.php");
    break;
    case 2:  /* BITACORA DE PUNTOS */
        require("./include/card/bitacora.php");
    break;
    case 3:  /* AGREGAR MOVIMIENTO DE PUNTOS */
        require("./include/card/add_mov.php");
    break;
    case 4:  /* ACTUALIZAR STATUs*/
        require("./include/card/status_edit.php");
    break;
    default:
        echo json_encode(["code" => 400, "message" => "Bad Request"]);
        return;
    break;
}

?>
