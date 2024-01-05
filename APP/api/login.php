<?php
session_start();
require "../config/config.php";
require "../dao/Conection.php";
require "../dao/ConectionServer.php";


/*Se reciben los parametros */
$err = 0;

if(!isset($_POST["user"]) || !isset($_POST["pass"]))
{
    $err++;
}
else
{
    if(strlen($_POST["user"]) < 4 || strlen($_POST["pass"]) < 4)
    {
        $err++;
    }
}

if($err)
{
    echo json_encode(["code" => 401, "message"  => "Unauthorized"]);
    return;
}

login($conexion, $conexion_server);

function login($conexion, $conexion_server)
{

   $user = $conexion->real_escape_string($_POST["user"]);
   $pass = $conexion->real_escape_string($_POST["pass"]);

    $sql = "SELECT iduser, nombre, permisos FROM user WHERE username = ? AND password = MD5(?) AND id_sistema = 1;";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('ss', $user, $pass);
    /* ejecuta sentencias prepradas */
    $stmt->execute();

    $result = $stmt->get_result();
    $arr = [];
    while($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }

    if(!$arr)
    {
        echo json_encode(["code" => 204, "message" => "Forbidden"]);
    }


    /* cierra sentencia y conexión */
    $stmt->close();



    if(!empty($arr))
    {
        $data_user = $arr[0];
        $session = new LoginSession();
        $response = $session->sessionStart($data_user, $conexion, $conexion_server);

        if(!$response)
        {
           echo json_encode(["code" => 505, "message" => "Internal Server Error"]);
        }
        else
        {
            echo json_encode(["code" => 200, "message" => "Success"]);
        }
    }

    /* cierra la conexión */
    $conexion->close();

}


Class LoginSession {

    public function sessionStart($data_user, $conexion, $conexion_server)
    {

        $_SESSION["datauser"] = ["iduser" => $data_user["iduser"], "name" => $data_user["nombre"], "permissions" => $data_user["permisos"]];


        $SQL_CONFIG = "SELECT id, sync_lines, sync_cards, sync_stores, factor_precio, path_backup, path_log, path_upload, path_transfer FROM config WHERE id = 1 ;";
        $res_config = $conexion->query($SQL_CONFIG);
        if(!$res_config)
        {
            session_destroy();
            return false;
        }

       return true;
    }
}


?>
