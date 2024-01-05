<?php

class CapacityModel
{
    private $conexion;

    public $id;
    public $capacidad;
    public $unidad;
    public $tipo;
    public $newId;


    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function all()
    {
        $sql = "SELECT idcapacidad, capacidad, unidad, tipo FROM capacidad;";
        return $this->conexion->query($sql);
    }

    public function one()
    {
        $sql = "SELECT idcapacidad, capacidad, unidad, tipo FROM capacidad WHERE idcapacidad = '".$this->id."' LIMIT 1;";
        return $this->conexion->query($sql); 
    }

    public function create()
    {
        $sql = "INSERT INTO capacidad (idcapacidad, capacidad, unidad, tipo) VALUES ('".$this->id."', '".$this->capacidad."', '".$this->unidad."', '".$this->tipo."');";
        return $this->conexion->query($sql); 
    }

    public function update()
    {
        $sql = "UPDATE capacidad SET idcapacidad = '".$this->newId."', capacidad = '".$this->capacidad."', unidad = '".$this->unidad."', tipo = '".$this->tipo."' WHERE idcapacidad = '".$this->id."';";
        return $this->conexion->query($sql); 
    }

    public function delete()
    {
        $sql = "DELETE FROM capacidad WHERE idcapacidad = '".$this->id."' LIMIT 1;";
        return $this->conexion->query($sql); 
    }
}

?>