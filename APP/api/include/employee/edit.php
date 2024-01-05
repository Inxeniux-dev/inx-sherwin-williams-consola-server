<?php
  if(!$permisos->Empleados->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

  $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
  $apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";
  $num_empleado = isset($_POST["num_empleado"]) ? trim($_POST["num_empleado"]) : 0;
  $sucursal = isset($_POST["sucursal"]) ? trim($_POST["sucursal"]) : 0;
  $idempleado = isset($_POST["idempleado"]) ? trim($_POST["idempleado"]) : 0;

  if($idempleado == null || $idempleado <= 0){ echo json_encode(["code" => 200, "error" => ["El identificador es incorrecto"]]); return; }
  if($nombre == null || strlen($nombre) == 0){ echo json_encode(["code" => 200, "error" => ["El nombre es incorrecto"]]); return; }
  if($apellido == null || strlen($apellido) == 0){ echo json_encode(["code" => 200, "error" => ["El apellido es incorrecto"]]); return; }
  if($sucursal == null || $sucursal <= 0){ echo json_encode(["code" => 200, "error" => ["La sucursal es incorrecta"]]); return; }
  if($num_empleado == null || $num_empleado <= 0){ echo json_encode(["code" => 200, "error" => ["El número de empleado es incorrecto"]]); return; }

  /*Valida número de empleado duplicado*/

  $model->no_empleado = $num_empleado;
  $empleado = $model->findByNoEmpleado();
  if($empleado && $empleado->num_rows > 0)
  {
      $empleado = $empleado->fetch_object();
      if($empleado->idempleado != $idempleado)
      {
        echo json_encode(["code" => 200, "error" => ["El número de empleado ya esta registrado anteriormente"]]); return;
      }
  }


  $model->nombre = $nombre;
  $model->apellido = $apellido;
  $model->idsucursal = $sucursal;
  $model->idempleado = $idempleado;
  $response = $model->update();
  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al actualizar el empleado"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;
?>
