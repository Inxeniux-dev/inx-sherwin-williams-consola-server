<?php

class Prices extends Controller
{
        protected $modelDetail;
        protected $model;
        protected $permission;
        public function __construct()
        {
            $this->modelDetail = $this->model('CambioPrecioDetalleModel');
            $this->model = $this->model('CambioPrecioModel');
            $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Gestion->Listado_de_cambio_de_precios;
        }



    public function index($name = '')
    {
        $this->view('error/not_found');
    }

    public function all()
    {
        if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
        $this->view('prices/list_change', null);
    }
    
    public function detail($id = 0)
    {
        if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
        $change = $this->model->findById($id)->fetch_object();
        $detail = $this->modelDetail->findById($id);

        $this->view('prices/detail', ["change" => $change, "detail" => $detail]);
    }

}
?>
