<?php

class LocationService
{

    public function validateAddLocation($data)
    {
       $errors = array();

       if(is_null($data["key"]) || strlen ($data["key"]) <= 0)
       {
             array_push($errors, 'La clave de la sucursal es requerida');
       }
       else{
            if(!is_string($data["key"]))
            {
                array_push($errors, 'La clave de la sucursal es incorrecta');
            }
       }

       if(is_null($data["name"]) || strlen ($data["name"]) <= 0)
       {
             array_push($errors, 'El nombre es requerido');
       }
       else{
             if(is_int($data["name"]) || is_float($data["name"]))
             {
                 array_push($errors, 'El nombre es incorrecto');
             }
       }

       if(is_null($data["serie"]) || strlen ($data["serie"]) <= 0)
       {
             array_push($errors, 'La serie es requerida');
       }
       else{
             if(is_int($data["serie"]) || is_float($data["serie"]) || is_numeric($data["serie"]))
             {
                 array_push($errors, 'La serie es incorrecta');
             }
       }

       if(is_null($data["direccion"]) || strlen ($data["direccion"]) <= 0)
       {
             array_push($errors, 'La dirección es requerida');
       }
       else{
             if(is_int($data["direccion"]) || is_float($data["direccion"]))
             {
                 array_push($errors, 'La dirección es incorrecta');
             }
       }

       if(is_null($data["direccion"]) || strlen ($data["direccion"]) <= 0)
       {
             array_push($errors, 'La dirección es requerida');
       }
       else{
             if(is_int($data["direccion"]) || is_float($data["direccion"]))
             {
                 array_push($errors, 'La dirección es incorrecta');
             }
       }


       if(is_null($data["numint"]) || strlen($data["numint"]) <= 0)
       {
            array_push($errors, 'El número interior es requerido');
       }
       else
       {
            if(is_int($data["numint"]) || is_float($data["numint"]))
            {
                array_push($errors, 'El estado es incorrecto');
            }
       }

       if(is_null($data["numext"]) || strlen($data["numext"]) <= 0)
       {
            array_push($errors, 'El número exterior es requerido');
       }
       else
       {
            if(is_int($data["numext"]) || is_float($data["numext"]))
            {
                array_push($errors, 'El número exterior es incorrecto');
            }
       }

       if(is_null($data["cp"]) || strlen ($data["cp"]) <= 0)
       {
             array_push($errors, 'El código postal es requerido');
       }
       else{
             if(!is_numeric($data["cp"]))
             {
                 array_push($errors, 'El código postal es incorrecto');
             }
       }

       if(is_null($data["municipio"]) || strlen ($data["municipio"]) <= 0)
       {
             array_push($errors, 'El municipio es requerido');
       }
       else{
             if(is_int($data["municipio"]) || is_float($data["municipio"]))
             {
                 array_push($errors, 'El municipio es incorrecto');
             }
       }

       if(is_null($data["estado"]) || strlen ($data["estado"]) <= 0)
       {
              array_push($errors, 'El estado es requerido');
       }
       else
       {
             if(is_int($data["estado"]) || is_float($data["estado"]))
             {
                 array_push($errors, 'El estado es incorrecto');
             }
       }

       if(is_null($data["pais"]) || strlen($data["pais"]) <= 0)
       {
              array_push($errors, 'El país es requerido');
       }
       else
       {
             if(is_int($data["pais"]) || is_float($data["pais"]))
             {
                 array_push($errors, 'El país es incorrecto');
             }
       }

       if(is_null($data["type"]) || strlen($data["type"]) <= 0)
       {
              array_push($errors, 'El tipo de sucursal es requerido');
       }
       else
       {
             if($data["type"] > 3 && $data["type"] < 1)
             {
                 array_push($errors, 'El tipo de sucursal es incorrecto');
             }
       }


       $status = count($errors) > 0 ? false : true;

       return array("error" => $errors, "validation" => $status);

    }


    public function LocationTableList($data, $paginator)
    {
        $output = '<table class="table table-hover table-condensed table-sm">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Serie</th>
                                <th>Tipo</th>
                                <th>Dirección</th>
                                <th style = "text-align:right">Teléfono</th>
                                <th style = "text-align:right">Email</th>
                            </tr>
                        </thead>
                        <tbody>';

                        while($rows = $data->fetch_object())
                        {

                            $tipo  = "Sucursal";
                            if($rows->tipo == 1){ $tipo = "<b>Almacén</b>"; }
                            if($rows->tipo == 3){ $tipo = "<b>Auditoria</b>"; }

                            $output.='<tr>
                                        <td><b> '.strtoupper($rows->idsucursal).'</b><br>'.strtoupper($rows->nombre).'</td>
                                        <td>'.strtoupper($rows->serie).'</td>
                                        <td>'.$tipo.'</td>
                                        <td>'.strtoupper($rows->direccion).'</td>
                                        <td align = "right">'.phoneformat($rows->telefono).'</td>
                                        <td align = "right">'.$rows->email.'</td>
                                      </tr>';
                        }

            $output.="</tbody></table><div class='box-footer'>";
            $output .=$paginator;
            $output.="</div>";
        return $output;

    }


}

?>
