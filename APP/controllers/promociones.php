<?php

class Promociones extends Controller
{
    protected $promocionesModel;
    protected $permission;
    public function __construct()
    {
        $this->promocionesModel = $this->model('PromocionesModel');
        $this->permission = json_decode($_SESSION["datauser"]["permissions"])->Catalogos->Promociones;
    }
    public function index()
    {
       $this->view('error/not_found');
    }

    public function list()
    {
      if(!$this->permission->Consultar){  $this->view('error/permisos', null); return; }
      $promo = $this->promocionesModel->getArticulo();
      $this->view('promociones/list' ,["permisos" => $this->permission ]);
    }

    public function getArticulo()
    {
        $articulo = $this->promocionesModel->getArticulo();
        if (!empty($articulo)) {
            $response = ["success" => true, "data" => $articulo];
        } else {
            $response = ["success" => false, "message" => "No se encontraron artículos"];
        }
        echo json_encode($response);
    }
    public function getLinea()
    {
        $linea = $this->promocionesModel->getLinea();
        if (!empty($linea)) {
            $response = ["success" => true, "data" => $linea];
        } else {
            $response = ["success" => false, "message" => "No se encontraron linea"];
        }
        echo json_encode($response);
    }

    public function getMarca()
    {
        $marca = $this->promocionesModel->getMarca();
        if (!empty($marca)) {
            $response = ["success" => true, "data" => $marca];
        } else {
            $response = ["success" => false, "message" => "No se encontraron linea"];
        }
        echo json_encode($response);
    }

    public function insertarPromocion()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $codigo = $_POST["codigo"];
        $descripcion = $_POST["descripcion"];
        $estado = $_POST["estado"];
        $descuento = $_POST["descuento"];
        $fechaIni = $_POST["fechaIni"];
        $fechaFin = $_POST["fechaFin"];
        $cantidadMinima = $_POST["cantidadMinima"];
        $cantidadMaxima = $_POST["cantidadMaxima"];
        $tipCliente = $_POST["tipCliente"];
        $giroCliente = $_POST["giroCliente"];
        $cliente3 = $_POST["cliente3"];
        $cliente4 = $_POST["cliente4"];
        $cliente5 = $_POST["cliente5"];
        $cliente6 = $_POST["cliente6"];
        $linea = $_POST["linea"];
        $subLinea = $_POST["subLinea"];
        $familia = $_POST["familia"];
        $promocion = $_POST["promocion"];
        $fecha = $_POST["fecha"]; // Nuevo campo fecha

        $resultado = $this->promocionesModel->insertPromocion($codigo, $descripcion, $estado, $descuento, $fechaIni, $fechaFin, $cantidadMinima, $cantidadMaxima, $tipCliente, $giroCliente, $cliente3, $cliente4, $cliente5, $cliente6, $linea, $subLinea, $familia, $promocion, $fecha);

        if ($resultado) {
            $response = ["success" => true, "message" => "La promoción se ha insertado correctamente."];
        } else {
            $response = ["success" => false, "message" => "Ha ocurrido un error al insertar la promoción."];
        }
        echo json_encode($response);
    } else {
        $response = ["success" => false, "message" => "El método de solicitud no es válido."];
        echo json_encode($response);
    }
}



}

?>
