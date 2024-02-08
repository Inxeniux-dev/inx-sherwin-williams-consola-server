<?php

class CustomerModel
{
    private $conexion;
    public $name;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }

      // ------  CATALOGO GENERAL DE CLIENTES

    public function list($page, $type, $search, $apellido = '')
    {
      try {
          $inicio=($page-1)*100;
          $limit = 100;

          // Construye la condición de búsqueda para el nombre completo
          $fullname_search = "concat_ws(' ', NOMBRE, APELLIDO) LIKE '%" . $search . "%'";

          $filter = "(".$fullname_search." OR RFC LIKE '%".$search."%' OR RAZON_SOCIAL LIKE '%".$search."%' OR IDCLIENTE LIKE '%".$search."%')";

          if($type == 1){ $filter .= " AND NUM_CREDITO > 0 "; }
          if($type == 2){ $filter .= " AND NUM_CREDITO = 0 "; }
          if($type == 3){ $filter .= " AND DESCUENTO > 0 "; }
          if($type == 4){ $filter .= " AND (SALDO < 0 OR SALDO > 0 )"; }
          if($type == 5){ $filter .= " AND SALDO  = 0"; }

          if(strlen(trim($apellido)) > 0)
          {
            $filter .= " AND APELLIDO LIKE'%".$apellido."%' ";
          }

          $LIMIT = "LIMIT ".$inicio.", ".$limit.";";
          if($page == -1){ $LIMIT = ""; }

          $sql = "SELECT IDCLIENTE, NOMBRE, APELLIDO, RFC, RAZON_SOCIAL, TIPO, EMAIL, TELEFONO, DESCUENTO, PRECIO_ESPECIAL, NUM_CREDITO, SALDO FROM cliente WHERE ".$filter." ORDER BY IDCLIENTE ASC ".$LIMIT.";";
          // echo "Consulta SQL: " . $sql;
          $items = $this->conexion->query($sql);

          if($page == -1){ return $items; }


          $sql_p="SELECT COUNT(1) AS contador, CASE WHEN count(1) % ".$limit."> 0 THEN TRUNCATE(((count(1) /".$limit.")+1),0) ELSE TRUNCATE((count(1) /".$limit."),0) END AS pages FROM cliente  WHERE ".$filter." ; ";
          $paginator =  $this->conexion->query($sql_p);

          return array("items" => $items, "paginator" =>$paginator);
      } catch (Exception $e) {
        // Captura cualquier excepción y muestra un mensaje de error
        echo json_encode(["code" => 500, "message" => "Error en la consulta SQL: " . $e->getMessage()]);
        die(); // Detiene la ejecución del script después de mostrar el mensaje de error
      }

    }


    public function getAllCustomers($type, $search = '', $apellido = '')
    {
      try {

          // Construye la condición de búsqueda para el nombre completo
          $fullname_search = "concat_ws(' ', NOMBRE, APELLIDO) LIKE '%" . $search . "%'";

          $filter = "(".$fullname_search." OR RFC LIKE '%".$search."%' OR RAZON_SOCIAL LIKE '%".$search."%' OR IDCLIENTE LIKE '%".$search."%')";

          if($type == 1){ $filter .= " AND NUM_CREDITO > 0 "; }
          if($type == 2){ $filter .= " AND NUM_CREDITO = 0 "; }
          if($type == 3){ $filter .= " AND DESCUENTO > 0 "; }
          if($type == 4){ $filter .= " AND (SALDO < 0 OR SALDO > 0 )"; }
          if($type == 5){ $filter .= " AND SALDO  = 0"; }

          if(strlen(trim($apellido)) > 0)
          {
            $filter .= " AND APELLIDO LIKE '%".$apellido."%' ";
          }

          $sql = "SELECT IDCLIENTE, NOMBRE, APELLIDO, RFC, RAZON_SOCIAL, TIPO, EMAIL, TELEFONO, DESCUENTO, PRECIO_ESPECIAL, NUM_CREDITO, SALDO FROM cliente WHERE ".$filter." ORDER BY IDCLIENTE ASC;";
          // echo "Consulta SQL: " . $sql;
          $items = $this->conexion->query($sql);

          return $items;

      } catch (Exception $e) {
        // Captura cualquier excepción y muestra un mensaje de error
        echo json_encode(["code" => 500, "message" => "Error en la consulta SQL: " . $e->getMessage()]);
        die(); // Detiene la ejecución del script después de mostrar el mensaje de error
      }

    }

    public function all(){
        $sql = "SELECT * FROM cliente";
        return $this->conexion->query($sql);
    }



     public function deleteItem($id)
     {
         $sql = "DELETE FROM cliente WHERE IDCLIENTE = '".$id."' LIMIT 1;";
         return $this->conexion->query($sql);
     }


    public function getData($id)
    {
      try {
        $sql = "SELECT IDCLIENTE, NOMBRE, APELLIDO, RFC, RAZON_SOCIAL, TIPO, DIRECCION, COLONIA, NUM_INTERIOR, NUM_EXTERIOR, MUNICIPIO, ESTADO, PAIS, CODIGO_POSTAL, EMAIL, TELEFONO, CELULAR, id_regimen FROM cliente WHERE IDCLIENTE = '".$id."' LIMIT 1";
        // echo "Consulta SQL getData: " . $sql;
        return $this->conexion->query($sql);
      } catch (Exception $e) {
        // Captura cualquier excepción y muestra un mensaje de error
        echo json_encode(["code" => 500, "message" => "Error en la consulta SQL: " . $e->getMessage()]);
        die(); // Detiene la ejecución del script después de mostrar el mensaje de error
      }
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

    public function getCountByFullNameAndRFC($name, $lastname, $rfc)
    {
      $sql = "SELECT COUNT(*) AS total FROM cliente WHERE NOMBRE = '".trim($name)."' AND APELLIDO = '".trim($lastname)."' AND RFC = '".trim($rfc)."';";
      return $this->conexion->query($sql)->fetch_object();
    }

    public function getCountByFullNameAndRFCEdit($name, $lastname, $rfc, $id_cust)
    {
      $sql = "SELECT COUNT(*) AS total FROM cliente WHERE NOMBRE = '".trim($name)."' AND APELLIDO = '".trim($lastname)."' AND RFC = '".trim($rfc)."' AND IDCLIENTE != '".$id_cust."';";
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

    public function add($rfc, $name, $lastname, $razon, $tipo, $email, $telefono, $celular, $direccion, $colonia, $numexterior, $numinterior, $cp, $municipio, $estado, $pais, $regimen)
    {
      try {
        $hoy = date("Y-m-d H:i:s");
        $sql = "INSERT INTO cliente (NOMBRE, APELLIDO, RFC, RAZON_SOCIAL, TIPO, DIRECCION, COLONIA, NUM_INTERIOR, NUM_EXTERIOR, MUNICIPIO, ESTADO, PAIS, CODIGO_POSTAL, EMAIL, TELEFONO, CELULAR, NUM_VENTAS, DESCUENTO, PRECIO_ESPECIAL, NUM_CREDITO, CREDITO, SALDO, DIAS_DE_PAGO, create_at, id_regimen, uuid_sync) VALUES ('".$name."', '".$lastname."', '".$rfc."', '".$razon."', '".$tipo."', '".$direccion."', '".$colonia."',  '".$numinterior."', '".$numexterior."', '".$municipio."', '".$estado."', '".$pais."', '".$cp."', '".$email."', '".$telefono."', '".$celular."', 0, 0.00, 0, 0, 0.00, 0.00, 0, '".$hoy."', '".$regimen."', UUID());";
        // echo "Consulta SQL: " . $sql;
        return $this->conexion->query($sql);
      } catch (Exception $e) {
        // Captura cualquier excepción y muestra un mensaje de error
        echo json_encode(["code" => 500, "message" => "Error en la consulta SQL: " . $e->getMessage()]);
        die(); // Detiene la ejecución del script después de mostrar el mensaje de error
      }

    }


    public function edit($rfc, $name, $lastname, $razon, $tipo, $email, $telefono, $celular, $direccion, $colonia, $numexterior, $numinterior, $cp, $municipio, $estado, $pais, $regimen, $id_cust)
    {
      try {
        $sql = "UPDATE cliente SET NOMBRE = '".$name."', APELLIDO = '".$lastname."', TIPO = '".$tipo."', RFC = '".$rfc."', RAZON_SOCIAL = '".$razon."', DIRECCION = '".$direccion."', COLONIA = '".$colonia."', NUM_INTERIOR = '".$numinterior."', NUM_EXTERIOR = '".$numexterior."', MUNICIPIO = '".$municipio."', ESTADO = '".$estado."', PAIS = '".$pais."', CODIGO_POSTAL = '".$cp."',
        EMAIL = '".$email."', TELEFONO = '".$telefono."', CELULAR = '".$celular."', id_regimen = ".$regimen." WHERE IDCLIENTE  = '".$id_cust."' LIMIT 1;";
        return $this->conexion->query($sql);
        // echo "Consulta SQL edit: " . $sql;
      } catch (Exception $e) {
        // Captura cualquier excepción y muestra un mensaje de error
        echo json_encode(["code" => 500, "message" => "Error en la consulta SQL: " . $e->getMessage()]);
        die(); // Detiene la ejecución del script después de mostrar el mensaje de error
      }

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


}

?>
