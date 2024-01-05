<?php

class VersionDetalleModel
{
    private $conexion;

    public $id;
    public $detalle;
    public $idversion;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }

    function delete()
    {
        $sql = "DELETE FROM version_detalle WHERE id = '".$this->id."' AND idversion = '".$this->idversion."' LIMIT 1;";
        return  $this->conexion->query($sql);
    }
}
