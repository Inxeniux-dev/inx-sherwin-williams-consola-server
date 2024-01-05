
var EXISTENCE_CODE = 0;
var IMPORT_DIFERENCE = 0;


$("#igualcc-line").change(function()
{
    $(".table-base-list").html("");
});



$(".table-base-list").on("click", ".pag-number", function(){
    getBases($(this).attr("data"));
});


$(".btn-search-base").click(() => {

    validaBase();
});


$("#search_base").keyup(function()
{
    validaBase();
});


function validaBase(){

    let line = document.getElementById("igualcc-line").value;
    let capacity = document.getElementById("igualcc-capacity").value;
    let cant = document.getElementById("igualcc-cant").value;
    let description = document.getElementById("igualcc-description").value;
    let price = document.getElementById("igualcc-price").value;
    let descount = document.getElementById("igualcc-discount").value;


    let msg = '';
    let err = 0;

    if(line <= 0)
    {   err ++;
        msg += "Seleccionar una línea <br>";
    }

    if(capacity <= 0)
    {
        err++;
        msg += "Seleccionar una capacidad <br>";
    }

    if(description == null || description.length < 4 || isNaN(price))
    {
        err++;
        msg += "Ingrese una descripción <br>";
    }

    if(cant == null || cant.length == 0 || isNaN(cant))
    {
        err++;
        msg += "La cantidad del igualado es incorrecta <br>";
    }

    if(price == null || price.length == 0 || isNaN(price))
    {
        err++;
        msg += "El preció neto del igualado es incorrecto <br>";
    }

    if(descount == null || descount.length == 0 || isNaN(descount))
    {
        err++;
        msg += "El descuento es incorrecto <br>";
    }


    let out = "";

    if(err == 0)
    {
        getBases(1);
    }
    else
    {
          out = '<div class="alert alert-warning alert-dismissible fade show" role="alert"> ' +
                    '<strong>¡Espera!</strong> <br> ' + msg +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> ' +
                    '<span aria-hidden="true">&times;</span> ' +
                    '</button> ' +
                '</div> ';
    }

    $(".msg-igualcc").html(out);

}


