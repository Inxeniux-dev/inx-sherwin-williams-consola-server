<?php
  if(!$permisos->Listado_de_Versiones->Crear){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

  $version = isset($_POST["version"]) ? $_POST["version"] : 0;
  $proyecto = isset($_POST["proyecto"]) ? trim($_POST["proyecto"]) : 0;

  if($version == null || $version <= 0){ echo json_encode(["code" => 200, "error" => ["La versión es incorrecta"]]); return; }
  if($proyecto == null || $proyecto <= 0){ echo json_encode(["code" => 200, "error" => ["El proyecto seleccionado es incorrecto"]]); return; }

  $response = $model->getLastVersionByProyect($proyecto);
  if(!$response){ echo json_encode(["code" => 200, "error" => ["Error al comprobar las versiones del proyecto seleccionado"]]); return; }
  $ult_version = 0;
  while($row = $response->fetch_object())
  {
    $ult_version = $row->version;
  }
  $result = version_compare($ult_version, $version);
  if($result == 1){ echo json_encode(["code" => 200, "error" => ["La versión ingresada es inferior a la más reciente: ".$ult_version."-".$version]]); return; }

  $response = $model->getDataByVersion($version, $proyecto);
  if(!$response){ echo json_encode(["code" => 200, "error" => ["Error al comparar la versión"]]); return; }
  $total = $response->fetch_object()->total;
  if($total > 0){  echo json_encode(["code" => 200, "error" => ["La versión ingresada ya está registrada"]]); return; }

  $response = $model->create($version, $proyecto);
  $code = $response["status"] ? 201 : 200;
  $error = $response["status"] ? [] : ["Error al crear la versión del proyecto"];
  echo json_encode(["code" => $code, "error" => $error, "id" => $response["id"]]);
  return;
?>
