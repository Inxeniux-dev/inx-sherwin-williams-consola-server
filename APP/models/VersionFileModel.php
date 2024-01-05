<?php

class VersionFileModel
{
    private $conexion;

    public $id;
    public $nombre;
    public $path;
    public $idversion;

    public $page = 0;
    public $limit = 50;
    public $search = '';

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function one()
    {
        $sql ="SELECT id, nombre, path, idversion FROM version_file WHERE id = '".$this->id."' AND idversion = '".$this->idversion."' LIMIT 1;";
        return  $this->conexion->query($sql);
    }

    public function deleteOne()
    {
        $sql ="DELETE FROM version_file WHERE id = '".$this->id."' AND idversion = '".$this->idversion."' LIMIT 1;";
        return  $this->conexion->query($sql);
    }
}

?>
