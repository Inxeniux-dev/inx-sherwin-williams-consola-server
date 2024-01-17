<?php
  if(!$permisos->Crear){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }
  $rfc = isset($_POST["rfc"]) ? trim($_POST["rfc"]) : 0;
  $rfc_confirm = isset($_POST["rfc_confirm"]) ? trim($_POST["rfc_confirm"]) : 0;
  $name = isset($_POST["name"]) ? trim($_POST["name"]) : "";
  $lastname = isset($_POST["lastname"]) ? trim($_POST["lastname"]) : 0;
  $razon = isset($_POST["razon"]) ? trim($_POST["razon"]) : 0;
  $email = isset($_POST["email"]) ? trim($_POST["email"]) : 0;
  $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : 0;
  $celular = isset($_POST["celular"]) ? trim($_POST["celular"]) : 0;

  $direccion = isset($_POST["direccion"]) ? trim($_POST["direccion"]) : 0;
  $colonia = isset($_POST["colonia"]) ? trim($_POST["colonia"]) : 0;
  $numexterior = isset($_POST["numexterior"]) ? trim($_POST["numexterior"]) : 0;
  $numinterior = isset($_POST["numinterior"]) ? trim($_POST["numinterior"]) : 0;
  $cp = isset($_POST["cp"]) ? trim($_POST["cp"]) : 0;
  $municipio = isset($_POST["municipio"]) ? trim($_POST["municipio"]) : 0;
  $estado = isset($_POST["estado"]) ? trim($_POST["estado"]) : 0;
  $pais = isset($_POST["pais"]) ? trim($_POST["pais"]) : 0;
  $regimen = isset($_POST["regimen"]) ? trim($_POST["regimen"]) : 0;


  // if($rfc == null || strlen($rfc) == 0){ echo json_encode(["code" => 200, "error" => ["El rfc es incorrecto"]]); return; }
  // if($rfc_confirm == null || strlen($rfc_confirm) == 0 || $rfc != $rfc_confirm){ echo json_encode(["code" => 200, "error" => ["La confirmación del rfc es incorrecta"]]); return; }
  // if($name == null || strlen($name) == 0){ echo json_encode(["code" => 200, "error" => ["Los nombres son incorrectos"]]); return; }
  // if($lastname == null || strlen($lastname) == 0){ echo json_encode(["code" => 200, "error" => ["Los apellidos son incorrectos"]]); return; }
  // if($razon == null || strlen($razon) == 0){ echo json_encode(["code" => 200, "error" => ["La razón es incorrecta"]]); return; }

  // if($cp == null || strlen($cp) == 0){ echo json_encode(["code" => 200, "error" => ["El campo código postal incorrecto"]]); return; }
  // if($municipio == null || strlen($municipio) == 0){ echo json_encode(["code" => 200, "error" => ["El campo municipio es incorrecto"]]); return; }
  // if($estado == null || strlen($estado) == 0){ echo json_encode(["code" => 200, "error" => ["El campo estado es incorrecto"]]); return; }
  // if($pais == null || strlen($pais) == 0){ echo json_encode(["code" => 200, "error" => ["El campo país es incorrecto"]]); return; }
  // if($regimen == null || $regimen == 0){ echo json_encode(["code" => 200, "error" => ["El campo régimen es incorrecto"]]); return; }

  $duplicado = $model->getCountByFullNameAndRFC($name, $lastname, $rfc);
  if($duplicado->total > 0){ echo json_encode(["code" => 200, "error" => ["El cliente con el nombre, apellidos y rfc proporcionados ya está registrado"]]); return; }

  $tipo = strlen($rfc) == 13 ? 1 : 0;

  $response = $model->add($rfc, $name, $lastname, $razon, $tipo, $email, $telefono, $celular, $direccion, $colonia, $numexterior, $numinterior, $cp, $municipio, $estado, $pais, $regimen);
  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al crear el cliente"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;

?>
