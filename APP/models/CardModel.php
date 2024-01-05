<?php

class CardModel
{
    private $conexion;
    public $id;
    public $no_tarjeta;
    public $nombre;
    public $apellido;
    public $telefono;
    public $puntos;
    public $descuento;
    public $direccion;
    public $create_at;
    public $update_at;
    public $status;

    public $tipo;
    public $idsucursal;
    public $search;
    public $rows;
    public $date_final;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function getList()
    {

        $filter = '';
        if($this->status >= 0)
        {
            $filter = " status = ".$this->status. " AND ";
        }

        $sql ="SELECT idtarjeta, no_tarjeta, nombre, apellido, telefono, email, create_at, puntos, descuento, direccion, update_at, status FROM tarjeta WHERE ".$filter." (nombre LIKE '%".$this->search."%' OR no_tarjeta LIKE'%".$this->search."%') ORDER BY no_tarjeta;";
        return  $this->conexion->query($sql);
    }

    public function one()
    {
        $sql ="SELECT idtarjeta, no_tarjeta, nombre, apellido, telefono, email, create_at, puntos, descuento, direccion FROM tarjeta WHERE idtarjeta = '".$this->id."' LIMIT 1;";
        return  $this->conexion->query($sql);
    }

    public function update()
    {
        $sql = "UPDATE tarjeta SET puntos = '".$this->puntos."', update_at = '".$this->update_at."' WHERE idtarjeta = '".$this->id."' LIMIT 1 ;";
        return  $this->conexion->query($sql);
    }

    public function getData($id)
    {
        $sql ="SELECT idtarjeta, no_tarjeta, nombre, apellido, telefono, email, create_at, puntos, descuento, direccion FROM tarjeta WHERE idtarjeta = '".$id."' LIMIT 1;";
        return  $this->conexion->query($sql);
    }

    public function getBitacora()
    {
        $filter = ($this->tipo > 0) ? " AND idconcepto = ".$this->tipo : "";
        $filter .= $this->idsucursal > 0 ? " AND idsucursal = ".$this->idsucursal : "";
        $LIMIT = " LIMIT ".$this->rows;

        $sql = "SELECT create_at, fecha_sucursal, puntos, remision, sucursal.idsucursal, idtarjeta, idconcepto, nombre, total, referencia FROM tarjeta_bitacora LEFT JOIN sucursal ON tarjeta_bitacora.idsucursal = sucursal.idsucursal WHERE idtarjeta = '".$this->id."' ".$filter." ORDER BY create_at DESC ".$LIMIT." ; ";
        return $this->conexion->query($sql);
    }


    public function update_status($id, $status){
        $sql = "UPDATE tarjeta SET status = '".$status."', update_at = '".date("Y-m-d H:i:s")."' WHERE idtarjeta = '".$id."' LIMIT 1 ;";
        return  $this->conexion->query($sql);
    }


    public function byYearOrganizedByMonth(){
       $sql =  "SELECT 
       s.sucursal_alta AS id,
           ss.nombre,
           ss.`status` AS status_tienda,
           SUM(MONTH(t.create_at) = 1) AS enero,
           SUM(MONTH(t.create_at) = 1) AS febrero,
       SUM(MONTH(t.create_at) = 3) AS marzo,
       SUM(MONTH(t.create_at) = 4) AS abril,
       SUM(MONTH(t.create_at) = 5) AS mayo,
       SUM(MONTH(t.create_at) = 6) AS junio,
       SUM(MONTH(t.create_at) = 7) AS julio,
       SUM(MONTH(t.create_at) = 8) AS agosto,
           SUM(MONTH(t.create_at) = 9) AS septiembre,
           SUM(MONTH(t.create_at) = 10) AS octubre,
           SUM(MONTH(t.create_at) = 11) AS noviembre,
           SUM(MONTH(t.create_at) = 12) AS diciembre
   FROM (
       SELECT DISTINCT sucursal_alta
       FROM tarjeta
   ) AS s
   LEFT JOIN (
       SELECT sucursal_alta, create_at
       FROM tarjeta
       WHERE create_at BETWEEN '".$this->create_at."' AND '".$this->date_final."'
           AND tarjeta.`status` = 1
       AND idtarjeta > 1
   ) AS t
   ON s.sucursal_alta = t.sucursal_alta
   LEFT JOIN sucursal AS ss ON s.sucursal_alta = ss.idsucursal
   WHERE ss.idsucursal > 0
   GROUP BY s.sucursal_alta;";
        return $this->conexion->query($sql);
    }
}
