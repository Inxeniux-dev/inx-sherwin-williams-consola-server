<?php
    session_start();
    require "../config/config.php";
    require "../dao/Conection.php";
    require "../dao/ConectionServer.php";

    if(!isset($_GET["a"]))
    {
        echo json_encode(["code" => 400, "message" => "Bad Request"]); return;
    }

    $action = $_GET["a"];

    if(!isset($_SESSION["datauser"]["iduser"]) || $_SESSION["datauser"]["iduser"] <= 0)
    {
        echo json_encode(["code" => 403, "message" => "Forbidden"]); return;
    }

    require "../utils/AppUtils.php";

    require "../models/SettingModel.php";
    require "../models/ItemModel.php";
    require "../models/DiaInhabilModel.php";

    $model = new SettingModel();
    $itemModel = new ItemModel();
    $inhabilModel = new DiaInhabilModel();

    switch ($action) {
        case 1:  /* ACTUALIZA PRECIOS */
              require("./include/settings/upload_items.php");
        break;
        case 2:  /* ACTUALIZA PRECIOS */
              require("./include/settings/stores_config_sync.php");
        break;
        case 3:  /* ACTUALIZA PRECIOS */
              require("./include/settings/update_config.php");
        break;
        case 4:  /* OBTENER SUBMODULOS */
              require("./include/settings/submodulos.php");
        break;
        case 5:  /* CREATE SUBMODULOS */
              require("./include/settings/sub_create.php");
        break;
        case 6:  /* CREATE SUBMODULOS */
              require("./include/settings/update_path.php");
        break;
        case 7:  /* CREATE SUBMODULOS */
              require("./include/settings/update_sync.php");
        break;
        case 8:  /* CREATE SUBMODULOS */
              require("./include/settings/not_working.php");
        break;
        case 9:  /* CREATE SUBMODULOS */
              require("./include/settings/delete_not_working.php");
        break;
        case 10:  /* UPDATE NOTEBOOK CONFIG */
              require("./include/settings/update_notebook.php");
        break;
        case 11:  /* UPDATE STORE CONFIG */
              require("./include/settings/update_store_config.php");
        break;




        case 13:  /* ELIMINAR USUARIO  */
              require("./include/settings/user_delete.php");
        break;
        case 14:  /* SINCRONIZAR USUARIOS */
              require("./include/settings/user_sync.php");
        break;
        case 15:  /* RESTAURAR BASE DE DATOS */
              require("./include/settings/restore_backup.php");
        break;
        case 18:  /* GENERAR CLAVE PARA DESBLOQUEO DEL SISTEMA */
              require("./include/settings/generate_key.php");
        break;
        case 19:  /* VERIFICA LA ULTIMA VERSIÓN EN EL SERVIDOR */
              require("./include/settings/check_version_server.php");
        break;
        default:
                echo json_encode(["code" => 400, "message" => "Bad Request"]);
                return;
        break;
      }


?>
