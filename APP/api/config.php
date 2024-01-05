<?php
    session_start();
    require "../config/config.php";
    require "../dao/Conection.php";


    if(!isset($_GET["a"]))
    {
        echo json_encode(["code" => 400, "message" => "Bad Request"]);  return;
    }

    $action = $_GET["a"];

    if(!isset($_SESSION["datauser"]["iduser"]) || $_SESSION["datauser"]["iduser"] <= 0)
    {
        echo json_encode(["code" => 403, "message" => "Forbidden"]); return;
    }

     require "../models/ConfigModel.php";
      require "../models/ItemModel.php";
     require "../utils/AppUtils.php";
     require "../services/AppService.php";


     $model = new ConfigModel();
     $appService = new AppService();

     switch ($action) {
        case 1:  /* ACTUALIZAR CONFIGURACION*/
              require("./include/config/change_config.php");
        break;
        default:
                echo json_encode(["code" => 400, "message" => "Bad Request"]);
                return;
        break;
    }

?>
