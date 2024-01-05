<?php
class Line extends Controller
{
	protected $model;
	public function __construct()
    {
        $this->model = $this->model('LineModel');
        $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Catalogos_generales;
    }

    public function index()
    {
        if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
        $marcas = $this->model->getAll();
        $this->view('line/list', $marcas);
    }


    public function add()
    {
      $this->view('line/add');
    }

    public function edit($id = 0)
    {
      $this->model->id = $id;
      $linea = $this->model->oneByID($id);
      $this->view('line/edit', $linea);
    }

}
?>