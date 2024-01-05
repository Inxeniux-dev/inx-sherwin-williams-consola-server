<?php 
class Price_Model  {

    private $crud;

    function __construct() {
        $this->crud = new Crud();
    }
    
    public function create($table, $data) {
        $id = $this->crud->create($table, $data);
        return $id;
    }

    public function read($table, $conditions = array()) {
        $conditions = array("id" => $id);
        $data = $this->crud->read("usuarios", $conditions);
        return $data;
    }

    public function update($table, $id, $data) {
        $data = array("nombre" => $nombre, "apellido" => $apellido, "edad" => $edad);
        $result = $this->crud->update("usuarios", $id, $data);
        return $result;
    }

    public function delete($table, $id) {
         $result = $this->crud->delete("usuarios", $id);
        return $result;
    }

}

?>