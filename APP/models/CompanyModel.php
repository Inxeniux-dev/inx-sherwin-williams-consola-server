<?php

class CompanyModel
{
    private $conexion;
    public $name;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }

    public function getData()
    {
        $sql = "SELECT razon, rfc, telefono, email, direccion, colonia, numero, cp, ciudad, estado, pais, ciudad AS municipio FROM datos_empresa WHERE idempresa = 1;";
        $response = $this->conexion->query($sql);
        if($response)
        {
            return $response->fetch_object();
        }
        return null;
    }

}