function getBases(page)
{
    let line = document.getElementById("igualcc-line").value;
    let capacity = document.getElementById("igualcc-capacity").value;
    let base = document.getElementById("igualcc-base").value;
    let search = $("#search_base").val();
    let url = "../../listbaseigualado/"+page+"/"+line+"/"+capacity+"/"+identified+"/"+base+"/"+search+"/";

    $.get(url, null, "html").done(( data, textStatus, jqXHR ) => {
        console.log(textStatus);
        $(".base-search").removeClass("d-none");
        $(".table-base-list").html(data);
      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}




$("#igualcc-price").keyup(function(){
    let val = $(this).val();

    if(isNaN(val))
    {
        $(this).css("background", "#ffcfcf");
    }
    else
    {
        $(this).css("background", "#fff");
    }

    calc_total();
});

$("#igualcc-cant").keyup(function(){

    let val = $(this).val();

    if(isNaN(val))
    {
        $(this).css("background", "#ffcfcf");
    }
    else
    {
        $(this).css("background", "#fff");
    }


    let cant_base = document.getElementById("base-cant").value;
    let exist_base = document.getElementById("base-exist").value;


    if((!isNaN(val) && val.length > 0 ) &&(!isNaN(cant_base) && cant_base.length > 0 ) && (!isNaN(exist_base) && exist_base.length > 0))
    {
        $("#base-cant").val(val);
    }
    else
    {
        if((!isNaN(exist_base) && exist_base.length > 0) && (val.length <= 0 || isNaN(val))) { $("#base-cant").val(1); };
    }

    calc_total();
});


$("#tinta-cant").keyup(function(){
    let val = $(this).val();

    if(isNaN(val))
    {
        $(this).css("background", "#ffcfcf");
    }
    else
    {
        $(this).css("background", "#fff");
    }
    calc_total();
});


$("#igualcc-discount").keyup(function(){
    let val = $(this).val();

    if(isNaN(val))
    {
        $(this).css("background", "#ffcfcf");
    }
    else
    {
        $(this).css("background", "#fff");
    }
    calc_total();
});

$("#code-igualadora").keyup(function(){
    $(this).css("background", "#fff");
});



function addBase(code, desc, price, exist, discount)
{
    let cantidad = document.getElementById("igualcc-cant").value;
    let err = 0;

    EXISTENCE_CODE = Math.abs(exist);
    DISCOUNT_IGUAL = discount;

    if(venta_con_kardex)
    {
        if(!vender_sin_existencias)
        {
          if(tipo_documento == 1)
          {
                if(Math.abs(cantidad) > Math.abs(exist))
                {   err++;
                    $("#igualcc-cant").css("background", "#ffcfcf");
                    alertMessage("warning", "La cantidad es mayor a la existencia", "Aceptar", false, null);
                }
          }
        }

        if(cantidad.length == 0 || isNaN(cantidad))
        {   err++;
            $("#igualcc-cant").css("background", "#ffcfcf");
            alertMessage("warning", "La cantidad es incorrecta", "Aceptar", false, null);
        }
    }

    if(err == 0)
    {
        $(".table-base-list").html("");
        $(".base-search").addClass("d-none");
        $("#base-code").val(code + " - " + desc);
        $("#base-code-hidden").val(code);
        $("#base-exist").val(exist);
        $("#base-cant").val(cantidad);
        $("#base-price").val(price);
        $("#igualcc-discount").val(discount);
    }

    lock_filters();

    calc_total();
}



function lock_filters()
{
    $("#igualcc-line").attr("disabled", "true");
    $("#igualcc-capacity").attr("disabled", "true");
    $(".del-base-igualcc").removeClass("d-none");
}

function unlock_filters(){
    $("#igualcc-line").removeAttr("disabled");
    $("#igualcc-capacity").removeAttr("disabled");
    $(".del-base-igualcc").addClass("d-none");
}


$(".del-base-igualcc").click(() => {
    unlock_filters();
    $("#base-code").val("");
    $("#base-code-hidden").val("");
    $("#base-exist").val("");
    $("#base-cant").val("");
    $("#base-price").val("");
    $("#igualcc-discount").val(0);
});


  $(".btn-add-igualcc").click(function(){

    let validation = validate();

    console.log(validation);

    if(validation[0])
    {
        loading_scrum();
        let url = "../../addIgualCC/";
        fetch(url, { method: 'POST', body: validation[1] })
        .then(function(response) {
        if(response.ok) {
            return response.json();
        } else {
            throw "Error en la llamada Ajax";
        }
        })
        .then(function(data) {
            console.log(data);


            if(data.session)
            {
                if(data.validation.validation)
                {
                    if(data.sale != null)
                        {
                            if(data.sale.status == 1)
                            {
                                if(data.save.save)
                                {   DISCOUNT_IGUAL = 0;

                                    if(data.sale.idtipo_descuento == 1)
                                    {
                                        window.location = "../"+identified+"/";
                                    }
                                    else {
                                        window.location = "../../changeConfig/"+identified+"/7/"+data.sale.idtipo_descuento+"/";
                                    }
                                }
                                else{ alertMessage("warning", "¡Error al realizar la operación!", "Aceptar", true, "../../aditems/"+identified+"/"); }
                            }
                            else{ alertMessage("warning", "¡La ya ha sido finalizada!", "Ver detalles", true, "../../detail/"+identified+"/"); }
                        }
                        else {  alertMessage("warning", "¡La venta no existe!", "Ir a listado", true, "../../"); }
                }
                else{ stop_scrum(); alertMessage("warning", "Los datos enviados son incorrectos", "Aceptar", false, null); }
            }
            else { alertMessage("warning", "¡La sessión ha expirado!", "Iniciar sesión", true, "../../../login/"); }


        })
        .catch(function(err) {
            console.log(err);
            stop_scrum();
            alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../aditems/"+identified+"/");
        });
    }


  });



  function validate()
  {

        let err = 0;
        let msg = "";

        let line = document.getElementById("igualcc-line").value;
        let capacity = document.getElementById("igualcc-capacity").value;
        let description = document.getElementById("igualcc-description").value;
        let cant = document.getElementById("igualcc-cant").value;
        let price = document.getElementById("igualcc-price").value;
        let descount = document.getElementById("igualcc-discount").value;


        let b_code = document.getElementById("base-code-hidden").value;
        let b_cant = document.getElementById("base-cant").value;
        let b_exist = document.getElementById("base-exist").value;
        let b_price = document.getElementById("base-price").value;

        let tinta_cant = document.getElementById("tinta-cant").value;

        let code_igualadora = document.getElementById("code-igualadora").value;


        if(line == 0) { err++; msg += "Seleccione linea <br> "; }
        if(capacity == 0) { err++; msg += "Seleccione capacidad <br> "; }
        if(description.length < 10 ) { err++; msg += "Ingrese una descripción <br>"; }
        if(cant == 0) { err++;  msg += "Ingrese una cantidad <br> "; }
        if(price == 0) { err++;  msg += "Ingrese el precio del igualado <br> "; }
        if(descount.length <= 0) { err++;  msg += "Ingrese el descuento del igualado <br> "; }
        if(descount > DISCOUNT_IGUAL) { err++; msg = "El descuento ingresado es mayor al permitido <br>"; }

        if(b_code.length <= 0) { err++;  msg += "Seleccione una base <br> "; }
        if(b_cant == 0) { err++;  msg += "Ingrese la cantidad de la base <br> "; }


        if(tinta_cant == 0) { err++;  msg += "Ingrese la cantidad de la tinta <br> "; }

        if(code_igualadora.length <= 0) { err ++; msg+= "Ingrese el código de la igualadora <br> "; $("#code-igualadora").css("background", "#ffcfcf"); }


        if(IMPORT_DIFERENCE < 0 ) {  err++;  msg += "La diferencía es menor a 0.<br> "; }

        if(venta_con_kardex)
        {   if(!vender_sin_existencias)
            {
                if(Math.abs(b_cant) > Math.abs(b_exist)) { err++;  msg += " La base no cuenta con la existencia suficiente <br> "; }
            }
        }


        if(err > 0)
        {
            let out = '<div class="alert alert-warning alert-dismissible fade show" role="alert"> ' +
                            '<strong>¡No es posible agregar el igualado!</strong> <br> ' + msg +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> ' +
                            '<span aria-hidden="true">&times;</span> ' +
                            '</button> ' +
                        '</div> ';

            $(".msg-igualcc").html(out);

            return [false, null];
        }
        else
        {   $(".msg-igualcc").html("");

            const data = new FormData();
            data.append('line', line);
            data.append('capacity', capacity);
            data.append('description', description);
            data.append('cant', cant);
            data.append('price', price);
            data.append('descount', descount);

            data.append('b_code_hidden', b_code);
            data.append('b_cant', b_cant);

            data.append('tinta_cant', tinta_cant);

            data.append('code_igualadora', code_igualadora);

            data.append('identified', identified);

            return [true, data];

        }
  }



  $(".btn-cancel-igualcc").click(()=>{
        loading_scrum();

        window.location = "../"+identified+"/";
  });


  function calc_total()
  {

    let cant = document.getElementById("igualcc-cant").value;
    let price = document.getElementById("igualcc-price").value;
    let descount = document.getElementById("igualcc-discount").value;

    let b_cant = document.getElementById("base-cant").value;
    let b_exist = document.getElementById("base-exist").value;
    let b_price = document.getElementById("base-price").value;

    let tinta_cant = document.getElementById("tinta-cant").value;


    let precio_neto = 0;
    let import_base = (b_price * cant);

    if(!isNaN(cant) && !isNaN(price))
    {
        precio_neto = (cant * price);
    }
    if(isNaN(precio_neto) || precio_neto.length <= 0) { precio_neto = 0; }
    if(isNaN(tinta_cant) || tinta_cant.length <= 0) { tinta_cant = 0; }
    if(isNaN(import_base) || import_base.length <= 0) { import_base = 0; }
    if(isNaN(descount) || descount.length <= 0){ descount = 0; }

    let importe_descuento = ((descount * precio_neto) / 100);
    let base_mas_tinta = Math.abs(import_base) + Math.abs(tinta_cant);
    let diference = (Math.abs(precio_neto) - base_mas_tinta);
    IMPORT_DIFERENCE = diference;

    $(".import-igualcc").html("$ " + formatNumber(precio_neto));
    $(".import-base").html("$ " + formatNumber(import_base));
    $(".import-tinta").html("$ " + formatNumber(tinta_cant));
    $(".import-descount").html("$ " + formatNumber(importe_descuento));
    $(".import-diference").html("$ " + formatNumber(diference));

    let color_diference = diference < 0 ? "text-danger" : "text-success";

    $(".import-diference").removeClass("text-danger");
    $(".import-diference").removeClass("text-success");

    $(".import-diference").addClass(color_diference);


  }
