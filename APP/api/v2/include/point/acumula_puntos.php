<?php

$input = json_decode(file_get_contents('php://input'), true);
$hoy = date("Y-m-d H:i:s");

$canjes =  isset($input["exchange"]) ? $input["exchange"] : null;
if($canjes == null || empty($canjes)) { echo json_encode(["code" => 200, "message" => "Datos recibidos incorrectos"]); return; }

$response_change = array();

foreach ($canjes as $key => $value) {

  $card =  $value["card"];
  $idcard = $value["idcard"];
  $remision = $value["remision"];
  $idremision = $value["idremision"];
  $points = $value["points"];
  $fecha = $value["fecha"];
  $idsuc = $value["idsuc"];
  $token = $value["token"];
  $total = $value["total"];

  if($card == 0 || $idcard == 0 || $remision == 0 || $points == 0 || $idsuc == 0 || strlen($token) == 0 || $idremision == 0 || $total == 0)
  {
      $response_change[] = array("code" => 200,  "message" => "Datos incorrectos");
  }
  else {  //Acá se realizá el canje

        //BUSCAR SI EXISTE EL REGISTRO EN LA BASE DE DATOS
        $sql = "SELECT COUNT(*) AS total FROM tarjeta_bitacora WHERE idsucursal = '".$idsuc."' AND remision = '".$remision."' AND idconcepto = 1;";
        $response = $conexion->query($sql);

        $count = -1;
        while($row = $response->fetch_object()){ $count = $row->total; }

        
        //OBTENEMOS EL ID DE LA TARJETA
        $sql = "SELECT idtarjeta, puntos, status FROM tarjeta WHERE no_tarjeta = '".$card."' LIMIT 1";
        $response = $conexion->query($sql);
        $id_tarjeta = 0;
        $puntos_actuales = 0;
        $status = 0;
        while($row = $response->fetch_object()){ $id_tarjeta = $row->idtarjeta; $puntos_actuales = $row->puntos; $status = $row->status; }
        if($id_tarjeta == 0) { $count_error++; $response_change[] = array("code" => 200,  "message" => "El identificador de la tarjeta no se ha encontrado"); }

         if($status == 0) { $count_error++; $response_change[] = array("code" => 200,  "message" => "La tarjeta esta desactivada"); }


        $sql = "SELECT fecha_sucursal, create_at, update_at, idsucursal FROM tarjeta_bitacora  WHERE idtarjeta = '".$id_tarjeta."' AND idconcepto = 1  ORDER BY fecha_sucursal DESC LIMIT 1;";
        $response = $conexion->query($sql);
        $ultima_fecha = "";
        while($row = $response->fetch_object()){ $ultima_fecha = $row->fecha_sucursal; }
        
        $numMeses = calcularMesesEntreFechas($ultima_fecha, $hoy);

        if($numMeses >= EXPIRATION_MONTH)
        {
            $nuevaFecha = date("Y-m-d H:i:s", strtotime($hoy . " -1 second"));
            $sql = "UPDATE tarjeta SET puntos = 0 WHERE no_tarjeta = '".$card."' LIMIT 1";
            $conexion->query($sql);

            $sql = "INSERT INTO tarjeta_bitacora (puntos, total, fecha_sucursal, create_at, update_at, idtarjeta, idsucursal, idconcepto) VALUES ('".$puntos_actuales."', '0', '".$fecha."', '".$nuevaFecha."', '".$nuevaFecha."', '".$id_tarjeta."', '".$idsuc."', 3);";
            $conexion->query($sql);
        }
        
        
        if($count == 0)
        {
            $conexion->autocommit(false);
            $count_error = 0;

            $sql = "INSERT INTO tarjeta_bitacora (puntos, total, remision, fecha_sucursal, create_at, update_at, idtarjeta, idsucursal, idconcepto) VALUES ('".$points."', '".$total."', '".$remision."', '".$fecha."', '".$hoy."', '".$hoy."', '".$id_tarjeta."', '".$idsuc."', 1);";
            $response = $conexion->query($sql);

            if(!$response){ $count_error++; }

            $sql = "UPDATE tarjeta SET puntos = (puntos + '".$points."'), update_at = '".$hoy."' WHERE no_tarjeta = '".$card."' LIMIT 1;";
            $response = $conexion->query($sql);

            if(!$response){ $count_error++; }

            if($count_error > 0)
            {
                $conexion->rollback();
                $response_change[] = array("code" => 200,  "message" => "No Creado");
            }
            else {
              $conexion->commit();
            }

            $conexion->autocommit(true);
            $response_change[] = array("code" => 201,  "message" => "Creado",  "card" => $card, "idcard" => $idcard, "remision" => $remision, "puntos" => $points, "token" => $token, "idremision" => $idremision);
        }
        else {
            $response_change[] = array("code" => 200,  "message" => "Duplicado o consulta fallida");
        }
  }

}


echo json_encode(["code" => 200, "response" => $response_change]);
return;
?>
