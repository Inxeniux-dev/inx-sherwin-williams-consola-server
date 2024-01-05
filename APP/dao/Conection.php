<?php
$conexion=new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');

if(mysqli_connect_errno()){
    printf(" <div class = 'alert alert-danger'> Fallo conexion con bd: ", mysqli_connect_errno()." </div>");
    return;
}
