<?php
ini_set('memory_limit', '254M');
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
require "../../services/BackupService.php";

$key = isset($_GET["key"]) ? $_GET["key"] : '';
$action = isset($_GET["a"]) ? $_GET["a"] : '';

if(!isset($_GET["a"])){ echo json_encode(["code" => 400, "message" => "Bad Request"]); return; }
if($key != API_KEY) { echo json_encode(["code" => 403, "message" => "Forbidden"]); return; }


require_once "../../models/ConfigModel.php";

switch ($action) {
    case 1:  /* CREANDO BACKUP EN EL SERVIDO0R */
        require("./include/backup/create.php");
    break;
    case 2:  /* RESTAURANDO ULTIMO BACKUP EN EL SERVIDO0R */
        require("./include/backup/ult_restore.php");
    break;
    case 3:  /* RESTAURAR BACKUP RESTANTES */
        require("./include/backup/backup_restantes.php");
    break;
    case 4:  /* OBTENER BACKUP DE LA SUCURSAL */
        require("./include/backup/backup_store.php");
    break;
    default:
        echo json_encode(["code" => 400, "message" => "Bad Request"]);
        return;
    break;
}

?>
