<?php

function getAreas()
{
  return [ 0 => "Seleccione", 1 => "Sistemas", 2 => "Administrador", 2 => "Contabilidad", 3 => "Ventas", 4 => "Auditoría", 5 => "Gerencia" ];
}

function generate_string($strength = 16) {
    $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXZ';
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}

function phoneformat($number)
{
    if(strlen($number) == 10)
    {
      $result = sprintf("%s-%s-%s",
              substr($number, 0, 3),
              substr($number, 3, 3),
              substr($number, 6));
        return $result;
    }
  return $number;
}


function SumarORestarFechas($fecha, $operacion, $cantidad, $tipo)
{
    return date("Y-m-d",strtotime($fecha."".$operacion." ".$cantidad." ".$tipo));
}


function diasEntreFechas($fechainicio, $fechafin){
    return intval(((strtotime($fechafin)-strtotime($fechainicio))/86400));
}

function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}


function validar_fecha_espanol($fecha){
    $valores = explode('-', $fecha);
    if(count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])){
        return true;
    }
    return false;
}


function addCeros($value)
{
  if($value < 10){ return "0".str_replace("0","", $value); }
  return $value;
}


function removeCeros($value)
{
    if($value < 10){ return str_replace("0", "", $value); }
    return $value;
}


function numero_dia_fecha($fecha)
{
    return substr($fecha, -2);
}

function inicio_de_mes($date)
{
  $aux = explode("-", $date);
  return $aux[0]."-".$aux[1]."-01";
}

function to_object($data)
{
  return json_decode(json_encode($data));
}

function conver_to_date($value)
{
    if(is_numeric($value) && strlen($value) == 8)
    {
       $anio = substr($value, 0, 4);
       $mes = substr($value, 4, 2);
       $day = substr($value, 6, 2);
       return $anio."-".$mes."-".$day;
    }
    return false;
}

function conver_to_hour($value)
{
    if(is_numeric($value) && strlen($value) == 6)
    {
       $hora = substr($value, 0, 2);
       $min = substr($value, 2, 2);
       $segundo = substr($value, 4, 2);
       return $hora.":".$min.":".$segundo;
    }
    return false;
}



function getCountInabilesDelMes($anio, $mes, $sunday = true)
{
    $no_dias = getUltimoDiaMes($anio, $mes);

    $dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
    $count_domingos = 0;

    $NOMBRE_DIA  = '';
    for($x = 0; $x < $no_dias; $x++)
    {
        $dia = ($x+1);
        $NOMBRE_DIA = $dias[(date('N', strtotime($anio."-".$mes."-".$dia))) - 1];

        if(!$sunday)  //Trabaja en domingo
        {
          if($NOMBRE_DIA == "Domingo")
          {
              $count_domingos++;
          }
        }
    }
    return $count_domingos;
}



function getCountInabilesDelMesALaFecha($anio, $mes, $sunday = true , $fecha)
{
      $no_dias = getUltimoDiaMes($anio, $mes);

      $dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
      $dias_laborados = 0;
      $NOMBRE_DIA  = '';
      for($x = 0; $x < $no_dias; $x++)
      {
            $dia = ($x+1);
            $NOMBRE_DIA = $dias[(date('N', strtotime($anio."-".$mes."-".$dia))) - 1];

            if($sunday)  //Trabaja en domingo
            {
                  $dias_laborados++;
            }
            else
            {
                if($NOMBRE_DIA != "Domingo")
                {
                    $dias_laborados++;
                }
            }

            $date_aux = $anio."-".$mes."-".$dia;
            if($fecha == $date_aux){ break; }
      }
      return $dias_laborados;
}





function eliminarDobleEspacios($cadena)
{
    $limpia    = "";
    $parts    = array();

    // divido la cadena con todos los espacios q haya
    $parts = explode(" ",$cadena);

    foreach($parts as $subcadena)
    {
        // de cada subcadena elimino sus espacios a los lados
        $subcadena = trim($subcadena);

        // luego lo vuelvo a unir con un espacio para formar la nueva cadena limpia
        // omitir los que sean unicamente espacios en blanco
        if($subcadena!="")
        { $limpia .= $subcadena." "; }
    }
    $limpia = trim($limpia);

    $limpia = str_replace("'", '', $limpia);
    $limpia = str_replace("\"", '', $limpia);
    $limpia = str_replace(",", '', $limpia);
    $limpia = str_replace("Ñ", '¥', strtoupper($limpia));

    return $limpia;
}


