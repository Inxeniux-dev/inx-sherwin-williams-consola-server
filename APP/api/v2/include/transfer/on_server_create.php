<?php

$sql = "SELECT path_transfer FROM config WHERE id = 1 LIMIT 1;";
$response = $conexion->query($sql);
$PATH_TRANSFER = $response->fetch_object()->path_transfer;
$PATH_TRANSFER = strlen($PATH_TRANSFER) == 0 ? "C:/" : $PATH_TRANSFER;

date_default_timezone_set("America/Chihuahua");

$datosRecibidos = file_get_contents("php://input");
$vale = json_decode($datosRecibidos);

$header = $vale->vale->header;
$prods= $vale->vale->prods;

 try {
 			$xml=new DomDocument('1.0');
 			$xml->formatOutput=true;

 		    $file = $suc_sal.$suc_ent.$serie_sal.$ult_dig_fol.'.xml';

 			$conten=$xml->createElement("contend");
 			$xml->appendChild($conten);

 			$data=$xml->createElement("data");
 			$conten->appendChild($data);

 			$name=$xml->createElement("name","XML_SALIDAS");
 			$data->appendChild($name);

 			$datefile=$xml->createElement("date_file",date("Y-m-d"));
 			$data->appendChild($datefile);

 			$datefile=$xml->createElement("folio", $header->folio);
 			$data->appendChild($datefile);

 			$datefile=$xml->createElement("suc_sol", $header->suc_env);
 			$data->appendChild($datefile);

 			$datefile=$xml->createElement("suc_env", $header->suc_sal);
 			$data->appendChild($datefile);

 			$id_chofer=$xml->createElement("id_chofer", 0);
 			$data->appendChild($id_chofer);

 			$serie=$xml->createElement("serie", $header->serie);
 			$data->appendChild($serie);


 			$DATA_COMENT = '';

 			if(!isset($header->comentario) || $header->comentario != null)
 			{
 				$DATA_COMENT = $header->comentario;
 			}

 			$comentario = $xml->createElement("coment", $DATA_COMENT);
 			$data->appendChild($comentario);


 			$productos=$xml->createElement("productos");
 			$conten->appendChild($productos);

 			for($x = 0; $x<count($prods); $x++)
 			{

 			    $prod=$xml->createElement("product");
 				$productos->appendChild($prod);

 				$code=$xml->createElement("CODIGO", $prods[$x]->codigo);
 					$prod->appendChild($code);

 				$capa=$xml->createElement("CAPA", $prods[$x]->capa);
 					$prod->appendChild($capa);

 				$fecha=$xml->createElement("FECHA", $prods[$x]->fecha);
 					$prod->appendChild($fecha);

 			    $serie=$xml->createElement("SV", $prods[$x]->sv);
 					$prod->appendChild($serie);

 				$fol=$xml->createElement("FOL", $prods[$x]->fol);
 					$prod->appendChild($fol);

 				$vale=$xml->createElement("VALE", $prods[$x]->vale);
 					$prod->appendChild($vale);

 				$mov=$xml->createElement("MOV", $prods[$x]->mov);
 					$prod->appendChild($mov);

 				$partida=$xml->createElement("CANT", $prods[$x]->cant);
 					$prod->appendChild($partida);

 				$fletee=$xml->createElement("FLETE", $prods[$x]->flete);
 					$prod->appendChild($fletee);

 				$cost=$xml->createElement("COSTO", $prods[$x]->costo);
 					$prod->appendChild($cost);

 				$precio=$xml->createElement("PRECIO", $prods[$x]->precio);
 					$prod->appendChild($precio);
 			}

 			if($xml->save($PATH_TRANSFER.$header->file)){
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
