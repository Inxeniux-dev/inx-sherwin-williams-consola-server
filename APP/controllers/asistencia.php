<?php

class Asistencia extends Controller
{
    protected $model;
    protected $service;
    protected $storeModel;
    protected $permission;

    public function __construct()
    {
      $this->storeModel = $this->model('StoreModel');
      $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Asistencia->Listado_de_Asistencia;
    }

    public function index()
    {
        $this->view('error/not_found');
    }

    public function bitacora()
    {
      if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
      $stores = $this->storeModel->getList();
      $this->view('asistencia/bitacora', $stores);
    }

    public function bitacoraSuper()
    {
      if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
      $stores = $this->storeModel->getList();
      $this->view('asistencia/bitacora_super', $stores);
    }

    public function bitacoraGlobal()
    {
      if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
      $stores = $this->storeModel->getList();
      $this->view('asistencia/bitacora_global', $stores);
    }

}


?>
