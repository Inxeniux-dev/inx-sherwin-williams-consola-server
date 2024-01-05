<?php
class Supplier extends Controller
{
	protected $model;
	public function __construct()
    {
        $this->model = $this->model('ProveedorModel');
        $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Catalogos_generales;
    }

    public function index()
    {
        if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
        $marcas = $this->model->getAll();
        $this->view('supplier/list', $marcas);
    }

    public function add()
    {
      $this->view('supplier/add');
    }

    public function edit($id = 0)
    {
      $this->model->id = $id;
      $linea = $this->model->one();
      $this->view('supplier/edit', $linea);
    }

}
?>