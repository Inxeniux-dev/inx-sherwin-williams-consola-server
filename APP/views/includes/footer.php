<div class="invoi">
    <div class="footer-copyright text-center"><b>©

    <?php
        $anio_creacion = 2021;
        $anio_actual = date('Y');

        if($anio_creacion != $anio_actual)
        {
            echo $anio_creacion ."-".$anio_actual;
        }
        else
        {
            echo $anio_actual;
        }
     ?>

   </b>,
       <!-- <a href="javascript:void(0);"> Cotsoft Inc. <span class="text-primary"><b> Estás usando Inventory versión  <span class = "text-danger"> BETA</span></b></span></a> -->

       <a href="javascript:void(0);"> <span class="text-primary" style="font-weight:550">Estás usando <b>Console</b> en su versión <span class = "text-danger"><b><?php echo VERSION; ?></b></span></span></a>

    </div>
</div>