function nameDia($fecha){
    $fechats = strtotime($fecha); //pasamos a timestamp

 //el parametro w en la funcion date indica que queremos el dia de la semana
 //lo devuelve en numero 0 domingo, 1 lunes,....
   switch (date('w', $fechats)){
       case 0: return "Domingo"; break;
       case 1: return "Lunes"; break;
       case 2: return "Martes"; break;
       case 3: return "Miercoles"; break;
       case 4: return "Jueves"; break;
       case 5: return "Viernes"; break;
       case 6: return "Sabado"; break;
   }
 }




function calcula_precio_item_compra($cantidad, $paquete, $precio)
{
  $precio_unitario = $precio;
  if($paquete > 1)
  {
    $cantidad = ($cantidad * $paquete);
    $precio_unitario = $cantidad == 0 ? 0 : ($precio / $cantidad);
  }
  return array("cantidad" => $cantidad, "precio_unitario" => $precio_unitario);
}


function calcula_importe_por_producto($precio, $cant, $descuento)
{
        if($descuento >= 100){
            $descuento = 1;
        }
        else{
            if($descuento >= 10)
            {
              $descuento = str_replace(".", "", $descuento);
            }
            if($descuento >= 10){
                $descuento = "0.".$descuento;
            }
            else{
                 $descuento = str_replace(".", "", $descuento);
                 $descuento = "0.0".$descuento;
            }
        }


        $precio_sin_impuesto = round(($precio/1.16), 2);
        $descuento_individual_producto = ($precio_sin_impuesto * $descuento);
        $descuento_subtotal = ($descuento_individual_producto * $cant);

        $descuento_individual_producto_neto = ($precio * $descuento);
        $descuento_subtotal_neto = ($descuento_individual_producto_neto * $cant);

        $iva_producto = (($precio_sin_impuesto - truncadoNoFormat($descuento_individual_producto,2)) * 0.16);
        $importe_iva_con_cantidad = round(($iva_producto*$cant),2);
        $importe_iva_sin_cantidad = round(($iva_producto),2);
        $precio_con_impuesto = $precio_sin_impuesto + $importe_iva_sin_cantidad;
        $nuevo_iva_sin_redondear = ($iva_producto * $cant);
        $importe_sin_impuesto = ($precio_sin_impuesto * $cant);
        $importe_total = ($precio_sin_impuesto * $cant) + $importe_iva_con_cantidad;
        $subtotal_neto = ($cant * $precio);

        $_DESCUENTO = truncadoNoFormat($descuento_subtotal, 2);
        //$_DESCUENTO = truncadoNoFormat(round($descuento_subtotal,2), 2);
        $_DESCUENTO_NETO = truncadoNoFormat($descuento_subtotal_neto, 2);
        $_SUMA = ($precio_sin_impuesto) * $cant;
        $_IVA = $nuevo_iva_sin_redondear;
        $_SUB = $_SUMA-$_DESCUENTO;
        $_SUB_CON_IMPUESTO = ($_SUB * 1.16);

        return array(
                "descuento" => $_DESCUENTO,
                "descuento_individual" => ($precio * $descuento),
                "suma" => $_SUMA,
                "iva" => $_IVA,
                "subtotal" => $_SUB,
                "subtotal_con_iva" => $_SUB_CON_IMPUESTO,
                "importe_total" => $importe_total,
                "precio_sin_impuesto" => $precio_sin_impuesto,
                "precio_neto " => $precio,
                "subtotal_neto" => $subtotal_neto,
                "descuento_neto" => $_DESCUENTO_NETO,
                "descuento_subtotal" => truncadoNoFormat($descuento_subtotal,2)
        );
    }



