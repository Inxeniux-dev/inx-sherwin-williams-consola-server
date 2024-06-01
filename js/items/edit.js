$(document).ready(() => {
    $("#sidebarCollapse").on('click', function () {
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });

    getPromociones();

    let promocionesData = [];
    let isPromocionValida = true;

    async function getPromociones() {
        var url = '../../../items/getPromociones';
        try {
            let response = await fetch(url);
            if (!response.ok) {
                throw new Error('La solicitud falló');
            }
            let data = await response.json();
            console.log("Datos de promociones recibidos:", data);
            if (data.success && Array.isArray(data.data) && data.data.length > 0) {
                // Filtrar los datos para obtener solo aquellos con estado "activo"
                let promocionesActivas = data.data.filter(item => item.estado === 'activo');
                if (promocionesActivas.length > 0) {
                    promocionesData = promocionesActivas;  // Guardar los datos de promociones activas en la variable global
                    console.log("Promociones activas almacenadas:", promocionesData);

                    // Llamar a la función para establecer la descripción inicial si ya hay un valor en el input de promoción
                    setInitialDescription();
                } else {
                    console.error("No hay promociones activas disponibles");
                }
            } else {
                console.error("Error al obtener las promociones:", data.message || 'No data available');
            }
        } catch (error) {
            console.error("Error al obtener las promociones:", error);
        }
    }


    document.getElementById('promocion').addEventListener('input', function () {
        var inputVal = this.value.toLowerCase();
        if (inputVal === '') {
            isPromocionValida = true;
            document.getElementById('tituloPromocion').value = '';
            document.getElementById('descuentoPromocion').value = '';
            document.getElementById('fechaIniPromo').value = '';
            document.getElementById('fechaFinPromo').value = '';
            document.getElementById('cantidadMinima').value = '';
            document.getElementById('cantidadMaxima').value = '';
        } else {
            var foundPromocion = promocionesData.find(function (promocion) {
                return promocion.promocion.toLowerCase() === inputVal;
            });

            if (foundPromocion) {
                document.getElementById('tituloPromocion').value = foundPromocion.tituloPromo;
                document.getElementById('descuentoPromocion').value = foundPromocion.descuentoPromo;
                document.getElementById('fechaIniPromo').value = foundPromocion.fechaIni;
                document.getElementById('fechaFinPromo').value = foundPromocion.fechaFin;
                document.getElementById('cantidadMinima').value = foundPromocion.cantidadMinima;
                document.getElementById('cantidadMaxima').value = foundPromocion.cantidadMaxima;
                isPromocionValida = true;
            } else {
                document.getElementById('tituloPromocion').value = '';
                document.getElementById('descuentoPromocion').value = '';
                document.getElementById('fechaIniPromo').value = '';
                document.getElementById('fechaFinPromo').value = '';
                document.getElementById('cantidadMinima').value = '';
                document.getElementById('cantidadMaxima').value = '';
                isPromocionValida = false;
            }
        }
    });

    function setInitialDescription() {
        var promocionInput = document.getElementById('promocion').value.toLowerCase();
        if (promocionInput === '') {
            isPromocionValida = true;
            return;
        }

        var foundPromocion = promocionesData.find(function (promocion) {
            return promocion.promocion.toLowerCase() === promocionInput;
        });

        if (foundPromocion) {
            document.getElementById('tituloPromocion').value = foundPromocion.tituloPromo;
            document.getElementById('descuentoPromocion').value = foundPromocion.descuentoPromo;
            document.getElementById('fechaIniPromo').value = foundPromocion.fechaIni;
            document.getElementById('fechaFinPromo').value = foundPromocion.fechaFin;
            document.getElementById('cantidadMinima').value = foundPromocion.cantidadMinima;
            document.getElementById('cantidadMaxima').value = foundPromocion.cantidadMaxima;
            isPromocionValida = true;
        } else {
            isPromocionValida = false;
        }
    }



    $(".btn-update").click(function () {
        let promocionInput = $("#promocion").val().trim();


        if (promocionInput !== '' && !isPromocionValida) {
            showModalMessageError("warning", "¡La promoción ingresada no es válida!", 2300);
            return;
        }

        let codigo = $("#codigo");
        let barcode = $("#barcode");
        let codigo_asociado = $("#codigo_asociado");
        let precio = $("#precio");
        let descripcion = $("#descripcion");
        let clave_sat = $("#clave_sat");
        let linea = $("#line");
        let capacidad = $("#capacity");
        let descuento = $("#descuento");
        let promocion = $("#promocion");
        let fechini = $("#fechini");
        let fechfin = $("#fechfin");
        let peso = $("#peso");
        let marca = $("#marca");
        let tituloPromo = $("#tituloPromocion");
        let descuentoPromo = $("#descuentoPromocion");
        let tipoUtilidad = $("#tipoUtilidad");
        let monto = $("#monto");
        let hidden = $("#cod-hidd").val();
        let bhidden = $("#bar-hidd").val();
        let idprod = $("#idprod").val();
        let es_base = $("#es_base");
        let fechaIniPromo = $("#fechaIniPromo");
        let fechaFinPromo = $("#fechaFinPromo");
        let cantidadMinima = $("#cantidadMinima");
        let cantidadMaxima = $("#cantidadMaxima");
        let check_es_base = 0;
        if (es_base.is(':checked')) { check_es_base = 1; }

        let desactivar = $("#status");
        let check_desactivar = 0;
        if (desactivar.is(':checked')) { check_desactivar = 1; }

        let error = 0;
        error += valid_imputs([codigo, descripcion, precio, clave_sat, linea, capacidad, descuento, fechini, fechfin, peso, marca]);
        error += valid_numeric_positive([linea, capacidad, descuento, precio, peso, marca]);
        error += valid_no_cero([linea, capacidad, marca]);

        if (error > 0) {
            showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300);
            return;
        }

        loading_scrum();

        let url = "../../../app/api/item.php?a=12";

        const data = new FormData();
        data.append('codigo', codigo.val());
        data.append('hidden', hidden);
        data.append('bhidden', bhidden);

        data.append('barcode', barcode.val());
        data.append('codigo_asociado', codigo_asociado.val());
        data.append('precio', precio.val());
        data.append('descripcion', descripcion.val());
        data.append('clave_sat', clave_sat.val());
        data.append('es_base', check_es_base);
        data.append('linea', linea.val());
        data.append('capacidad', capacidad.val());
        data.append('descuento', descuento.val());
        data.append('fechini', fechini.val());
        data.append('fechfin', fechfin.val());
        data.append('peso', peso.val());
        data.append('status', check_desactivar);
        data.append('marca', marca.val());
        data.append('promocion', promocion.val());
        data.append('id_prod', idprod);
        data.append('descuentoPromo', descuentoPromo.val());
        data.append('tituloPromo', tituloPromo.val());
        data.append('tipoUtilidad', tipoUtilidad.val());
        data.append('monto', monto.val());
        data.append('fechaIniPromo', fechaIniPromo.val());
        data.append('fechaFinPromo', fechaFinPromo.val());
        data.append('cantidadMinima', cantidadMinima.val());
        data.append('cantidadMaxima', cantidadMaxima.val());
        fetch(url, { method: 'POST', body: data })
            .then(function (response) { return response.json(); })
            .then(function (data) {

                console.log(data);
                const { code, status } = data;
                if (code == 201) {
                    showModalMessageError("success", "Producto Actualizado Correctamente", 2300);
                    setTimeout(function () { window.location = `../${idprod}/ ` }, 2300);
                    return;
                }
                statusHTTP(data, "../../");
                stop_scrum();
            })
            .catch(function (err) { stop_scrum(); console.log(err); });

    });
});


function checkTimeAndExecute() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();


    if (hours === 23 && minutes === 59) {
        var url = '../../../items/actualizarPromociones';

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('La solicitud falló');
                }
                return response.json();
            })
            .then(data => {
                console.log(data.message);
                if (data.success) {
                    console.log("Operación exitosa.");
                } else {
                    console.log("Hubo un problema al eliminar los datos de promoción.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
}







