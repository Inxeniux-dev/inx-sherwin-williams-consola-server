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


require "../models/EmpleadoModel.php";
require "../models/EmpleadoBitacora.php";
require "../services/EmpleadoService.php";
$model = new EmpleadoModel();
$service = new EmpleadoService();
$modelBicatora = new EmpleadoBitacora();

switch ($action) {
    case 1:  /* BITACORA DE ASISTENCIA */
        require("./include/asistencia/bitacora.php");
    break;
    case 2:  /* BITACORA GLOBAL DE ASISTENCIA */
        require("./include/asistencia/bitacora_global.php");
    break;
    case 3:  /* BITACORA ASISTENCIA SUPERVISORES */
        require("./include/asistencia/bitacora_super.php");
    break;
    default:
        echo json_encode(["code" => 400, "message" => "Bad Request"]);
        return;
    break;
}

?>
