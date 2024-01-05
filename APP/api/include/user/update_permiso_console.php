<?php
if(!$permisos->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

$identified = isset($_POST["id"]) ? $_POST["id"] : null;
$permiso = isset($_POST["value"]) ? $_POST["value"] : null;
$check = isset($_POST["check"]) ? $_POST["check"] : 0;


if($identified == null || $identified <= 0 || $permiso == null)
{
    echo json_encode(["code" => 200, "status" => false, "error" => ["No es posible actualizar permiso"]]); return;
}

$aux = explode("-", $permiso);
if(count($aux) != 3)
{
  echo json_encode(["code" => 200, "status" => false, "error" => ["Opción incorrecta"]]); return;
}

$mod = $aux[0];
$sub = $aux[1];
$opc = $aux[2];

$model->id = $identified;
$permiso = $model->one();
if(!$permiso && $permiso->num_rows == 0)
{
  echo json_encode(["code" => 501, "status" => false, "error" => ["Usuario no identificado"]]); return;
}
$user_db = $permiso->fetch_object();

$schema = to_object($permisoService->generatePermissionSchema());
$permisos = json_decode($user_db->permisos);

//Se hace match del esquema con lo registrado en la base de datos
foreach ($schema as $modulo => $permiso) {
    foreach ($permiso as $submodulo => $permiso_submodulo) {
        foreach ($permiso_submodulo as $submodulo2 => $estatus) {
            if(isset($permisos->$modulo->$submodulo->$submodulo2)){
                $estado = $permisos->$modulo->$submodulo->$submodulo2;
                $schema->$modulo->$submodulo->$submodulo2 = $estado == 1 ? true : false;  //Le asignamos al Schema el valor que tiene actualmente en Base de Datos
            }
        }
    }
}

//Cambiamos el valor del modulo envíado desde el Front
$schema->$mod->$sub->$opc = $check == 1 ? true : false;

$model->nombre = $user_db->nombre;
$model->username = $user_db->username;
$model->tipo = $user_db->tipo;

$model->permisos = json_encode((array)$schema);
$model->update_at = date("Y-m-d H:i:s");
$response = $model->updateUser();

$error = $response ? [] : ["Error al actualizar la información"];
$code = $response ? 201 : 200;

echo json_encode(["code" => $code, "status" => $response, "error" => $error]); return;
?>
