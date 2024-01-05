<?php


class PriceModel
{

  private $conexion;
  public $name;

  public function __construct()
  {
      $this->conexion = $GLOBALS["conexion"];
  }


  function getDataChangeDetail($identified)
  {

    $sql = "SELECT idprecio, total, fecha, status FROM cambio_de_precio WHERE idprecio = '".$identified."';";
    $response_data = $this->conexion->query($sql);


    $sql = "SELECT cambio_de_precio_producto.codigo, descripcion, cantidad, precio_antiguo, precio_nuevo, diferencia, tipo  FROM cambio_de_precio_producto INNER JOIN articulo ON cambio_de_precio_producto.codigo = articulo.codigo WHERE idcambio = '".$identified."';";
    $response_details = $this->conexion->query($sql);

    return ["data" =>$response_data, "detail" =>$response_details];
  }

  function getLastPrices(){
      $sql = "SELECT id, created_at FROM cambio_precio ORDER BY id DESC LIMIT 5;";
      return $this->conexion->query($sql);
  }


  function getList($page, $fechini, $fechfin)
  {

    $ini=($page-1)*20;

    $limit = "LIMIT ".$ini.", 20;";

    $finaly_query = " ORDER BY idprecio DESC ".$limit."";
    if($page == -1)
    {
      $finaly_query = " ORDER BY idprecio DESC";
    }

        $sql = "SELECT idprecio, total, fecha FROM cambio_de_precio WHERE (fecha >= '".$fechini." 00:00:00' AND fecha <= '".$fechfin." 23:59:59') AND status = 0 ".$finaly_query."";

        $prices = $this->conexion->query($sql);

        if($page == -1)
        {
          return $prices;
        }



        $sql_p="SELECT COUNT(1) AS contador,
        CASE
        WHEN count(1) % 20 > 0
        THEN TRUNCATE(((count(1) /20)+1),0)
        ELSE TRUNCATE((count(1) /20),0)
        END AS pages
        FROM cambio_de_precio WHERE (fecha >= '".$fechini." 00:00:00' AND fecha <= '".$fechfin." 23:59:59') AND status = 0;";
        $paginator =  $this->conexion->query($sql_p);

        return array("prices" => $prices, "paginator" =>$paginator);

  }


}

?>
