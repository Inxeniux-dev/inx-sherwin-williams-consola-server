<?php

class AlmacenModel
{
    private $conexion;

    public $id;
    public $clave;
    public $nombre;
    public $version;


    public $page = 0;
    public $limit = 50;
    public $search = '';

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function one()
    {
        $sql ="SELECT idalmacen, clave, nombre, version FROM almacen WHERE idalmacen = '".$this->id."' LIMIT 1;";
        return  $this->conexion->query($sql);
    }

    public function all()
    {
      $sql ="SELECT idalmacen, clave, nombre, version FROM almacen;";
      return  $this->conexion->query($sql);
    }
}
?>
