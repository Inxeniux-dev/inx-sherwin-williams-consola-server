<?php
class Empleado extends Controller
{
    protected $model;
    protected $storeModel;
    protected $permission;

    public function __construct()
    {
        $this->model = $this->model('EmpleadoModel');
        $this->storeModel = $this->model('StoreModel');
        $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Asistencia->Empleados;
    }


    public function all()
    {
      if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
      $stores = $this->storeModel->getList();
      $this->view('empleado/list', $stores);
    }

    public function edit($id_empleado = 0)
    {
        if(!$this->permission->Editar){  $this->view('error/permisos', null); return; }
        $stores = $this->storeModel->getList();

        $this->model->idempleado = $id_empleado;
        $empleado = $this->model->one();
        $this->view('empleado/edit', ["stores" => $stores, "empleado" => $empleado]);
    }


    public function delete($id_empleado = 0)
    {
        if(!$this->permission->Eliminar){  $this->view('error/permisos', null); return; }
        $this->model->idempleado = $id_empleado;
        $empleado = $this->model->one();
        $this->view('empleado/delete', ["empleado" => $empleado]);
    }


    public function rotacion($id_empleado = 0)
    {
      if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
      $stores = $this->storeModel->getList();

      $this->model->idempleado = $id_empleado;
      $empleado = $this->model->one();
      $this->view('empleado/rotacion', ["id" => $id_empleado, "stores" => $stores, "empleado" => $empleado]);
    }

  }
