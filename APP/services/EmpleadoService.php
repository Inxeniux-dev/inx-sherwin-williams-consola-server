<?php
class EmpleadoService
{


  function generaEncabezados($mes, $anio)
  {
      $mes_anterior = ($mes-1);
      if($mes_anterior <= 0){ $mes_anterior = 12; }
      $numero = cal_days_in_month(CAL_GREGORIAN, intval($mes_anterior), intval($anio));
      $mes_actual = date("m");
      $anio_actual = date("y");

      $fecha = date($anio."-".$mes."-01");
      $nuevafecha = strtotime ( '-1 month' , strtotime ( $fecha ) ) ;
      $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
      $data_fecha_ant = explode("-", $nuevafecha);

      $dias_abrev = array('L','Ma','Mi','J','V','S','D');

      $ULTIMO_DIA =  intval(20);

      if($anio_actual != $anio || $mes_actual != $mes)
      {
          $ULTIMO_DIA =  20;
      }

      $dias = array();

      for($x = 21; $x <= $numero; $x++)
       {
           $anio_anterior = ($anio-0); //hay que validar el año
           $NOMBRE_DIA = $dias_abrev[(date('N', strtotime($anio_anterior."-".$data_fecha_ant[1]."-".$x))) - 1];
           $dias[] = ["nombre" => $NOMBRE_DIA, "numero" => $x, "fecha" =>$anio_anterior."-".$data_fecha_ant[1]."-".$x];
       }

       for($x = 1; $x <= $ULTIMO_DIA; $x++)
       {
           $NOMBRE_DIA = $dias_abrev[(date('N', strtotime($anio."-".$mes."-".$x))) - 1];
           $dias[] = ["nombre" => $NOMBRE_DIA, "numero" => $x,  "fecha" => $anio."-".$mes."-".addCeros($x)];
       }

      return $dias;
  }



  function formatEmpleadosAsistencia($data, $encabezados)
  {

      $response = array();

      foreach ($data as $key => $value) {

          $bitacora = $value["bitacora"];
          $tipo = $value["tipo"];

          $movimientos = array();
          while($row = $bitacora->fetch_object())
          {
             $movimientos[] = [
               "fecha" => $row->create_at,
               "date_store" => $row->create_at,
               "date" => substr($row->create_at, 0, 10)
             ];
          }

          /*
          [idbitacora] => 17 [idconcepto] => 3 [create_at] => 2022-02-22 12:36:19 [date_store] => 2022-02-22 12:36:19 [nombre] => DAVID ADRIAN [apellido] => GARCIA CASTAÑEDA [nombre_sucursal] => PLAZA ORIENTE [nombre_base] => [suc_base] => 0 [idsucursal] => 7 )
          */

          $value = to_object($value);

          if($value->id > 1)
          {
                $dias = array();

                $count_retardos = 0;
                $minutos_retardo = 0;

                foreach ($encabezados as $ky => $val) {
                      $val = to_object($val);
                      $dia = $val->fecha;

                      $found_hora =  searchForId($dia, $movimientos);
                      $trabaja_sabado = 0;

                      $asistencia = to_object(obtieneAsistencia($found_hora, $dia, $trabaja_sabado, $tipo));

                      $dias[] = [
                        "asistencia" =>   $asistencia
                      ];

                      if($asistencia->code == 3){ $count_retardos++; }
                }

                $dias[] = [ "asistencia" => ["hora" => $count_retardos]];
                $dias[] = [ "asistencia" => ["hora" => $minutos_retardo]];
                $dias[] = [ "asistencia" => ["hora" => "NO"]];

              $response[] = [
                   "no_empleado" => $value->no_empleado,
                   "nombre" => $value->nombre." ".$value->apellido,
                   "dias" => $dias
              ];

          }

      }


      return $response;
  }




}
?>
