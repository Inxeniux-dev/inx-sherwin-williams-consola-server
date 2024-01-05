$(document).ready(() =>{

    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $("#search").focus();

console.log("La resolución de tu pantalla es: " + screen.width + " x " + screen.height);


let msg_errors = '';
for(var i = 0; i<array_errors.length; i++)
{
    msg_errors += array_errors[i]+"<br>";
}

if(array_errors.length > 0)
{
    $(".panel-errors").removeClass("d-none");
    $(".panel-errors").addClass("d-block");
}

$(".errors-msgs").html(msg_errors);



if (screen.width < 1024)
   console.log("Pequeña")
else
   if (screen.width < 1280)
   console.log("Mediana")
   else
   console.log("Grande")
});


var DISCOUNT_IGUAL = 0;
var AMOUNT_PAYMENT = 0;


$(".change").click(() =>{
    loading_scrum();
});


$(".btn-create-igualcc").click(() => {
    $(".panel-igual-cc").removeClass("d-none");
    $(".panel-items-add").addClass("d-none");
    $(".panel-igual-ma").addClass("d-none");
});

$(".btn-create-igualma").click(() => {
    $(".panel-igual-ma").removeClass("d-none");
    $(".panel-items-add").addClass("d-none");
    $(".panel-igual-cc").addClass("d-none");
});


function display_discount(row){
     $("#input-discount-"+row).removeClass("d-none");
     $(".lbl-discount-"+row).addClass("d-none");
     $("#input-discount-"+row).focus();
     $("#input-discount-"+row).select();
};

function display_cant(row){
    $("#input-cant-"+row).removeClass("d-none");
    $(".lbl-cant-"+row).addClass("d-none");
    $("#input-cant-"+row).focus();
    $("#input-cant-"+row).select();
};

function display_price(row){
    $("#input-price-"+row).removeClass("d-none");
    $(".lbl-price-"+row).addClass("d-none");
    $("#input-price-"+row).focus();
    $("#input-price-"+row).select();
};




$(".input-price-add").keyup(function(event){

    let code = $(this).attr("data-code");
    let id_code = $(this).attr("data-id");
    let price = $(this).val();

    $(".alert-msg").html("");



    if(isNaN(price) || price.length == 0)
    {
        $(this).css("background", "#ffcfcf");
        return;
    }
    else
    {
        $(this).css("background", "#fff");
    }


    if(event.keyCode == 13)
    {
        if(isNaN(price))
        {
            $(this).css("background", "#ffcfcf");
            display_alert("warning", "El precio es incorrecto");
            return;
        }

        addPriceItem(code, price, id_code);
    }
});



$(".input-discount-add").keyup(function(event){

    let discount_max = $(this).attr("data-discount");
    let code = $(this).attr("data-code");
    let id_code = $(this).attr("data-id");
    let discount = $(this).val();

    $(".alert-msg").html("");



    if(isNaN(discount) || discount.length == 0)
    {
        $(this).css("background", "#ffcfcf");
        return;
    }
    else
    {
        $(this).css("background", "#fff");
    }



    if(event.keyCode == 13)
    {
        if(parseFloat(discount) > parseFloat(discount_max))
        {
            $(this).css("background", "#ffcfcf");
                display_alert("warning", "El descuento es mayor al permitido");
            return;
        }

        addDescount(code, discount, id_code, 0);
    }
});




$(".input-cant-add").keyup(function(event){

    let exist = $(this).attr("data-exist");
    let code = $(this).attr("data-code");
    let id_code = $(this).attr("data-id");
    let cant = $(this).val();

    if(isNaN(cant) || cant.length == 0 || cant <= 0)
    {
        $(this).css("background", "#ffcfcf");
        return;
    }
    else
    {
        $(this).css("background", "#fff");
    }

    if(event.keyCode == 13)
    {
        if(venta_con_kardex)
        {
            if(!vender_sin_existencias)
            {
              if(tipo_documento == 1)
              {
                  if(parseFloat(cant) > parseFloat(exist))
                  {
                      $(this).css("background", "#ffcfcf");
                          display_alert("warning", "La cantidad es mayor a la existencia");
                      return;
                  }
              }
            }
        }

        let item = code + "*"+ cant;
        addItem(item, false, id_code);
    }

});


function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}


function display_alert(type, msg)
{
    let alert = '<div class="alert alert-'+type+' alert-dismissible fade show" role="alert">' +
        '<strong>!Espera! </strong>'+ msg +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
        '<span aria-hidden="true">&times;</span>'+
        '</button>'+
    '</div>';

    $(".alert-msg").html(alert);
}

