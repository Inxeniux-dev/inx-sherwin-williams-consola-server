<?php

class ItemModel
{
    private $conexion;
    public $name;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }

      // ------  CATALOGO GENERAL DE PRODUCTOS

    public function list($page, $line, $capacity, $search)
    {
          $inicio=($page-1)*100;
          $limit = 100;
          $filter = "(codigo LIKE '%".$search."%' OR articulo.descripcion LIKE '%".$search."%')";
          if($line > 0){ $filter .= ' AND articulo.idlinea = "'.$line.'" '; }
          if($capacity > 0){ $filter .= ' AND articulo.idcapacidad = "'.$capacity.'" '; }

          $LIMIT = "LIMIT ".$inicio.", ".$limit.";";
          if($page == -1){ $LIMIT = ""; }

          $sql = "SELECT articulo.id, codigo, articulo.descripcion, precio, es_base, update_at, linea.descripcion AS linea, articulo.idlinea, barcode, descuento, fechini, fechfin, clave_sat, idcapacidad, peso, precio_especial, codigo_asociado, marca.marca, articulo.idmarca, precio_aux, descuento_ref, fechini_ref, fechfin_ref, sucursales FROM articulo LEFT JOIN linea ON articulo.idlinea = linea.idlinea INNER JOIN marca ON articulo.idmarca = marca.idmarca WHERE ".$filter." ORDER BY articulo.idlinea ASC, codigo DESC ".$LIMIT." ";
          $items = $this->conexion->query($sql);

          if($page == -1){ return $items; }


          $sql_p="SELECT COUNT(1) AS contador, CASE WHEN count(1) % ".$limit."> 0 THEN TRUNCATE(((count(1) /".$limit.")+1),0) ELSE TRUNCATE((count(1) /".$limit."),0) END AS pages FROM articulo  WHERE ".$filter." ; ";
          $paginator =  $this->conexion->query($sql_p);

          return array("items" => $items, "paginator" =>$paginator);
    }


    public function all(){
        $sql = "SELECT * FROM articulo";
        return $this->conexion->query($sql);
    }



     public function deleteItem($code, $id)
     {
         $sql = "DELETE FROM articulo WHERE id = '".$id."' AND codigo = '".$code."' LIMIT 1;";
         return $this->conexion->query($sql);
     }


    public function getData($id)
    {
        $sql = "SELECT articulo.id, codigo, articulo.descripcion, precio, es_base, update_at, linea.descripcion AS linea, articulo.idlinea, barcode, descuento,promocion,tipoUtilidad,monto, fechini, fechfin, clave_sat, idcapacidad, peso, articulo.status, codigo_asociado, idmarca  FROM articulo LEFT JOIN linea ON articulo.idlinea = linea.idlinea WHERE id = '".$id."' LIMIT 1";
        return $this->conexion->query($sql);
    }




    public function update_all_especial($factor)
    {
          $sql = "UPDATE articulo SET precio_especial = (precio + (precio*(".$factor."/100)));";
          return $this->conexion->query($sql);
    }


    public function countByMark($id)
    {
        $sql = "SELECT COUNT(*) AS total FROM articulo WHERE idlinea = '".$id."';";
        return $this->conexion->query($sql);
    }

    public function countByLine($id)
    {
        $sql = "SELECT COUNT(*) AS total FROM articulo WHERE idmarca = '".$id."';";
        return $this->conexion->query($sql);
    }

    public function countByCapacity($id)
    {
        $sql = "SELECT COUNT(*) AS total FROM articulo WHERE idcapacidad = '".$id."';";
        return $this->conexion->query($sql);
    }


      // ------  END CATALOGO GENERAL DE PRODUCTOS



    // ------  PRODUCTOS PARA CANJES

    public function list_change($page, $type, $search)
    {
          $inicio=($page-1)*20;
          $limit = 20;
          $filter = "producto LIKE '%".$search."%'";

          if($type == 1)
          {
             $filter .= " AND cantidad > 0 ";
          }
          if($type == 2)
          {
             $filter .= " AND cantidad = 0 ";
          }

          $LIMIT = "LIMIT ".$inicio.", ".$limit.";";
          if($page == -1){ $LIMIT = ""; }

          $sql = "SELECT idproducto, producto, precio, cantidad FROM producto_canje WHERE ".$filter." ORDER BY cantidad DESC ".$LIMIT." ";
          $items = $this->conexion->query($sql);


          $sql_p="SELECT COUNT(1) AS contador, CASE WHEN count(1) % ".$limit."> 0 THEN TRUNCATE(((count(1) /".$limit.")+1),0) ELSE TRUNCATE((count(1) /".$limit."),0) END AS pages FROM producto_canje WHERE ".$filter." ; ";
          $paginator =  $this->conexion->query($sql_p);

          return array("items" => $items, "paginator" =>$paginator);
    }

    public function create($producto, $cantidad, $precio)
    {
          $sql = "INSERT INTO producto_canje (producto, precio, cantidad) VALUES ('".$producto."', '".$precio."', '".$cantidad."');";
          return $this->conexion->query($sql);
    }

    public function getDataProd($id)
    {
        $sql = "SELECT idproducto, producto, precio, cantidad FROM producto_canje WHERE idproducto = '".$id."' LIMIT 1";
        return $this->conexion->query($sql);
    }

    public function update($producto, $precio, $cantidad, $id)
    {
        $sql = "UPDATE producto_canje SET producto = '".$producto."', precio = '".$precio."', cantidad = '".$cantidad."' WHERE idproducto = '".$id."' LIMIT 1";
        return $this->conexion->query($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM producto_canje WHERE idproducto = '".$id."' LIMIT 1;";
        return $this->conexion->query($sql);
    }

    // ------ END PRODUCTOS PARA CANJES




    public function update_price($code, $id, $precio, $update_at)
    {
        $sql = "UPDATE articulo SET precio = '".$precio."', edited = 1, update_at = '".$update_at."' WHERE id = '".$id."' AND codigo = '".$code."' LIMIT 1";
        return $this->conexion->query($sql);
    }

    public function update_price_aux($id, $precio_aux)
    {
        $sql = "UPDATE articulo SET precio_aux = '".$precio_aux."', edited = 0  WHERE id = '".$id."' LIMIT 1";
        return $this->conexion->query($sql);
    }


    public function getCountByCode($code)
    {
      $sql = "SELECT COUNT(*) AS total FROM articulo WHERE codigo = '".trim($code)."';";
      return $this->conexion->query($sql)->fetch_object();
    }

    public function getCountByCodeEdit($code, $hidden)
    {
      $sql = "SELECT COUNT(*) AS total FROM articulo WHERE codigo = '".trim($code)."' AND codigo != '".trim($hidden)."';";
      return $this->conexion->query($sql)->fetch_object();
    }

    public function getCountByBarcode($barcode)
    {
      $sql = "SELECT COUNT(*) AS total FROM articulo WHERE barcode = '".trim($barcode)."';";
      return $this->conexion->query($sql)->fetch_object();
    }

    public function getCountByBarcodeEdit($barcode, $bhidden)
    {
      $sql = "SELECT COUNT(*) AS total FROM articulo WHERE barcode = '".trim($barcode)."' AND barcode != '".trim($bhidden)."';";
      return $this->conexion->query($sql)->fetch_object();
    }


    public function cleanAll()
    {
      $sql = "DELETE FROM articulo;";
      $response =  $this->conexion->query($sql);

      $sql = "ALTER TABLE articulo AUTO_INCREMENT = 1";
      $this->conexion->query($sql);

      return $response;
    }

    public function updatePeso($codigo, $peso)
    {
      $sql = "UPDATE articulo SET peso = '".$peso."' WHERE codigo = '".$codigo."' LIMIT 1;";
      return $this->conexion->query($sql);
    }

    public function add($codigo, $barcode, $descripcion, $clave_sat, $precio, $linea, $capacidad, $descuento,  $fechini, $fechfin, $es_base, $precio_especial = 0, $peso = 0, $codigo_asociado = "", $idmarca = "0")
    {
        $hoy = date("Y-m-d H:i:s");
        $sql = "INSERT INTO articulo (barcode, codigo, descripcion, precio, precio_especial, es_base, descuento, fechini, fechfin, clave_sat, create_at, update_at, idcapacidad, idlinea, peso, status, codigo_asociado, idmarca, edited, uuid_sync) VALUES ('".$barcode."', '".$codigo."', '".$descripcion."', '".$precio."', '".$precio_especial."', '".$es_base."',  '".$descuento."', '".$fechini."', '".$fechfin."', '".$clave_sat."', '".$hoy."', '".$hoy."', '".$capacidad."', '".$linea."', '".$peso."', 1, '".$codigo_asociado."', '".$idmarca."', 1, UUID());";
        return $this->conexion->query($sql);
    }


    public function edit($codigo, $barcode, $descripcion, $clave_sat, $precio, $linea, $capacidad, $descuento,
    $promocion, $descuentoPromo, $tituloPromo, $tipoUtilidad, $monto, $fechaIniPromo, $fechaFinPromo, $cantidadMinima, $cantidadMaxima, $fechini, $fechfin,
    $es_base, $id_prod, $precio_especial = 0, $peso = 0, $status = 1, $codigo_asociado = "", $idmarca) {

$hoy = date("Y-m-d H:i:s");

$sql = "UPDATE articulo SET
barcode = '$barcode',
codigo = '$codigo',
descripcion = '$descripcion',
precio = '$precio',
precio_especial = '$precio_especial',
es_base = '$es_base',
descuento = '$descuento',
promocion = '$promocion',
tituloPromo = '$tituloPromo',

descuentoPromo = '$descuentoPromo',
tipoUtilidad = '$tipoUtilidad',
monto = '$monto',
fechaIniPromo = '$fechaIniPromo',
fechaFinPromo = '$fechaFinPromo',
cantidadMinima = '$cantidadMinima',
cantidadMaxima = '$cantidadMaxima',
fechini = '$fechini',
fechfin = '$fechfin',
clave_sat = '$clave_sat',
create_at = '$hoy',
update_at = '$hoy',
idcapacidad = '$capacidad',
idlinea = '$linea',
peso = '$peso',
status = $status,
codigo_asociado = '$codigo_asociado',
idmarca = '$idmarca',
edited = 1
WHERE id = '$id_prod'
LIMIT 1;";

return $this->conexion->query($sql);
}




    public function update_discount($code, $id, $discount,  $fechini, $fechfin, $update_at)
    {
        $sql = "UPDATE articulo SET descuento = '".$discount."', fechini = '".$fechini."', fechfin = '".$fechfin."', update_at = '".$update_at."', edited = 1 WHERE id = '".$id."' AND codigo = '".$code."' LIMIT 1";
        return $this->conexion->query($sql);
    }


    public function add_discount($codigo, $descuento, $fechini, $fechfin, $update_at){
      $sql = "UPDATE articulo SET descuento = '".$descuento."', fechini= '".$fechini."', fechfin = '".$fechfin."', update_at = '".$update_at."', edited = 1 WHERE codigo = '".$codigo."' LIMIT 1";
      return $this->conexion->query($sql);
    }

    public function add_discount_reforcement($codigo, $descuento, $fechini, $fechfin, $update_at, $sucursales){
      $sql = "UPDATE articulo SET descuento_ref = '".$descuento."', fechini_ref = '".$fechini."', fechfin_ref = '".$fechfin."', update_at = '".$update_at."', sucursales = '".$sucursales."', edited = 1 WHERE codigo = '".$codigo."' LIMIT 1";
      return $this->conexion->query($sql);
    }


    public function getPromociones()
    {
      $sql ="SELECT * FROM promocion";
      $result = $this->conexion->query($sql);


      if ($result && $result->num_rows > 0) {
        $promociones = [];
        while ($row = $result->fetch_assoc()) {
            $promociones[] = $row;
        }
        return $promociones;
    } else {
        return [];
    }
    }









}

?>
