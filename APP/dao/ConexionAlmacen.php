<?php

//CONEXION ALMACEN
$conexion_almacen = new mysqli($data_config->host_db_notebook, $data_config->user_db_notebook, $data_config->pass_db_notebook, $data_config->db_name_notebook, $data_config->port_db_notebook);
mysqli_query($conexion_almacen, 'SET NAMES "'.DB_ENCODE.'"');
if(mysqli_connect_errno()){
    printf(" <div class = 'alert alert-danger'> Fallo conexion con bd: ", mysqli_connect_errno()." </div>");
}


?>
