<?php

class ClaveSatModel
{
    private $conexion;

    public $clave_sat;
    public $es_peligroso;

    public $page = 0;
    public $limit = 50;
    public $search = '';

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }

    public function one()
    {
        $sql ="SELECT clave_sat, es_peligroso FROM clave_sat WHERE clave_sat = '".$this->clave_sat."' LIMIT 1;";
        return  $this->conexion->query($sql);
    }

}

?>
