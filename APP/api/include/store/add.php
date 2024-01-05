<?php
if(!$permisos->Crear){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

$clave = isset($_POST["clave"]) ? $_POST["clave"] : null;
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
$serie = isset($_POST["serie"]) ? $_POST["serie"] : null;
$telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : null;
$correo = isset($_POST["correo"]) ? $_POST["correo"] : null;

$direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : null;
$cruzamiento = isset($_POST["cruzamiento"]) ? $_POST["cruzamiento"] : null;
$no_interior = isset($_POST["no_interior"]) ? $_POST["no_interior"] : null;
$no_exterior = isset($_POST["no_exterior"]) ? $_POST["no_exterior"] : null;
$colonia = isset($_POST["colonia"]) ? $_POST["colonia"] : null;
$cp = isset($_POST["cp"]) ? $_POST["cp"] : null;

$municipio = isset($_POST["municipio"]) ? $_POST["municipio"] : null;
$estado = isset($_POST["estado"]) ? $_POST["estado"] : null;
$pais = isset($_POST["pais"]) ? $_POST["pais"] : null;

$sunday = isset($_POST["sunday"]) ? $_POST["sunday"] : null;
$foranea = isset($_POST["foranea"]) ? $_POST["foranea"] : null;

$ip = isset($_POST["ip"]) ? $_POST["ip"] : null;
$tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : null;

if($clave == null || $clave <= 0 || !is_numeric($clave)){ echo json_encode(["code" => 200, "error" => ["La clave es incorrecta"]]);  return; }
if($serie == null || strlen(trim($serie)) == 0){ echo json_encode(["code" => 200, "error" => ["La serie es incorrecta"]]);  return; }
if($telefono == null || strlen(trim($telefono)) < 10 || !is_numeric($telefono)){ echo json_encode(["code" => 200, "error" => ["El teléfono es incorrecto"]]);  return; }
if($correo == null || strlen(trim($correo)) == 0){ echo json_encode(["code" => 200, "error" => ["El correo es incorrecto"]]);  return; }

if($direccion == null || strlen(trim($direccion)) == 0){ echo json_encode(["code" => 200, "error" => ["La dirección es incorrecta"]]);  return; }
if($cruzamiento == null || strlen(trim($cruzamiento)) == 0){ echo json_encode(["code" => 200, "error" => ["El cruzamiento es incorrecto"]]);  return; }
if($no_exterior == null || strlen(trim($no_exterior)) == 0){ echo json_encode(["code" => 200, "error" => ["El número exterior es incorrecto"]]);  return; }
if($colonia == null || strlen(trim($colonia)) == 0){ echo json_encode(["code" => 200, "error" => ["La colonia es incorrecta"]]);  return; }
if($cp == null || $cp <= 0 || !is_numeric($cp)){ echo json_encode(["code" => 200, "error" => ["El código postal es incorrecto"]]);  return; }

if($municipio == null || strlen(trim($municipio)) == 0){ echo json_encode(["code" => 200, "error" => ["El municipio es incorrecto"]]);  return; }
if($estado == null || strlen(trim($estado)) == 0){ echo json_encode(["code" => 200, "error" => ["El estado es incorrecto"]]);  return; }
if($pais == null || strlen(trim($pais)) == 0){ echo json_encode(["code" => 200, "error" => ["El pais es incorrecto"]]);  return; }

if($sunday == null || $sunday < 0 || !is_numeric($sunday)){ echo json_encode(["code" => 200, "error" => ["El dato para trabajar en domingo es incorrecto"]]);  return; }
if($foranea == null || $foranea < 0 || !is_numeric($foranea)){ echo json_encode(["code" => 200, "error" => ["La información de tienda foránea es incorrecta"]]);  return; }

if($ip == null || strlen(trim($ip)) == 0){ echo json_encode(["code" => 200, "error" => ["La IP es incorrecta"]]);  return; }
if($tipo == null || $tipo < 0 || !is_numeric($tipo)){ echo json_encode(["code" => 200, "error" => ["El tipo de sucursal es incorrecto"]]);  return; }

/*Consultamos duplicados*/
$model->id = $clave;
$sucursal = $model->one();
if($sucursal && $sucursal->num_rows > 0)
{
   echo json_encode(["code" => 200, "error" => ["]La clave está asociada a otra sucursal"]]);  return;
}

$model->clave = $clave;
$model->nombre = $nombre;
$model->serie = $serie;
$model->telefono = $telefono;
$model->email = $correo;

$model->direccion = $direccion;
$model->cruzamiento = $cruzamiento;
$model->no_interior = $no_interior;
$model->no_exterior = $no_exterior;
$model->colonia = $colonia;
$model->cp = $cp;

$model->municipio = $municipio;
$model->estado = $estado;
$model->pais = $pais;

$model->es_foranea = $foranea;
$model->trabaja_domingo = $sunday;
$model->ip = $ip;
$model->version = $tipo == 1 ? 0 : 1;
$model->almacen = $tipo;

$response = $model->add();
$code = $response ? 201 : 200;
$error = $response ? [] : ["Error al crear el producto"];
echo json_encode(["code" => $code, "error" => $error]);
return;

?>
