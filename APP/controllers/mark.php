<?php
class Mark extends Controller
{
	protected $model;
	public function __construct()
    {
        $this->model = $this->model('MarcaModel');
        $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Catalogos_generales;
    }

    public function index()
    {
        if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
        $this->model = $this->model('MarcaModel');
        $marcas = $this->model->all();
        $this->view('mark/list', $marcas);
    }


    public function add()
    {
      $this->view('mark/add');
    }

    public function edit($id = 0)
    {
      $this->model->id = $id;
      $marca = $this->model->one();
      $this->view('mark/edit', $marca);
    }

}
?>