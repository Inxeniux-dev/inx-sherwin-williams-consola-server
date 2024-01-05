<?php

class SupplierModel
{
    private $conexion;

    public $id;
    public $rfc;
    public $razon_social;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function all()
    {
        $sql = 'SELECT idproveedor, rfc, razon_social FROM proveedor';
        return $this->conexion->query($sql);
    }

    public function add()
    {
        $sql = "INSERT INTO proveedor (rfc, razon_social) VALUES ('".$this->rfc."', '".$this->razon_social."');";
        return $this->conexion->query($sql);
    }

  }


?>