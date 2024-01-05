<?php

Class SettingModel
{
    private $conexion;
    private $conexionServer;

    public $id;
    public $sync_lines;
    public $sync_cards;
    public $sync_users;
    public $sync_stores;
    public $sync_sellers;

    public $factor_precio;

    public $path_backup;
    public $path_log;
    public $path_upload;
    public $path_orders;
    public $path_transfer;
    public $path_prices;

    public $user_db_notebook;
    public $pass_db_notebook;
    public $host_db_notebook;
    public $port_db_notebook;
    public $name_db_notebook;

    public $points_for_money;
    public $points_percentage;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function one()
    {
        $sql = "SELECT id, sync_lines, sync_cards, sync_stores, sync_users, factor_precio, path_backup, path_log, path_upload, path_transfer, path_orders, path_prices, user_db_notebook, pass_db_notebook, host_db_notebook, port_db_notebook, name_db_notebook, sync_sellers, points_for_money, points_percentage FROM config WHERE id = 1 ;";
        return $this->conexion->query($sql)->fetch_object();
    }


    public function updatePaths()
    {
      $sql = "UPDATE config SET path_backup = '".$this->path_backup."', path_log = '".$this->path_log."', path_upload = '".$this->path_upload."', path_transfer = '".$this->path_transfer."', path_orders = '".$this->path_orders."', path_prices = '".$this->path_prices."' WHERE id = 1 LIMIT 1";
      return $this->conexion->query($sql);
    }


    public function updateSync()
    {
      $sql = "UPDATE config SET  sync_lines = '".$this->sync_lines."', sync_cards = '".$this->sync_cards."', sync_users = '".$this->sync_users."', sync_stores = '".$this->sync_stores."', sync_sellers = '".$this->sync_sellers."' WHERE id = 1 LIMIT 1";
      return $this->conexion->query($sql);
    }

    public function updateNotebook()
    {
         $sql = "UPDATE config SET  user_db_notebook = '".$this->user_db_notebook."', host_db_notebook = '".$this->host_db_notebook."', port_db_notebook = '".$this->port_db_notebook."', name_db_notebook = '".$this->name_db_notebook."' WHERE id = 1 LIMIT 1";
      return $this->conexion->query($sql);
    }


    public function updateStoreConfig(){
         $sql = "UPDATE config SET  points_for_money = '".$this->points_for_money."', points_percentage = '".$this->points_percentage."' WHERE id = 1;";
      return $this->conexion->query($sql);
    }







    /*METHODOS ANTIGUOS */

    public function getDataStore()
    {
        $sql = "SELECT email, telefono, direccion, colonia, num_interior, num_exterior, municipio, estado, pais, codigo_postal FROM cliente WHERE idcliente = 1 LIMIT 1";
        $response = $this->conexion->query($sql);

        $correo = '';
        $telefono = '';
        $clave_sucursal = '';

        while($row = $response->fetch_object())
        {
            $correo = $row->email;
            $telefono = $row->telefono;
            $direccion = $row->direccion;
            $colonia = $row->colonia;
            $num_interior = $row->num_interior;
            $num_exterior = $row->num_exterior;
            $municipio = $row->municipio;
            $estado = $row->estado;
            $pais = $row->pais;
            $cp = $row->codigo_postal;
        }

        $sql = "SELECT nombre FROM vendedor WHERE idvendedor = 1 LIMIT 1;";
        $response = $this->conexion->query($sql);

        $encargado = 'Encargado';
         while($row = $response->fetch_object())
        {
            $encargado = $row->nombre;
        }

        return array("correo" => $correo, "telefono" => $telefono,  "encargado" => $encargado, "clave_sucursal" => $clave_sucursal, "direccion" => $direccion, "colonia" => $colonia, "num_exterior" => $num_exterior, "num_interior" => $num_interior, "municipio" => $municipio, "estado" => $estado, "pais" => $pais, "cp" => $cp);

    }







    // VER SI VUELAN ESTOS METIDOS

    public function all_users()
    {
        $sql = "SELECT iduser, nombre, tipo FROM user";
        if(MODE == "SERVER")
        {
          return $this->conexionServer->query($sql);
        }
        return $this->conexion->query($sql);
    }


    public function getDataUser($identified)
    {
        $sql = "SELECT iduser, nombre, tipo FROM user WHERE iduser = '".$identified."' LIMIT 1";
        if(MODE == "SERVER")
        {
          return $this->conexionServer->query($sql);
        }
        return $this->conexion->query($sql);
    }
}
