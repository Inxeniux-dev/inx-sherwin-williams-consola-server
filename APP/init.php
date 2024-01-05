<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once 'config/config.php';
require_once 'core/app/Indices.php';
require_once 'core/app/Verify.php';
require_once 'dao/Conection.php';
require_once 'dao/ConectionServer.php';
require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'dao/Crud.php';
require_once 'utils/AppUtils.php'; /* Funciones Globales para la Aplicacion */
require_once 'utils/AppSettings.php'; /* Funciones Globales para la Aplicacion */

?>
