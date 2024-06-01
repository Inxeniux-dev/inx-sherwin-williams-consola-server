<?php

class PromocionesModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }

    public function getArticulo()
    {
        $sql = "SELECT * FROM articulo";
        $result = $this->conexion->query($sql);

        if ($result && $result->num_rows > 0) {
            $articulo = [];
            while ($row = $result->fetch_assoc()) {
                $articulo[] = $row;
            }
            return $articulo;
        } else {
            return [];
        }
    }

    public function getLinea()
{
    $sql = "SELECT * FROM linea";
    $result = $this->conexion->query($sql);

    if ($result && $result->num_rows > 0) {
        $lineas = [];
        while ($row = $result->fetch_assoc()) {
            $lineas[] = $row;
        }
        return $lineas;
    } else {
        return [];
    }
}

public function getMarca()
{
    $sql = "SELECT * FROM marca";
    $result = $this->conexion->query($sql);

    if ($result && $result->num_rows > 0) {
        $marca = [];
        while ($row = $result->fetch_assoc()) {
            $marca[] = $row;
        }
        return $marca;
    } else {
        return [];
    }
}


    public function insertPromocion($codigo, $tituloPromo, $estado, $descuentoPromo, $fechaIni, $fechaFin, $cantidadMinima, $cantidadMaxima, $tipCliente, $giroCliente, $cliente3, $cliente4, $cliente5, $cliente6, $linea, $subLinea, $familia, $promocion, $fecha)
    {
        $sql = "INSERT INTO promocion (codigo, tituloPromo, estado, descuentoPromo, fechaIni, fechaFin, cantidadMinima, cantidadMaxima, tipCliente, giroCliente, cliente3, cliente4, cliente5, cliente6, linea, subLinea, familia, promocion, fecha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssssssssssssssssss", $codigo, $tituloPromo, $estado, $descuentoPromo, $fechaIni, $fechaFin, $cantidadMinima, $cantidadMaxima, $tipCliente, $giroCliente, $cliente3, $cliente4, $cliente5, $cliente6, $linea, $subLinea, $familia, $promocion, $fecha);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

}

?>
