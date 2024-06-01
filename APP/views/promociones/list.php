<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/" . PROJECT . "/app/views/includes/head.php" ?>

    <title>Promociones</title>
</head>

<body>

    <div class="wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT'] . "/" . PROJECT . "/app/views/includes/sidebar.php" ?>

        <div class="content">

            <?php include $_SERVER['DOCUMENT_ROOT'] . "/" . PROJECT . "/app/views/includes/navbar.php" ?>

            <div class="container-fluid ">
                <div class="row">

                    <div class="invoi invoi-blue">
                        <div class="row">
                            <div class="col-sm-8">
                                <h5 class="text-withe"><i class="fa fa-tags"></i>&nbsp;Promociones</h5>
                            </div>
                        </div>
                    </div>
                    <div class="invoi " style="margin-bottom: 1px;">

                        <div class="">
                            <form id="formulario" name="loteManual">
                                <div class="row align-items-center">
                                    <div class="col-xl-2 col-lg-2 col-sm-6 col-xs-12 col-6">
                                        <div class="form-group">
                                            <label for="descripcion">Nombre</label>
                                            <input type="text" class="form-control form-control-sm" id="descripcion"
                                                list="opcionesDescripcion" name="descripcion" />
                                            <datalist id="opcionesDescripcion"></datalist>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-6 col-xs-12 col-3">
                                        <div class="form-group">
                                            <label for="dateInitial">C&oacute;digo</label>
                                            <input type="text" class="form-control form-control-sm" id="codigo"
                                                name="codigo" />
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-6">
                                        <div class="form-group">
                                            <label for="dateInitial">Fecha</label>
                                            <input type="date" class="form-control form-control-sm" id="fecha"
                                                name="fecha" />
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-6 col-xs-12 col-3">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch d-inline-block">
                                                <input type="checkbox" class="custom-control-input" id="estado">
                                                <label class="custom-control-label" for="estado"
                                                    id="estadoLabel">Inactivo</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <b><i class="fa fa-cogs"></i>&nbsp;Configuración</b>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-6">
                                        <div class="form-group">
                                            <label for="dateInitial">Descuento (%)</label>
                                            <input type="text" class="form-control form-control-sm" id="descuento"
                                                name="descuento" oninput="validateInput(this)" />
                                        </div>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-6">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                            <label class="custom-control-label" for="customSwitch1">Rango de
                                                fechas</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-6">
                                        <div class="form-group">
                                            <label for="dateInitial">Del</label>
                                            <input type="date" class="form-control form-control-sm" id="fechaIni"
                                                name="fechaIni" />
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-6">
                                        <div class="form-group">
                                            <label for="dateInitial">Al</label>
                                            <input type="date" class="form-control form-control-sm" id="fechaFin"
                                                name="fechaFin" />
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6 ">
                                        <b><i class="fa fa-cogs"></i>&nbsp;Condiciones de la promoción</b>
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-sm-3 col-xs-12 col-6">
                                        <div class="form-group">
                                            <label for="dateInitial">Cantidad minima de venta</label>
                                            <input type="text" class="form-control form-control-sm" id="cantidadMinima"
                                                name="cantidadMinima" oninput="formatCurrency(this)" />
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-sm-3 col-xs-12 col-6">
                                        <div class="form-group">
                                            <label for="dateInitial">Cantidad máxima de venta</label>
                                            <input type="text" class="form-control form-control-sm" id="cantidadMaxima"
                                                name="cantidadMaxima" oninput="formatCurrency(this)" />
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                                        <b><i class="fa fa-cogs"></i>&nbsp;Cladificación de clientes</b>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-4">
                                        <div class="form-group">
                                            <label for="dateInitial">Tipo cliente</label>
                                            <input type="text" class="form-control form-control-sm" id="tipCliente"
                                                name="tipCliente" />
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-4">
                                        <div class="form-group">
                                            <label for="dateInitial">Giro cliente</label>
                                            <input type="text" class="form-control form-control-sm" id="giroCliente"
                                                name="giroCliente" />
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-4">
                                        <div class="form-group">
                                            <label for="dateInitial">Clasificación 3 cliente</label>
                                            <input type="text" class="form-control form-control-sm" id="cliente3"
                                                name="cliente3" />
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-4">
                                        <div class="form-group">
                                            <label for="dateInitial">Clasificación 4 cliente</label>
                                            <input type="text" class="form-control form-control-sm" id="cliente4"
                                                name="cliente4" />
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-4">
                                        <div class="form-group">
                                            <label for="dateInitial">Clasificación 5 cliente</label>
                                            <input type="text" class="form-control form-control-sm" id="cliente5"
                                                name="cliente5" />
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-4">
                                        <div class="form-group">
                                            <label for="dateInitial">Clasificación 6 cliente</label>
                                            <input type="text" class="form-control form-control-sm" id="cliente6"
                                                name="cliente6" />
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <b><i class="fa fa-cogs"></i>&nbsp;Clasificación de articulos</b>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-4">
                                        <div class="form-group">
                                            <label for="linea">Linea</label>
                                            <select class="form-control form-control-sm" id="linea" name="linea">
                                                <option value="">Seleccione una opción</option>
                                                <option value="opcion2">Opción 2</option>
                                                <option value="opcion3">Opción 3</option>

                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-4">
                                        <div class="form-group">
                                            <label for="dateInitial">Sublinea</label>
                                            <input type="text" class="form-control form-control-sm" id="subLinea"
                                                name="subLinea" />
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-4">
                                        <div class="form-group">
                                            <label for="familia">Familia</label>
                                            <select class="form-control form-control-sm" id="familia" name="familia">
                                                <option value="">Seleccione una opción</option>
                                                <option value="opcion2">Opción 2</option>
                                                <option value="opcion3">Opción 3</option>

                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-4">
                                        <div class="form-group">
                                            <label for="dateInitial">Descuento 30%</label>
                                            <input type="text" class="form-control form-control-sm" id="desc30"
                                                name="desc30" />
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-4">
                                        <div class="form-group">
                                            <label for="dateInitial">Descuentos</label>
                                            <input type="text" class="form-control form-control-sm" id="desc"
                                                name="desc" />
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-2 col-xs-12 col-4">
                                        <div class="form-group">
                                            <label for="dateInitial">Promocion</label>
                                            <input type="text" class="form-control form-control-sm" id="promocion"
                                                name="promocion" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button class="btn my-btn-blue btn-sm" id="btn-search"
                                            style="margin-top:30px;"><i class="fa fa-save"></i> Guardar</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>

                    <?php include $_SERVER['DOCUMENT_ROOT'] . "/" . PROJECT . "/app/views/includes/footer.php" ?>

                </div>
            </div>
        </div>

    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . "/" . PROJECT . "/app/views/includes/scripts.php" ?>
    <script src="<?php echo PATH; ?>js/promociones/list.js"> </script>

    <script>
        $(document).ready(function() {});
    </script>

    <script>
       function validateInput(input) {

    input.value = input.value.replace(/[^0-9]/g, '').substring(0, 2);
}


        function formatCurrency(input) {
            let value = input.value.replace(/[^0-9.]/g, '');
            value = value.replace(/\.(?=.*\.)/g, '');
            let [integerPart, decimalPart] = value.split('.');
            integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            let formattedValue = '$' + integerPart;
            if (decimalPart !== undefined) {
                formattedValue += '.' + decimalPart;
            }
            input.value = formattedValue;
        }
    </script>

<script>
    $(document).ready(function () {

        toggleFechaAl($("#customSwitch1").is(":checked"));

        $("#customSwitch1").change(function () {
            toggleFechaAl($(this).is(":checked"));
        });

        function toggleFechaAl(checked) {
            if (checked) {
                $("#fechaFin").prop("disabled", false);
            } else {
                $("#fechaFin").prop("disabled", true);
            }
        }
    });
</script>

</body>

</html>
