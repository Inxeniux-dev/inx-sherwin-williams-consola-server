<?php

//if(!$_SESSION["permissions"][60]->status) {  echo json_encode(["code" => 200, "status" => false, "error" => ["No tienes permiso para realizar esta operación"]]); return; }

$name = isset($_POST["name"]) ? $_POST["name"] : null;
$username = isset($_POST["username"]) ? $_POST["username"] : null;
$pass = isset($_POST["pass"]) ? $_POST["pass"] : null;
$type = isset($_POST["type"]) ? $_POST["type"] : 2;

if($name == null || strlen($name) == 0)
{
    echo json_encode(["code" => 200, "status" => false, "error" => ["Nombre incorrecto o requerido"]]); return;
}

if($username == null || strlen($username) == 0)
{
    echo json_encode(["code" => 200, "status" => false, "error" => ["Nombre de usuario incorrecto o requerido"]]); return;
}

if($pass == null || strlen($pass) == 0)
{
    echo json_encode(["code" => 200, "status" => false, "error" => ["Password incorrecto o requerido"]]); return;
}

$data = ["name" => $name, "username" => $username, "pass" => $pass, "type" => $type];

//Valida duplicado
$duplicado = $userModel->getDataUserByUsername($data);
if($duplicado)
{
    $count = $duplicado->fetch_object()->total;
    if($count > 0)
    {
        echo json_encode(["code" => 200, "status" => false, "error" => ["El nombre de usuario ya ha sido registrado anteriormente"]]); return;
    }
}
else
{
    echo json_encode(["code" => 200, "status" => false, "error" => ["No se ha podido comprobar el nombre de usuario"]]); return;
}


$script = $service->getScript();

if($type == 2)
{
  $script = $service->getScriptVendedor();
}

if(MODE == "SERVER")
{
    $res = $userModel->create_user_server($script, $data);
}
else {
    $res = $userModel->create_user($script, $data);
}

$err = $res ? [] : ["Error al registrar al nuevo usuario"];

echo json_encode(["code" => 200, "status" => $res, "error" => [$err]]); return;
?>
