$(document).ready(() =>{

    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });

    $(document).ready(function(){

        $('[data-toggle="tooltip"]').tooltip()

    });
});

var itemsReturn = [];
var itemsReturnDouble = [];



$(".btn-cancel-remision").click(() =>{
    Swal.fire({
        title: '¿Estás seguro de cancelar la remisión?',
        text: "¡No podrás revertir esto!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '¡Si, cancelar remisión!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
            cancel();
        }
      })
});


function cancel()
{
    loading_scrum();
        const data = new FormData();
        data.append('identified', identified);

        let url = "../../../app/api/sale.php?a=2";
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
            stop_scrum();

            if(data.code == 200)
            {
              if(data.status)
              {
                  alertMessage("success", "La remisión se ha cancelado", "Aceptar", true, "../../detail/"+identified+"/");
                  return;
              }
            }
            statusHTTP(data, "../../");
        })
        .catch(function(err) {
            console.log(err);
            stop_scrum();
            alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../detail/"+identified+"/");
        });
}




$(".btn-change-clients").click(() => {  $(".table-modal-customers").html("Consultando..."); get_list_clients(1); });
$("#searchCustomer").keyup(()=>{ get_list_clients(1); });
$("#btn-search-customer").click(()=>{ get_list_clients(1); });
$("#typeCustomer").change(()=> { get_list_clients(1); });

$(".table-modal-customers").on("click",".pag-number", function(){
    get_list_clients($(this).attr("data"));
});

function get_list_clients(page)
{
    let item = $("#searchCustomer").val();
    let type = document.getElementById("typeCustomer").value;
    let url = "../../listclient/"+page+"/"+type+"/"+identified+"/detail/"+item+"/";
    console.log(url);
    $.get(url, null, "html").done(( data, textStatus, jqXHR ) => {
        console.log(textStatus);
        $(".table-modal-customers").html(data);
      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}



function addCustomer(idcustomer)
{


  loading_scrum();
  let url = `../../../app/api/sale.php?a=18`;

  const data = new FormData();
  data.append('identified', identified);
  data.append('id_client', idcustomer);

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) {
    stop_scrum();
      console.log(data);

      if(data.code == 201)
      {
        if(data.status)
        {
            showModalMessageError("success", data.msg, 2000);
            $("#exampleModal").modal("hide");
            window.setTimeout( function(){  window.location = '../'+identified+'/'; }, 2400);
           return;
        }
      }
      statusHTTP(data, "../../");
  })
  .catch(function(err) {
      stop_scrum(); console.log(err);
  });


}


$(".print_ticket").click(() => {
    print_ticket();
});


$(".gen-fact").click(function(){
    let type = $(this).attr("data");


    const data = new FormData();
    data.append('identified', identified);
    data.append('type', 1);

    let url = "../../../app/api/sale.php?a=5";
    let str_tipo = 'retimbrar';

    if(type == 1)
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
                if(type == 1)
                {
                    alertMessage("success", "!La factura se ha enviado a "+str_tipo+" correctamente, verifica el conector de ADVANS!", "Aceptar", true, "../../detail/"+identified+"/");
                    return;
                }

                alertMessage("success", "!La factura se ha enviado a "+str_tipo+" correctamente, verifica el conector de ADVANS!", "Aceptar", false, null);
            }
            else
            {
                alertMessage("warning", "¡Error al "+str_tipo+"  la remisión!", "Aceptar", false, null);
            }
        }
    })
    .catch(function(err) {
        console.log(err);
        stop_scrum();
        alertMessage("error", "¡Error Interno de Servidor, no se puede timbrar la factura!", "Aceptar", true, "../../detail/"+identified+"/");
    });

});

function print_ticket()
{
    const data = new FormData();
    data.append('identified', identified);
    data.append('type', 1);
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
            alertMessage("warning", "¡Error al realizar la operación!", "Aceptar", true, "../../detail/"+identified+"/");
        }
        else if(data.code == 403)
        {    stop_scrum();
            alertMessage("warning", "¡La sessión ha expirado!", "Iniciar sesión", true, "../../../login/")
        }
        else if(data.code == 200)
        {
            stop_scrum();

            if(data.status)
            {
                showModalMessageError("success", "!El Ticket se ha enviado a imprimir!", 2000);
            }
            else
            {
                showModalMessageError("warning", "¡Error al enviar a imprimir el ticket!", 2000);
            }
        }

    })
    .catch(function(err) {
        console.log(err);
        stop_scrum();
        showModalMessageError("error", "¡Error al enviar a imprimir el ticket, verificar nombre de impresora!", 2000);
    });
}





$(".link-noapplied").click(() => {
    $('html, body').animate({
        scrollTop: $(".div-noapplied").offset().top
        }, 1500);
});

let tipe_doc = 0;

$(".search-remision").click(function(){
    $("#search_modal").modal("show");
    $(".modal-title").html("<b>Ingrese folio de la remisión</b>");
    $(".input-folio").focus();
    tipe_doc = 1;
});

$(".search-factura").click(function(){
    $("#search_modal").modal("show");
    $(".modal-title").html("<b>Ingrese folio de la factura</b>");
    $(".input-folio").focus();
    tipe_doc  = 2;
});


$(".btn-search-ok").click(function(){

    loading_scrum();
    let url = "../../../app/api/sale.php?a=19";
    const data = new FormData();
    data.append('type', tipe_doc);
    data.append('folio', $(".input-folio").val());

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
        if(data.code == 200)
        {
          if(data.status == 201)
            {
                showModalMessageError("success", "Folio encontrado", 2000);
                setTimeout(function(){ window.location = '../'+data.id+"/"; }, 2500);
                return;
            }

            showModalMessageError("warning", "¡El folio no se ha encontrado!", 2500);
            stop_scrum();
            return;
        }

        showModalMessageError("warning", "¡Error al realizar la búsqueda!", 2000);
        stop_scrum();
    })
    .catch(function(err) {
        console.log(err);
        showModalMessageError("error", "Error al realizar la operación", 2000);
        stop_scrum();
    });

});




$(".btn-change-cfdi").click(function(){


    loading_scrum();
    let url = "../../../app/api/sale.php?a=21";
    $(".table-modal-cfdi").html("");

    fetch(url, { method: 'GET'})
    .then(function(response) {
    if(response.ok) {
        return response.json();
    } else {
        throw "Error en la llamada Ajax";
    }
    })
    .then(function(data) {
        console.log(data);
        if(data.code == 201)
        {
                $("#modalUsoCFDI").modal("show");
                $(".table-modal-cfdi").html(data.html);
        }

        stop_scrum();
    })
    .catch(function(err) {
        console.log(err);
        showModalMessageError("error", "Error al realizar la operación", 2000);
        stop_scrum();
    });


});


function change_CFDI(id)
{

    loading_scrum();
    let url = "../../../app/api/sale.php?a=22";
    const data = new FormData();
    data.append('identified', identified);
    data.append('id', id);

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
        if(data.code == 201)
        {
            showModalMessageError("success", data.msg, 2000);
            window.setTimeout( function(){  window.location = '../'+identified+'/'; }, 2200);
            stop_scrum();
            return;
        }

        showModalMessageError("warning", data.msg, 2000);
        stop_scrum();
    })
    .catch(function(err) {
        console.log(err);
        showModalMessageError("error", "Error al realizar la operación", 2000);
        stop_scrum();
    });
}


function displayIgual(id)
{
  console.log(id);
  if ($(".igual"+id).hasClass('d-none')){
       $(".igual"+id).removeClass("d-none");
   }else{
        $(".igual"+id).addClass("d-none");
   }
}
