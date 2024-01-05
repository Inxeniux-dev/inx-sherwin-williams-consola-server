<?php

class ProductModel
{
    private $conexion;
    public $name;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function getListAll()
    {
        $sql = "SELECT existencia, precio FROM articulo;";
        $response = $this->conexion->query($sql);
        if($response) { return $response; }else {return null; }
    }


}

?>
