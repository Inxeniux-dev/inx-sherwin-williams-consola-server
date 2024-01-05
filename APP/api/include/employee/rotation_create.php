<?php
if(!$permisos->Rotacion_de_Personal->Crear){ echo json_encode(["code" => 200, "error" => ["No tienes permiso para realizar está operación"]]); return; }  //Esto debe ser en otro archivo
$hoy = date('Y-m-d');
$id_sucursal = isset($_POST["sucursal"]) ? $_POST["sucursal"] : 0;
$id_empleado = isset($_POST["idemploye"]) ? $_POST["idemploye"] : 0;
$expiracion = isset($_POST["expiracion"]) ? $_POST["expiracion"] : $hoy;
$expiracion_check = isset($_POST["unexpired"]) ? $_POST["unexpired"] : 0;
$all = isset($_POST["all"]) ? $_POST["all"] : 0;

if($all == 0)
{
    if($id_sucursal < 0 || $id_empleado <= 0 || strlen($expiracion) < 10 || $expiracion_check < 0)
    {
      echo json_encode(["code" => 200, "error" => ["Los datos introducidos son incorrectos"]]); return;
    }
}
else {
    if(strlen($expiracion) < 10 || $expiracion_check < 0)
    {
      echo json_encode(["code" => 200, "error" => ["Los datos introducidos son incorrectos"]]); return;
    }
}


if($all == 1)
{
    $sucursales = $modelStoreModel->getList();
    while($row = $sucursales->fetch_object())
    {
        $modelRotacion->id_sucursal = $row->idsucursal;
        $modelRotacion->id_empleado = $id_empleado;
        $rotacion = $modelRotacion->getOne();

        if($rotacion && $rotacion->num_rows == 0)
        {
          $expiracion = $expiracion_check == 1 ? SumarORestarFechas($hoy, '+', '10', 'year')  : $expiracion;
          $modelRotacion->create_at = $hoy.date(" H:i:s");
          $modelRotacion->expiracion = $expiracion;
          $modelRotacion->create();
        }
    }

    echo json_encode(["code" => 201, "msg" => "Create"]); return;
}
else {

  /*VALIDAMOS SI YA ESTA ASIGNADO A LA SUCURSAL A GUARDAR*/
  $modelRotacion->id_sucursal = $id_sucursal;
  $modelRotacion->id_empleado = $id_empleado;
  $rotacion = $modelRotacion->getOne();

  if($rotacion && $rotacion->num_rows > 0)
  {
      $rotacion = $rotacion->fetch_object();
      $expiracion = $rotacion->expiracion;
      if($expiracion >= $hoy)
      {
        echo json_encode(["code" => 200, "error" => ["El empleado tiene una asignación activa en ésta sucursal"]]); return;
      }
  }

  $expiracion = $expiracion_check == 1 ? SumarORestarFechas($hoy, '+', '10', 'year')  : $expiracion;
  $modelRotacion->create_at = $hoy.date(" H:i:s");
  $modelRotacion->expiracion = $expiracion;

  if($modelRotacion->create())
  {
    echo json_encode(["code" => 201, "msg" => "Create"]); return;
  }

  echo json_encode(["code" => 200,  "error" => ["El registro no se ha creado"]]); return;

}
?>
