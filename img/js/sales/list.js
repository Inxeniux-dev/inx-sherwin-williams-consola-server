$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    console.log("read");

    getSales(1);
});

var IDCLIENT = 0;
var GRUPO_REPORTE = 0;

function getSales(page)
{
    let fechini = document.getElementById("dateInitial").value;
    let fechafin = document.getElementById("dateFinaly").value;
    let search = document.getElementById("search").value;
    let status = document.getElementById("status").value;
    let type = document.getElementById("type").value;
    let type_sale = document.getElementById("type_sale").value;
    let url =  `../../app/api/sale.php?a=7&&page=${page}&&fechini=${fechini}&&fechfin=${fechafin}&&idcliente=${IDCLIENT}&&module=list&&status=${status}&&type=${type}&&type_sale=${type_sale}&&search=${search}`;

    console.log(url);

    loading_scrum();
      $(".table-sales").html("");
    $.get(url, null, "html").done(( data, textStatus, jqXHR ) => {
        console.log(textStatus);
        stop_scrum();
        $(".table-sales").html(data);
          let mod = "sales";
          if(type_sale == 2){ mod = "invoice";}

          if(type_sale == 3){
            $(".r-pdf").attr("href", `javascript:void(0);`);
            $(".r-xls").attr("href", `javascript:void(0);`);
          }
          else {
            $(".r-pdf").attr("href", `../../report/${mod}/${fechini}/${fechafin}/${IDCLIENT}/`);
            $(".r-xls").attr("href", `../../reportExcel/${mod}/${fechini}/${fechafin}/${IDCLIENT}/`);
          }
      })
      .fail((jqXHR, textError, errorThrown) => {
          stop_scrum();
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}

$("#dateInitial").change(()=>{ getSales(1); });
$("#dateFinaly").change(()=>{ getSales(1); });
$("#type").change(()=>{ getSales(1); });
$("#status").change(()=>{ getSales(1); });
$("#type_sale").change(()=>{ getSales(1); });
$(".table-sales").on("click",".pag-number", function(){
    getSales($(this).attr("data"));
});


function delay(callback, ms) {
    var timer = 0;
    return function() {
      var context = this, args = arguments;
      clearTimeout(timer);
      timer = setTimeout(function () {
        callback.apply(context, args);
      }, ms || 0);
    };
  }


  $('#search').keyup(delay(function (e) {
      getSales(1);
  }, 700));




function addCustomer(rfc, name, id)
{
   IDCLIENT = id;
   $("#exampleModal").modal("hide");
   $(".t-client").html(`<b>${name}</b> &nbsp;&nbsp; <i class="fas fa-trash hand" title = 'Quitar Cliente' onclick = 'delCustomer();'></i>`);
   getSales(1);
}

function delCustomer()
{
    IDCLIENT = 0;
    $(".t-client").html(`<b>Todos los clientes</b>`);
    getSales(1);
}


  $(".btn-clients").click(() => {  $(".table-modal-customers").html("Consultando..."); get_list(1); });
  $('#searchCustomer').keyup(delay(function (e) {
      get_list(1);
  }, 500));

  $("#btn-search-customer").click(()=>{ get_list(1); });
  $("#typeCustomer").change(()=> { get_list(1); });


  function get_list(page)
  {   IDCLIENT = 0;
      let search = $("#searchCustomer").val();
      let type = document.getElementById("typeCustomer").value;
      let url =  `../../app/api/customer.php?a=5&&page=${page}&&type=${type}&&search=${search}`;

      fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) {
          stop_scrum();
          $(".table-modal-customers").html(data.data);
      })
      .catch(function(err) {
          stop_scrum(); console.log(err);
      });
  }


  $(".table-modal-customers").on("click",".pag-number", function(){
      get_list($(this).attr("data"));
  });


$("#sale_option").change(function(){
    GRUPO_REPORTE = $(this).val();
    getSales(1);
});



function rePrintTicket(id)
{
    const data = new FormData();
     data.append('identified', id);
     data.append('type', 1);
     let url = "../../app/api/sale.php?a=3";

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
              showModalMessageError("warning", "¡Error al realizar la operación!", 2500);
         }
         else if(data.code == 403)
         {    stop_scrum();
              showModalMessageError("warning", "¡La sesión ha expirado!", 2500);
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
         stop_scrum();
         showModalMessageError("error", "¡Error al imprimir el ticket!, Verificar el nombre de la impresora", 2500);
     });
}




function generaFactura(type, identified, serie, folio, type_url)
{
    const data = new FormData();
    data.append('identified', identified);
    data.append('type', type);
    data.append('serie', serie);
    data.append('folio', folio);

    let url = "../../app/api/sale.php?a=5";
    let str_tipo = 'retimbrar';

    if(type_url == 1)
    {
        url = "../../app/api/sale.php?a=4";
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
                    if(type_url == 1)
                    {
                        getSales(1);
                    }
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
