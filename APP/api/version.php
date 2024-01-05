<?php
session_start();
require "../config/config.php";
require "../dao/Conection.php";
require "../utils/AppSettings.php";

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

$permisos = json_decode($_SESSION["datauser"]["permissions"])->Versionamiento;

require "../models/VersionModel.php";
require "../models/VersionFileModel.php";
require "../models/VersionDetalleModel.php";
require "../models/StoreModel.php";
require "../models/SettingModel.php";
require "../utils/AppUtils.php";

$model = new VersionModel();
$settingModel = new SettingModel();

switch ($action) {
    case 1:  /* LISTADO DE VERSIONES */
        require("./include/version/list.php");
    break;
    case 2:  /* ADD DESCRIPCION VERSION*/
       require("./include/version/add_description.php");
    break;
    case 3:  /* UPDATE STATUS*/
       require("./include/version/upd_status.php");
    break;
    case 4:  /* CREATE VERSION*/
       require("./include/version/create.php");
    break;
    case 5:  /* UPLOAD FILE*/
       require("./include/version/upload_file.php");
    break;
    case 6:  /* VERSION REMOTA DE TIENDAS */
       require("./include/version/store_list.php");
    break;
    case 7:  /* DELETE UPLOAD FILE */
       require("./include/version/delete_file_upload.php");
    break;
    case 8:  /* ADD SUCURSALES TO VERSION */
       require("./include/version/stores_version.php");
    break;
    case 9:  /* DELETE COMENT VERSION*/
       require("./include/version/delete_coment.php");
    break;
    default:
        echo json_encode(["code" => 400, "message" => "Bad Request"]);
        return;
    break;
}

?>
