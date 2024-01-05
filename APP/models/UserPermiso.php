<?php

class UserPermiso {

  private $conexion;
  public $id;
  public $iduser;
  public $idsubmodulo;
  public $idmodulo;
  public $status;

  public function __construct()
  {
      $this->conexion = $GLOBALS["conexion"];
  }


  public function one()
  {
      $sql = "SELECT iduserpermiso, iduser, idsubmodulo, idmodulo, status FROM user_permiso WHERE iduser = '".$this->iduser."' AND idsubmodulo = '".$this->idsubmodulo."';";
      return $this->conexion->query($sql);
  }

  public function create()
  {
      $sql = "INSERT INTO user_permiso (iduser, idsubmodulo, idmodulo, status) VALUES ('".$this->iduser."', '".$this->idsubmodulo."', '".$this->idmodulo."', '".$this->status."');";
      return $this->conexion->query($sql);
  }

  public function update()
  {
      $sql = "UPDATE user_permiso SET status = '".$this->status."' WHERE iduser = '".$this->iduser."' AND idsubmodulo = '".$this->idsubmodulo."' AND idmodulo = '".$this->idmodulo."';";
      return $this->conexion->query($sql);
  }

}


?>
