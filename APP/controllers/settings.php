<?php

class Settings extends Controller
{
    protected $service;
    protected $model;
    protected $permisoModuloModel;
    protected $permission;

    protected $locationModel;
    protected $diaInhabilModel;

    public function __construct()
    {
        $this->model = $this->model('SettingModel');
        $this->locationModel = $this->model('CatalogModel');
        $this->diaInhabilModel = $this->model('DiaInhabilModel');
        $this->permission = json_decode($_SESSION["datauser"]["permissions"]);
    }

    public function index($name = '')
    {
        $this->view('error/not_found');
    }

    public function upload_items()
    {
        if(!$this->permission->Herramientas->Archivo_de_Precios->Editar){  $this->view('error/permisos', null); return; }
        $this->view('settings/upload_items');
    }


    public function backup_stores()
    {
      $this->view('settings/backup_stores');
    }

    public function db_structure()
    {
      $this->view('settings/db_structure');
    }

    public function non_working()
    {
      if(!$this->permission->Herramientas->Dias_Inhabiles->Crear){  $this->view('error/permisos', null); return; }
      $this->diaInhabilModel->dia_inhabil = date("Y")."-01-01";
      $dias = $this->diaInhabilModel->allByYear();
      $this->view('settings/non_working', $dias);
    }

    public function system()
    {
      $data = $this->model->one();
      $this->view('settings/system', $data);
    }

    public function user()
    {
      $this->view('settings/user', $data);
    }


}
?>
