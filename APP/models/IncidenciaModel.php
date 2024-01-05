<?php

class Incidencia
{
    private $conexion;
    public $id;
    public $comentario;
    public $path_img;
    public $create_at;
    public $idsucursal;

    public $page = 0;
    public $limit = 20;
    public $search = '';

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }

    /*public function create()
    {
        $sql = "INSERT INTO incidencia (comentario, path_img, created_at, idsucursal) VALUES ('".$this->comentario."', '".$this->path_img."', '".$this->created_at."', '".$this->idsucursal."');";
        $this->conexion->autocommit(FALSE);
        if($this->conexion->query($sql)){
          $this->conexion->commit();
          return $this->conexion->insert_id;
        }
        $this->conexion->rollback();
        return false;
    }*/

    public function create()
    {
        $sql = "INSERT INTO incidencia (comentario, path_img, create_at, idsucursal) VALUES ('".$this->comentario."', '".$this->path_img."', '".$this->create_at."', '".$this->idsucursal."');";
        if($this->conexion->query($sql)){
          return $this->conexion->insert_id;
        }
        return false;
    }

    public function all()
    {

        $sql = 'SELECT idincidencia, comentario, path_img, create_at, incidencia.idsucursal, nombre FROM incidencia INNER JOIN sucursal ON incidencia.idsucursal = sucursal.idsucursal WHERE comentario LIKE "%'.$this->search.'%" ORDER BY create_at DESC;';
        if($this->page < 0) { $res = $this->conexion->query($sql);  return $res ? $res : false; }
        $incidencias = $this->conexion->query($sql);

        /*Paginator*/
        $sql = 'SELECT COUNT(1) AS contador, CASE WHEN count(1) % '.$this->limit.'> 0 THEN TRUNCATE(((count(1) /'.$this->limit.')+1),0) ELSE TRUNCATE((count(1) /'.$this->limit.'),0) END AS pages FROM incidencia WHERE comentario LIKE "%'.$this->search.'%";';
        $paginator =  $this->conexion->query($sql);

        return ["incidencias" => $incidencias, "paginator" => $paginator];
    }

    public function one()
    {
        $sql = 'SELECT idincidencia, comentario, path_img, create_at, idsucursal FROM incidencia WHERE idincidencia= '.$this->id.' LIMIT 1; ';
        return $this->conexion->query($sql);
    }


    public function update()
    {
        $sql = 'UPDATE incidencia SET comentario = "'.$this->comentario.'", path_img = "'.$this->path_img.'", created_at = "'.$this->created_at.'", idsucursal = "'.$this->idsucursal.'" WHERE idincidencia= '.$this->id.' LIMIT 1;';
        return $this->conexion->query($sql);
    }

}
