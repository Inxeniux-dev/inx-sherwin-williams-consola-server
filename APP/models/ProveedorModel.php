<?php

class ProveedorModel
{
    private $conexion;
    public $id;
    public $rfc;
    public $razon_social;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function one()
    {
        $sql = 'SELECT idproveedor, rfc, razon_social FROM proveedor WHERE idproveedor = "'.$this->id.'" LIMIT 1;';
        return $this->conexion->query($sql);
    }

    public function oneByRFC()
    {
        $sql = 'SELECT idproveedor, rfc, razon_social FROM proveedor WHERE rfc = "'.$this->rfc.'" LIMIT 1;';
        return $this->conexion->query($sql);
    }

    public function getall()
    {
       $sql = "SELECT idproveedor, rfc, razon_social FROM proveedor ORDER BY idproveedor ASC;";
       return $this->conexion->query($sql);
    }

    public function create(){
        $sql = "INSERT INTO proveedor (rfc, razon_social) VALUES('".$this->rfc."', '".$this->razon_social."');";
        return $this->conexion->query($sql);
    }   

    public function update(){
        $sql = "UPDATE proveedor SET rfc = '".$this->rfc."', razon_social = '".$this->razon_social."' WHERE idproveedor = '".$this->id."' LIMIT 1;";
        return $this->conexion->query($sql);
    }

    public function delete(){
        $sql = "DELETE FROM proveedor WHERE idproveedor = '".$this->id."' LIMIT 1;";
        return $this->conexion->query($sql);
    }



}