function calcula_importe_por_producto_backup($precio, $cant, $descuento)
{
        if($descuento >= 100){
            $descuento = 1;
        }
        else{
            $descuento = str_replace(".", "", $descuento);
            if($descuento >= 10){
                $descuento = "0.".$descuento;
            }
            else{
                 $descuento = "0.0".$descuento;
            }
        }

        $precio_sin_impuesto = round(($precio/1.16), 2);
        $descuento_individual_producto = ($precio_sin_impuesto * $descuento);
        $descuento_subtotal = ($descuento_individual_producto * $cant);

        $descuento_individual_producto_neto = ($precio * $descuento);
        $descuento_subtotal_neto = ($descuento_individual_producto_neto * $cant);

        $iva_producto = (($precio_sin_impuesto - truncadoNoFormat($descuento_individual_producto,2)) * 0.16);
        $importe_iva_con_cantidad = round(($iva_producto*$cant),2);
        $importe_iva_sin_cantidad = round(($iva_producto),2);
        $precio_con_impuesto = $precio_sin_impuesto + $importe_iva_sin_cantidad;
        $nuevo_iva_sin_redondear = ($iva_producto * $cant);
        $importe_sin_impuesto = ($precio_sin_impuesto * $cant);
        $importe_total = ($precio_sin_impuesto * $cant) + $importe_iva_con_cantidad;
        $subtotal_neto = ($cant * $precio);

        $_DESCUENTO = truncadoNoFormat($descuento_subtotal, 2);
        $_DESCUENTO_NETO = truncadoNoFormat($descuento_subtotal_neto, 2);
        $_SUMA = ($precio_sin_impuesto) * $cant;
        $_IVA = $nuevo_iva_sin_redondear;
        $_SUB = $_SUMA-$_DESCUENTO;

        return array(
                "descuento" => $_DESCUENTO,
                "descuento_individual" => ($precio * $descuento),
                    "suma" => $_SUMA,
                    "iva" => $_IVA,
                    "subtotal" => $_SUB,
                    "importe_total" => $importe_total,
                "precio_sin_impuesto" => $precio_sin_impuesto,
                "precio_neto " => $precio,
                "subtotal_neto" => $subtotal_neto,
                "descuento_neto" => $_DESCUENTO_NETO,
                "descuento_subtotal" => truncadoNoFormat($descuento_subtotal,2)
        );
    }


    function truncadoFormat($cantidad, $decimales){

            $divisor=0;
            $dividendo=0;
            if(strrpos($cantidad, ".")){
            $dividir = explode(".", $cantidad);
            $dividendo=$dividir[0];
            $divisor=$dividir[1];
            }
            else{
            $cantidad=$cantidad.".00";
            $dividir = explode(".", $cantidad);
            $dividendo=$dividir[0];
            $divisor=$dividir[1];
            }



            if($divisor== 0) {
            return number_format($cantidad, $decimales,".",",");
            }else{
            $monto = number_format($dividendo,0,".",",");
            $decimaltruncado=substr($divisor, 0, $decimales);
            return $monto.".".$decimaltruncado;
            }
        }



        function truncadoNoFormat($cantidad, $decimales){

            $divisor=0;
            $dividendo=0;
            if(strrpos($cantidad, ".")){
            $dividir = explode(".", $cantidad);
            $dividendo=$dividir[0];
            $divisor=$dividir[1];
            }
            else{
            $cantidad=$cantidad.".00";
            $dividir = explode(".", $cantidad);
            $dividendo=$dividir[0];
            $divisor=$dividir[1];
            }

            if($divisor== 0) {
            return number_format($cantidad, $decimales,".","");
            }else{
            $monto = number_format($dividendo,0,".","");
            $decimaltruncado=substr($divisor, 0, $decimales);
            return $monto.".".$decimaltruncado;
            }
        }





    function calculaDescuentoPorCodigo($idtipo_descuento, $tipo_de_linea, $data_venta, $fecha_inicial, $fecha_final, $descuento_code, $descuento_maximo){

        $corte = $_SESSION["config"]["date_corte"];

        $descuento_por_codigo = 0;

        if($idtipo_descuento == 1)
        {
            if($corte >= $fecha_inicial && $corte <= $fecha_final)
            {
                $descuento_por_codigo = $descuento_code;
            }

            if($tipo_de_linea == 2)
            {
                $descuento_por_codigo = 0;
            }
        }
        if($idtipo_descuento == 2)
        {
            $descuento_por_codigo = $descuento_maximo;

            if($tipo_de_linea == 2)
            {
                $descuento_por_codigo = 0;
            }
        }

        if($idtipo_descuento == 3)
        {
            $descuento_por_codigo = $data_venta->descuento;
            if($tipo_de_linea == 2)
            {
                $descuento_por_codigo = 0;
            }
        }

        if($idtipo_descuento == 4)
        {
            $descuento_por_codigo = $data_venta->descuento_puntos;
            if($tipo_de_linea == 2)
            {
                $descuento_por_codigo = 0;
            }
        }

        if($idtipo_descuento == 5)
        {
            $descuento_por_codigo = 100;
            if($tipo_de_linea == 2)
            {
                $descuento_por_codigo = 0;
            }
        }



      //  echo $idtipo_descuento." - ".$tipo_de_linea." - - ".$fecha_inicial." - ".$fecha_final." - ".$descuento_code." - ".$descuento_por_codigo."<br>";

        return $descuento_por_codigo;
    }



  function genera_cadena_descuento()
  {
      $digit1 = (string)rand(10, 99);
      $digit2 = (string)rand(10, 99);
      $digit3 = (string)date("H");
      return $digit1."-".$digit2."-".$digit3;
  }


  function desifrar_clave_descuento($clave)
  {
    $clave = str_replace("-","",$clave);

    $numero1 = substr($clave, 0, 1);
    $numero2 = substr($clave, 1, 1);

    $numero3 = substr($clave, 2, 1);
    $numero4 = substr($clave, 3, 1);

    $numero5 = substr($clave, 4, 1);
    $numero6 = substr($clave, 5, 1);

    $n1 = $numero1.$numero3;
    $n2 = $numero2.$numero4;

    $digito1 = $n1 + $n2;
    $digito2 = $numero5+$numero6+$numero1;

    $num1 = $numero1.$numero3;
    $num2 = $numero2.$numero4;
    $nuevo_digito = ($numero1*$numero4)+$n2;

    $resultado = $digito1.$digito2.$nuevo_digito;
    return $resultado;
  }



