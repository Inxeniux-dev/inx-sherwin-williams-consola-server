<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <title>bootstrap 4 sidebar</title>
  </head>
  <body>
    
    <div class="wrapper">


        <nav id="sidebar">
            <div class="sidebar-header">
                   <img src="logo.svg" width="150px"> 
            </div>
            <ul class="list-unstyled components">
                <li>
                     <a href="#"><i class="fa fa fa-desktop fa-lg"></i> Panel</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-shopping-bag fa-lg"></i> Ventas</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Iniciar Venta</a>
                        </li>
                        <li>
                            <a href="#">Listado de Ventas</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#valeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-truck fa-lg"></i> Vales de Traspaso</a>
                    <ul class="collapse list-unstyled" id="valeSubmenu">
                        <li>
                            <a href="#">Nuevo Vale</a>
                        </li>
                        <li>
                            <a href="#">Listado de Vales</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-tasks fa-lg"></i> Catálogos</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-clock-o fa-lg"></i> Reloj Checador</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-money fa-lg"></i> Crédito y Cobranza</a>
                </li>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-wrench fa-lg"></i> Ajustes</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home1</a>
                        </li>
                        <li>
                            <a href="#">Home2</a>
                        </li>
                        <li>
                            <a href="#">Home3</a>
                        </li>
                    </ul>
                </li>


            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="#" class="download">Download code</a>
                </li>
                <li>
                    <a href="#" class="article">Cerrar Caja</a>
                </li>
            </ul>
        </nav>

        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                
                            
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fa fa-align-justify"></i><span></span>
                </button>
             
                <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="#"><i class="fa fa-bell-o fa-lg"></i> </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Cerrar Sesión</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                  </ul>
                </div>
              </nav>

              <div class="container-fluid ">
                    <div class="row">
                        <div class="invoi" style ="margin-bottom: 100px;">
                            <div class="col-12">
                                <h2>Table</h2>
                                
                                <div class="table-responsive">
                                        <table class="table table-hover table-condensed table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Cliente</th>
                                                    <th>RFC</th>
                                                    <th>Email</th>
                                                    <th>Teléfono</th>
                                                    <th>Detalles</th>
                                                    <th>Editar</th>
                                                    <th>Complemento</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            <?php 

                                            define("DB_HOST","localhost");
                                            define("DB_NAME","comex_migrating");
                                            define("DB_USERNAME","root");
                                            define("DB_PASSWORD","");
                                            define("DB_PORT","3308");
                                            define("DB_ENCODE","utf8");
                                            define("PRO_NAME","comexPDV");

                                            $conexion=new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

                                            mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');

                                            if(mysqli_connect_errno()){
                                                printf("Fallo conexion con bd: ", mysqli_connect_errno());
                                            }

                                            $page = 1;
                                            $item = '';
                                            $inicio=($page-1)*10;
                
                                            $sql = "SELECT idcliente, nombre, apellidos, rfc, razon_social, email, tipo, telefono FROM tc_clientes WHERE nombre LIKE'%".$item."%' OR apellidos LIKE'%".$item."%' OR rfc LIKE'%".$item."%' OR razon_social LIKE'%".$item."%' OR idcliente LIKE'%".$item."%' LIMIT ".$inicio.",50;";
                                            $res = $conexion->query($sql);
                                                        
                                                
                                            while($data = $res->fetch_object())
                                            {
                                                echo '<tr>
                                                        <td class="text-primary">';
                                                            $name = $data->tipo == 0 ? $data->razon_social : $data->nombre." ".$data->apellidos;
                                                            echo $name;
                                                echo '</td>
                                                        <td>'.$data->rfc.'</td>
                                                        <td>'.$data->email.'</td>
                                                        <td>'.$data->telefono.'</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <tr>';
                                            }


                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                            </div>

                            <div class="line"></div>
                        </div>
                    </div> 
            </div>  
            
            <!-- Footer -->
<footer class="page-footer font-small blue fixed-bottom" style="background: #fff;">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3"><b>© 2019</b> Copyright.
          <a href="#"> Cotsoft Inc. <span class="text-primary">Estás usando Inventory versión  1.0</span></a>
        </div>
        <!-- Copyright -->
      
      </footer>
      <!-- Footer -->
        </div>
        

    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script>
        $(document).ready(function(){
            $("#sidebarCollapse").on('click', function(){
                $("#sidebar").toggleClass("active");
            });

          //  $('.dropdown-toggle').dropdown();
        });
    
    </script>


</body>
</html>