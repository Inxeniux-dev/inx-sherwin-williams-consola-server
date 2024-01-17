<?php

class CatalogModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function getStores()
    {
        $sql ="SELECT idsucursal, nombre, versio, almacen, ip, serie, direccion, cruzamiento, num_interior, num_exterior, cp, colonia, ciudad, estado, pais, telefono, status, email FROM sucursal ORDER BY idsucursal;";
        return  $this->conexion->query($sql);
    }



    public function getBancos()
    {
        $sql ="SELECT idbanco, nombre, rfc FROM cat_banco ORDER BY nombre;";
        return  $this->conexion->query($sql);
    }

    public function getBancosCompany()
    {
        $sql ="SELECT idcuenta, nombre, rfc, cuenta, clabe FROM cat_banco_empresa ORDER BY nombre;";
        return  $this->conexion->query($sql);
    }

    public function getPayFormByComplement(){
        $sql="SELECT idformapago, nombre, clave, status FROM cat_forma_pago ORDER BY nombre;";
        return  $this->conexion->query($sql);
    }

    public function getLineas()
    {
        $sql ="SELECT idlinea, descripcion FROM linea ORDER BY idlinea;";
        return  $this->conexion->query($sql);
    }


    public function getVendedorByID($id)
    {
        $sql ="SELECT nombre FROM vendedor WHERE idvendedor = '".$id."';";
        return  $this->conexion->query($sql);
    }


    public function getCapacity($type = 0)
    {

        if($type > 0)
        {
            $filter = " WHERE tipo = '".$type."' ";
        }

        $sql ="SELECT idcapacidad, capacidad, unidad, tipo FROM capacidad ".$filter." ORDER BY tipo, capacidad ASC;";
        return  $this->conexion->query($sql);
    }


    public function getMovements($module = 0)
    {
        $filter = '';
        if($module > 0)
        {
            $filter = " WHERE idmodulo = ".$module;
        }

        $sql ="SELECT idmovimiento, clave, descripcion FROM cat_movimiento ".$filter." ORDER BY clave;";
        return  $this->conexion->query($sql);
    }

    public function getCFDIUse()
    {
        $sql = "SELECT idusocfdi, clave, descripcion FROM cat_uso_cfdi WHERE idusocfdi > 1;";
        return  $this->conexion->query($sql);
    }

    public function getRegimen()
    {
        $sql = "SELECT idregimen, clave, descripcion, fisica, moral FROM cat_regimen_fiscal;";
        return $this->conexion->query($sql);
    }

    public function getUsoCFDIForRegimen($regimen){
        $sql = "SELECT idusocfdi, clave, descripcion, regimen_fiscal FROM cat_uso_cfdi WHERE REGIMEN_FISCAL LIKE '%".$regimen."%';";
        return $this->conexion->query($sql);
    }

}

?>
