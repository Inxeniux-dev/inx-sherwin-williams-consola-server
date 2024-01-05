<?php

class StoreModel
{
    private $conexion;
    public $id;
    public $nombre;
    public $version;
    public $almacen;
    public $ip;
    public $serie;
    public $direccion;
    public $cruzamiento;
    public $num_interior;
    public $num_exterior;
    public $cp;
    public $colonia;
    public $ciudad;
    public $estado;
    public $pais;
    public $telefono;
    public $status;
    public $email;
    public $create_at;
    public $update_at;
    public $trabaja_domingo;
    public $es_foranea;
    public $clave;

    public $page = 0;
    public $limit = 50;
    public $search = '';

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function getList()
    {

        $sql ="SELECT idsucursal, nombre, version, almacen, ip, serie, direccion, cruzamiento, num_interior, num_exterior, cp, colonia, ciudad, estado, pais, telefono, status, email, update_at FROM sucursal WHERE almacen LIKE '%".$this->almacen."%' AND status LIKE'%".$this->status."%' ORDER BY idsucursal;";
        return  $this->conexion->query($sql);
    }


    public function all()
    {
        $sql = 'SELECT idsucursal, nombre, version, almacen, ip, serie, direccion, cruzamiento, num_interior, num_exterior, cp, colonia, ciudad, estado, pais, telefono, status, email, update_at FROM sucursal ORDER BY idsucursal;';
        if($this->page < 0) { $res = $this->conexion->query($sql);  return $res ? $res : false; }
        $stores = $this->conexion->query($sql);

        /*Paginator*/
        $sql = 'SELECT COUNT(1) AS contador, CASE WHEN count(1) % '.$this->limit.'> 0 THEN TRUNCATE(((count(1) /'.$this->limit.')+1),0) ELSE TRUNCATE((count(1) /'.$this->limit.'),0) END AS pages FROM sucursal;';
        $paginator =  $this->conexion->query($sql);

        return ["stores" => $stores, "paginator" => $paginator];
    }

    public function one()
    {
        $sql ="SELECT idsucursal, nombre, version, almacen, ip, serie, direccion, cruzamiento, num_interior, num_exterior, cp, colonia, ciudad, estado, pais, telefono, status, email, trabaja_domingo, es_foranea FROM sucursal WHERE idsucursal = '".$this->id."' LIMIT 1;";
        return  $this->conexion->query($sql);
    }


    public function getData($id)
    {
        $sql ="SELECT idsucursal, nombre, version, almacen, ip, serie, direccion, cruzamiento, num_interior, num_exterior, cp, colonia, ciudad, estado, pais, telefono, status, email, trabaja_domingo, es_foranea FROM sucursal WHERE idsucursal = '".$id."' LIMIT 1;";
        return  $this->conexion->query($sql);
    }


    public function add()
    {
        $date = date("Y-m-d H:i:s");
        $sql = "INSERT INTO sucursal (idsucursal, nombre, version, almacen, ip, serie, direccion, cruzamiento, num_exterior, num_interior, cp, colonia, ciudad, estado, pais, telefono, status, email, update_at, trabaja_domingo, es_foranea) VALUES ('".$this->clave."', '".$this->nombre."', '".$this->version."', '".$this->almacen."', '".$this->ip."', '".$this->serie."', '".$this->direccion."', '".$this->cruzamiento."', '".$this->no_exterior."', '".$this->no_interior."', '".$this->cp."', '".$this->colonia."', '".$this->ciudad."', '".$this->estado."', '".$this->pais."', '".$this->telefono."', '1', '".$this->email."', '$date',  '".$this->trabaja_domingo."',  '".$this->es_foranea."');";
        return $this->conexion->query($sql);
    }

    public function update()
    {
        $date = date("Y-m-d H:i:s");
        $sql = "UPDATE sucursal SET idsucursal = '".$this->clave."', nombre = '".$this->nombre."', serie = '".$this->serie."', serie = '".$this->serie."', direccion = '".$this->direccion."', cruzamiento = '".$this->cruzamiento."', telefono = '".$this->telefono."', num_interior = '".$this->no_interior."', num_exterior = '".$this->no_exterior."', cp = '".$this->cp."', colonia = '".$this->colonia."', ciudad = '".$this->municipio."', estado = '".$this->estado."', pais = '".$this->pais."', email = '".$this->email."', trabaja_domingo = '".$this->trabaja_domingo."', es_foranea = '".$this->es_foranea."', update_at = '".$date."', status = '".$this->status."', ip = '".$this->ip."' WHERE idsucursal = '".$this->id."' LIMIT 1";
        return $this->conexion->query($sql);
    }

    public function updateVersion($id, $version, $ip)
    {
        $date = date("Y-m-d H:i:s");
        $sql = "UPDATE sucursal SET version = '".$version."', ip = '".$ip."', update_at = '".$date."' WHERE idsucursal = '".$id."' AND version = 0 LIMIT 1";
        return $this->conexion->query($sql);
    }

	public function createDB($id)
    {
       $sql = "CREATE DATABASE sucursal_".addCeros($id).";";
       return $this->conexion->query($sql);
    }


    public function update_clave($id)
    {
       $clave = addCeros($id);

       $sql = "INSERT INTO sucursal_".$clave.".configuracion (CLAVE_SUCURSAL, SERIE_VENTA, FOLIO_VENTA, SERIE_FACTURA, FOLIO_FACTURA, FOLIO_VALE_TRASPASO, FOLIO_VALE_AUDITORIA, FECHA_CORTE, FOLIO_COMPLEMENTO, FOLIO_INVENTARIO, FOLIO_DEVOLUCION, VENTA_SIN_KARDEX, API_URL, PUNTOS_POR_PESO, FOLIO_CONVERSION, FOLIO_PEDIDO, DIAS_TOLERANCIA_VALE, version, ajuste_cartera, copias_tickets, format_vale, bloquea_sin_xml_mostrador, genera_backup, credito_maximo, api_advans, user_advans, pass_advans, path_winrar, path_mysqldump, path_backup, printer_name, tipo_impresion_ticket, vale_automatico, precio_especial, bloqueo, trabaja_domingo, no_aplicados, tipo_respaldo, tienda_nueva) VALUES ('".$clave."', 'A', '1', 'A', '1', '1', '1', '2021-09-29', '69', '1', '11', '0', 'http://25.113.174.136/comex_api/app/', '4', '2', '2', '3', '2.1', '0', '1', '1', '1', '1', '100000.00', 'https://app33.advans.mx/AAA181113X07/api/generar/texto/1.0', 'demo', 'C:/Program Files/WinRAR/winrar.exe', 'C:/Program Files/WinRAR/winrar.exe', ' C:/AppServ/MySQL/mysqldump', 'C:/Respaldos', 'EPSON TM-U220 Receipt', '1', '1', '0', '1', '0', '10', '0', '0');";
       return $this->conexion->query($sql);
    }


    public function upload_template($id)
    {
        $sucursal = "sucursal_".addCeros($id)."";
        $file = PATH_TEMPLATE."template_empty.sql";

        $command= PATH_MYSQL.' -hlocalhost -u root -pGCHydra.16* '.$sucursal.' < '.$file;

        exec($command,$output,$worked);
        switch($worked){
        case 0:
            return 0;
        break;
        case 1:
            return 1;
        break;
        }
        return 2;
    }




}
