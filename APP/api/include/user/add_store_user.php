<?php
  if(!$permisos->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }
  $almacen = isset($_POST["almacen"]) ? $_POST["almacen"] : null;
  $id = isset($_POST["iduser"]) ? $_POST["iduser"] : null;

  if($almacen == null || strlen($almacen) == 0 || !is_numeric($almacen) || $almacen <= 0){ echo json_encode(["code" => 200, "error" => ["El almacén es incorrecto"]]); return; }
  if($id == null || strlen($id) == 0 || !is_numeric($id) || $id <= 0){ echo json_encode(["code" => 200, "error" => ["El identificador es incorrecto"]]); return; }


  $almacenLibreta->idalmacen = $almacen;
  $almacenLibreta->iduser = $id;
  $almacen = $almacenLibreta->one();
  
  if($almacen && $almacen->num_rows > 0)
  {
      echo json_encode(["code" => 200, "error" => ["El almacén ya está asociado al usuario"]]);
      return;
  }

  $response = $almacenLibreta->create();
  $code = $response > 0 ? 201 : 200;
  $error = $response ? [] : ["Error al agregar almacén"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;
?>
