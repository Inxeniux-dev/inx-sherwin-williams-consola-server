<?php

    $products = isset($_POST["products"]) ? $_POST["products"] : null ;
    $identified = isset($_POST["identified"]) ? $_POST["identified"] : 0;


    if($products == null || strlen($products) <= 0){ echo "error"; return;}


    $aux = explode("&_&", $products);


    $productos_importe = array();

    foreach ($aux as $key => $value) {
        $string = substr($value, 0, -1);
        if($key > 0)
        {
            $string = substr($string, 1);
        }

        $auxx = explode(",", $string);

        $CODIGO = '';
        $CANTIDAD = 0;
        $IDPRODUCTO = 0;

        foreach ($auxx as $k => $val) {

            if($k == 0)
            {
              $CANTIDAD = $val;
            }

            if($k == 1)
            {
              $CODIGO = $val;
            }

            if($k == 2)
            {
              $IDPRODUCTO = $val;
            }
        }


        if($CANTIDAD > 0)
        {
          $productos_importe[] = array("codigo" => $CODIGO, "cantidad" => $CANTIDAD, "id" => $IDPRODUCTO);
        }

    }



    $data = $model->getProductListByID($identified);

    $SUMA = 0;
    $IVA = 0;
    $SUBTOTAL = 0;
    $DESCUENTO = 0;
    $TOTAL_VENTA = 0;

    while($value = $data->fetch_object())
    {
      $productos_importe = to_object($productos_importe);
      $cantidad_item = 0;

      foreach ($productos_importe as $k => $val) {
          if($val->codigo == $value->codigo)
          {
              $cantidad_item = $val->cantidad;
            break;
          }
      }

          $data_calculo = calcula_importe_por_producto($value->precio, $cantidad_item, $value->descuento);
          $DESCUENTO += $data_calculo["descuento"];
          $SUMA += $data_calculo["suma"];
          $IVA += $data_calculo["iva"];
    }


    $SUBTOTAL = $SUMA - $DESCUENTO;
    $IVA = ($SUBTOTAL * 0.16);
    $TOTAL = truncadoNoFormat($SUMA, 2) - truncadoNoFormat($DESCUENTO, 2) + number_format($IVA, 2, ".", "");


    echo json_encode(["status" => 200, "total" => $TOTAL, "total_format" => number_format($TOTAL,2)]);
    return;
?>
