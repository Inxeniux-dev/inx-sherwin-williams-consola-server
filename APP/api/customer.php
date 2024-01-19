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

    $permisos = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Clientes;
    $permisosCanje = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Productos_para_Canje;

     require "../models/CustomerModel.php";
     require "../models/LineModel.php";
     require "../models/ClaveSatModel.php";
     require "../models/SettingModel.php";

     require "../utils/AppUtils.php";
     require "../services/AppService.php";



     $model = new CustomerModel();
     $appService = new AppService();

     switch ($action) {
        case 1:  /* LISTADO DE ITEMS PARA CANJE DE PUNTOS*/
              require("./include/customers/list_change.php");
        break;
        case 2:  /* CREATE ITEM PARA CANJE DE PUNTOS */
              require("./include/customers/create.php");
        break;
        case 3:  /* EDIT ITEM PARA CANJE DE PUNTOS*/
              require("./include/customers/edit.php");
        break;
        case 4:  /* DELETE ITEM PARA CANJE DE PUNTOS*/
              require("./include/customers/delete.php");
        break;
        case 5:  /* LISTADO DE ITEMS PARA PRECIOS*/
              require("./include/customers/list_change_prices.php");
        break;
        case 6:  /* UPDATE PRICE ITEM GENERAL */
              require("./include/customers/change_price.php");
        break;
        case 7:  /* GENERAR XML DE PRECIOS */
              require("./include/customers/genera_xml.php");
        break;
        case 8:  /* ADD NUEVO CLIENTE GENERAL*/
              require("./include/customers/add.php");
        break;
        case 9:  /* LISTADO DE ITEMS PARA CAMPAÑA */
              require("./include/customers/campaing.php");
        break;
        case 10:  /* UPDATE DESCUENTO ITEM GENERAL */
              require("./include/customers/change_discount.php");
        break;
        case 11:  /* LISTADO DE CLIENTES GENERAL */
              require("./include/customers/list.php");
        break;
        case 12:  /* EDITAR CLIENTE GENERAL*/
              require("./include/customers/edit_cust.php");
        break;
        case 13:  /* ELIMINAR CLIENTE GENERAL */
           require("./include/customers/delete_cust.php");
        break;
        case 14: /* CARGAR CAMPAÑA DE REFORZAMIENTO */
            require("./include/customers/add_campaing_reforcement.php");
        break;
        case 15: /* CARGAR CAMPAÑA NORMAL */
            require("./include/customers/add_campaing_file.php");
        break;
        default:
                echo json_encode(["code" => 400, "message" => "Bad Request"]);
                return;
        break;
    }

?>
