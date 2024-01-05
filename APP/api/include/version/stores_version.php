<?php
  if(!$permisos->Listado_de_Versiones->Editar){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }

  $id = isset($_POST["id"]) ? $_POST["id"] : 0;
  $suc_clave = isset($_POST["suc_clave"]) ? trim($_POST["suc_clave"]) : -1;
  $accion = isset($_POST["accion"]) ? trim($_POST["accion"]) : 0;

  if($id == null || $id <= 0){ echo json_encode(["code" => 200, "error" => ["El identificador es incorrecto"]]); return; }
  if($suc_clave == null || $suc_clave < 0){ echo json_encode(["code" => 200, "error" => ["La sucursal es incorrecta"]]); return; }

  $version = $model->getData($id);
  $version = $version->fetch_object();

  $permitidas = json_decode($version->sucursales);
  $sucursales = array();

  foreach($permitidas as $key => $value) {
          $sucursales[$key] = $value;
  }
  if($accion == 0)
  {
      unset($sucursales[addCeros($suc_clave)]);
  }
  else
  {
      $store = new StoreModel();
      $sucursal = $store->getList();
      if($suc_clave == 0) { $sucursales = array(); }

      while($row = $sucursal->fetch_object())
      {
          $id_sucursal = addCeros($row->idsucursal);

          if($suc_clave == 0)  //Todas las sucursales
          {
                $sucursales[$id_sucursal] = $row->nombre;
          }
          else {  //Unicamente la sucursal Enviada
              if($suc_clave == $id_sucursal)
              {
                  if(!in_array($row->idsucursal, $sucursales)) {
                      $sucursales[$id_sucursal] = $row->nombre; break;
                  }
              }
          }
      }
  }

  $sucursales = json_encode($sucursales);
  $model->sucursales = $sucursales;
  $model->id = $id;
  $response = $model->update();

  $code = $response ? 201 : 200;
  $error = $response ? [] : ["Error al actualizar el estatus"];
  echo json_encode(["code" => $code, "error" => $error, "check" => $accion]);
  return;
?>
