<?php

class LocationModel
{
    private $conexion;
    public $name;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function getLocations($search, $page)
    {   $inicio = ($page-1) * 20;
        $limit = 20;
        $search = trim($search);
        $sql = "SELECT idsucursal, nombre, serie, tipo, direccion, telefono, email FROM cat_sucursal WHERE idsucursal LIKE'%".$search."%' OR nombre LIKE'%".$search."%' ORDER BY idsucursal LIMIT ".$inicio.", ".$limit.";";
        $sucursales = $this->conexion->query($sql);

        $sql_p="SELECT COUNT(1) AS contador, CASE WHEN count(1) % ".$limit."> 0 THEN TRUNCATE(((count(1) /".$limit.")+1),0) ELSE TRUNCATE((count(1) /".$limit."),0) END AS pages FROM cat_sucursal WHERE idsucursal LIKE'%".$search."%' OR nombre LIKE'%".$search."%' ;";
        $paginator =  $this->conexion->query($sql_p);

        return array("sucursales" => $sucursales, "paginator" =>$paginator);
    }


    public function getLocationsByID($idlocation)
    {
        $sql = "SELECT idsucursal, nombre, serie, tipo, direccion FROM cat_sucursal WHERE idsucursal =".$idlocation.";";
        return $this->conexion->query($sql);
    }

    public function getByItems($item, $value, $operation)
    {
        $items = '';
        if((count($item) != count($value)) || count($item) == 0)  { return null; }
        for($x = 0; $x < count($item); $x++)
        {
            $items .= ($x+1) == count($item) ? $item[$x]." = '".$value[$x]."' " : $item[$x]." = '".$value[$x]."' ".$operation[$x]." ";
        }
        $sql = "SELECT idsucursal, nombre, serie, tipo, direccion FROM cat_sucursal WHERE ".$items.";";
        return  $this->conexion->query($sql);
    }


    public function saveLocation($data)
    {
        $sql = "INSERT INTO cat_sucursal (idsucursal, nombre, serie, tipo, direccion, num_interior, num_exterior, codigo_postal, colonia, ciudad, estado, pais) VALUES ('".$data["key"]."', '".$data["name"]."', '".$data["serie"]."', '".$data["type"]."', '".$data["direccion"]."', '".$data["numint"]."', '".$data["numext"]."', '".$data["cp"]."','".$data["colonia"]."', '".$data["municipio"]."', '".$data["estado"]."', '".$data["pais"]."');";
        $sql = htmlspecialchars($sql);
        return array("status" => $this->conexion->query($sql), "id" => $this->conexion->insert_id);
    }

    public function getDataLocation($identified)
    {
        $sql ="SELECT idsucursal, nombre, serie, tipo, direccion, num_interior, num_exterior, codigo_postal, colonia, ciudad, estado, pais, telefono, email FROM cat_sucursal WHERE idsucursal = ".$identified."; ";
        $data = $this->conexion->query($sql)->fetch_object();
        if($data){ return $data; }
        else{ return null; }
    }


    public function updateLocation($data)
    {
        $sql = "UPDATE cat_sucursal SET idsucursal = '".$data["key"]."', nombre = '".$data["name"]."', serie = '".$data["serie"]."', tipo = '".$data["type"]."', direccion = '".$data["direccion"]."', num_interior = '".$data["numint"]."', num_exterior = '".$data["numext"]."', codigo_postal = '".$data["cp"]."', colonia = '".$data["colonia"]."', ciudad = '".$data["municipio"]."', estado = '".$data["estado"]."', pais = '".$data["pais"]."', telefono = '".$data["telefono"]."', email = '".$data["email"]."' WHERE idsucursal = ".$data['id_location'].";";
        $sql = htmlspecialchars($sql);
        return array("status" => $this->conexion->query($sql));
    }


    public function addLocation($data)
    {
      $data = to_object($data);

        $sql = "INSERT INTO cat_sucursal (idsucursal, nombre, serie, tipo, direccion, num_interior, num_exterior, codigo_postal, colonia, ciudad, estado, pais) VALUES ('".$data->key."', '".$data->name."', '".$data->serie."', '".$data->type."', '".$data->direccion."', '".$data->numint."', '".$data->numext."',  '".$data->cp."', '".$data->colonia."', '".$data->municipio."', '".$data->estado."', '".$data->pais."');";
        $sql = htmlspecialchars($sql);
        return array("status" => $this->conexion->query($sql));
    }

    public function deleteLocation($identified)
    {
        $sql = "DELETE FROM cat_sucursal WHERE idsucursal = ".$identified.";";
        return $this->conexion->query($sql);
    }




}
