<?php
class Catalog extends Controller
{
    protected $model;
    protected $marcaModel;
    protected $lineModel;  
    protected $capacityModel;
    protected $supplierModel;
    protected $permission;

    public function __construct()
    {
        $this->model = $this->model('CatalogModel');
        $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Catalogos_generales;
    }

    public function index()
    {

    }


    public function stores()
    {
      $this->view('catalog/stores');
    }


    public function getBancos()
    {
        $data = $this->model->getBancos();
        echo json_encode($data);
    }

    public function line()
    {   
        if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
        $this->lineModel = $this->model('LineModel');
        $lines = $this->lineModel->getAll();
        $this->view('line/list', $lines);
    }

    public function agents()
    {   
        if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
        $this->view('catalog/agents');
    }


    public function capacity()
    {   
        if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
        $this->capacityModel = $this->model('CapacityModel');
        $capacities = $this->capacityModel->all();
        $this->view('capacity/list', $capacities);
    }

    public function supplier()
    {
        if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
        $this->supplierModel = $this->model('SupplierModel');
        $suppliers = $this->supplierModel->all();
        $this->view('supplier/list', $suppliers);
    }

    public function all()
    {
        $this->view('catalog/select');
    }
}

?>
