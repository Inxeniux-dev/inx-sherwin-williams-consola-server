<?php

class ConfigModel
{
    private $conexion;

    public $id;
    public $sync_lines;
    public $sync_point;
    public $sync_user;
    public $sync_stores;
    public $factor_precio;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }

    public function one()
    {
      $sql = "SELECT sync_lines, sync_cards, sync_users, sync_stores, factor_precio, path_backup, path_log, path_upload, path_transfer, sync_sellers, points_for_money FROM config WHERE id = 1 LIMIT 1;";
      return $this->conexion->query($sql);
    }

    public function update_factor()
    {
      $sql = "UPDATE config SET factor_precio = '".$this->factor_precio."' WHERE id = 1;";
      return $this->conexion->query($sql);
    }
}


?>
