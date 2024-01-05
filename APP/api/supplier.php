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
     require "../models/ProveedorModel.php";
     require "../models/InvoiceModel.php";
     require "../utils/AppUtils.php";
     require "../services/AppService.php";


     $model = new ProveedorModel();
     $appService = new AppService();

     switch ($action) {
        case 1:  /* CREAR PROVEEDOR*/
              require("./include/supplier/add.php");
        break;
        case 2:  /* EDITAR PROVEEDOR*/
              require("./include/supplier/edit.php");
        break;
        case 3:  /* ELIMINAR PROVEEDOR*/
              require("./include/supplier/delete.php");
        break;
        default:
                echo json_encode(["code" => 400, "message" => "Bad Request"]);
                return;
        break;
    }

?>
