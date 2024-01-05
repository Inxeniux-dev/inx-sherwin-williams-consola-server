<?php

$CADENA_MD5_COMPLETA = isset($_POST["md5_key"])? $_POST["md5_key"] : 'x';
$code_key = isset($_POST["code_key"])? $_POST["code_key"] : null;

if($code_key != null && strlen($code_key)>0)
{
    $CLAVE = '';
    if($CADENA_MD5_COMPLETA != null){
        $length = (strlen($CADENA_MD5_COMPLETA) - 6);
        $CLAVE = substr($CADENA_MD5_COMPLETA, 2, -$length);

        if($CLAVE != $code_key){
          echo json_encode(["code" => 200, "status" => false, "error" => ["El código de desbloqueo es incorrecto"]]);
          return;
        }

        $_SESSION["config"]["unlok_system"] = true;
        echo json_encode(["code" => 200, "status" => true, "error" => []]);
        return;
    }
}
echo json_encode(["code" => 200, "status" => false, "error" => ["Error al realizar la operación"]]);
return;
?>