$("#key-discount").keyup(function(){
    let val = $(this).val();

    if(val.length < 4 || isNaN(val))
    {
        $(this).css("background", "#ffcfcf");
        $(".btn-add-discount").attr("disabled", "disabled");
    }
    else
    {
        $(this).css("background", "#fff");
        $(".btn-add-discount").removeAttr("disabled");
    }

});

$(".btn-add-discount").click(() =>{
    console.log("click");
    let key = document.getElementById("key-discount").value;

    if(key.length < 4 || isNaN(key))
    {
        $("#key-discount").css("background", "#ffcfcf");
    }
    else
    {
        $("#key-discount").css("background", "#fff");

        loading_scrum();
        const data = new FormData();
        data.append('identified', identified);
        data.append('key', key);

        let url = "../../addKeyDescount/";

        fetch(url, { method: 'POST', body: data })
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
                if(data.sale != null)
                {
                    if(data.validation)
                    {
                        if(data.sale.status == 1)
                        {
                            if(data.save)
                            {   showModalMessageError("success", "Clave agregada correctamente", 2000);
                                setTimeout(function(){ window.location = "../../changeConfig/"+identified+"/7/5/"; }, 2200);
                            }
                            else{ alertMessage("warning", "¡Error al realizar la operación!", "Aceptar", true, "../../additem/"+identified+"/"); }
                        }
                        else{ alertMessage("warning", "¡La ya ha sido finalizada!", "Ver detalles", true, "../../detail/"+identified+"/"); }
                    }
                    else{ alertMessage("warning", "La clave ingresada es incorrecta", "Aceptar", false, null); }
                }
                else { alertMessage("warning", "¡La venta no existe!", "Ir a listado", true, "../../");  }

                stop_scrum();
            }
            else { alertMessage("warning", "¡La sessión ha expirado!", "Iniciar sesión", true, "../../../login/"); }
        })
        .catch(function(err) {
            console.log(err);
            stop_scrum();
            alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../additem/"+identified+"/");
        });

    }

});





$(".btn-cancel").click(() =>{
    Swal.fire({
        title: '¿Estas seguro?',
        text: "¡No podrás revertir esto!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '¡Si, cancelar venta!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
            cancel();
        }
      })
});


function cancel ()
{
    loading_scrum();
    const data = new FormData();
    data.append('identified', identified);

    let url = `../../../app/api/sale.php?a=15`;

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();
      if(data.code == 200)
      {
        if(data.status)
        {
            alertMessage("success", data.msg, "Aceptar", true, "../../all/");
            return;
        }
      }
      statusHTTP(data, "../../");

    })
    .catch(function(err) { stop_scrum(); console.log(err); });
}




$(".btn-finaly").click(()=>{
    console.log("finalty");

//    loading_scrum();
    const data = new FormData();
    data.append('identified', identified);
    let url = "../../finaly/";

    fetch(url, { method: 'POST', body: data })
    .then(function(response) {
    if(response.ok) {
        return response.json();
    } else {
        throw "Error en la llamada Ajax";
    }
    })
    .then(function(data) {
        console.log(data);
    })
    .catch(function(err) {
        console.log(err);
        stop_scrum();
        alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../additem/"+identified+"/");
    });

});


let SERIE_REM = "";
let FOLIO_REM = "";



