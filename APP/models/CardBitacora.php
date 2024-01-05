<?php

class CardBitacora
{

  private $conexion;
  public $id;
  public $puntos;
  public $total;
  public $remision;
  public $referencia;
  public $fecha_sucursal;
  public $create_at;
  public $update_at;
  public $idtarjeta;
  public $idsucursal;
  public $idconcepto;

  public $search;

  public function __construct()
  {
      $this->conexion = $GLOBALS["conexion"];
  }


  public function create()
  {
      $sql = "INSERT INTO tarjeta_bitacora (puntos, total, remision, referencia, fecha_sucursal, create_at, update_at, idtarjeta, idsucursal, idconcepto) VALUES ('".$this->puntos."', '".$this->total."', '".$this->remision."', '".$this->referencia."', '".$this->fecha_sucursal."', '".$this->create_at."', '".$this->update_at."', '".$this->idtarjeta."', '".$this->idsucursal."', '".$this->idconcepto."');";
      return $this->conexion->query( $sql );
  }


}

?>
