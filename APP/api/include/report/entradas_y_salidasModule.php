<?php

$ajustes = $data["data_ajustes"];


$inventory_ent = array();
$inventory_sal = array();

$inventory = $data["inventory"];

while($row = $inventory->fetch_object()){

    if($row->total_entradas > 0)
    {
      $inventory_ent [] = array("total" => $row->total_entradas, "fecha" => $row->fecha_final, "count" => $row->count_entrada, "id" => $row->idinventario);
    }

    if($row->total_salidas> 0)
    {
      $inventory_sal [] = array("total" => $row->total_salidas, "fecha" => $row->fecha_final, "count" => $row->count_salida, "id" => $row->idinventario);
    }
}



    $data_convert = $data["data_convert"];
    if($data_convert->num_rows > 0){
 ?>


<div class="invoi">


        <b><i class="fas fa-sync-alt"></i> Conversiones</b><br>
        <div class="table-responsive" style='min-height: 50px;'>
          <table class="table table-hover table-condensed table-sm">
              <thead>
                  <tr>
                    <th>Movimiento</th>
                    <th>Fecha</th>
                    <th>Folio</th>
                    <th style = "text-align: right">Importe</th>
                    <th style = "text-align: right"># Art&iacute;culos</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                   $tipo = 1;

                    $total_rows = $data_convert->num_rows;
                    $count = 0;
                    $total_entradas = 0;
                    $total_salidas = 0;
                    $count_entradas = 0;
                    $count_salidas = 0;

                    while($row = $data_convert->fetch_object())
                    {
                      $count++;
                      $mov = $row->tipo == 0 ? "Salida por conversión" : "Entrada por conversión";
                      $serie = $row->tipo == 0 ? "SC" : "EC";
                      $importe = $row->precio * $row->cantidad;

                      if($row->tipo  == 1){ $total_entradas += $importe; $count_entradas++;}
                      if($row->tipo  == 0){ $total_salidas += $importe; $count_salidas++;}

                      if($tipo != $row->tipo)
                      {

                        echo "<tr>
                                  <td colspan = '2' align = 'right'><b>Total de movimientos ".$count_entradas."</b></td>
                                  <td align = 'right'><b>Total</b></td>
                                  <td align = 'right'><b>$ ".number_format($total_entradas, 2)."</b></td>
                                  <td></td>
                              <tr>
                              <tr>
                                <td colspan = '5'><br></td>
                              </tr>";


                        $tipo = $row->tipo;
                      }


                      echo "<tr>
                                <td>".$mov."</td>
                                <td>".fechaCorta($row->fecha)."</td>
                                <td>".$serie."-".$row->folio."</td>
                                <td align = 'right'>$ ".number_format($importe, 2)."</td>
                                <td align = 'right'>".$row->cantidad."</td>
                            </tr>";

                        if($count == $total_rows)
                        {
                          echo "<tr>
                                    <td colspan = '2' align = 'right'><b>Total de movimientos ".$count_salidas."</b></td>
                                    <td align = 'right'><b>Total</b></td>
                                    <td align = 'right'><b>$ ".number_format($total_salidas, 2)."</b></td>
                                    <td></td>
                                <tr>
                                <tr>
                                  <td colspan = '5'><br></td>
                                </tr>";
                        }
                    }
                  ?>
              </tbody>
            </table>
        </div>
</div>



  <?php
}
else {
  echo "<div class='invoi'><h5>No existen conversiones </h5></div>";
}
      $data_vales = $data["data_vales"];
      $tipo = 1;
      $total_rows = $data_vales->num_rows;
      $count = 0;

      $total_entradas = 0;
      $count_entradas = 0;

      $total_salidas = 0;
      $count_salidas = 0;


      if($total_rows > 0){
   ?>


<div class="invoi">



    <b><i class="fas fa-sync-alt"></i> Vales de Traspaso</b><br><br>


    <div class="table-responsive table-sales" style='min-height: 50px;'>
      <div class="table-responsive" style='min-height: 50px;'>
        <table class="table table-hover table-condensed table-sm">
            <thead>
                <tr>
                  <th>Sucursal de Salida</th>
                  <th>Fecha</th>
                  <th>Folio</th>
                  <th style = "text-align: right">Importe</th>
                  <th style = "text-align: right"># Art&iacute;culos</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan = '5'><b>Entrada por Traspaso</b></td>
              </tr>

              <?php
                $total_entradas = 0;
                while($row = $data_vales->fetch_object())
                {

                  if($row->status == 0)
                  {
                      $count++;
                      if($row->tipo  == 1){ $total_entradas += $row->total; $count_entradas++;}
                      if($row->tipo  == 0){ $total_salidas += $row->total; $count_salidas++;}

                      $sucursal_vale = isset($_SESSION["catalog"]["location"]["$row->suc_salida"]) ? $_SESSION["catalog"]["location"]["$row->suc_salida"] : "SUC ".$row->suc_salida;
                      $serie = $row->serie_salida;

                      if($row->tipo == 0)
                      {
                            $sucursal_vale = isset($_SESSION["catalog"]["location"]["$row->suc_entrada"]) ? $_SESSION["catalog"]["location"]["$row->suc_entrada"] : "SUC ".$row->suc_entrada;
                            $serie = $row->serie_salida;
                      }


                      if($tipo != $row->tipo)
                      {

                        echo "<tr>
                                  <td colspan = '2' align = 'right'><b>Total de movimientos ".$count_entradas."</b></td>
                                  <td align = 'right'><b>Total</b></td>
                                  <td align = 'right'><b>$ ".number_format($total_entradas, 2)."</b></td>
                                  <td></td>
                              <tr>
                              <tr>
                                <td colspan = '5'><br></td>
                              </tr>
                              <tr>
                                <td colspan = '5'><b>Salida por Traspaso</b></td>
                              </tr>";


                        $tipo = $row->tipo;
                      }


                      echo "<tr>
                                <td>".$sucursal_vale."</td>
                                <td>".$row->fecha."</td>
                                <td>".$serie."-".$row->folio."</td>
                                <td align = 'right'>$ ".number_format($row->total, 2)."</td>
                                <td align = 'right'>".$row->num_articulos."</td>
                            </tr>";



                          if($count == $total_rows)
                          {
                            if($count_salidas > 0)
                            {
                                echo "<tr>
                                          <td colspan = '2' align = 'right'><b>Total de movimientos ".$count_salidas."</b></td>
                                          <td align = 'right'><b>Total</b></td>
                                          <td align = 'right'><b>$ ".number_format($total_salidas, 2)."</b></td>
                                          <td></td>
                                      <tr>
                                      <tr>
                                        <td colspan = '5'><br></td>
                                      </tr>";
                              }
                          }
                  }
                }
              ?>

            </tbody>
          </table>
      </div>

    </div>
</div>

<?php
    }
    else {
      echo "<div class='invoi'><h5>No existen vales </h5></div>";
    }

      $data_ventas = $data["data_ventas"];

      if($data_ventas->num_rows > 0){
    ?>

    <div class="invoi">

        <b><i class="fas fa-sync-alt"></i> Ventas </b><br><br>

        <div class="table-responsive table-sales" style='min-height: 50px;'>
          <div class="table-responsive" style='min-height: 50px;'>
            <table class="table table-hover table-condensed table-sm">
                <thead>
                    <tr>
                      <th>Movimiento</th>
                      <th>Fecha</th>
                      <th>Folio</th>
                      <th style = "text-align: right">Importe</th>
                      <th style = "text-align: right"># Art&iacute;culos</th>
                    </tr>
                </thead>
                <tbody>

                  <?php
                  $count = 0;
                  $total_ventas = 0;

                    while($row = $data_ventas->fetch_object())
                    {
                      if($row->status == 0 || $row->status == 2)
                      {
                        $count ++;
                        $total_ventas += $row->total;
                        echo "<tr>
                                  <td>Salida por venta</td>
                                  <td>".$row->fecha."</td>
                                  <td>".$row->serie."-".$row->folio."</td>
                                  <td align = 'right'>$ ".number_format($row->total, 2)."</td>
                                  <td align = 'right'>".$row->num_articulos."</td>
                              <tr>";
                      }

                    }

                    ?>

                    <tr>
                        <td colspan = '2' align = 'right'><b>Total de movimientos <?php echo $count; ?></b></td>
                        <td align = 'right'><b>Total</b></td>
                        <td align = 'right'><b>$ <?php echo number_format($total_ventas, 2); ?></b></td>
                        <td></td>
                    <tr>
                    <tr>
                      <td colspan = '5'><br></td>
                    </tr>
                </tbody>
              </table>
          </div>

        </div>
    </div>



    <?php
      }
      else {
          echo "<div class='invoi'><h5>No existen salidas por venta </h5></div>";
      }

    $data_dev = $data["data_dev"];
    if($data_dev->num_rows > 0){
 ?>


 <div class="invoi">
     <b><i class="fas fa-sync-alt"></i> Devoluciones </b><br><br>
     <div class="table-responsive table-sales" style='min-height: 50px;'>
       <div class="table-responsive" style='min-height: 50px;'>
         <table class="table table-hover table-condensed table-sm">
             <thead>
                 <tr>
                   <th>Movimiento</th>
                   <th>Fecha</th>
                   <th>Folio</th>
                   <th style = "text-align: right">Importe</th>
                 </tr>
             </thead>
             <tbody>
               <?php
               $count = 0;
               $total_devoluciones = 0;

                 while($row = $data_dev->fetch_object())
                 {

                     $count ++;
                     $total_devoluciones += $row->total;
                     echo "<tr>
                               <td>Entrada por devolución</td>
                               <td>".fechaCorta($row->fecha)."</td>
                               <td>".$row->folio."</td>
                               <td align = 'right'>$ ".number_format($row->total, 2)."</td>
                           <tr>";
                 }

                 ?>
                 <tr>
                     <td colspan = '2' align = 'right'><b>Total de movimientos <?php echo $count; ?></b></td>
                     <td align = 'right'><b>Total</b></td>
                     <td align = 'right'><b>$ <?php echo number_format($total_devoluciones, 2); ?></b></td>
                     <td></td>
                 <tr>
            </tbody>
          </table>
        </div>
      </div>
  </div>


<?php
  }
  else {
      echo "<div class='invoi'><h5>No existen entradas por devolución </h5></div>";
  }


  if(count($inventory_ent) == 0)
  {
    echo "<div class='invoi'><h5>No existen entradas por ajuste de inventario </h5></div>";
  }
  else {
?>


<div class="invoi">
    <b><i class="fas fa-sync-alt"></i> Entrada por ajuste de inventario </b><br><br>
    <div class="table-responsive table-sales" style='min-height: 50px;'>
      <div class="table-responsive" style='min-height: 50px;'>
        <table class="table table-hover table-condensed table-sm">
            <thead>
                <tr>
                  <th>Movimiento</th>
                  <th>Fecha</th>
                  <th>Folio</th>
                  <th style = "text-align: right">Importe</th>
                  <th style = "text-align: right"># Articulos</th>
                </tr>
            </thead>
            <tbody>
              <?php
              $count = 0;
              $total_entradas = 0;
                $inventory_ent = json_decode(json_encode($inventory_ent));
                foreach ($inventory_ent as $key => $value)
                {
                    $count ++;
                    $total_entradas += $value->total;
                    echo "<tr>
                              <td>Entrada por ajuste</td>
                              <td>".fechaCorta($value->fecha)."</td>
                              <td>".$value->id."</td>
                              <td align = 'right'>$ ".number_format($value->total, 2)."</td>
                              <td align = 'right'>".number_format($value->count, 2)."</td>
                          <tr>";
                }

                ?>
                <tr>
                    <td colspan = '2' align = 'right'><b>Total de movimientos <?php echo $count; ?></b></td>
                    <td align = 'right'><b>Total</b></td>
                    <td align = 'right'><b>$ <?php echo number_format($total_entradas, 2); ?></b></td>
                    <td></td>
                <tr>
           </tbody>
         </table>
       </div>
     </div>
 </div>


<?php
    }
    if(count($inventory_sal) == 0)
    {
      echo "<div class='invoi'><h5>No existen salidas por ajuste de inventario </h5></div>";
    }
    else {
  ?>


  <div class="invoi">
      <b><i class="fas fa-sync-alt"></i> Salida por ajuste de inventario </b><br><br>
      <div class="table-responsive table-sales" style='min-height: 50px;'>
        <div class="table-responsive" style='min-height: 50px;'>
          <table class="table table-hover table-condensed table-sm">
              <thead>
                  <tr>
                    <th>Movimiento</th>
                    <th>Fecha</th>
                    <th>Folio</th>
                    <th style = "text-align: right">Importe</th>
                    <th style = "text-align: right"># Articulos</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                  $count = 0;
                  $total_entradas = 0;
                  $inventory_sal = json_decode(json_encode($inventory_sal));
                  foreach ($inventory_sal as $key => $value)
                  {
                      $count ++;
                      $total_entradas += $value->total;
                      echo "<tr>
                                <td>Salida por ajuste</td>
                                <td>".fechaCorta($value->fecha)."</td>
                                <td>".$value->id."</td>
                                <td align = 'right'>$ ".number_format($value->total, 2)."</td>
                                <td align = 'right'>".number_format($value->count, 0)."</td>
                            <tr>";
                  }

                  ?>
                  <tr>
                      <td colspan = '2' align = 'right'><b>Total de movimientos <?php echo $count; ?></b></td>
                      <td align = 'right'><b>Total</b></td>
                      <td align = 'right'><b>$ <?php echo number_format($total_entradas, 2); ?></b></td>
                      <td></td>
                  <tr>
             </tbody>
           </table>
         </div>
       </div>
   </div>


  <?php
      }

      if($ajustes["ent"]->num_rows == 0)
      {
        echo "<div class='invoi'><h5>No existen entradas por ajuste </h5></div>";
      }
      else {
    ?>

    <div class="invoi">
        <b><i class="fas fa-sync-alt"></i> Entrada por ajuste </b><br><br>
        <div class="table-responsive table-sales" style='min-height: 50px;'>
          <div class="table-responsive" style='min-height: 50px;'>
            <table class="table table-hover table-condensed table-sm">
                <thead>
                    <tr>
                      <th>Movimiento</th>
                      <th>Fecha</th>
                      <th>Folio</th>
                      <th style = "text-align: right">Importe</th>
                      <th style = "text-align: right"># Articulos</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    $count = 0;
                    $total_entradas = 0;

                    while($row = $ajustes["ent"]->fetch_object())
                    {
                        $count ++;
                        $total_entradas += $row->total;
                        $sucursal = isset($_SESSION["catalog"]["location"][$row->suc_salida]) ? $_SESSION["catalog"]["location"][$row->suc_salida] : "SUC-".$row->suc_salida;

                        echo "<tr>
                                  <td>De: ".$sucursal."</td>
                                  <td>".fechaCorta($row->fecha)."</td>
                                  <td>".$row->serie_salida."-".$row->folio."</td>
                                  <td align = 'right'>$ ".number_format($row->total, 2)."</td>
                                  <td align = 'right'>".number_format($row->num_articulos, 0)."</td>
                              <tr>";
                    }

                    ?>
                    <tr>
                        <td colspan = '2' align = 'right'><b>Total de movimientos <?php echo $count; ?></b></td>
                        <td align = 'right'><b>Total</b></td>
                        <td align = 'right'><b>$ <?php echo number_format($total_entradas, 2); ?></b></td>
                        <td></td>
                    <tr>
               </tbody>
             </table>
           </div>
         </div>
     </div>


    <?php
        }
        if($ajustes["sal"]->num_rows == 0)
        {
          echo "<div class='invoi'><h5>No existen salidas por ajuste </h5></div>";
        }
        else {
      ?>

      <div class="invoi">
          <b><i class="fas fa-sync-alt"></i> Salida por ajuste </b><br><br>
          <div class="table-responsive table-sales" style='min-height: 50px;'>
            <div class="table-responsive" style='min-height: 50px;'>
              <table class="table table-hover table-condensed table-sm">
                  <thead>
                      <tr>
                        <th>Movimiento</th>
                        <th>Fecha</th>
                        <th>Folio</th>
                        <th style = "text-align: right">Importe</th>
                        <th style = "text-align: right"># Articulos</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                      $count = 0;
                      $total_entradas = 0;

                      while($row = $ajustes["sal"]->fetch_object())
                      {
                          $count ++;
                          $total_entradas += $row->total;
                          $sucursal = isset($_SESSION["catalog"]["location"][$row->suc_entrada]) ? $_SESSION["catalog"]["location"][$row->suc_entrada] : "SUC-".$row->suc_entrada;

                          echo "<tr>
                                    <td>A: ".$sucursal."</td>
                                    <td>".fechaCorta($row->fecha)."</td>
                                    <td>".$row->serie_salida."-".$row->folio."</td>
                                    <td align = 'right'>$ ".number_format($row->total, 2)."</td>
                                    <td align = 'right'>".number_format($row->num_articulos, 0)."</td>
                                <tr>";
                      }

                      ?>
                      <tr>
                          <td colspan = '2' align = 'right'><b>Total de movimientos <?php echo $count; ?></b></td>
                          <td align = 'right'><b>Total</b></td>
                          <td align = 'right'><b>$ <?php echo number_format($total_entradas, 2); ?></b></td>
                          <td></td>
                      <tr>
                 </tbody>
               </table>
             </div>
           </div>
       </div>


      <?php
          }

       ?>
