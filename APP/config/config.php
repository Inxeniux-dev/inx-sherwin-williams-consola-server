<?php
/* Datos del sistema */
define('PROJECT', 'server');
define("COMPANY", 'GRUPO COMERCIAL HYDRA SA DE CV');
define("VERSION", "2.3.2");



/* DB Conexion */
define("DB_HOST","localhost");
define("DB_NAME", "c_server");
define("DB_USERNAME","root");
define("DB_PASSWORD","GCHydra16*");
define("DB_PORT","3306");
define("DB_ENCODE","utf8");

/*ALMACENES*/
define("ALMACENES", ["02", "70"]);

/* CANJE DE PUNTOS */
define("EXPIRATION_MONTH", 6);

/* KEYS */
define("API_KEY", "325c2693a7074eba9da136681eb7b05e");
define("KEY_COMPRESS", "2eae72fea4132b283a7a701199ab6c80efd42a6f");


/* Files y XMLS*/
define("SYNCRONIZATION_PATH", "C:/Syncronization/Files/");
define("PATH_WINRAR", "C:\\\Program Files\\\WinRAR\\winrar.exe");
define("PATH_MYSQLDUMP", "C:\\AppServ\\MySQL\\bin\\mysqldump");
define("PATH_MYSQL", "C:\\AppServ\\MySQL\\bin\\mysql");


define("PATH_FILES_VERSION", "C:\\Console\\Version\\");
define("PATH_FILES_BACKUPS", "F:\\Respaldos\\");
define("PATH_TEMPLATE", "C:\\Console\\Template\\");



/*Configurations PHP */
date_default_timezone_set("America/Chihuahua");
set_time_limit(0);


$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
define('HTTP_URL', '/'. substr_replace(trim($_SERVER['REQUEST_URI'], '/'), '', 0, strlen($scriptName)));
