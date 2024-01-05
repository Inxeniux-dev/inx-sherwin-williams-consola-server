<?php 
date_default_timezone_set("America/Chihuahua");
$datosRecibidos = file_get_contents("php://input");
$data = json_decode($datosRecibidos);


 $sql = "SELECT COUNT(*) AS total FROM tarjeta WHERE telefono = '".$data->telefono."' AND idtarjeta != '$data->id';";
 $response = $conexion->query($sql);
 $count = $response->fetch_object()->total;

 if($count > 0)
 {
 	echo json_encode(["code" => 200, "msg" => "El teléfono ya se encuentra registrado"]); return;
 }

$now = date("Y-m-d H:i:s");


$sql = "UPDATE tarjeta SET nombre = '".strtoupper($data->nombre)."', apellido = '".strtoupper($data->apellido)."', telefono = '".$data->telefono."', email = '".$data->email."', direccion = '".$data->direccion."', update_at = '".$now."' WHERE idtarjeta = '".$data->id."' LIMIT 1;"; 
$response = $conexion->query($sql);


if($response)
{


	$sql = "SELECT idtarjeta, no_tarjeta, nombre, apellido, telefono, email, puntos, descuento, direccion, status, create_at, membresia FROM tarjeta WHERE idtarjeta = '".$data->id."';";
	$response = $conexion->query($sql);

	$tarjeta = array();
	if($response)
	{
	  while($row = $response->fetch_object())
	  {
	    $tarjeta[] = $row;
	  }
	}


	echo json_encode(["code" => 201, "msg" => "Tarjeta actualizada exitosamente", "data" => $tarjeta]); return;
}


echo json_encode(["code" => 200, "msg" => "Error al actualizar tarjeta de puntos"]); return;


function generarFolioMembresia($nombre, $apellido) {
    $fechaActual = date('my');
    $primeraLetraNombre = strtoupper(substr($nombre, 0, 1));
    $primeraLetraApellido = strtoupper(substr($apellido, 0, 1));
    $numeroAleatorio = mt_rand(100, 999);

    $folio = $fechaActual ."-".$primeraLetraNombre . $primeraLetraApellido ."-". $numeroAleatorio;
    return $folio;
}

?>