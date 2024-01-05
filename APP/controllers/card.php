<?php
class Card extends Controller
{
    protected $model;
    protected $permission;

    public function __construct()
    {
        $this->model = $this->model('CardModel');
        $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Tarjeta_Puntos;
    }

    public function index()
    {
      $this->view('error/not_found');
    }

    public function list()
    {
      if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
      $this->view('card/list');
    }

    public function history($id = 0)
    {
        if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
        $card = $this->model->getData($id);
        $this->view('card/history', ["card" => $card]);
    }

}
