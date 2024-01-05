<?php

class EmpleadoRotacion
{

  private $conexion;
  public  $id;
  public  $id_empleado;
  public  $id_sucursal;
  public  $create_at;
  public  $expiracion;

  public function __construct()
  {
      $this->conexion = $GLOBALS["conexion"];
  }


  public function one()
  {
      $sql = "SELECT r.idrotacion, r.idempleado, r.idsucursal, r.create_at, r.expiracion, s.nombre FROM empleado_rotacion AS r INNER JOIN sucursal AS s ON r.idsucursal = s.idsucursal WHERE idrotacion = '".$this->id."' LIMIT 1";
      return $this->conexion->query($sql);
  }

  public function getList()
  {
      $sql = "SELECT r.idrotacion, r.idempleado, r.idsucursal, r.create_at, r.expiracion, s.nombre FROM empleado_rotacion AS r LEFT JOIN sucursal AS s ON r.idsucursal = s.idsucursal WHERE idempleado = '".$this->id_empleado."' ORDER BY expiracion DESC, create_at DESC LIMIT 0, 100; ";
      return $this->conexion->query($sql);
  }

  public function create()
  {
    $sql = "INSERT INTO empleado_rotacion (idempleado, idsucursal, create_at, expiracion) VALUES ('".$this->id_empleado."', '".$this->id_sucursal."', '".$this->create_at."', '".$this->expiracion."');";
    return $this->conexion->query($sql);
  }

  public function update()
  {
     $sql = "UPDATE empleado_rotacion SET expiracion = '".$this->expiracion."' WHERE idrotacion = '".$this->id."' LIMIT 1;";
      return $this->conexion->query($sql);
  }


  public function getOne()
  {
    $sql = "SELECT r.idempleado, r.idsucursal, r.create_at, r.expiracion, s.nombre FROM empleado_rotacion AS r INNER JOIN sucursal AS s ON r.idsucursal = s.idsucursal WHERE idempleado = '".$this->id_empleado."' AND r.idsucursal = '".$this->id_sucursal."' LIMIT 1;";
    return $this->conexion->query($sql);
  }

  public function deleteByIdEmployee()
  {
      $sql = "DELETE FROM empleado_rotacion WHERE idempleado = '".$this->id_empleado."';";
      return $this->conexion->query($sql);
  }

}

?>
