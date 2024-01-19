<?php
class Report extends Controller
{
    private $PATH = "";
    private $versionModel;
    public function __construct()
    {
        $this->PATH = $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/APP/";
    }


    public function versionDetails($id = 0)
    {
       $this->versionModel = $this->model("VersionModel");
       $this->versionModel->id = $id;
       $version = $this->versionModel->getData($id);
       $detalle = $this->versionModel->detail($id);

       include $this->PATH."report/version_details.php";
    }


    public function storeVersion($id = 0)
    {
       $this->versionModel = $this->model("VersionModel");
       $this->versionModel->id = $id;
       $version = $this->versionModel->getLastVersionProductionByProyect($id);
       include $this->PATH."report/store_version.php";
    }

    public function customers($type, $search = '', $apellido = '')
   {
        $this->customerModel = $this->model('CustomerModel');
        $data = $this->customerModel->getAllCustomers($type, $search, $apellido);
        include $this->PATH."report/customer_list.php";
   }

}
