<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <button type="button" id="sidebarCollapse" class="btn btn-sm my-btn-blue">
            <i class="fa fa-align-justify"></i><span></span>
        </button>
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">

            <li class="nav-item">
               <a class="nav-link" href="javascript:void(0);" tabindex="-1" aria-disabled="true"><b style = "font-size : 13px;">

                  <?php
                     echo fechaCastellanoSinDate(date("Y-m-d"));
                  ?>
                 </b>
               </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);" tabindex="-1" aria-disabled="true"><i class="fas fa-male"></i> <?php echo substr(strtoupper($_SESSION["datauser"]["name"]), 0, 20); ?></a>
            </li>
          </ul>
        </div>
</nav>

<!--
  <div class="container-fluid ">
        <div class="row">
          <div class="invoi">
              <div class="row">
                <div class="col-sm-12">
                        <div class = "alert alert-danger"><h4><b>¡El sistema está en fase de desarrollo!</b></h4>
                          <br>
                          <span> <i class="fas fa-exclamation-triangle"></i> Es normal que se pueda presentar algunos inconvenientes en los procesos</span><br>
                          <span> <i class="fas fa-exclamation-triangle"></i> Los <b>CAMBIOS</b> relizados podrán ser visibles en el <b>SERVIDOR</b> y en <b>TIENDAS</b></span><br>
                        </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
-->