function name_mes($mes)
{
    date_default_timezone_set("America/Mexico_City");
    $name = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"][$mes - 1];
    return $name;
}


function days_diference($start, $end)
{
    $firstDate = $start;
    $secondDate = $end;

    $dateDifference = (strtotime($secondDate) - strtotime($firstDate));

    $years  = floor($dateDifference / (365 * 60 * 60 * 24));
    $months = floor(($dateDifference - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days   = floor(($dateDifference) / (60 * 60 * 24));
    //return array("years" => $years, "months" => $months, "days" => $days);
    return $days;
}


function sanear_string($string)
{

    $string = trim($string);

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('¥', '¥', 'c', 'C',),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             "\"", "'"),
        '',
        $string
    );


    return $string;
}




function sanear_clave_sucursal($clave){
    if($clave < 10)
    {
        $pos = strpos($clave, "0");
        if ($pos === false) {
              return $clave;
        } else {
          return str_replace("0", "", $clave);
        }
    }
  return $clave;
}




function fechaCastellano ($fecha) {
    $hora=$fecha;
    $fecha = substr($fecha, 0, 10);
    $hora =substr($hora, 10, 19);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio." a las".$hora;
  }


  function fechaCastellanoSinDate ($fecha) {
    $hora=$fecha;
    $fecha = substr($fecha, 0, 10);
    $hora =substr($hora, 10, 19);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
  }


function fechaCorta ($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $numeroDia."/".$nombreMes."/".$anio;
}


function fechaCortaConHora ($fecha) {
    $hora=$fecha;
    $fecha = substr($fecha, 0, 10);
    $hora =substr($hora, 10, 19);
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $numeroDia."-".$nombreMes."-".$anio. " ".$hora;
}


function fechaCortaAbreviada ($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $meses_ES = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $numeroDia."-".$nombreMes."-".$anio;
}


function fechaCortaAbreviadaConHora ($fecha) {
    $hora=$fecha;
    $fecha = substr($fecha, 0, 10);
    $hora =substr($hora, 10, 19);
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $meses_ES = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    $meridiado = substr($hora, 0, 3) > 11 ? ' PM' : ' AM';

    if(strlen($hora) == 0)
    {
        return $numeroDia."-".$nombreMes."-".$anio;
    }

    return $numeroDia."-".$nombreMes."-".$anio. ",  ".$hora.$meridiado;
}


