<?php
class Banktransfer extends Controller
{
	protected $model;
    protected $modelAccount;
    protected $storeModel;
	public function __construct()
    {
        $this->modelAccount = $this->model('BankTransferAccount');
        $this->model = $this->model('BankTransferModel');
        $this->storeModel = $this->model('StoreModel');
        $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Gestion->Transferencias_bancarias;
    }

    public function index()
    {
        if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
        $stores = $this->storeModel->getList();
        $cuentas = $this->modelAccount->all();
        $this->view('transfer/index', ["cuentas" => $cuentas, "stores" => $stores]);
    }

    public function detail($id = 0){
        $this->model->id = $id;
        $transfer = $this->model->one()->fetch_object();
        $this->view("transfer/detail", ["transfer" => $transfer]);
    }
}
?>