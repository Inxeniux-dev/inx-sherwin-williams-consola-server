<?php
class ReportExcel extends Controller
{
    private $PATH = "";
    private $storeModel;
    private $invoiceModel;
    private $proveedorModel;
    private $almacenModel;
    private $empleadoBitacora;
    private $empleadoModel;
    private $empleadoService;
    private $banktransferModel;
    private $cardModel;

    public function __construct()
    {
      $this->PATH = $_SERVER['DOCUMENT_ROOT']."/".PROJECT."/APP/";
      $this->storeModel = $this->model("StoreModel");
    }

    public function storeList()
    {
        $data = $this->storeModel->getList();
        include $this->PATH."reportExcel/store_list.php";
    }

    public function items($line = 0,  $capacity = -1, $type = 0,  $search = '')
    {
      $capacity == -1 ? null : $capacity;
      $this->itemModel = $this->model('ItemModel');
      $data = $this->itemModel->list(-1, $line, $capacity, $search);
      if($type == 1)
      {
          include $this->PATH."reportExcel/item_list_template.php"; return;
      }
      include $this->PATH."reportExcel/item_list.php";
    }


    public function banktransfer($fech_ini = 0, $fech_fin = 0, $store = 0, $account, $status = -1){
        $this->banktransferModel = $this->model("BankTransferModel");
        $this->banktransferModel->page = -1;
        $this->banktransferModel->sucursal = $store;
        $this->banktransferModel->cuenta = $account;
        $this->banktransferModel->create_at = $fech_ini;
        $this->banktransferModel->fecha_final = $fech_fin;
        $this->banktransferModel->status = $status;
        $data = $this->banktransferModel->all();
        include $this->PATH."reportExcel/banktransfer_list.php";
    }


    public function bitacoraAsistencia($sucursal = 0, $movimiento = 0, $fecha, $orden = 1)
    {
        $this->empleadoBitacoraModel = $this->model("EmpleadoBitacora");

        $order = 'date_store DESC';
        switch ($orden) {
          case 2:
            $order = 'empleado.nombre';
          break;
          case 3:
            $order = 'empleado.idsucursal';
          break;
          case 4:
            $order = 'date_store';
          break;
        }

        $this->empleadoBitacoraModel->create_at = $fecha;
        $this->empleadoBitacoraModel->create_at_final = $fecha;
        $this->empleadoBitacoraModel->idconcepto = $movimiento == 0 ? "" : $movimiento;
        $this->empleadoBitacoraModel->filter_idsucursal = $sucursal == 0 ? "" : " AND empleado.idsucursal = ".$sucursal." ";
        $this->empleadoBitacoraModel->orden = $order;
        $bitacora = $this->empleadoBitacoraModel->getList();


        include $this->PATH."reportExcel/asistencia_list.php";
    }



    public function bitacoraAsistenciaSuper($sucursal = 0, $movimiento = 0, $fecha, $fechafin, $orden = 1)
    {
        $this->empleadoBitacoraModel = $this->model("EmpleadoBitacora");

        $order = 'date_store DESC';
        switch ($orden) {
          case 2:
            $order = 'empleado.nombre';
          break;
          case 3:
            $order = 'empleado.idsucursal';
          break;
          case 4:
            $order = 'date_store';
          break;
        }

        $this->empleadoBitacoraModel->create_at = $fecha;
        $this->empleadoBitacoraModel->create_at_final = $fechafin;
        $this->empleadoBitacoraModel->idconcepto = $movimiento == 0 ? "" : $movimiento;
        $this->empleadoBitacoraModel->filter_idsucursal = $sucursal == 0 ? "" : " AND empleado.idsucursal = ".$sucursal." ";
        $this->empleadoBitacoraModel->orden = $order;
        $this->empleadoBitacoraModel->tipo = 2;
        $bitacora = $this->empleadoBitacoraModel->getList();


        $asistencia = array();
        while($row = $bitacora->fetch_object())
        {
            $asistencia[] = ["nombre" => $row->nombre, "apellido" => $row->apellido, "suc_base" => $row->suc_base, "idsucursal" => $row->$idsucursal, "date_store" => $row->date_store, "idconcepto" => $row->idconcepto, "nombre_sucursal" => $row->nombre_sucursal, "nombre_base" => $row->nombre_base];
        }

        $asistencia = groupArray($asistencia, "nombre");

        include $this->PATH."reportExcel/asistencia_list_super.php";
    }



