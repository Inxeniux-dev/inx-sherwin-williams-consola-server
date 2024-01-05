<?php

class BitacoraUserModel
{
    private $conexion;
    public $idconcepto;
    public $iduser;
    public $create_at;
    public $observacion;


    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }





}
