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
require_once "../../models/StoreModel.php";
require_once "../../models/LineModel.php";
require_once "../../models/TarjetaModel.php";
require_once "../../models/ConfigModel.php";
require_once "../../models/DiaInhabilModel.php";
require_once "../../models/SellerModel.php";

switch ($action) {
    case 1:  /* LISTADO DE SUCURSALES Y SU ULTIMO CORTE */
        require("./include/store/backup_date.php");
    break;
    case 2: /* LISTADO DE SUCURSALES Y SU ULTIMO CORTE */
        require("./include/store/many_backup_upload.php");
    break;
    case 3:  /* CONFIGURACIÓN DE TIENDAS */
        require("./include/store/config_sync.php");
    break;
    case 4:  /* SINCRONIZA TODO EL CATALOGO DE TIENDAS */
        require("./include/store/sync_all.php");
    break;
    default:
        echo json_encode(["code" => 400, "message" => "Bad Request"]);
        return;
    break;
}

?>
