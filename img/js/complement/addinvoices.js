$(document).ready(function(){
    console.log('read');
    getAllInvoices(1);
});



$("#folio").keyup(function(e){
  if(e.which == 13) {
        searchInvoice();
 }
});



$(".btn-search").click(function()
{
    searchInvoice();
});

function searchInvoice()
{

  $(".tbl-fact").addClass("d-none");
  $(".tbl-fact").html("");

  let folio = $("#folio");
  let err = 0;
  err += valid_imputs([folio]);
  err +=  valid_numeric_positive([folio]);
  err +=  valid_no_cero([folio]);
  if(err > 0){ showModalMessageError("warning", "Verifique campos en rojo", 3000); return; }

  loading_scrum();
  let url = "../../../app/api/complement.php?a=9";
  const data = new FormData();
  data.append('invoice', folio.val());
  data.append('idcomplement', identified);
  data.append('idcustomer', idcustomer);

  fetch(url, { method: 'POST', body: data})
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
          $(".tbl-fact").removeClass("d-none");
          $(".tbl-fact").html(data.output);
          stop_scrum();
          return;
      }

    console.log(data);
    statusHTTP(data, null);
    stop_scrum();
  })
  .catch(function(err) {
      stop_scrum();
      console.log(err);
      showModalMessageError("error", "¡Error Interno de Servidor!", 2000)
  });
}


function getAllInvoices(page)
{

  $(".dv-btn").addClass("d-none");
  let url = "../../../app/api/complement.php?a=3&&page="+page+"&&identified="+identified ;
  fetch(url, { method: 'GET' })
  .then(function(response) {
  if(response.ok) {
      return response.json();
  } else { throw "Error en la llamada Ajax"; }
  })
  .then(function(data) {
    $(".table-invoices-complement").html(data.data);
    if(data.btn)
    {
        $(".dv-btn").removeClass("d-none");
    }
  })
  .catch(function(err) {
      stop_scrum();
      console.log(err);
      showModalMessageError("error", "¡Error Interno de Servidor!", 2000);
  });
}


function AddInvoice(factura, saldo)
{

  let abono=$("#abono").val();
  let nota=$("#nota_credito").val();

  const data = new FormData();
  data.append('nota', nota);
  data.append('abono', abono);
  data.append('fol', factura);
  data.append('total', saldo);
  data.append('identified', identified);


    let url = "../../../app/api/complement.php?a=4";

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

        if(data.data.validation)
        {
            if(data.data.errors.length == 0)
             {
                 showModalMessageError("success", "¡La factura se ha asociado correctamente!", 2000);
                 setTimeout(function(){ window.location = "../../addinvoices/"+identified+"/"; }, 2000);
             }
             else{ displayMsgs(data.data.errors); }
        }
        else{ displayMsgs(data.data.error); }

        statusHTTP(data, null);
    })
    .catch(function(err) {
        stop_scrum();
        console.log(err);
      showModalMessageError("error", "¡Error Interno de Servidor!", 2000);
    });

}

$(".table-invoices-complement").on("click", ".fa-trash", function(){

    const data = new FormData();
    data.append('indentifiedelement', $(this).attr("data-indentified"));
    data.append('fol', $(this).attr("data-fol"));
    data.append('identified', identified);

    let url = "../../../app/api/complement.php?a=5";

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

        if(data.status)
        {
          showModalMessageError("success", "¡La factura se ha eliminado correctamente!", 2000);
          setTimeout(function(){ window.location = "../../addinvoices/"+identified+"/"; }, 2050);
        }
        else{
          showModalMessageError("error", "¡Error al realizar la operación!", 2000);
        }
    })
    .catch(function(err) {
        stop_scrum();
        console.log(err);
        showModalMessageError("error", "¡Error Interno de Servidor!", 2000);
    });
});






$(".btn-finaly-complement").click(function(){
    $(this).hide();
    $(".fa-trash").hide();

    const data = new FormData();
    data.append('identified', identified);
    let url = "../../../app/api/complement.php?a=6";

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

        if(data.status)
        {
          let text_generate = data.txt ? "El complemento de pago se generó correctamente" : "El complemento de pago se registró correctamente.       (El archivo para facturarlo no se ha generado, pero puede crealo después de continuar con este mensaje)";
          let type = data.txt ? "success" : "warning";


          showModalMessageError(type, text_generate, 3000);
          setTimeout(function(){ window.location = "../../detail/"+identified+"/"; }, 3000);
        }
        else{
            showModalMessageError("error", "¡Error al realizar la operación!", 2000);
        }

    })
    .catch(function(err) {
        stop_scrum();
        console.log(err);
        $(this).show();
        $(".fa-trash").hide();
        showModalMessageError("error", "¡Error Interno de Servidor!", 2000);
    });
});


function displayMsgs(errors)
{   console.log(errors)
    let msg_error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
     if(errors.length > 0)
     {
         for(let x=0; x<errors.length; x++)
         {
            msg_error += errors[x]+' <br>';
         }
     }
     msg_error += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

     $(".msg-validadion").html(msg_error);
}
