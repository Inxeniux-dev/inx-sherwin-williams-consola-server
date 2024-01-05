<?php

class User extends Controller
{
    protected $service;
    protected $model;
    protected $permisoService;
    protected $permission;
    protected $almacenModel;
    protected $almacenLibretaModel;

    public function __construct()
    {
        $this->model = $this->model('UserModel');
        $this->permisoService = $this->service('permisoService');
        $this->almacenModel = $this->model('AlmacenModel');
        $this->almacenLibretaModel = $this->model('AlmacenLibretaModel');
        $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Configuracion->Usuarios;
    }


    public function index($name = '')
    {
        $this->view('error/not_found');
    }


    public function console()
    {
      if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
      $this->model->id_sistema = 1;
      $data = $this->model->allBySystem();
      $this->view('user/console', $data);
    }

    public function createUserConsole()
    {
      if(!$this->permission->Crear){  $this->view('error/permisos', null); return; }
      $this->view('user/console_create', null);
    }

    public function consoleEdit($id = 0)
    {
        if(!$this->permission->Crear){  $this->view('error/permisos', null); return; }
        if(!$this->permission->Editar){  $this->view('error/permisos', null); return; }
        $this->model->id = $id;
        $user = $this->model->one();
        $user = $user ? $user->fetch_object() : null;
        $this->view('user/console_edit', ["user" => $user]);
    }

    public function consolePermission($id = 0)
    {
        if(!$this->permission->Editar){  $this->view('error/permisos', null); return; }
        $this->model->id = $id;
        $user = $this->model->one();
        $user = $user ? $user->fetch_object() : null;
        $schema = $this->permisoService->generatePermissionSchema();

        $this->view('user/console_edit_permisos', ["user" => $user, "schema" => $schema]);
    }

    public function consoleStore($id = 0)
    {
        $almacenes = $this->almacenModel->all();
        $this->almacenLibretaModel->iduser = $id;
        $almacen_user = $this->almacenLibretaModel->getListByUser();
        $this->model->id = $id;
        $user = $this->model->one();
        $user = $user ? $user->fetch_object() : null;
        $this->view('user/console_edit_stores', ["almacenes" => $almacenes, "almacen_user" => $almacen_user, "user" => $user]);
    }



    public function pos()
    {
      if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
      $this->model->id_sistema = 2;
      $data = $this->model->allBySystem();
      $this->view('user/pos', $data);
    }

    public function createUserPOS()
    {
      if(!$this->permission->Crear){  $this->view('error/permisos', null); return; }
      $this->view('user/pos_create', null);
    }

    public function posEdit($id = 0)
    {
      if(!$this->permission->Crear){  $this->view('error/permisos', null); return; }
      if(!$this->permission->Editar){  $this->view('error/permisos', null); return; }
      $this->model->id = $id;
      $user = $this->model->one();
      $user = $user ? $user->fetch_object() : null;
      $this->view('user/pos_edit', ["user" => $user]);
    }

    public function posPermission($id = 0)
    {
        if(!$this->permission->Editar){  $this->view('error/permisos', null); return; }
        $this->model->id = $id;
        $user = $this->model->one();
        $user = $user ? $user->fetch_object() : null;
        $schema = $this->permisoService->generatePermissionSchemaPOS();

        $this->view('user/pos_edit_permisos', ["user" => $user, "schema" => $schema]);
    }


    public function crm()
    {
      if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
      $this->model->id_sistema = 3;
      $data = $this->model->allBySystem();
      $this->view('user/crm', $data);
    }

    public function crmEdit($id = 0)
    {
        if(!$this->permission->Crear){  $this->view('error/permisos', null); return; }
        if(!$this->permission->Editar){  $this->view('error/permisos', null); return; }
        $this->model->id = $id;
        $user = $this->model->one();
        $user = $user ? $user->fetch_object() : null;
        $this->view('user/crm_edit', ["user" => $user]);
    }


    public function createUserCRM()
    {
      if(!$this->permission->Crear){  $this->view('error/permisos', null); return; }
      $this->view('user/crm_create', null);
    }




    public function edidPassword($id = 0)
    {
        $this->model->id = $id;
        $user = $this->model->one();
        $user = $user ? $user->fetch_object() : null;

        $this->view('user/edit_password', ["user" => $user]);
    }
}
