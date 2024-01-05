<?php
    //CONEXION DE PUNTO DE VENTA
    $conexion_old = new mysqli("25.87.195.174", "david", "adapter", "sucursal_03", DB_PORT);
    mysqli_query($conexion_old, 'SET NAMES "'.DB_ENCODE.'"');
    if(mysqli_connect_errno()){
        printf(" <div class = 'alert alert-danger'> Fallo conexion con bd: ", mysqli_connect_errno()." </div>");
    }

?>
