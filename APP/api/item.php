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

    $permisos = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Articulos;
    $permisosCanje = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Productos_para_Canje;

     require "../models/ItemModel.php";
     require "../models/LineModel.php";
     require "../models/ClaveSatModel.php";
     require "../models/SettingModel.php";

     require "../utils/AppUtils.php";
     require "../services/AppService.php";



     $model = new ItemModel();
     $appService = new AppService();

     switch ($action) {
        case 1:  /* LISTADO DE ITEMS PARA CANJE DE PUNTOS*/
              require("./include/item/list_change.php");
        break;
        case 2:  /* CREATE ITEM PARA CANJE DE PUNTOS */
              require("./include/item/create.php");
        break;
        case 3:  /* EDIT ITEM PARA CANJE DE PUNTOS*/
              require("./include/item/edit.php");
        break;
        case 4:  /* DELETE ITEM PARA CANJE DE PUNTOS*/
              require("./include/item/delete.php");
        break;
        case 5:  /* LISTADO DE ITEMS PARA PRECIOS*/
              require("./include/item/list_change_prices.php");
        break;
        case 6:  /* UPDATE PRICE ITEM GENERAL */
              require("./include/item/change_price.php");
        break;
        case 7:  /* GENERAR XML DE PRECIOS */
              require("./include/item/genera_xml.php");
        break;
        case 8:  /* ADD NUEVO PRODUCTO */
              require("./include/item/add.php");
        break;
        case 9:  /* LISTADO DE ITEMS PARA CAMPAÑA */
              require("./include/item/campaing.php");
        break;
        case 10:  /* UPDATE DESCUENTO ITEM GENERAL */
              require("./include/item/change_discount.php");
        break;
        case 11:  /* LISTADO DE ITEMS GENERAL */
              require("./include/item/list.php");
        break;
        case 12:  /* EDITAR ARTICULO GENERAL */
              require("./include/item/edit_prod.php");
        break;
        case 13:  /* ELIMINAR ARTICULO GENERAL */
           require("./include/item/delete_prod.php");
        break;
        case 14: /* CARGAR CAMPAÑA DE REFORZAMIENTO */
            require("./include/item/add_campaing_reforcement.php");
        break;
        case 15: /* CARGAR CAMPAÑA NORMAL */
            require("./include/item/add_campaing_file.php");
        break;
        default:
                echo json_encode(["code" => 400, "message" => "Bad Request"]);
                return;
        break;
    }

?>
