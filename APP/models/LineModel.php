<?php

class LineModel
{
    private $conexion;

    public $id;
    public $descripcion;
    public $tipo;
    public $para_igualado;
    public $para_conversion;
    public $new_id;

    public $page = 0;
    public $limit = 20;
    public $search = '';


    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function all()
    {
        $sql = 'SELECT idlinea, descripcion, tipo, para_igualado, para_conversion FROM linea WHERE descripcion LIKE "%'.$this->search.'%"  ORDER BY idlinea ASC;';
        if($this->page < 0) { $res = $this->conexion->query($sql);  return $res ? $res : false; }
        $linea = $this->conexion->query($sql);

        /*Paginator*/
        $sql = 'SELECT COUNT(1) AS contador, CASE WHEN count(1) % '.$this->limit.'> 0 THEN TRUNCATE(((count(1) /'.$this->limit.')+1),0) ELSE TRUNCATE((count(1) /'.$this->limit.'),0) END AS pages FROM linea WHERE descripcion LIKE "%'.$this->search.'%";';
        $paginator =  $this->conexion->query($sql);

        return ["linea" => $linea, "paginator" => $paginator];
    }



    public function add()
    {
        $sql = "INSERT INTO linea (idlinea, descripcion, tipo, para_igualado, para_conversion) VALUES('".$this->id."', '".$this->descripcion."', '".$this->tipo."', '".$this->para_igualado."', '".$this->para_conversion."');";
       return $this->conexion->query($sql);
    }


    public function update()
    {
       $sql = "UPDATE linea SET idlinea = '".$this->new_id."', descripcion = '".$this->descripcion."', tipo = '".$this->tipo."', para_igualado = '".$this->para_igualado."', para_conversion = '".$this->para_conversion."' WHERE idlinea = '".$this->id."' LIMIT 1;";
       return $this->conexion->query($sql);
    }

    public function delete()
    {
        $sql = "DELETE FROM linea WHERE idlinea =".$this->id." LIMIT 1;";
        return $this->conexion->query($sql);
    }



    public function oneByID($id)
    {
      $sql = "SELECT * FROM linea WHERE idlinea = '".$id."' LIMIT 1;";
      return $this->conexion->query($sql);
    }

    public function create($data)
    {
       $sql = "INSERT INTO linea (idlinea, descripcion, tipo, para_igualado) VALUES('".$data["IDLINEA"]."', '".$data["DESCRIPCION"]."', '".$data["TIPO"]."', '".$data["PARA_IGUALADO"]."');";
       return $this->conexion->query($sql);
    }

    public function getAll()
    {
      $sql ="SELECT idlinea, descripcion, tipo, para_igualado, para_conversion FROM linea ORDER BY idlinea ASC";
      return $this->conexion->query($sql);
    }

    public function getLines($page, $search)
    {
      $inicio=($page-1)*20;
      $limit = 20;
      $filter = " descripcion LIKE '%".$search."%'";

      $sql ="SELECT idlinea, descripcion, tipo, para_igualado FROM linea WHERE ".$filter." LIMIT ".$inicio.", ".$limit.";";
      $lines = $this->conexion->query($sql);

      $sql_p="SELECT COUNT(1) AS contador, CASE WHEN count(1) % ".$limit."> 0 THEN TRUNCATE(((count(1) /".$limit.")+1),0) ELSE TRUNCATE((count(1) /".$limit."),0) END AS pages FROM
      linea WHERE ".$filter."; ";

      $paginator =  $this->conexion->query($sql_p);

      return array("lines" => $lines, "paginator" =>$paginator);
    }

    public function getPromociones()
    {
      $sql ="SELECT * FROM promocion";
      return $this->conexion->query($sql);
    }

}

?>