    public function bitacoraGlobal($sucursal = 0, $mes = 0, $anio = 0, $orden = 1)
    {
        $this->empleadoBitacoraModel = $this->model("EmpleadoBitacora");
        $this->empleadoModel = $this->model("EmpleadoModel");
        $this->empleadoService = $this->service("EmpleadoService");

        $order = 'empleado.no_empleado';
        switch ($orden) {
          case 2:
            $order = 'empleado.nombre';
          break;
          case 3:
            $order = 'empleado.apellido';
          break;
          case 4:
            $order = 'empleado.idsucursal, empleado.no_empleado ASC';
          break;
        }

        $this->empleadoModel->orden = $order;
        $this->empleadoModel->filter_idsucursal = $sucursal == -1 ? "" : " AND empleado.idsucursal = ".$sucursal." ";
        $empleados = $this->empleadoModel->getList();

        $fecha_actual = $anio."-".$mes."-21";
        $nuevafecha = strtotime ( '-1 month' , strtotime ( $fecha_actual ) ) ;
        $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
        $data_fecha_ant = explode("-", $nuevafecha);
        $fecha_anterior = $data_fecha_ant[0]."-".$data_fecha_ant[1]."-20";

        $this->empleadoBitacoraModel->create_at = $fecha_anterior;
        $this->empleadoBitacoraModel->create_at_final = $fecha_actual;
        $this->empleadoBitacoraModel->idconcepto = 3;
        $this->empleadoBitacoraModel->filter_idsucursal = $sucursal == -1 ? "" : " AND empleado.idsucursal = ".$sucursal." ";
        $this->empleadoBitacoraModel->orden = $order;

        $data_empleados = array();
        while($row = $empleados->fetch_object())
        {
            $this->empleadoBitacoraModel->idempleado = $row->idempleado;
            $bitacora = $this->empleadoBitacoraModel->getListByIdEmpleado();

            $data_empleados[] = [
              "id" => $row->idempleado,
              "nombre" => $row->nombre,
              "apellido" => $row->apellido,
              "no_empleado" => $row->no_empleado,
              "tipo" => $row->tipo,
              "bitacora" => $bitacora
            ];
        }

        $encabezados = $this->empleadoService->generaEncabezados($mes, $anio);
        $data_procesada = $this->empleadoService->formatEmpleadosAsistencia($data_empleados, $encabezados);


        include $this->PATH."reportExcel/asistencia_list_global.php";
    }



    public function invoices($fechini = 0,  $fechfin = 0, $proveedor = 0,  $almacen = 0, $estatus = 0, $tipo = 0, $search = '')
    {
        $this->storeModel = $this->model("InvoiceModel");
        $this->storeModel->search = $search;
        $this->storeModel->idalmacen = $almacen;
        $this->storeModel->idproveedor = $proveedor;
        $this->storeModel->fechini = $fechini;
        $this->storeModel->fechfin = $fechfin;
        $this->storeModel->page = -1;
        $this->storeModel->estatus = $estatus;
        $this->storeModel->tipo_factura = $tipo;
        $data = $this->storeModel->all();

        $this->proveedorModel = $this->model("proveedorModel");
        $this->proveedorModel->id = $proveedor;
        $proveedor = $this->proveedorModel->one();
        if($proveedor){ $proveedor = $proveedor->fetch_object(); }

        $this->almacenModel = $this->model("AlmacenModel");
        $this->almacenModel->id = $almacen;
        $almacen = $this->almacenModel->one();
        if($almacen){ $almacen = $almacen->fetch_object(); }

        include $this->PATH."reportExcel/invoice_list.php";
      }



      public function cards($status = 0, $search = '')
      {
        $this->cardModel = $this->model("CardModel");
        $this->cardModel->search = $search;
        $this->cardModel->status = $status;
        $data = $this->cardModel->getList();
      
        include $this->PATH."reportExcel/card_list.php";
      }


      public function cards_by_month($year)
      {
        $this->cardModel = $this->model("CardModel");
        $this->cardModel->create_at = $year."-01-01 00:00:00";
        $this->cardModel->date_final = $year."-12-31 23:59:59";
        $data = $this->cardModel->byYearOrganizedByMonth(); 
        include $this->PATH."reportExcel/card_list_month.php";
      }

      public function customers($type = 0, $search = '', $apellido = '')
    {
      $this->customerModel = $this->model('CustomerModel');
      $data = $this->customerModel->list(-1, $type, $search, $apellido);
      include $this->PATH."reportExcel/customer_list.php";
    }
}
