<?php
class Invoice extends Controller
{
  protected $model;
  protected $modelProveedor;
  protected $almacenLibreta;
  protected $permission;

  public function __construct()
  {
    $this->model = $this->model('InvoiceModel');
    $this->modelProveedor = $this->model('ProveedorModel');
    $this->almacenLibreta = $this->model('AlmacenLibretaModel');
    $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Libreta_de_Pagos->Listado_de_Facturas;
  }


  public function index()
  {
      $this->view('error/not_found');
  }

  public function list()
  {
      if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
      $this->almacenLibreta->iduser = $_SESSION["datauser"]["iduser"];
      $almacen = $this->almacenLibreta->getListByUser();
      $proveedor = $this->modelProveedor->getall();
      $this->view('invoice/list', ["almacen" => $almacen, "proveedor" => $proveedor, "permisos" => $this->permission]);
  }

  public function detail($idcompra = 0)
  {
      if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
      $this->model->id = $idcompra;
      $invoice = $this->model->one();
      if(!$invoice){ $this->view('error/not_found'); return;}
      $invoice = $invoice->fetch_object();

      $this->modelProveedor->id = $invoice->idproveedor;
      $proveedor = $this->modelProveedor->one();
      if(!$proveedor){ $this->view('error/not_found'); return;}
      $proveedor = $proveedor->fetch_object();

      $this->view('invoice/detail', ["invoice" => $invoice, "proveedor" => $proveedor]);
  }

}
?>
