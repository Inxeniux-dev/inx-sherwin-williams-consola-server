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

    require "../services/AppService.php";
    require "../utils/AppUtils.php";
    require "../models/ItemModel.php";
    require "../models/PriceModel.php";
    require "../models/StoreModel.php";

    require "../models/CambioPrecioModel.php";
    require "../models/CambioPrecioDetalleModel.php";

    $model = new ItemModel();
    $priceModel = new PriceModel();
    $appService = new AppService();

    $cambioPrecioModel = new CambioPrecioModel();
    $cambioPrecioDetalleModel = new CambioPrecioDetalleModel();

    switch ($action) {
        case 1:  /* VERIFICA CAMBIO DE PRECIOS */
              require("./include/prices/verify_change.php");
        break;
        case 2:  /* CONFIRMAR LA ACTUALIZACIÓN DE PRECIOS */
              require("./include/prices/confirm_change.php");
        break;
        case 3:  /* LISTADO DE CAMBIO DE PRECIOS*/
              require("./include/prices/list_change.php");
        break;
        case 4:  /* LISTADO DE CAMBIO DE PRECIOS*/
              require("./include/prices/sync.php");
        break;
        case 5:  /* CONFIRMA PRECIOS MODIFICADOS ACTUALMENTE*/
            require("./include/prices/confirm.php");
        break;
        case 6:  /* CONFIRMA PRECIOS MODIFICADOS ACTUALMENTE*/
            require("./include/prices/confirm_all.php");
        break;
        default:
        echo json_encode(["code" => 400, "message" => "Bad Request"]);
        return;
        break;
      }
