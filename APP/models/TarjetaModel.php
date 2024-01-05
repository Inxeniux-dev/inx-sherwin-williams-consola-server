<?php

class TarjetaModel
{
    private $conexion;

    public $id;
    public $descripcion;
    public $tipo;
    public $para_igualado;

    public $page = 0;
    public $limit = 20;
    public $search = '';


    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }

    public function all()
    {
        $sql = 'SELECT idtarjeta, no_tarjeta, nombre, apellido, telefono, email, puntos, descuento, direccion FROM tarjeta WHERE nombre LIKE "%'.$this->search.'%" OR no_tarjeta LIKE "%'.$this->search.'%" ORDER BY no_tarjeta ASC;';
        if($this->page < 0) { $res = $this->conexion->query($sql);  return $res ? $res : false; }
        $cards = $this->conexion->query($sql);

        /*Paginator*/
        $sql = 'SELECT COUNT(1) AS contador, CASE WHEN count(1) % '.$this->limit.'> 0 THEN TRUNCATE(((count(1) /'.$this->limit.')+1),0) ELSE TRUNCATE((count(1) /'.$this->limit.'),0) END AS pages FROM tarjeta WHERE nombre LIKE "%'.$this->search.'%" OR no_tarjeta LIKE "%'.$this->search.'%";';
        $paginator =  $this->conexion->query($sql);

        return ["cards" => $cards, "paginator" => $paginator];
    }

}
?>
