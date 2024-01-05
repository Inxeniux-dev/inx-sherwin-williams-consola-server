<?php
class Version extends Controller
{
    protected $model;
    protected $proyect_model;
    protected $storeModel;
    protected $permission;

    public function __construct()
    {
        $this->model = $this->model('VersionModel');
        $this->proyect_model = $this->model('proyectoModel');
        $this->storeModel = $this->model('StoreModel');
        $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Versionamiento;
    }

    public function index()
    {
         $this->view('error/not_found');
    }

    public function stores()
    {
        if(!$this->permission->Version_en_Tiendas->Consultar){  $this->view('error/permisos', null); return; }
        $this->proyect_model->idproyecto = 1; // Solo PDV
        $version = $this->proyect_model->last_version();
        $this->view('version/stores', $version);
    }


    public function all()
    {
        if(!$this->permission->Listado_de_Versiones->Consultar){  $this->view('error/permisos', null); return; }
        $create = $this->permission->Listado_de_Versiones->Crear;
        $proyects = $this->proyect_model->getList();
        $this->view('version/list', ["proyects" => $proyects, "create" => $create]);
    }

    public function edit($id = 0)
    {
        if(!$this->permission->Listado_de_Versiones->Editar){  $this->view('error/permisos', null); return; }
        $detalle = $this->model->detail($id);
        $version = $this->model->getData($id);
        $files = $this->model->getFilesByID($id);
        $sucursal = $this->storeModel->getList();
        $this->view('version/edit', ["version" => $version,  "detalle" => $detalle, "files" => $files, "sucursal" => $sucursal]);
    }

    public function detail($id = 0)
    {
        $detalle = $this->model->detail($id);
        $version = $this->model->getData($id);
        $files = $this->model->getFilesByID($id);
        $sucursal = $this->storeModel->getList();
        $this->view('version/detail', ["version" => $version,  "detalle" => $detalle, "files" => $files, "sucursal" => $sucursal]);
    }


    public function create()
    {
        if(!$this->permission->Listado_de_Versiones->Crear){  $this->view('error/permisos', null); return; }
        $proyects = $this->proyect_model->getList();
        $this->view('version/create', ["proyects" => $proyects]);
    }


    public function additems($id = 0)
    {
        $this->view('buy/additems', ["id" => $id]);
    }


    public function downloadsys($id)
    {

      if(!$this->permission->Listado_de_Versiones->Consultar){  $this->view('error/permisos', null); return; }

      $file = $this->model->getFileByID($id);
      if($file)
      {
        $file = $file->fetch_object();

        $fileName = basename($file->nombre);
        $filePath = PATH_FILES_VERSION.$file->version."\\".$file->path;

        header("Content-disposition: attachment; filename=".$fileName."_".$file->path);
        header("Content-type: application/octet-stream");
        readfile($filePath);
      }
    }

}
