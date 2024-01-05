<?php

class VersionModel
{
    private $conexion;

    public $id;
    public $version;
    public $create_at;
    public $status;
    public $idproyecto;
    public $sucursales;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }

    /* REESTRUCTURING*/

    public function one()
    {
        $sql ="SELECT version.id, version, create_at, status, idproyecto, nombre, dias_limite, sucursales FROM version INNER JOIN proyecto ON version.idproyecto = proyecto.id WHERE version.id = '".$this->id."'";
        return  $this->conexion->query($sql);
    }

    public function update()
    {
        $sql = "UPDATE version SET sucursales =  '".$this->sucursales."' WHERE id = '".$this->id."' LIMIT 1;";
        return  $this->conexion->query($sql);
    }

    /* END REESTRUCTURING*/

    public function getList($fech_ini, $fech_fin, $estatus, $proyecto)
    {
        $filter = '';
        if($proyecto > 0){  $filter .= ' AND idproyecto = "'.$proyecto.'" ';  }
        if($estatus > -1)  {  $filter .= ' AND status = "'.$estatus.'" ';  }

        $sql ="SELECT version.id, version, create_at, status, idproyecto, nombre FROM version INNER JOIN proyecto ON version.idproyecto = proyecto.id WHERE (create_at >= '".$fech_ini."' AND create_at <= '".$fech_fin."')  ".$filter." ORDER BY version DESC, idproyecto ASC;";
        return  $this->conexion->query($sql);
    }


    public function getData($id)
    {
        $sql ="SELECT version.id, version, create_at, status, idproyecto, nombre, dias_limite, sucursales FROM version INNER JOIN proyecto ON version.idproyecto = proyecto.id WHERE version.id = '".$id."'";
        return  $this->conexion->query($sql);
    }

    public function detail($id)
    {
        $sql = "SELECT id, detalle FROM version_detalle WHERE idversion = '".$id."';";
        return  $this->conexion->query($sql);
    }

    public function adddetail($id, $detalle)
    {
        $sql = "INSERT INTO version_detalle(detalle, idversion) VALUES ('".$detalle."', '".$id."');";
        return $this->conexion->query($sql);
    }

    public function updateStatus($id, $status)
    {
        $str_date = $status == 0 ? ", create_at = '".date("Y-m-d")."' " : "";
        $sql = "UPDATE version SET status = '".$status."' ".$str_date." WHERE id = '".$id."' LIMIT 1;";
        return $this->conexion->query($sql);
    }


    public function getLastVersionByProyect($idproyecto)
    {
      $sql ="SELECT version.id, version, create_at, status, idproyecto, nombre FROM version INNER JOIN proyecto ON version.idproyecto = proyecto.id WHERE version.idproyecto = '".$idproyecto."' ORDER BY version DESC LIMIT 1; ";
      return  $this->conexion->query($sql);
    }
    
    public function getLastVersionProductionByProyect($idproyecto)
    {
      $sql ="SELECT version.id, version, create_at, status, idproyecto, nombre FROM version INNER JOIN proyecto ON version.idproyecto = proyecto.id WHERE version.idproyecto = '".$idproyecto."' AND status = 0 ORDER BY version DESC LIMIT 1; ";
      return  $this->conexion->query($sql);
    }


    public function getDataByVersion($version, $idproyecto)
    {
      $sql ="SELECT COUNT(*) AS total FROM version WHERE idproyecto = '".$idproyecto."' AND version = '".$version."' LIMIT 1; ";
      return  $this->conexion->query($sql);
    }

    public function create($version, $idproyecto)
    {
      $sql = "INSERT INTO version (version, create_at, status, idproyecto) VALUES ('".$version."', '".date("Y-m-d")."', 1, '".$idproyecto."');";
      $response =  $this->conexion->query($sql);
      return array("status" => $response, "id" => $this->conexion->insert_id);
    }

    public function addFile($nombre, $file, $id, $fecha)
    {
      $sql = "INSERT INTO version_file (nombre, path, idversion, create_at) VALUES ('".$nombre."', '".$file."', '".$id."', '".$fecha."');";
      return $this->conexion->query($sql);
    }

    public function getFilesByID($id)
    {
       $sql = "SELECT id, nombre, path, create_at FROM version_file WHERE idversion = '".$id."';";
       return $this->conexion->query($sql);
    }

    public function getFileByID($id)
    {
       $sql = "SELECT nombre, path, version FROM version_file INNER JOIN version ON version_file.idversion = version.id WHERE version_file.id = '".$id."';";
       return $this->conexion->query($sql);
    }


}

?>
