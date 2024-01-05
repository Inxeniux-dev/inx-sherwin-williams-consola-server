<?php 
	
	require_once "../../models/StoreModel.php";

	$suc = isset($_GET["suc"]) ? $_GET['suc'] : null;
	if($suc == null || !is_numeric($suc))
	{
		echo json_encode(["code" => 404, "error" => ["Sucursal inválida"]]);
		return;
	}

	$storeModel = new StoreModel();
	$storeModel->id = $suc;
	$store = $storeModel->one();
	$ip = $store->fetch_object()->ip;

	if($store && $store->num_rows > 0)
	{
			   $ch = curl_init();
			   curl_setopt($ch, CURLOPT_URL, 'http://'.$store->ip.'/pventa/app/api/send_backup.php'); 
			   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			   curl_setopt($ch, CURLOPT_HEADER, 0); 
			   $data = curl_exec($ch); 
			   curl_close($ch); 

			   $response = json_decode($data);
			   if($response->code == 200)
			   {
			   		echo json_encode(["code" => 201, "msg" => $response->msg]);
			   		return;
			   }

			   echo json_encode(["code" => 200,  "error" => ["No se pudo establecer la comunicación con la sucursal"]]);
			   return;

	}


 	echo json_encode(["code" => 404, "error" => ["Sucursal no identificada"]]);
	return;
?>