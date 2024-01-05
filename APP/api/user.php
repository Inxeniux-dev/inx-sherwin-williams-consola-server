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

    $permisos = json_decode($_SESSION["datauser"]["permissions"])->Configuracion->Usuarios;

    require "../utils/AppUtils.php";
    require "../services/SettingsService.php";
    require "../services/PermisoService.php";
    require "../models/UserModel.php";
    require "../models/AlmacenLibretaModel.php";

    $model = new UserModel();
    $service = new SettingsService();
    $permisoService = new PermisoService();
    $almacenLibreta = new AlmacenLibretaModel();

    switch ($action) {
        case 2:  /*UPDATE PERMISO */
              require("./include/user/update_permiso_console.php");
        break;
        case 3:  /*REGISTRA NUEVO USUARIO*/
              require("./include/user/create_user.php");
        break;
        case 4:  /*UPDATE PERMISO PUNTO DE VENTA*/
              require("./include/user/update_permiso_pos.php");
        break;
        case 5:  /*UPDATE PERMISO PUNTO DE VENTA*/
              require("./include/user/update_user.php");
        break;
        case 6:  /*UPDATE ALMACEN PARA EL USUARIO CONSOLE */
              require("./include/user/add_store_user.php");
        break;
        case 7:  /*ELIMINAR ALMACEN PARA EL USUARIO CONSOLE */
              require("./include/user/delete_store_user.php");
        break;
        case 8:  /*ACTUALIZAR EL PASSWORD DEL USUARIO */
              require("./include/user/update_pass_user.php");
        break;
        case 9:  /* ELIMINAR USUARIO  */
              require("./include/user/delete_user.php");
        break;
        default:
                echo json_encode(["code" => 400, "message" => "Bad Request"]);
                return;
        break;
      }


?>
