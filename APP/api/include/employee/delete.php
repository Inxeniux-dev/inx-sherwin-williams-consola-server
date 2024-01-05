<?php
  if(!$permisos->Empleados->Eliminar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }
  $id = isset($_POST["id"]) ? trim($_POST["id"]) : 0;

  if($id == null || $id <= 0){ echo json_encode(["code" => 200, "error" => ["El identificador es incorrecto"]]); return; }

  $modelBitacora->idempleado = $id;
  $modelBitacora->deleteByIdEmployee();
  $modelRotacion->id_empleado = $id;
  $modelRotacion->deleteByIdEmployee();

  $model->idempleado = $id;
  $response = $model->delete();
  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al eliminar empleado"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;
?>
