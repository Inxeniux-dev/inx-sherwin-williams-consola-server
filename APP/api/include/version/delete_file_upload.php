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
  $proyect = $data->nombre;

  $mfile = new VersionFileModel();
  $mfile->id = $id;
  $mfile->idversion = $idv;
  $data = $mfile->one();


  $setting = $settingModel->one();
  $PHAT_FILES = $setting->path_upload;

  if($data && $data->num_rows > 0)
  {
      $data = $data->fetch_object();
      $path = $PHAT_FILES."\\".$proyect."\\".$version.'\\'.$data->path;

      if(@unlink($path))
      {
          $res = $mfile->deleteOne();
      }
  }

  $response = $res; //$model->create($version, $proyecto);
  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al eliminar el archivo del proyecto"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;
?>
