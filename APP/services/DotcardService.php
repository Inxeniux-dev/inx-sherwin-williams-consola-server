<?php

    class Dotcardservice
    {


        public function validateAddDotCard($data)
        {
            $errors = array();


            if(is_null($data["card"]) || strlen ($data["card"]) <= 0)
            {
                  array_push($errors, 'La tarjeta es requerida');
            }
            else{
                if(is_int($data["card"]) || is_float($data["card"]))
                {
                    array_push($errors, 'La tarjeta es incorrecta');
                }
            }


            if(is_null($data["direction"]) || strlen ($data["direction"]) <= 0)
            {
                  array_push($errors, 'La dirección es requerida');
            }
            else{
                if(is_int($data["direction"]) || is_float($data["direction"]))
                {
                    array_push($errors, 'La dirección es incorrecta');
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


            if(is_null($data["occupation"]) || strlen ($data["occupation"]) <= 0)
            {
                  array_push($errors, 'La ocupación es requerida');
            }
            else{
                  if(is_int($data["name"]) || is_float($data["name"]))
                  {
                      array_push($errors, 'La ocupación es incorrecta');
                  }
            }


            if(is_null($data["descount"]) || strlen($data["descount"]) <= 0)
            {
                     array_push($errors, 'El descuento es incorrecto');
            }
            else
            {
                 if(!is_numeric($data["descount"]))
                 {
                     array_push($errors, 'El descuento es incorrecto');
                 }
                 else{
                     if($data["descount"] < 0)
                     {
                         array_push($errors, 'El descuento es incorrecto');
                     }
                 }
            }



          /*-------------------------------------------------------------------------
          -- NO REQUERIDOS: Pero si se ingresan deben de tener el formato correcto --
          -------------------------------------------------------------------------*/

          if(strlen($data["email"]) > 0)
          {
                if(!filter_var($data["email"], FILTER_VALIDATE_EMAIL))
                {
                    array_push($errors, 'El email es incorrecto');
                }
          }

          if(strlen($data["phone"]) > 0 && strlen($data["phone"]) < 11)
          {
                if(!is_numeric($data["phone"]))
                {
                    array_push($errors, 'El teléfono es incorrecto');
                }
          }


          if($data["edit"] == true)
          {
                if(is_null($data["points"]) || strlen($data["points"]) <= 0)
                {
                        array_push($errors, 'Los puntos son requeridos');
                }
                else
                {
                    if(!is_numeric($data["points"]))
                    {
                        array_push($errors, 'Los puntos son incorrectos');
                    }
                    else{
                        if($data["points"] < 0)
                        {
                            array_push($errors, 'Los puntos son incorrectos');
                        }
                    }
                }
          }



            $status = count($errors) > 0 ? false : true;
            return array("error" => $errors, "validation" => $status);

        }



        public function DotCardTableList($data, $paginator)
        {
            $output = '<table class="table table-hover table-condensed table-sm">
                        <thead>
                            <tr>
                                <th>Tarjeta</th>
                                <th>Nombre</th>
                                <th>Puntos</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Fecha Alta</th>
                                <th>Ocupación</th>
                                <th align="center"><i class="fa fa-search"></i></th>
                            </tr>
                        </thead>
                        <tbody>';

                        while($rows = $data->fetch_object())
                        {   if($rows->idpintor > 1){

                              $css = '';
                              $change = 0;
                              if(!is_numeric($rows->num_tarjeta))
                              {
                                  $css = 'class = "table-danger"';
                                  $change++;
                              }
                              else {
                                if(intval($rows->num_tarjeta) <= 0)
                                {
                                    $css = 'class = "table-danger"';
                                    $change++;
                                }
                              }

                                $output .= '<tr '.$css.'>
                                                <td>'.$rows->num_tarjeta.'</td>
                                                <td class = "text-primary">'.strtoupper($rows->nombre).'</td>
                                                <td align = "right">'.number_format($rows->puntos, 0).'</td>
                                                <td>'.$rows->telefono.'</td>
                                                <td>'.$rows->direccion.'</td>
                                                <td>'.$rows->fecha_alta.'</td>
                                                <td>'.$rows->ocupacion.'</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <h6 class="dropdown-header"><b>Canje</b></h6>';
                                                            if($change > 0)
                                                            {
                                                                  $output .= '<a class="dropdown-item" href="javascript:void(0);" ><small class = "text-muted">No disponible</small></a>';
                                                            }
                                                            else {
                                                                $output .= '<a class="dropdown-item" href="change/'.$rows->idpintor.'/" ><i class="fas fa-exchange-alt"></i> Canjear Puntos</a>';
                                                            }

                                                $output .= '<div class="dropdown-divider"></div>
                                                            <h6 class="dropdown-header"><b>Otros</b></h6>
                                                            <a class="dropdown-item" href="details/'.$rows->idpintor.'/" ><i class="fa fa-search"></i> Ver detalles</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>';
                            }
                        }

            $output .= "</tbody></table><div class='box-footer'>";
            $output .= $paginator;
            $output .= "</div>";
            return $output;
        }
    }






    







?>
