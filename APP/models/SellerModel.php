<?php

class SellerModel
{
    private $conexion;

    public $id;
    public $nombre;
    public $objetivo;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function all()
    {
        $sql = 'SELECT idvendedor, nombre, objetivo, status FROM vendedor';
        return $this->conexion->query($sql);
    }

    public function create()
    {
        $sql = "INSERT INTO vendedor (nombre, objetivo) VALUES ('".$this->nombre."', '".$this->objetivo."');";
        return $this->conexion->query($sql);
    }

    public function one()
    {
        $sql = 'SELECT idvendedor, nombre, objetivo FROM vendedor WHERE idvendedor = "'.$this->id.'" LIMIT 1;';
        return $this->conexion->query($sql);
    }

    public function update()
    {
    	$sql = "UPDATE vendedor SET nombre = '".$this->nombre."' , objetivo = '".$this->objetivo."' WHERE idvendedor = ".$this->id." LIMIT 1";
        return $this->conexion->query($sql);
    }

    public function delete()
    {
    	$sql = "UPDATE vendedor SET status = 0 WHERE idvendedor = ".$this->id." LIMIT 1";
    	return $this->conexion->query($sql);
    }

  }
