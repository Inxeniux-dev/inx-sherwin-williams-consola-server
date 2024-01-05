<?php
    session_start();
    require "../config/config.php";
    require "../dao/Conection.php";


    if(!isset($_GET["a"]))
    {
        echo json_encode(["code" => 400, "message" => "Bad Request"]); return;
    }

    $action = $_GET["a"];

    if(!isset($_SESSION["datauser"]["iduser"]) || $_SESSION["datauser"]["iduser"] <= 0)
    {
        echo json_encode(["code" => 403, "message" => "Forbidden"]); return;
    }


    require "../services/AppService.php";
    require "../utils/AppUtils.php";

    require "../models/itemModel.php";
    require "../models/QueueModel.php";
    require "../models/CapaModel.php";
    require "../models/InventoryModel.php";
    require "../models/UserModel.php";

    $appService = new AppService();
    $ItemModel = new ItemModel();
    $modelQueue = new QueueModel();
    $capaModel = new CapaModel();
    $inventoryModel = new InventoryModel();
    $userModel = new UserModel();


    switch ($action) {
        case 1:  //  MODIFICAR LA CANTIDAD DEL CODIGO
             require("./include/inventory/finaly.php");
        break;
        default:
              echo json_encode(["code" => 400, "message" => "Bad Request"]);
              return;
        break;
      }




?>
