<?php
  if(!$permisos->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }
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

  $id_cust = isset($_POST["id_cust"]) ? trim($_POST["id_cust"]) : 0;


  $duplicado = $model->getCountByFullNameAndRFCEdit($name, $lastname, $rfc, $id_cust);
  if($duplicado->total > 0){ echo json_encode(["code" => 200, "error" => ["El cliente con el nombre, apellidos y rfc proporcionados ya está registrado"]]); return; }

  $tipo = strlen($rfc) == 13 ? 1 : 0;

  $response = $model->edit($rfc, $name, $lastname, $razon, $tipo, $email, $telefono, $celular, $direccion, $colonia, $numexterior, $numinterior, $cp, $municipio, $estado, $pais, $regimen, $id_cust);
  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al editar el cliente"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;

?>
