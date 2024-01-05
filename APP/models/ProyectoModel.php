<?php

class ProyectoModel
{
    private $conexion;

    private $id;
    private $version;

    public $idproyecto;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }

    public function getList()
    {
        $sql ="SELECT id, nombre FROM proyecto;";
        return  $this->conexion->query($sql);
    }

    public function last_version()
    {
        $sql = "SELECT id, version, create_at FROM version WHERE idproyecto = '".$this->idproyecto."' AND status = 0 ORDER BY create_at DESC LIMIT 1;";
        return $this->conexion->query($sql);
    }


}

?>
