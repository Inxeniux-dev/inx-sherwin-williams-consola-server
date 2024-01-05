<?php

$url = $_SESSION["config"]["api_url"]."productos.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FAILONERROR, true);
$datos = curl_exec($ch);
curl_close($ch);
$datos = json_decode($datos, true);


 ?>
