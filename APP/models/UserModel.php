<?php

class UserModel
{
    private $conexion;
    private $conexionServer;

    public $id;
    public $username;
    public $password;
    public $name;
    public $tipo;
    public $idmodulo;
    public $create_at;
    public $update_at;
    public $permisos;
    public $id_sistema;

    public $page = 0;
    public $limit = 20;
    public $search = '';

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function one()
    {
       $sql = 'SELECT iduser, username, nombre, tipo, create_at, update_at, permisos, id_sistema FROM user WHERE iduser = "'.$this->id.'" LIMIT 1;';
       return $this->conexion->query($sql);
    }


    public function getbyUsernameAndSistem()
    {
       $sql = 'SELECT iduser, username, nombre, tipo, create_at, update_at, permisos FROM user WHERE username = "'.$this->username.'" AND id_sistema = "'.$this->id_sistema.'" LIMIT 1;';
       return $this->conexion->query($sql);
    }

    public function all()
    {
        $sql = 'SELECT iduser, username, nombre, tipo, create_at, update_at, password, permisos, id_sistema FROM user WHERE username LIKE "%'.$this->search.'%" OR nombre LIKE "%'.$this->search.'%" ORDER BY iduser ASC;';
        if($this->page < 0) { $res = $this->conexion->query($sql);  return $res ? $res : false; }
        $users = $this->conexion->query($sql);

        /*Paginator*/
        $sql = 'SELECT COUNT(1) AS contador, CASE WHEN count(1) % '.$this->limit.'> 0 THEN TRUNCATE(((count(1) /'.$this->limit.')+1),0) ELSE TRUNCATE((count(1) /'.$this->limit.'),0) END AS pages FROM user WHERE username LIKE "%'.$this->search.'%" OR nombre LIKE "%'.$this->search.'%"; ';
        $paginator =  $this->conexion->query($sql);

        return ["users" => $users, "paginator" => $paginator];
    }


    public function allBySystem()
    {
        $sql = 'SELECT iduser, username, nombre, tipo, create_at, update_at, password, permisos, id_sistema FROM user WHERE id_sistema = "'.$this->id_sistema.'" ORDER BY iduser ASC;';
        $res = $this->conexion->query($sql);
        return $res ? $res : false;
    }

    public function permisoByModule()
    {
      $sql = 'SELECT iduserpermiso, iduser, idsubmodulo, idmodulo, status FROM user_permiso WHERE iduser = "'.$this->id.'" AND idmodulo = "'.$this->idmodulo.'";';
      return $this->conexion->query($sql);
    }


    public function permiso()
    {
        $sql = 'SELECT iduserpermiso, iduser, idsubmodulo, idmodulo, status FROM user_permiso WHERE iduser = "'.$this->id.'";';
        $res = $this->conexion->query($sql);
        return $res ? $res : false;
    }


    public function addUser()
    {
        $sql = "INSERT INTO user (username, password, nombre, tipo, create_at, update_at, permisos, id_sistema) VALUES ('".$this->username."', MD5('".$this->password."'), '".$this->nombre."', '".$this->tipo."', '".$this->create_at."', '".$this->update_at."', '".$this->permisos."', '".$this->id_sistema."');";
        return $this->conexion->query($sql) ? $this->conexion->insert_id : 0;
    }

    public function updateUser()
    {
        $sql = "UPDATE user SET permisos = '".$this->permisos."', update_at = '".$this->update_at."', nombre = '".$this->nombre."', username = '".$this->username."', tipo = '".$this->tipo."' WHERE iduser = '".$this->id."' LIMIT 1";
        return $this->conexion->query($sql);
    }

    public function updatePassword()
    {
        $sql = "UPDATE user SET password = MD5('".$this->password."'), update_at = '".$this->update_at."' WHERE iduser = '".$this->id."' AND id_sistema = '".$this->id_sistema."' LIMIT 1";
        return $this->conexion->query($sql);
    }

    public function delete()
    {
        $sql = "DELETE FROM user WHERE iduser = '".$this->id."' AND id_sistema = '".$this->id_sistema."' LIMIT 1";
        return $this->conexion->query($sql);
    }


}
