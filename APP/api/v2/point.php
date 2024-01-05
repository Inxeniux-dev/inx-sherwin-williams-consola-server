<?php
ini_set('memory_limit', '128M');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

require "../../config/config.php";
require "../../dao/Conection.php";
require "../../utils/AppSettings.php";
require "../../utils/AppUtils.php";

$key = isset($_GET["key"]) ? $_GET["key"] : '';
$action = isset($_GET["a"]) ? $_GET["a"] : '';

if(!isset($_GET["a"])){ echo json_encode(["code" => 400, "message" => "Bad Request"]); return; }
if($key != API_KEY) { echo json_encode(["code" => 403, "message" => "Forbidden"]); return; }

require_once "../../models/UserModel.php";

switch ($action) {
    case 1:  /* ACUMULA PUNTOS DE VENTAS */
        require("./include/point/acumula_puntos.php");
    break;
    case 2:  /* CANJE DE PUNTOS */
        require("./include/point/canje_puntos.php");
    break;
    case 3:  /* SINCRONIZAR TARJETA DE PUNTOS */
        require("./include/point/sync.php");
    break;
    case 4:  /* CONSULTAR PRODUCTOS ESPECIALES */
        require("./include/point/productos_especiales.php");
    break;
    case 5:  /* SINCRONIZA UNA SOLA TARJETA */
        require("./include/point/sync_one.php");
    break;
    case 6:  /* CREAR TARJETA DE PUNTOS */
        require("./include/point/add.php");
    break;
    case 7:  /* ACTUALIZAR TARJETA DE PUNTOS */
        require("./include/point/update.php");
    break;
    default:
        echo json_encode(["code" => 400, "message" => "Bad Request"]);
        return;
    break;
}

?>