$(".btn-finaly-test").click(() => {

    loading_scrum();

    $(".panel-errors").addClass("d-none");
    $(".panel-errors").html("");

    const data = new FormData();
    data.append('identified', identified);
    data.append('cfdiuse', "aaaaa");

    let url = `../../../app/api/sale.php?a=13`;

    fetch(url, { method: 'POST', body: data })
    .then(function(response) {
    if(response.ok) {
        return response.json();
    } else {
        throw "Error en la llamada Ajax";
    }
    })
    .then(function(data) {
        console.log(data);

        if(data.TIME_OUT)
        {
            let out = "<div class = 'alert alert-danger'><b><i class = 'far fa-clock'></i> Tiempo de espera excedido.</b> Intenta finalizar la venta nuevamente</div>";
            $(".panel-errors").removeClass("d-none");
            $(".panel-errors").html(out);
            stop_scrum();
            return;
        }

        if(data.error.length > 0)
        {
            console.log(data.error);
            let msg = '';
            for(let x = 0; x < data.error.length; x++)
            {
                msg += "<i class = 'fas fa-exclamation-triangle'></i> " + data.error[x] + "<br>";
            }

            let out = "<div class = 'alert alert-danger'>"+msg+"</div>";
            $(".panel-errors").removeClass("d-none");
            $(".panel-errors").html(out);
            stop_scrum();
            statusHTTP(data, "../../");
            return;
        }
        else
        {
            $("#sidebar").toggleClass("active");
            $(".content").toggleClass("active");

            SERIE_REM = data.serie;
            FOLIO_REM = data.folio;

            let cliente = data.data.tipo == 1 ? `${data.data.nombre} ${data.data.apellido}` : `${data.data.razon_social}`;

            let out = `<div class="row">
                        <div class="invoi invoi-blue">

                          <h4><i class="fas fa-check-circle"></i> VENTA FINALIZADA CON ÉXITO</h4>

                            <div class="row">
                                          <div class="col-md-6 col-12">
                                                    <div class="table-responsive  mt-3">
                                                            <table class="table  table-sm">
                                                                <tbody>
                                                                  <tr>
                                                                      <td class="text-blanco spacing">Folio de Remisión:</td>
                                                                      <td class="text-blanco spacing" align = "right"><b>${data.serie}-${data.folio}</b></td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td class="text-blanco spacing">Fecha:</td>
                                                                      <td class="text-blanco spacing" align = "right"><b>${data.date}</b></td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td class="text-blanco spacing">Tipo de Venta:</td>
                                                                      <td class="text-blanco spacing" align = "right"><b></b></td>
                                                                  </tr>
                                                                </tbody>
                                                            </table>
                                                    </div>
                                          </div>

                                          <div class="col-md-6 col-12">
                                                  <div class="table-responsive  mt-3">
                                                            <table class="table  table-sm">
                                                                <tbody>
                                                                  <tr>
                                                                      <td class="text-blanco spacing">RFC:</td>
                                                                      <td class="text-blanco spacing" align = "right"><b>${data.data.rfc}</b></td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td class="text-blanco spacing">Nombre o Razón Social:</td>
                                                                      <td class="text-blanco spacing" align = "right"><b>${cliente}</b></td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td class="text-blanco spacing">Correo:</td>
                                                                      <td class="text-blanco spacing" align = "right"><b>${data.data.email}</b></td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td class="text-blanco spacing">Uso del CFDI:</td>
                                                                      <td class="text-blanco spacing" align = "right"><b>${data.data.desc_uso_cfdi}</b></td>
                                                                  </tr>
                                                                  <tr class = "tr-folio d-none">
                                                                      <td class="text-blanco spacing">Folio de Factura:</td>
                                                                      <td class="text-blanco spacing td-folio" align = "right"></td>
                                                                  </tr>
                                                                </tbody>
                                                            </table>
                                                  </div>
                                          </div>
                                </div>
                           </div>


                           <div class="invoi">
                               <div class="row">
                                     <div class = 'col-md-6 my-2'>
                                          <button class = 'btn btn-primary btn-print-ticket'><i class = 'fas fa-print'></i> Reimprimir Ticket</button> &nbsp;&nbsp;
                                          <a href = '../../detail/${identified}/' class = 'btn btn-info'><i class = 'fas fa-file-invoice'></i> Ver Detalles y Facturar</a>
                                      </div>
                                      <div class = 'col-md-6 my-2' style = "text-align:right;">
                                          <a href = '../../create/' class = 'btn btn-success'><i class = 'fas fa-shopping-cart'></i> Nueva Remisión</a>  &nbsp;&nbsp;`
                                          if(data.data.idcliente > 1)
                                          {
                                               out += `<button class="btn my-btn-blue-only-border btn-fact"><i class="fas fa-bell"></i> Facturar Venta</button>`;
                                          }

                               out += `</div>
                               </div>
                           </div>
                      </div> `;

            $(".container-full").html(out);

            sincroniza_puntos(identified);
            stop_scrum();
            print_ticket_sale(identified);

            if(data.data.idcliente == 1)
            {
               setTimeout(function(){ window.location = '../../create/' }, 9000);
            }
            return;
        }

    })
    .catch(function(err) {
        console.log(err);
        let out = "<div class = 'alert alert-success'><b>Error Interno de Servicio</b></div>";
        $(".panel-errors").removeClass("d-none");
        $(".panel-errors").html(out);
        stop_scrum();
        return;
    });

});





function changeTypeDiscount(identified, type)
{
  const data = new FormData();
  data.append('identified', identified);
  data.append('type', type);
  let url = `../../../app/api/sale.php?a=26`;
  fetch(url, { method: 'POST', body: data })
  .then(function(response) {
  if(response.ok) {
      return response.json();
  } else {
      throw "Error en la llamada Ajax";
  }
  })
  .then(function(data) {
      if(data.code == 201)
      {
          showModalMessageError("success", "El descuento se ha actualizado correctamente, verifique los importes", 3000);
          setTimeout(function(){ window.location = '../'+identified+'/' }, 2800);
          return;
      }

     statusHTTP(data, "../../");
     stop_scrum();
  })
  .catch(function(err) {
      console.log(err);
      stop_scrum();
      alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../additem/"+identified+"/");
  });
}




