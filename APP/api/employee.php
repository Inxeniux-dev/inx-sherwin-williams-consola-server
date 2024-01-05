<?php
session_start();
require "../config/config.php";
require "../dao/Conection.php";
require "../utils/AppSettings.php";
require "../utils/AppUtils.php";

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

$permisos = json_decode($_SESSION["datauser"]["permissions"])->Asistencia;


require "../models/EmpleadoModel.php";
require "../models/EmpleadoRotacion.php";
require "../models/EmpleadoBitacora.php";
require "../models/StoreModel.php";


$model = new EmpleadoModel();
$modelRotacion = new EmpleadoRotacion();
$modelBitacora = new EmpleadoBitacora();
$modelStoreModel = new StoreModel();

switch ($action) {
    case 1:  /* HISTORIAL DE EMPLEADOS */
        require("./include/employee/list.php");
    break;
    case 2:  /* HISTORIAL DE ROTACION */
        require("./include/employee/rotation.php");
    break;
    case 3:  /* CREAR ROTATION */
        require("./include/employee/rotation_create.php");
    break;
    case 4:  /* EXPIRAR ROTACION */
        require("./include/employee/rotation_expirate.php");
    break;
    case 5:  /* EDITAR EMPLEADO */
        require("./include/employee/edit.php");
    break;
    case 6:  /* EDITAR EMPLEADO */
        require("./include/employee/delete.php");
    break;
    case 7:  /* EDITAR PERMISOS EMPLEADO */
        require("./include/employee/edit_permission.php");
    break;
    default:
        echo json_encode(["code" => 400, "message" => "Bad Request"]);
        return;
    break;
}

?>
