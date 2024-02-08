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


/* REQUERIDOS  */
if(strlen($rfc) == 13)  /* Es persona moral*/
{
      if(strlen($name) <= 0)
      {
        echo json_encode(["code" => 200, "error" => ["El nombre es requerido"]]); return;
      }
      else
      {
          if(is_int($name) || is_float($name))
          {
            echo json_encode(["code" => 200, "error" => ["El nombre es incorrecto"]]); return;
          }
      }

      if(strlen($lastname) <= 0)
      {
        echo json_encode(["code" => 200, "error" => ["El apellido es requerido"]]); return;
      }
      else
      {
          if(is_int($lastname) || is_float($lastname))
          {
            echo json_encode(["code" => 200, "error" => ["El apellido es incorrecto"]]); return;
          }
      }
}
else if (strlen($rfc) == 12) /*Es persona fisica */
{
      if(strlen($razon) <= 0)
      {
        echo json_encode(["code" => 200, "error" => ["La razón social es requerida"]]); return;
      }
      else
      {
          if(is_int($razon) || is_float($razon))
          {
            echo json_encode(["code" => 200, "error" => ["La razón social es incorrecta"]]); return;
          }
      }
}
else   /* RFC Incorrecto */
{
  echo json_encode(["code" => 200, "error" => ["El rfc es incorrecto"]]); return;
}


if(is_null($cp) || strlen ($cp) <= 0)
{
  echo json_encode(["code" => 200, "error" => ["El código postal es requerido"]]); return;
}
else{
      if(!is_numeric($cp))
      {
        echo json_encode(["code" => 200, "error" => ["El código postal es incorrecto"]]); return;
      }
}


if(is_null($municipio) || strlen ($municipio) <= 0)
{
  echo json_encode(["code" => 200, "error" => ["El municipio es requerido"]]); return;
}
else{
      if(is_int($municipio) || is_float($municipio))
      {
        echo json_encode(["code" => 200, "error" => ["El municipio es incorrecto"]]); return;
      }
}


if(is_null($estado) || strlen ($estado) <= 0)
{
  echo json_encode(["code" => 200, "error" => ["El estado es requerido"]]); return;
}
else
{
      if(is_int($estado) || is_float($estado))
      {
        echo json_encode(["code" => 200, "error" => ["El estado es incorrecto"]]); return;
      }
}


if(is_null($pais) || strlen($pais) <= 0)
{
  echo json_encode(["code" => 200, "error" => ["El país es requerido"]]); return;
}
else
{
      if(is_int($pais) || is_float($pais))
      {
        echo json_encode(["code" => 200, "error" => ["El país es incorrecto"]]); return;
      }
}


/*-------------------------------------------------------------------------
-- NO REQUERIDOS: Pero si se ingresan deben de tener el formato correcto --
-------------------------------------------------------------------------*/

if(strlen($email) > 0)
{
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
         echo json_encode(["code" => 200, "error" => ["El email es incorrecto"]]); return;
      }
}


if(strlen($telefono) > 0)
{
      if(!is_numeric($telefono))
      {
        echo json_encode(["code" => 200, "error" => ["El teléfono es incorrecto"]]); return;
      }
}


if(strlen($celular) > 0)
{
      if(!is_numeric($celular))
      {
        echo json_encode(["code" => 200, "error" => ["El celular es incorrecto"]]); return;
      }
}


if(strlen($colonia) > 0)
{
      if(is_int($colonia) || is_float($colonia))
      {
        echo json_encode(["code" => 200, "error" => ["La colinia es incorrecta"]]); return;
      }
}


if(strlen($numinterior) > 0)
{
      if(!is_string($numinterior))
      {
        echo json_encode(["code" => 200, "error" => ["El número interior es incorrecto"]]); return;
      }
}


if(strlen($numexterior) > 0)
{
      if(!is_string($numexterior))
      {
        echo json_encode(["code" => 200, "error" => ["El número exterior es incorrecto"]]); return;
      }
}


if(strlen($regimen) <= 0)
{
  echo json_encode(["code" => 200, "error" => ["El regimen es incorrecto"]]); return;
}


  $duplicado = $model->getCountByFullNameAndRFC($name, $lastname, $rfc);
  if($duplicado->total > 0){ echo json_encode(["code" => 200, "error" => ["El cliente con el nombre, apellidos y rfc proporcionados ya está registrado"]]); return; }

  $tipo = strlen($rfc) == 13 ? 1 : 0;

  // Genera el UUID con uniqid
  $uuid_sync = uniqid('', true);

  $response = $model->add($rfc, $name, $lastname, $razon, $tipo, $email, $telefono, $celular, $direccion, $colonia, $numexterior, $numinterior, $cp, $municipio, $estado, $pais, $regimen, $uuid_sync);
  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al crear el cliente"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;

?>