function sincroniza_puntos()
{
  let url = "../../../app/api/sale.php?a=17";

  const data = new FormData();
  data.append('identified', identified);

  fetch(url, { method: 'POST', body: data })
  .then(function(response) {
  if(response.ok) {
      return response.json();
  } else {
      throw "Error en la llamada Ajax";
  }
  })
  .then(function(data) {
    console.log(data);
  })
  .catch(function(err) {
      console.log(err);
      stop_scrum();
      return;
  });
}


$(".container-full").on("click", ".btn-print-ticket", function(){
    print_ticket_sale(identified);
});



function print_ticket_sale(identified)
{
    const data = new FormData();
    data.append('identified', identified);
    data.append('type', 0);
    let url = "../../../app/api/sale.php?a=3";

    fetch(url, { method: 'POST', body: data})
    .then(function(response) {
    if(response.ok) {
        return response.json();
    } else {
        throw "Error en la llamada Ajax";
    }
    })
    .then(function(data) {
        console.log(data);

        if(data.code == 400)
        {    stop_scrum();
             showModalMessageError("warning", "¡Error al imprimir ticket!", 2500);
        }
        else if(data.code == 200)
        {
            stop_scrum();

            if(data.status)
            {
                showModalMessageError("success", "!El Ticket se ha enviado a imprimir!", 2500);
            }
            else
            {
                showModalMessageError("warning", "¡Error al enviar a imprimir el ticket!", 2500);
            }
        }

    })
    .catch(function(err) {
        console.log(err);
        showModalMessageError("error", "¡Error al enviar a imprimir el ticket, verificar nombre de impresora!", 2500);
    });
}


$(".add-order").click(function(){
    let order = $(".order").val();
    const data = new FormData();
    data.append('identified', identified);
    data.append('order', order);
    let url = "../../../app/api/sale.php?a=10";

    fetch(url, { method: 'POST', body: data })
    .then(function(response) {
    if(response.ok) {
        return response.json();
    } else {
        throw "Error en la llamada Ajax";
    }
    })
    .then(function(data) {

      console.log(data);
      if(data.response)
      {
          $(".add-order").removeClass("my-btn-blue-light");
          $(".add-order").addClass("btn-success");
      }

    })
    .catch(function(err) {
        console.log(err);
        let out = "<div class = 'alert alert-success'><b>Error Interno de Servicio</b></div>";
        $(".panel-errors").removeClass("d-none");
        $(".panel-errors").html(out);
        stop_scrum();
        return;
    });
});


$(".container-full").on("click", ".btn-fact", function(){
  Swal.fire({
      title: '¡Atención! ',
      text: "No podrás revertir esta operación una vez confirmada",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: 'rgb(63 99 134)',
      cancelButtonColor: '#3085d6',
      confirmButtonText: '¡Si, facturar remisión!',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
            generaFactura(1, identified, SERIE_REM, FOLIO_REM, 1);
      }
    });
});




function generaFactura(type, identified, serie, folio, type_url)
{
    const data = new FormData();
    data.append('identified', identified);
    data.append('type', type);
    data.append('serie', serie);
    data.append('folio', folio);

    let url = "../../../app/api/sale.php?a=5";
    let str_tipo = 'retimbrar';

    if(type_url == 1)
    {
        url = "../../../app/api/sale.php?a=4";
        str_tipo = 'timbrar';
    }

    loading_scrum();

    fetch(url, { method: 'POST', body: data})
    .then(function(response) {
    if(response.ok) {
        return response.json();
    } else {
        throw "Error en la llamada Ajax";
    }
    })
    .then(function(data) {
      console.log("respondiendo ... ");
        console.log(data);
          stop_scrum();
        if(data.code == 400)
        {
            alertMessage("warning", "¡Error al realizar la operación!", "Aceptar", true, "../../detail/"+identified+"/");
        }
        else if(data.code == 403)
        {
            alertMessage("warning", "¡La sessión ha expirado!", "Iniciar sesión", true, "../../../login/")
        }
        else if(data.code == 200)
        {
              if(data.status)
            {
                    showModalMessageError("success", "!La factura se ha enviado a timbrar correctamente, verifica el conector de ADVANS!", 2000);
                    $(".container-full .btn-fact").addClass("d-none");
                    $(".container-full .tr-folio").removeClass("d-none");
                    $(".container-full .td-folio").html(`<b>${data.data.data.serie}-${data.data.data.folio}</b>`);
                    return;
            }
            else
            {
                showModalMessageError("warning", "!Error al timbrar la remisión o factura!", 2000);
                return;
            }
        }
    })
    .catch(function(err) {
        console.log(err);
        stop_scrum();
        showModalMessageError("error", "¡Error Interno de Servidor, no se puede timbrar la factura!", 2000);
        return;;
    });

}
