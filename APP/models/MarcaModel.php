<?php

class MarcaModel
{
    private $conexion;

    public $id;
    public $marca;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }

    public function all()
    {
        $sql = 'SELECT idmarca, marca FROM marca';
        return $this->conexion->query($sql);
    }

    public function one()
    {
        $sql = "SELECT idmarca, marca FROM marca WHERE idmarca =".$this->id.";";
        return $this->conexion->query($sql);
    }

    public function add()
    {
        $sql = "INSERT INTO marca (marca) VALUES ('".$this->marca."');";
        return $this->conexion->query($sql);
    }

    public function update()
    {
        $sql = "UPDATE marca SET marca = '".$this->marca."' WHERE idmarca =".$this->id.";";
        return $this->conexion->query($sql);
    }

    public function delete()
    {
        $sql = "DELETE FROM marca WHERE idmarca =".$this->id." LIMIT 1;"; 
        return $this->conexion->query($sql);
    }

  }