function calcularMesesEntreFechas($fechaInicio, $fechaFin) {
    $inicio = new DateTime($fechaInicio);
    $fin = new DateTime($fechaFin);
    
    $diff = $inicio->diff($fin);
    
    $anios = $diff->y;
    $meses = ($anios * 12) + $diff->m;
    
    return $meses;
}


function generaKeyQue()
{
  $KEY = rand(0, 100000);
  $op = rand(1, 9);
  $result = round(abs(($KEY/$op)));
  $time = date("His");
  $rand = rand(0,100);
  return trim($result.$time.$rand);
}


function generate_string_token()
{
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($permitted_chars);
    $strength = 20;

    $random_string = '';

    for($i = 0; $i < $strength; $i++) {
        $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string."_".$_SESSION["config"]["key_suc"];
}




function getMonths()
{
    return array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
}

function nameMonth($month)
{
    if($month < 0 || $month > 12)
    {
      "Undefined";
      return;
    }
   $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
   return $meses[$month-1];
}

function getYears($inicial)
{
    $years = array();
    $anio_inicial = $inicial == null  ?  $_SESSION["config"]["year_init"] : $inicial;
    $anio_actual = date("Y");
    $count = intval(abs($anio_inicial - $anio_actual));
    for($x=0; $x <= $count; $x++)
    {
        $years[] = $anio_inicial;
        $anio_inicial++;
    }
    return $years;
}



function getUltimoDiaMes($elAnio,$elMes) {
    return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
}



function get_IVA($monto)
{
    return ($monto/1.16);
}




function diferencia_en_fechas($fecha_ini, $fecha_fin)
{
  if($fecha_ini > $fecha_fin)
  {
    return 0;
  }

  $dateTimeObject1 = date_create($fecha_ini);
  $dateTimeObject2 = date_create($fecha_fin);

  $difference = date_diff($dateTimeObject1, $dateTimeObject2);
  $minutes = $difference->days * 24 * 60;
  $minutes += $difference->h * 60;
  $minutes += $difference->i;

  return $minutes;
}


function convertirMinutosAHoras($tiempo_en_minutos) {
    $tiempo_en_segundos = ($tiempo_en_minutos * 60);
    $horas = floor($tiempo_en_segundos / 3600);
    $minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
    $segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);

    if($horas > 1)
    {
       return $horas . ' horas ' . $minutos . " min ";
    }

    return $minutos." min";
}



function nombreDia($date)
{
   $dias_abrev = array('L','Ma','Mi','J','V','S','D');
   return  $dias_abrev[(date('N', strtotime($date))) - 1];
}


function searchForId($fecha, $array) {

   foreach ($array as $key => $val) {
       if ($val['date'] === $fecha) {
           return $val;
       }
   }
   return null;
}


function obtieneAsistencia($found_hora, $dia, $trabaja_sabado, $tipo)
{
  $hoy = date("Y-m-d");
  $hora = substr($found_hora['fecha'], 10);
  $nombre_dia = nombreDia($dia);

  if($tipo == 6)
  {
     return ["code" => 0, "hora" => ''];
  }

  if($dia > $hoy)
  {
     return ["code" => 0, "hora" => ''];
  }

  if(trim($nombre_dia) == "S")
  {
     return $trabaja_sabado == 0 ?  $hora != null ? ["code" => 3, "hora" => 'R'.$hora] : ["code" => 2, "hora" => 'F']   :  ["code" => 1, "hora" => ''];
  }

  if(trim($nombre_dia) == "D")
  {
        return  $hora != null ?  $hora != null ? ["code" => 3, "hora" => 'R'.$hora] : ["code" => 2, "hora" => 'F']   :  ["code" => 1, "hora" => ''];
  }

  if($hora == null)
  {
     return ["code" => 2, "hora" => 'F'];
  }

  $minutos = diferencia_en_fechas(trim($dia)." 08:00:00", trim($dia)." ".trim($hora));

  if($minutos >= 6 )
  {
      return ["code" => 3, "hora" => 'R'.$hora];
  }

  return ["code" => 0, "hora" => ''];
}




