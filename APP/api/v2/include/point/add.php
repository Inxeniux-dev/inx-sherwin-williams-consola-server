<?php 
date_default_timezone_set("America/Chihuahua");
$datosRecibidos = file_get_contents("php://input");
$data = json_decode($datosRecibidos);


 $sql = "SELECT COUNT(*) AS total FROM tarjeta WHERE telefono = '".$data->telefono."';";
 $response = $conexion->query($sql);
 $count = $response->fetch_object()->total;

 if($count > 0)
 {
 	echo json_encode(["code" => 200, "msg" => "El teléfono ya se encuentra registrado"]); return;
 }

$now = date("Y-m-d H:i:s");


$sql = "SELECT no_tarjeta FROM tarjeta ORDER BY no_tarjeta DESC LIMIT 1;";
$response = $conexion->query($sql);

$no_tarjeta = 1;
while($row = $response->fetch_object()){
	$no_tarjeta = ($row->no_tarjeta + 1);
}

$membresia = generarFolioMembresia($data->nombre, $data->apellido);


$sql = "INSERT INTO tarjeta (no_tarjeta, nombre, apellido, telefono, email, puntos, descuento, direccion, create_at, update_at, status, huella, sucursal_alta, membresia) VALUES ('".$no_tarjeta."', '".strtoupper($data->nombre)."', '".strtoupper($data->apellido)."', '".$data->telefono."', '".$data->email."', '0', '0', '".$data->direccion."', '".$now."', '".$now."', 1, 'H', '".$data->sucursal."', '".$membresia."');"; 
     $response = $conexion->query($sql);
     $id = $conexion->insert_id;

if($response)
{	
	
	$sql_suc = "SELECT nombre FROM sucursal WHERE idsucursal = '".$data->sucursal."';";
	$response_suc = $conexion->query($sql_suc);
	$sucursal_name = "";
	while($row = $response_suc->fetch_object()){
		$sucursal_name = $row->nombre;
	}



		$tarjeta = [
				"nombre" => $data->nombre,
				"apellido" => $data->apellido,
				"telefono" => $data->telefono,
				"puntos" => 0,
				"email" => $data->email,
				"descuento" => 0,
				"direccion" => $data->direccion,
				"status" => 1,
				"id" => $id,
				"no_tarjeta" => $no_tarjeta,
				"fecha" => $now,
				"membresia" => $membresia,
				"sucursal_registro" => $sucursal_name
			];


		echo json_encode(["code" => 201, "msg" => "Tarjeta creada exitosamente", "data" => $tarjeta]); return;
}


echo json_encode(["code" => 200, "msg" => "Error al registrar tarjeta de puntos"]); return;


function generarFolioMembresia($nombre, $apellido) {
    $fechaActual = date('my');
    $primeraLetraNombre = strtoupper(substr($nombre, 0, 1));
    $primeraLetraApellido = strtoupper(substr($apellido, 0, 1));
    $numeroAleatorio = mt_rand(100, 999);

    $folio = $fechaActual ."-".$primeraLetraNombre . $primeraLetraApellido ."-". $numeroAleatorio;
    return $folio;
}

?>