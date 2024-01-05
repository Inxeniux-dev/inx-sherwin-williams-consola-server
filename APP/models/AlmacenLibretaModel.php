<?php

class AlmacenLibretaModel {

  private $conexion;
  public $idalmacen;
  public $iduser;

  public function __construct()
  {
      $this->conexion = $GLOBALS["conexion"];
  }


  public function getListByUser()
  {
      $sql = "SELECT almacen_libreta.idalmacen, almacen.clave, almacen.nombre, iduser FROM almacen_libreta INNER JOIN almacen ON almacen_libreta.idalmacen = almacen.idalmacen WHERE iduser = '".$this->iduser."'";
      return $this->conexion->query($sql);
  }

  public function one()
  {
      $sql = "SELECT idalmacen, iduser FROM almacen_libreta WHERE idalmacen = ".$this->idalmacen." AND iduser = ".$this->iduser." LIMIT 1";
      return $this->conexion->query($sql);
  }

  public function create()
  {
      $sql = "INSERT INTO almacen_libreta(idalmacen, iduser) VALUES(".$this->idalmacen.", ".$this->iduser.");";
      return $this->conexion->query($sql);
  }


  public function delete()
  {
      $sql = "DELETE FROM almacen_libreta WHERE idalmacen = ".$this->idalmacen." AND iduser = ".$this->iduser." LIMIT 1";
      return $this->conexion->query($sql);
  }
}


?>