function groupArray($array, $groupkey)
{
 if (count($array)>0)
 {
    $keys = array_keys($array[0]);
    $removekey = array_search($groupkey, $keys);        if ($removekey===false)
        return array("Clave \"$groupkey\" no existe");
    else
        unset($keys[$removekey]);
    $groupcriteria = array();
    $return=array();
    foreach($array as $value)
    {
        $item=null;
        foreach ($keys as $key)
        {
            $item[$key] = $value[$key];
        }
        $busca = array_search($value[$groupkey], $groupcriteria);
        if ($busca === false)
        {
            $groupcriteria[]=$value[$groupkey];
            $return[]=array($groupkey=>$value[$groupkey],'groupeddata'=>array());
            $busca=count($return)-1;
        }
        $return[$busca]['groupeddata'][]=$item;
    }
    return $return;
 }
 else
    return array();
}



function enableMeses($year){
    $meses[] = null;
    $month_actual = date("m");
    $year_actual = date("Y");
    for($x=1; $x <= 12; $x++)
    {
        if($year_actual == $year)
        {
            if($x > $month_actual)
            {
                $meses[$x] = false;
            }
            else{
                $meses[$x] = true;
            }
        }
        else{
            $meses[$x] = true;
        }
    }
    return $meses;
}




function genera_letra_celda($indice)
{
    $LETRAS = [1 => "A", 2 => "B", 3 => "C", 4 => "D", 5 => "E", 6 => "F", 7 => "G", 8 => "H", 9 => "I", 10 => "J", 11 => "K", 12 => "L", 13 => "M", 14 => "N", 15 => "O",
            16 => "P", 17 => "Q", 18 => "R", 19 => "S", 20 => "T", 21 => "U", 22 => "V", 23 => "W", 24 => "X", 25 => "Y", 26 => "Z", 27 => "AA", 28 => "AB", 29 => "AC",
            30 => "AD", 31 => "AE", 32 => "AF", 33 => "AG", 34 => "AH", 35 => "AI", 36 => "AJ", 37 => "AK", 38 => "AL", 39 => "AM", 40 => "AN",  41 => "AO",  42 => "AP",
            43 => "AQ",  44 => "AR",  45 => "AS",  46 => "AT",  47 => "AU",  48 => "AV",  49 => "AW",  50 => "AX",  51 => "AY",  52 => "AZ",  53 => "BA",  54 => "BB" ,
            55 => "BC",  56 => "BD",  57 => "BE",  58 => "BF",  59 => "BG",  60 => "BH",  61 => "BI",  62 => "BJ",  63 => "BK",  64 => "BL",  65 => "BM",  66 => "BN",
            67 => "BO",  68 => "BQ",  69 => "BR",  70 => "BS", 71 => "BT", 72 => "BU", 73=> "BV", 74 => "BW", 75 => "BX", 76 => "BY", 77 => "BZ", 78 => "CA", 79 => "CB",
            80 => "CB"];

    return $LETRAS[$indice];
}


