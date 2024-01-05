<?php

class DiaInhabilModel
{
    private $conexion;
    public $id;
    public $dia_inhabil;
    public $create_at;
    public $user;
    public $concepto;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function allByYear()
    {
        $sql = "SELECT id, dia_inhabil, create_at, user, concepto FROM dia_inhabil WHERE dia_inhabil >= '".$this->dia_inhabil."';";
        return $this->conexion->query($sql);
    }

    public function findByDiaInhabil()
    {
      $sql = "SELECT id, dia_inhabil, create_at, user, concepto FROM dia_inhabil WHERE dia_inhabil = '".$this->dia_inhabil."';";
      return $this->conexion->query($sql);
    }

    public function create()
    {
        $sql = "INSERT INTO dia_inhabil (dia_inhabil, create_at, user, concepto) VALUES ('".$this->dia_inhabil."', '".$this->create_at."', '".$this->user."', '".$this->concepto."');";
        return $this->conexion->query($sql);
    }

    public function delete()
    {
      $sql = "DELETE FROM dia_inhabil WHERE id = '".$this->id."' LIMIT 1;";
      return $this->conexion->query($sql);
    }
}
