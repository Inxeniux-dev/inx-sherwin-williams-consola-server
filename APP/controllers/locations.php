<?php
class Locations extends Controller
{
    protected $locationModel;
    protected $appService;
    protected $service;
    protected $permission;

    public function __construct()
    {
        $this->locationModel = $this->model('LocationModel');
        $this->appService = $this->service('AppService');
        $this->service = $this->service('LocationService');
        $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Sucursales;
    }

    public function index()
    {
        if(!$_SESSION["permissions"][20]->status) {  $this->view('error/permisos', null); return; }
        $this->view('locations/index');
    }

    public function getlist($page = 1, $search = " ")
    {
        $data = $this->locationModel->getLocations($search, $page);
        $paginator = $this->appService->getPaginatorAjax($data["paginator"], $page);
        $response = $this->service->LocationTableList($data["sucursales"], $paginator);
        echo $response;
    }


    public function add($id_location = 0)
    {   $data["edit"] = false;
        if($id_location > 0)
        {
          $data = $this->locationModel->getDataLocation($id_location);
          $data->edit = true;
        }
       $data = json_encode($data);
       $this->view('locations/add', json_decode($data));
    }


    public function register()
    {
        $data = [
            "duplicate" => false,
            "id_location" => isset($_POST["il"]) ? $_POST["il"] : '',
            "name" => isset($_POST["name"]) ? $this->appService->sanear_string(strtoupper($_POST["name"])) : '',
            "key" => isset($_POST["key"]) ? $this->appService->sanear_string($_POST["key"]) : '',
            "serie" => isset($_POST["serie"]) ? $this->appService->sanear_string(strtoupper($_POST["serie"])) : '',
            "direccion" => isset($_POST["direccion"]) ? $this->appService->sanear_string(strtoupper($_POST["direccion"])) : '',
            "cp" => isset($_POST["cp"]) ? $this->appService->sanear_string($_POST["cp"]) : '',
            "colonia" => isset($_POST["colonia"]) ? $this->appService->sanear_string(strtoupper($_POST["colonia"])) : '',
            "numint" => isset($_POST["numinterior"]) ? $this->appService->sanear_string(strtoupper($_POST["numinterior"])) : '',
            "numext" => isset($_POST["numexterior"]) ? $this->appService->sanear_string(strtoupper($_POST["numexterior"])) : '',
            "municipio" => isset($_POST["municipio"]) ? $this->appService->sanear_string(strtoupper($_POST["municipio"])) : '',
            "estado" => isset($_POST["estado"]) ? $this->appService->sanear_string(strtoupper($_POST["estado"])) : '',
            "pais" => isset($_POST["pais"]) ? $this->appService->sanear_string(strtoupper($_POST["pais"])) : '',
            "type" => isset($_POST["type"]) ? $_POST["type"] : '',
            "serie_update" => isset($_POST["serie_update"]) ? $this->appService->sanear_string(strtoupper($_POST["serie_update"])) : '',
            "edit" => isset($_POST["edit"]) ? $_POST["edit"] : ''
          ];

          $res = $this->service->validateAddLocation($data);

        if($res["validation"])
        {
            $is_duplicate = true;

            if(isset($data["edit"]) && $_POST["edit"] == "true") /* Si existe la variable edit y es true, es una actualización */
            {
                if($_POST["serie"] != $_POST["serie_update"] || $_POST["key"] != $_POST["il"])
                {
                    $is_duplicate = true;
                }
                else{ $is_duplicate = false; }
            }
            else{ /* Si no existe la variable edit, es un registro nuevo */
                if($this->locationModel->getByItems(['serie' , 'idsucursal'], [$_POST["serie"], $_POST["key"]], ['OR'])->fetch_object() == NULL)
                {
                    $is_duplicate = false;
                }
            }


            if(!$is_duplicate)  /* si no esta duplicado */
            {
              $res["duplicate"] = false;
                if(isset($_POST["edit"]) && $_POST["edit"] == "true")
                {
                    $update =  $this->locationModel->updateLocation($data); /* Update to Location */
                    $res["save"] = $update["status"];
                    $res["id"] = $data["id_location"];
                }
                else{
                  $save = $this->locationModel->saveLocation($data); /* Add to User */
                  $res["save"] = $save["status"];
                  $res["id"] = $save["status"] ? $save["id"] : 0;
                  $res["sql"] = $save["sql"];
                }
            }
            else{ $res["duplicate"] = true; }


        }
            $res["data"] = $data;
          echo json_encode($res);
    }


    public function delLocation()
    {
       echo json_encode(["status" => $this->locationModel->deleteLocation($_POST["indentified"])]);
    }



    public function details($id_location)
    {
        $data = $this->locationModel->getDataLocation($id_location);
        $this->view('locations/details', $data);
    }

}
