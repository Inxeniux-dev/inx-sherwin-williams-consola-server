<?php

require_once '../dao/Crud.php';

class CrudTest {

    private $crud;

    function __construct() {
        $this->crud = new Crud();
    }

    public function crearUsuario($nombre, $apellido, $edad) {
        $data = array("nombre" => $nombre, "apellido" => $apellido, "edad" => $edad);
        $id = $this->crud->create("usuarios", $data);
        return $id;
    }

    public function obtenerUsuarioPorId($id) {
        $conditions = array("id" => $id);
        $data = $this->crud->read("usuarios", $conditions);
        return $data;
    }

    public function actualizarUsuario($id, $nombre, $apellido, $edad) {
        $data = array("nombre" => $nombre, "apellido" => $apellido, "edad" => $edad);
        $result = $this->crud->update("usuarios", $id, $data);
        return $result;
    }

    public function eliminarUsuario($id) {
        $result = $this->crud->delete("usuarios", $id);
        return $result;
    }

}