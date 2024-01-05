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

    $permisos = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Catalogos_generales;
     require "../models/LineModel.php";
     require "../models/ItemModel.php";
     require "../utils/AppUtils.php";
     require "../services/AppService.php";


     $model = new LineModel();
     $appService = new AppService();

     switch ($action) {
        case 1:  /* CREAR LINEA*/
              require("./include/line/add.php");
        break;
        case 2:  /* EDITAR LINEA*/
              require("./include/line/edit.php");
        break;
        case 3:  /* ELIMINAR LINEA*/
              require("./include/line/delete.php");
        break;
        default:
                echo json_encode(["code" => 400, "message" => "Bad Request"]);
                return;
        break;
    }

?>
