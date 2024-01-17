<?php
class Customers extends Controller
{
    protected $model;
    protected $lineModel;
    protected $catalogModel;
    protected $marcaModel;
    protected $configModel;
    protected $permission;

    public function __construct()
    {
       $this->model = $this->model('CustomerModel');
       $this->lineModel = $this->model('LineModel');
       $this->marcaModel = $this->model('marcaModel');
       $this->catalogModel = $this->model('CatalogModel');
       $this->configModel = $this->model('ConfigModel');
       $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Clientes;
    }

    public function index()
    {
       $this->view('error/not_found');
    }

    /* =============== ARTICULOS GENERAL  =============== */
    public function list()
    {
      if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }

      // Obtener datos del modelo
      $data = $this->model->list($page, $type, $search, $apellido);

      // Pasar datos a la vista
      $this->view('customers/list', ["data" => $data, "permisos" => $this->permission]);
    }

    public function campaing()
    {
      if(!$this->permission->Editar_Descuento){  $this->view('error/permisos', null); return; }
      $lineas = $this->lineModel->getAll();
      $capacity = $this->catalogModel->getCapacity();
      $this->view('items/campaing',  ["lineas" => $lineas, "capacidad" => $capacity]);
    }


    public function reinforcementCampaign(){
      if(!$this->permission->Editar_Descuento){  $this->view('error/permisos', null); return; }
      $lineas = $this->lineModel->getAll();
      $capacity = $this->catalogModel->getCapacity();
      $this->view('items/reinforcementCampaing',  ["lineas" => $lineas, "capacidad" => $capacity]);
    }


    public function listPrices()
    {
      if(!$this->permission->Editar_Precio){  $this->view('error/permisos', null); return; }
      $lineas = $this->lineModel->getAll();
      $capacity = $this->catalogModel->getCapacity();
      $config = $this->configModel->one();
      $config = $config ? $config->fetch_object() : null;
      $this->view('items/list_change_prices', ["lineas" => $lineas, "capacidad" => $capacity, "config" => $config, "permisos" => $this->permission]);
    }

    public function add()
    {
      if(!$this->permission->Crear){  $this->view('error/permisos', null); return; }
      $regimen = $this->catalogModel->getRegimen();
      $this->view('customers/add', ["regimen" => $regimen]);
    }

    public function edit($id = 0)
    {
      if(!$this->permission->Editar){  $this->view('error/permisos', null); return; }
      $regimen = $this->catalogModel->getRegimen();
      $customer = $this->model->getData($id);
      $this->view('customers/edit', ["regimen" => $regimen, "item" => $customer]);
    }

    public function detail($id = 0)
    {
      if(!$this->permission->Editar){  $this->view('error/permisos', null); return; }
      $item = $this->model->getData($id);
      $lineas = $this->lineModel->getAll();
      $capacity = $this->catalogModel->getCapacity();
      $this->view('items/detail', ["item" => $item, "lineas" => $lineas, "capacidad" => $capacity]);
    }

    public function delete($id = 0)
    {
      if(!$this->permission->Eliminar){  $this->view('error/permisos', null); return; }
      $item = $this->model->getData($id);
      $this->view('items/delete', ["item" => $item]);
    }

}
