<?php
class Capacity extends Controller
{
	protected $model;
	public function __construct()
    {
        $this->model = $this->model('CapacityModel');
        $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Catalogos_generales;
    }

    public function index()
    {
        if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
        $marcas = $this->model->all();
        $this->view('capacity/list', $marcas);
    }


    public function add()
    {
      $this->view('capacity/add');
    }

    public function edit($id = 0)
    {
      $this->model->id = $id;
      $linea = $this->model->one();
      $this->view('capacity/edit', $linea);
    }

}
?>