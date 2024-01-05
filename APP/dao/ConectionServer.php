<?php

Class ConectionServer{
    private  $conexion_server = null;

    public function __construct()
    {
        $this->conexion_server = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME_SERVER, DB_PORT);
        if($this->conexion_server)
        {
          $this->conexion->query('SET NAMES "'.DB_ENCODE.'"');
        }

        if(mysqli_connect_errno()){
              $this->conexion_server = null;
        }
    }

    public function getConexion()
    {
      return $this->conexion_server;
    }
}

?>
