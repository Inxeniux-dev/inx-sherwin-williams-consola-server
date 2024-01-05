<?php
ini_set('memory_limit', '128M');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

require "../../config/config.php";
require "../../dao/Conection.php";
require "../../utils/AppSettings.php";
require "../../utils/AppUtils.php";

$key = isset($_GET["key"]) ? $_GET["key"] : '';
$action = isset($_GET["a"]) ? $_GET["a"] : '';

if(!isset($_GET["a"])){ echo json_encode(["code" => 400, "message" => "Bad Request"]); return; }
if($key != API_KEY) { echo json_encode(["code" => 403, "message" => "Forbidden"]); return; }

switch ($action) {
    case 1:  /* LEER VALES DEL SERVIDOR */
        require("./include/transfer/on_server.php");
    break;
    case 2:  /* VERIFICAR VALES ANTIGUOS (VENCIDOS) PARA INGRESO AUTOMATICO */
        require("./include/transfer/on_server_old.php");
    break;
    case 3:  /* LEER LA INFORMACIÓN DEL VALE */
        require("./include/transfer/on_server_read.php");
    break;
    case 4:  /* ELIMINAR UN VALE POR NOMBRE */
        require("./include/transfer/on_server_delete.php");
    break;
    case 5:  /* CREAR VALE EN EL SERVIDOR */
        require("./include/transfer/on_server_create.php");
    break;
    case 6:  /* ELIMINAR UN VALE POR NOMBRE */
        require("./include/transfer/on_server_delete_folios.php");
    break;
    case 7:  /*LEER VALES DEL SERVIDOR PARA ALMACEN */
        require("./include/transfer/on_server_almacen.php");
    break;
    default:
        echo json_encode(["code" => 400, "message" => "Bad Request"]);
        return;
    break;
}

?>
