<?php
$idsucursal = isset($_GET["suc"]) ? $_GET["suc"] : '';
$date_corte = isset($_GET["date"]) ? $_GET["date"] : '';
$id_sistema = isset($_GET["id_sistema"]) ? $_GET["id_sistema"] : 0;

if(strlen($idsucursal) == 0 || !is_numeric($idsucursal))
{
   echo json_encode(["code" => 200,  "error" => ["La sucursal no ha sido identificada"]]); return;
}

if(strlen($id_sistema) == 0 || !is_numeric($id_sistema) || $id_sistema <= 0)
{
   echo json_encode(["code" => 200,  "error" => ["EL sistema solicitante no se ha identificado"]]); return;
}


$dataResponse = [
  "sunday" => [], //ok
  "lines" => [],  //ok
  "points" => [], //ok
  "stores" => [], //ok
  "user" => [],  //ok
  "transfer" =>[],
  "inhabiles" => [],
  "suc" => $idsucursal,
  "sellers" => []
];

$sync_user = false;
$sync_card = false;
$sync_store = false;
$sync_line = false;
$sync_sellers = false;


//Config
$config = new ConfigModel();
$data = $config->one();
if($data)
{
    while($row = $data->fetch_object()) {
        $sync_user = $row->sync_users == 1 ? true : false;
        $sync_card = $row->sync_cards == 1 ? true : false;
        $sync_store = $row->sync_stores == 1 ? true : false;
        $sync_line = $row->sync_lines == 1 ? true : false;
        $sync_sellers = $row->sync_sellers == 1 ? true : false;
    }
}


//USERS
if($sync_user)
{
    $user = new UserModel();
    $user->id_sistema = $id_sistema;
    $data = $user->allBySystem();
    if($data)
    {
        $users = [];
        while($row = $data->fetch_object()) {

          if($row->id_sistema == $id_sistema)
          {
                $users[] = array( "iduser" => $row->iduser, "password" => $row->password, "username" => $row->username, "nombre" => $row->nombre, "tipo" => $row->tipo, "create_at" => $row->create_at, "update_at" => $row->uptade_at, "permisos" => $row->permisos);
          }

        }
        $dataResponse["user"] = $users;
    }
}



//SUNDAY
$store = new StoreModel();
$store->id = $idsucursal;
$data = $store->one();
if($data)
{
    while($row = $data->fetch_object()) {$dataResponse["sunday"] = $row->trabaja_domingo; }
}

//STORES

if($sync_store)
{
    $store = new StoreModel();
    $store->page = -1;
    $data = $store->all();
    if($data)
    {
        $stores = [];
        while($row = $data->fetch_object()) { $stores[] = $row; }
        $dataResponse["stores"] = $stores;
    }
}

//LINEAS
if($sync_line)
{
    $line = new LineModel();
    $line->page = -1;
    $data = $line->all();
    if($data)
    {
        $lines = [];
        while($row = $data->fetch_object()) { $lines[] = $row; }
        $dataResponse["lines"] = $lines;
    }
}


//POINTS
if($sync_card)
{
    $card = new TarjetaModel();
    $card->page = -1;
    $data = $card->all();
    if($data)
    {
        $points = [];
        while($row = $data->fetch_object()) { $points[] = $row; }
        $dataResponse["points"] = $points;
    }
}


$inhabiles = new DiaInhabilModel();
$inhabiles->dia_inhabil = date("Y")."-01-01";
$data = $inhabiles->allByYear();
if($data)
{
    $days = [];
    while($row = $data->fetch_object()) { $days[] = $row; }
    $dataResponse["inhabiles"] = $days;
}



if($sync_sellers)
{
    $sellerModel = new SellerModel();
    $data = $sellerModel->all();
    if($data)
    {
        $sellers = [];
        while($row = $data->fetch_object()) { $sellers[] = $row; }
        $dataResponse["sellers"] = $sellers;
    }
}


echo json_encode(["code" => 201, "data" => $dataResponse]); return;
?>
