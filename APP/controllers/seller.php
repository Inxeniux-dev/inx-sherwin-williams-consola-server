<?php
class Seller extends Controller
{
	protected $model;
	public function __construct()
    {
        $this->model = $this->model('SellerModel');
        $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Catalogos_generales;
    }

    public function index()
    {
        if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
        $sellers = $this->model->all();
        $this->view('seller/list', $sellers);
    }

    public function add()
    {
      $this->view('seller/add');
    }

    public function edit($id = 0)
    {
      $this->model->id = $id;
      $seller = $this->model->one();
      $this->view('seller/edit', $seller);
    }

}
?>