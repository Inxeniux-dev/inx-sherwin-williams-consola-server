<?php

class CambioPrecioDetalleModel
{
    private $conexion;
    public $name;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function create($data)
    {
        $data = to_object($data);
        $sql = "INSERT INTO cambio_precio_detalle (cambio_precio_id, articulo_id, precio_anterior, precio_nuevo, created_at, data) VALUES('".$data->precio_id."', '".$data->id."', '".$data->precio_aux."', '".$data->precio."', '".date('Y-m-d H:i:s')."', '".$data->data."');";
        return $this->conexion->query($sql);
    }

    public function findById($id)
    {
        $sql = "SELECT precio_anterior, precio_nuevo, codigo, descripcion, data FROM cambio_precio_detalle INNER JOIN articulo ON cambio_precio_detalle.articulo_id = articulo.id WHERE cambio_precio_id = '".$id."';";
        return $this->conexion->query($sql);
    }

    

}

?>