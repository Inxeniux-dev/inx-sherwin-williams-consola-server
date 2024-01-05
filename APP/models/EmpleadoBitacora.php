<?php

class EmpleadoBitacora
{
    private $conexion;
    public  $id;
    public $idempleado;
    public $idconcepto;
    public $idsucursal;
    public $create_at;
    public $date_store;
    public $tipo;

    public $filter_idsucursal;
    public $orden;
    public $create_at_final;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function getList()
    {
        $sql ="SELECT idbitacora, idconcepto, empleado_bitacora.create_at, date_store, empleado.nombre, empleado.apellido, s1.nombre AS nombre_sucursal, s2.nombre AS nombre_base, empleado.idsucursal AS suc_base, empleado_bitacora.idsucursal FROM empleado_bitacora INNER JOIN empleado ON empleado_bitacora.idempleado = empleado.idempleado LEFT JOIN sucursal AS s1 ON empleado_bitacora.idsucursal = s1.idsucursal LEFT JOIN sucursal AS s2 ON empleado.idsucursal = s2.idsucursal WHERE idconcepto LIKE '%".$this->idconcepto."%' AND empleado.tipo LIKE '%".$this->tipo."%' ".$this->filter_idsucursal." AND (empleado_bitacora.create_at >= '".$this->create_at." 00:00:00' AND empleado_bitacora.create_at <= '".$this->create_at_final." 23:59:59') ORDER BY ".$this->orden.";";
        return  $this->conexion->query($sql);
    }

    public function getListByIdEmpleado()
    {
      $sql ="SELECT idbitacora, idconcepto, empleado_bitacora.create_at, date_store, empleado.nombre, empleado.apellido, s1.nombre AS nombre_sucursal, s2.nombre AS nombre_base, empleado.idsucursal AS suc_base, empleado_bitacora.idsucursal FROM empleado_bitacora INNER JOIN empleado ON empleado_bitacora.idempleado = empleado.idempleado LEFT JOIN sucursal AS s1 ON empleado_bitacora.idsucursal = s1.idsucursal LEFT JOIN sucursal AS s2 ON empleado.idsucursal = s2.idsucursal WHERE idconcepto LIKE '%".$this->idconcepto."%' ".$this->filter_idsucursal." AND empleado.idempleado LIKE '".$this->idempleado."' AND (empleado_bitacora.create_at >= '".$this->create_at." 00:00:00' AND empleado_bitacora.create_at <= '".$this->create_at_final." 23:59:59') ORDER BY empleado_bitacora.create_at DESC, ".$this->orden.";";
      return  $this->conexion->query($sql);
    }

    public function deleteByIdEmployee()
    {
      $sql = "DELETE FROM empleado_bitacora WHERE idempleado = '".$this->idempleado."';";
      return $this->conexion->query($sql);
    }
}
