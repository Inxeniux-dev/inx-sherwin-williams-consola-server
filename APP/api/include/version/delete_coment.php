<?php
  if(!$permisos->Listado_de_Versiones->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }
  $id = isset($_POST["id"]) ? $_POST["id"] : 0;
  $idv = isset($_POST["idv"]) ? $_POST["idv"] : 0;

  $res = false;

  $model->id = $idv;
  $version = $model->one();
  if($version && $version->num_rows > 0)
  {
      $data = $version->fetch_object();
  }

  $version = $data->version;


  $detalle = new VersionDetalleModel();
  $detalle->id = $id;
  $detalle->idversion = $idv;
  $response = $detalle->delete();

  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al eliminar el comentario del proyecto"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;
?>
