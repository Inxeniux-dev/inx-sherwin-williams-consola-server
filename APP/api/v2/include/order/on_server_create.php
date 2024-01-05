<?php

$sql = "SELECT path_orders FROM config WHERE id = 1 LIMIT 1;";
$response = $conexion->query($sql);
$PATH_ORDER = $response->fetch_object()->path_orders;
$PATH_ORDER = strlen($PATH_ORDER) == 0 ? "C:/" : $PATH_ORDER;

date_default_timezone_set("America/Mexico_City");
$datosRecibidos = file_get_contents("php://input");
$vale = json_decode($datosRecibidos);

$header = $vale->vale->header;
$prods= $vale->vale->prods;


try {

	  $xml=new DomDocument('1.0');
    $xml->formatOutput=true;

    $conten=$xml->createElement("contend");
    $xml->appendChild($conten);


    $data=$xml->createElement("data");
    $conten->appendChild($data);

    $name=$xml->createElement("name","XML_PEDIDOS");
    $data->appendChild($name);

    $datefile=$xml->createElement("date_file", $header->date_file);
    $data->appendChild($datefile);

    $datefile=$xml->createElement("name_file", $header->file);
    $data->appendChild($datefile);

    $datefile=$xml->createElement("suc_id", $header->suc_id);
    $data->appendChild($datefile);

    $almacen=$xml->createElement("almacen", $header->almacen);
    $data->appendChild($almacen);

    $datefile=$xml->createElement("suc_name",$header->sucursal);
    $data->appendChild($datefile);


    $productos=$xml->createElement("productos");
    $conten->appendChild($productos);

		for($x = 0; $x<count($prods); $x++)
		{
          $prod=$xml->createElement("product");
          $prod->setAttribute("id",$prods[$x]->id);
          $productos->appendChild($prod);

          $code=$xml->createElement("code",$prods[$x]->cod);
          $prod->appendChild($code);

          $price=$xml->createElement("cant",$prods[$x]->cant);
          $prod->appendChild($price);
		}

		if($xml->save($PATH_ORDER.$header->file.".xml")){
			$code_status = 'FileSave';
		}
		else
		{
			$code_status = 'ErrorSave';
		}
	}
	catch(Exception $e){
	   $code_status = 'ErrorCreate';
	}

$respuesta = array(
    "mensaje" => "API: He recibido los datos",
    "encabezados" => getallheaders(),
    "fechaYHora" => date("Y-m-d H:i:s"),
    "code_status" => $code_status
 );

 echo json_encode($respuesta);
 return;
?>