function numeroALetras($num, $fem = false, $dec = true) {


      if($num < 1)
      {
          $aux = explode(".", $num);
          $centavos = "0";
          if(count($aux) > 1)
          {
            $centavos = $aux[1];
          }
          return 'Cero pesos '.$centavos.'/100 M.N.';
      }


   $matuni[2]  = "dos";
   $matuni[3]  = "tres";
   $matuni[4]  = "cuatro";
   $matuni[5]  = "cinco";
   $matuni[6]  = "seis";
   $matuni[7]  = "siete";
   $matuni[8]  = "ocho";
   $matuni[9]  = "nueve";
   $matuni[10] = "diez";
   $matuni[11] = "once";
   $matuni[12] = "doce";
   $matuni[13] = "trece";
   $matuni[14] = "catorce";
   $matuni[15] = "quince";
   $matuni[16] = "dieciseis";
   $matuni[17] = "diecisiete";
   $matuni[18] = "dieciocho";
   $matuni[19] = "diecinueve";
   $matuni[20] = "veinte";
   $matunisub[2] = "dos";
   $matunisub[3] = "tres";
   $matunisub[4] = "cuatro";
   $matunisub[5] = "quin";
   $matunisub[6] = "seis";
   $matunisub[7] = "sete";
   $matunisub[8] = "ocho";
   $matunisub[9] = "nove";

   $matdec[2] = "veint";
   $matdec[3] = "treinta";
   $matdec[4] = "cuarenta";
   $matdec[5] = "cincuenta";
   $matdec[6] = "sesenta";
   $matdec[7] = "setenta";
   $matdec[8] = "ochenta";
   $matdec[9] = "noventa";
   $matsub[3]  = 'mill';
   $matsub[5]  = 'bill';
   $matsub[7]  = 'mill';
   $matsub[9]  = 'trill';
   $matsub[11] = 'mill';
   $matsub[13] = 'bill';
   $matsub[15] = 'mill';
   $matmil[4]  = 'millones';
   $matmil[6]  = 'billones';
   $matmil[7]  = 'de billones';
   $matmil[8]  = 'millones de billones';
   $matmil[10] = 'trillones';
   $matmil[11] = 'de trillones';
   $matmil[12] = 'millones de trillones';
   $matmil[13] = 'de trillones';
   $matmil[14] = 'billones de trillones';
   $matmil[15] = 'de billones de trillones';
   $matmil[16] = 'millones de billones de trillones';

   //Zi hack
   $float=explode('.',$num);
   $num=$float[0];

   $num = trim((string)@$num);
   if ($num[0] == '-') {
      $neg = 'menos ';
      $num = substr($num, 1);
   }else
      $neg = '';
   while ($num[0] == '0') $num = substr($num, 1);
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num;
   $zeros = true;
   $punt = false;
   $ent = '';
   $fra = '';
   for ($c = 0; $c < strlen($num); $c++) {
      $n = $num[$c];
      if (! (strpos(".,'''", $n) === false)) {
         if ($punt) break;
         else{
            $punt = true;
            continue;
         }

      }elseif (! (strpos('0123456789', $n) === false)) {
         if ($punt) {
            if ($n != '0') $zeros = false;
            $fra .= $n;
         }else

            $ent .= $n;
      }else

         break;

   }
   $ent = '     ' . $ent;
   if ($dec and $fra and ! $zeros) {
      $fin = ' coma';
      for ($n = 0; $n < strlen($fra); $n++) {
         if (($s = $fra[$n]) == '0')
            $fin .= ' cero';
         elseif ($s == '1')
            $fin .= $fem ? ' una' : ' un';
         else
            $fin .= ' ' . $matuni[$s];
      }
   }else
      $fin = '';
   if ((int)$ent === 0) return 'Cero ' . $fin;
   $tex = '';
   $sub = 0;
   $mils = 0;
   $neutro = false;
   while ( ($num = substr($ent, -3)) != '   ') {
      $ent = substr($ent, 0, -3);
      if (++$sub < 3 and $fem) {
         $matuni[1] = 'una';
         $subcent = 'as';
      }else{
         $matuni[1] = $neutro ? 'un' : 'uno';
         $subcent = 'os';
      }
      $t = '';
      $n2 = substr($num, 1);
      if ($n2 == '00') {
      }elseif ($n2 < 21)
         $t = ' ' . $matuni[(int)$n2];
      elseif ($n2 < 30) {
         $n3 = $num[2];
         if ($n3 != 0) $t = 'i' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }else{
         $n3 = $num[2];
         if ($n3 != 0) $t = ' y ' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }
      $n = $num[0];
      if ($n == 1) {
         $t = ' ciento' . $t;
      }elseif ($n == 5){
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
      }elseif ($n != 0){
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
      }
      if ($sub == 1) {
      }elseif (! isset($matsub[$sub])) {
         if ($num == 1) {
            $t = ' mil';
         }elseif ($num > 1){
            $t .= ' mil';
         }
      }elseif ($num == 1) {
         $t .= ' ' . $matsub[$sub] . 'ón';
      }elseif ($num > 1){
         $t .= ' ' . $matsub[$sub] . 'ones';
      }
      if ($num == '000') $mils ++;
      elseif ($mils != 0) {
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub];
         $mils = 0;
      }
      $neutro = true;
      $tex = $t . $tex;
   }
   $tex = $neg . substr($tex, 1) . $fin;
   //Zi hack --> return ucfirst($tex);
   $end_num=ucfirst($tex).' pesos '.$float[1].'/100 M.N.';
   return  strtoupper($end_num);
}

?>
