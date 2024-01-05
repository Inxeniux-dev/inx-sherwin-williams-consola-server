<?php
class ItemsChange extends Controller
{
    protected $model;
    protected $lineModel;
    protected $catalogModel;
    protected $configModel;
    protected $permission;

    public function __construct()
    {
       $this->model = $this->model('ItemModel');
       $this->lineModel = $this->model('LineModel');
       $this->catalogModel = $this->model('CatalogModel');
       $this->configModel = $this->model('ConfigModel');
       $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Productos_para_Canje;
    }

    public function index()
    {
       $this->view('error/not_found');
    }

    public function list()
    {
      if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
      $this->view('items/changes', ["permisos" => $this->permission]);
    }

    public function create()
    {
      if(!$this->permission->Crear){  $this->view('error/permisos', null); return; }
      $this->view('items/create', null);
    }

    public function edit($id = 0)
    {
      if(!$this->permission->Editar){  $this->view('error/permisos', null); return; }
      $item = $this->model->getDataProd($id);
      $this->view('items/editProd', ["item" => $item]);
    }







}
