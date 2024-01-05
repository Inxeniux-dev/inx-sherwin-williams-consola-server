<?php
class Store extends Controller
{
    protected $model;
    protected $permission;

    public function __construct()
    {
        $this->model = $this->model('StoreModel');
        $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Sucursales;
    }

    public function index()
    {
       $this->view('error/not_found');
    }

    public function list()
    {
      if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
      $this->view('store/list');
    }

    public function add($id = 0)
    {
      //if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
      $store = $this->model->getData($id);
      $this->view('store/add', ["store" => $store]);
    }

    public function detail($id = 0)
    {
      if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
      $store = $this->model->getData($id);
      $this->view('store/detail', ["store" => $store]);
    }

    public function edit($id = 0)
    {
      if(!$this->permission->Editar){  $this->view('error/permisos', null); return; }
      $this->model->id = $id;
      $store = $this->model->one();
      $this->view('store/edit', ["store" => $store]);
    }

    public function updateSetting($id = 0)
    {
      if(!$this->permission->Editar){  $this->view('error/permisos', null); return; }
      $store = $this->model->getData($id);
      $this->view('store/update_version', ["store" => $store]);
    }

    public function queryService($id = 0)
    {
      if(!$this->permission->Query_Remota){  $this->view('error/permisos', null); return; }
      $store = $this->model->getData($id);
      $this->view('store/query_service', ["store" => $store]);
    }

}
