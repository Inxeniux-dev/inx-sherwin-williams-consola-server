<?php
$idmodulo = isset($_GET["module"]) ? $_GET["module"] : 0;
$iduser = isset($_GET["iduser"]) ? $_GET["iduser"] : 0;

$submodulo = new PermisoSubmoduloModel();
$submodulo->idmodulo = $idmodulo;
$data = $submodulo->getById();


$model->idmodulo = $idmodulo;
$model->id = $iduser;
$permiso = $model->permisoByModule();

$permisos = array();
while($row = $permiso->fetch_object())
{
      $permisos[] = ["id" => $row->idsubmodulo, "status" => $row->status];
}


$output = '';
while ($row = $data->fetch_object()) {

  $check = '';
  $icon = '<i class="far fa-check-circle text-success"></i> ';

  $indice = in_array_r($row->idpermisosubmodulo, $permisos);
  if($indice >= 0 && is_numeric($indice))
  {
      $check = $permisos[$indice]["status"] == 1 ? 'checked' : '';
  }
  else {
    $icon = '<i class="far fa-times-circle text-danger"></i> ';
  }

  $output .= '<tr>
                  <td>'.$row->descripcion.'</td>
                  <td align = "center"><input class="form-check-input" type="checkbox" '.$check.'  data = "'.$row->idmodulo.'-'.$row->idpermisosubmodulo.'"></td>
                  <td align = "center">'.$icon.'</td>
              </tr>';
}


echo json_encode(["code" => 200, "output" => $output]);


function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $index => $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return $index;
        }
    }

    return false;
}

?>
