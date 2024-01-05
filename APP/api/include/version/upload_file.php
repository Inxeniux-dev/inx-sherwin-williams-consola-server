<?php
  if(!$permisos->Listado_de_Versiones->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

  $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
  $id = isset($_POST["id"]) ? $_POST["id"] : 0;

  if($nombre == null || strlen($nombre) == 0){ echo json_encode(["code" => 200, "error" => ["El nombre del archivo es incorrecto"]]); return; }
  if($id == null || $id <= 0){ echo json_encode(["code" => 200, "error" => ["El identificador es incorrecto"]]); return; }

  $conteo = count($_FILES["archivos"]["name"]);
  if($conteo == 0 ){ echo json_encode(["code" => 200, "error" => ["Los archivos son requeridos"]]); return; }


  $version = $model->getData($id);
  if(!$version){ echo json_encode(["code" => 200, "error" => ["Error al identificar la versión"]]); return; }
  $data = $version->fetch_object();
  $proyect = $data->nombre;
  $version = $data->version;
  $count_files = $conteo;
  $count_uplodad = 0;


  $setting = $settingModel->one();
  $PHAT_FILES = $setting->path_upload;


  //CREAMOS LA CARPETA DE LA VERSION
  $PATH_FILES = $PHAT_FILES."\\".$proyect."\\".$version."\\";
  if (!file_exists($PATH_FILES)) {
      mkdir($PATH_FILES, 0777, true);
  }

 if (file_exists($PATH_FILES)) {

   for ($i = 0; $i < $conteo; $i++) {

       $ubicacionTemporal = $_FILES["archivos"]["tmp_name"][$i];
       $nombreArchivo = $_FILES["archivos"]["name"][$i];
       $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
       // Renombrar archivo
       $nuevoNombre = sprintf("%s.%s", uniqid(), $extension);
       // Mover del temporal al directorio actual

       if(move_uploaded_file($ubicacionTemporal, $PATH_FILES.$nuevoNombre))
       {
           $count_uplodad ++;
           $fecha = date('Y-m-d H:i:s');
           $response_add = $model->addFile(strtoupper($nombre), $nuevoNombre, $id, $fecha);
       }
   }
 }


  $response = $response_add; //$model->create($version, $proyecto);
  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al cargar el archivo del proyecto"];
  echo json_encode(["code" => $code, "error" => $error]);
  return;
?>
