<?php

class EmpleadoModel
{
    private $conexion;
    public $id;
    public $nombre;
    public $apellido;
    public $idempleado;
    public $idconcepto;
    public $idsucursal;
    public $create_at;
    public $date_store;
    public $no_empleado;

    public $username;
    public $password;
    public $add_pintor;
    public $list_pintor;
    public $add_user;
    public $list_user;

    public $filter_idsucursal;
    public $search ;
    public $orden;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function getList()
    {
        $sql ="SELECT idempleado, empleado.nombre, apellido, no_empleado, empleado.idsucursal, sucursal.nombre AS nombre_sucursal, empleado.tipo FROM empleado LEFT JOIN sucursal ON empleado.idsucursal = sucursal.idsucursal WHERE (empleado.nombre LIKE '%".$this->search."%' OR apellido LIKE '%".$this->search."%') AND  idempleado LIKE '%".$this->idempleado."%' ".$this->filter_idsucursal." ORDER BY ".$this->orden.";";
        return  $this->conexion->query($sql);
    }

    public function one()
    {
        $sql ="SELECT idempleado, empleado.nombre, apellido, no_empleado, empleado.idsucursal, sucursal.nombre AS sucursal_nombre, add_pintor, list_pintor, add_user, list_user, username FROM empleado LEFT JOIN sucursal ON empleado.idsucursal = sucursal.idsucursal WHERE idempleado = '".$this->idempleado."' LIMIT 1;";
        return  $this->conexion->query($sql);
    }

    public function update()
    {
        $sql = "UPDATE empleado SET nombre = '".$this->nombre."', apellido = '".$this->apellido."', idsucursal = '".$this->idsucursal."', no_empleado = '".$this->no_empleado."' WHERE idempleado = '".$this->idempleado."' LIMIT 1; ";
        return  $this->conexion->query($sql);
    }

    public function update_permission()
    {
        $sql = "UPDATE empleado SET username = '".$this->username."', password = MD5('".$this->password."'), add_pintor = '".$this->add_pintor."', list_pintor = '".$this->list_pintor."', add_user = '".$this->add_user."', list_user = '".$this->list_user."' WHERE idempleado = '".$this->idempleado."' LIMIT 1; ";
        return  $this->conexion->query($sql);
    }

    public function delete()
    {
      $sql = "DELETE FROM empleado WHERE idempleado = '".$this->idempleado."' LIMIT 1;";
      return  $this->conexion->query($sql);
    }


    public function findByNoEmpleado()
    {
        $sql ="SELECT idempleado, empleado.nombre, apellido, no_empleado, empleado.idsucursal, sucursal.nombre AS sucursal_nombre, add_pintor, list_pintor, add_user, list_user, username FROM empleado LEFT JOIN sucursal ON empleado.idsucursal = sucursal.idsucursal WHERE no_empleado = '".$this->no_empleado."' LIMIT 1;";
        return  $this->conexion->query($sql);
    }

}
