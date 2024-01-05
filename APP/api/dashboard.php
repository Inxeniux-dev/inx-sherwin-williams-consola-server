<?php
    session_start();
    require "../config/config.php";
    require "../dao/Conection.php";


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

    require "../models/TransferModel.php";
    require "../models/CapaModel.php";
    require "../models/InventoryModel.php";

    require "../models/SaleModel.php";

    require "../services/AppService.php";
    require "../utils/AppUtils.php";

    $model = new TransferModel();
    $capaModel = new CapaModel();
    $inventoryModel = new InventoryModel();
    $appService = new AppService();
    $saleModel = new SaleModel();

    switch ($action) {
        case 1:  /* INGRESA VALES AUTOMATICOS */
              require("./include/transfer/transfer_old.php");
        break;
        case 2:  /* SINCRONIZA PUNTOS AL SERVIDOR*/
              require("./include/dotcard/sync_points.php");
        break;
      break;
        default:
                echo json_encode(["code" => 400, "message" => "Bad Request"]); return;
        break;
      }

?>
