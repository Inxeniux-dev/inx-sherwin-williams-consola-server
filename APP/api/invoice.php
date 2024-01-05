<?php
    session_start();
    require "../config/config.php";
    require "../dao/Conection.php";
    require "../models/SettingModel.php";


    if(!isset($_GET["a"]))
    {
        echo json_encode(["code" => 400, "message" => "Bad Request"]);  return;
    }

    $action = $_GET["a"];

    if(!isset($_SESSION["datauser"]["iduser"]) || $_SESSION["datauser"]["iduser"] <= 0)
    {
        echo json_encode(["code" => 403, "message" => "Forbidden"]); return;
    }

    $permisos = json_decode($_SESSION["datauser"]["permissions"])->Libreta_de_Pagos->Listado_de_Facturas;

     require "../models/InvoiceModel.php";
     require "../models/AlmacenLibretaModel.php";
     require "../utils/AppUtils.php";
     require "../services/AppService.php";
     $appService = new AppService();


     switch ($action) {
        case 1:  /* LISTADO DE ITEMS PARA CANJE DE PUNTOS*/
              require("./include/invoice/list.php");
        break;
        case 2:  /* SINCRONIZAR INFORMACIÓN DE LAS BODEGAS*/
              require("./include/invoice/sync_almacen.php");
        break;
        case 3:  /* ACTUALIZAR FECHA DE PAGO DE FACTURA*/
              require("./include/invoice/update_pago.php");
        break;
        case 4:  /* SINCRONIZA LA INFORMACIÓN DE UNA FACTURA */
              require("./include/invoice/sync_detail.php");
        break;
        default:
            echo json_encode(["code" => 400, "message" => "Bad Request"]);
            return;
        break;
      }

?>
