$(document).ready(function(){
    console.log('read');
});


var color_border_error = "1px solid  #ff988e";
var color_border_normal = "1px solid  #c5c5c5";


$("#btn-add-complement").click(function(){

    let payform = $("#payform");
    let paymentdate = $("#paymentdate");
    let importe = $("#import");
    let operation = $("#operation");
    let banktransmitter = $("#banktransmitter");
    let account = $("#account");
    let bankreceiver = $("#bankreceiver");
    let error = 0;

    error += valid_numeric_positive([payform]);
    error += valid_no_cero([payform]);

    if(payform.val() == 1)
    {
         error += valid_imputs([paymentdate, importe, operation]);
    }
    else
    {
         if(!valida_txt_account(account.val())){ error++;  account.css("border", "1px solid #f64747");}else { account.css("border", "1px solid #ced4da"); }
         error += valid_imputs([paymentdate, importe, operation, banktransmitter]);
         error += valid_numeric_positive([banktransmitter, bankreceiver]);
         error += valid_no_cero([banktransmitter, bankreceiver]);
         if(banktransmitter.val() <= 1){ error++;  banktransmitter.css("border", "1px solid #f64747");}else { banktransmitter.css("border", "1px solid #ced4da"); }
         if(bankreceiver.val() <= 1){ error++;  bankreceiver.css("border", "1px solid #f64747");}else { bankreceiver.css("border", "1px solid #ced4da"); }


    }
    if(error > 0){ showModalMessageError("warning", "Verifique campos en rojo", 3000); return; }
    complementRegister();
});




function complementRegister()
{   let key = $("#payform").find(':selected').attr('data-clave');
    let f = $("#frm-complement"); // .serialize()+"&&indentified="+indentified+"&&key="+key;
    let url =  "../../../app/api/complement.php?a=2";

    const data = new FormData();
    data.append('paymentdate', document.getElementById("paymentdate").value);
    data.append('payform', document.getElementById("payform").value);
    data.append('import', document.getElementById("import").value);
    data.append('operation', document.getElementById("operation").value);
    data.append('banktransmitter', document.getElementById("banktransmitter").value);
    data.append('account', document.getElementById("account").value);
    data.append('bankreceiver', document.getElementById("bankreceiver").value);
    data.append('indentified', indentified);
    data.append('key', key);

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

        if(data.validation)
        {   if(data.exist_complement == "0")
            {
                if(data.save)
                {
                    let url_redirect = '../../addinvoices/'+data.identified+"/"
                    alertMessage("success", "¡El comprobante de pago se ha registrado correctamente!", "Detalles",  true, url_redirect);
                }
                else{
                    alertMessage("warning", "¡Error al realizar la operación!", "Aceptar", false, null);

                      let msg_error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';

                      if(data.errors.length > 0)
                      {
                          for(let x=0; x<data.errors.length; x++)
                          {
                             msg_error += data.errors[x]+' <br>';
                          }
                      }
                      msg_error += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

                      $(".msg-validadion").html(msg_error);
                }
            }
            else{
                alertMessage("warning", "¡El cliente tiene un complemento sin finalizar!", "Aceptar", false, null);
            }
        }
        else{
             let msg_error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';

             if(data.error.length > 0)
             {
                 for(let x=0; x<data.error.length; x++)
                 {
                    msg_error += data.error[x]+' <br>';
                 }
             }
             msg_error += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

             $(".msg-validadion").html(msg_error);
        }


    })
    .catch(function(err) {
        stop_scrum();
        console.log(err);
        alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../add/"+indentified+"/");
    });
}






function valida_txt_account(account){
    var retorno=false;
    var key = $("#payform").find(':selected').attr('data-clave');
    data = account.trim();
    console.log(key);
    switch (key) {
        case "01":
                if(!isNaN(data)){if(data.length==1 || data.length==0){retorno=true;}else{retorno=false;}}else{retorno=false;}
            break;
        case "02":
            if(!isNaN(data)){if(data.length==0 || data.length==11 || data.length==18){retorno=true;}else{retorno=false;}}else{retorno=false;}
        break;
        case "03":
            if(!isNaN(data)){if(data.length==0 || data.length==10 || data.length==16 || data.length==18){retorno=true;}else{retorno=false;}}else{retorno=false;}
        break;
        case "04":
            if(!isNaN(data)){if(data.length==0 || data.length==16){retorno=true;}else{retorno=false;}}else{retorno=false;}
        break;
        case "28":
            if(!isNaN(data)){if(data.length==0 || data.length==16){retorno=true;}else{retorno=false;}}else{retorno=false;}
        break;
        default:
            return false;
        break;
    }
    return retorno;
}







function getComplements(page)
{

    let fechini = document.getElementById('dateInitial').value;
    let fechfin = document.getElementById('dateFinaly').value;

    fetch(`../../app/api/complement.php?a=1&&page=${page}&&fi=${fechini}&&ff=${fechfin}`, {
            method: 'GET'
        })
        .then(function(response) {
        if(response.ok) {
            return response.json()
        } else {
            throw "Error en la llamada Ajax";
        }
        })
        .then(function(data) {
            console.log(data);
            if(data.code == 200)
            {
                $(".table-complement").html(data.data);
            }
            else
            {

            }
        })
        .catch(function(err) {
        console.log(err);
     });
}


$(".table-complement").on("click",".pag-number", function(){
    getComplements($(this).attr("data"));
});

$("#dateInitial").change(()=>{ getComplements(1); });
$("#dateFinaly").change(()=>{ getComplements(1); });


$(".add-bank").click(function(){
   $("#rfc").val("");
   $("#razon").val("");
   $("#name").val("");
});




$(".confirm-bank").click(function(){
    let rfc = $("#rfc");
    let razon = $("#razon");
    let name = $("#name");
    let error = 0;

    var rfcCorrecto = rfcValido(rfc.val());
    if(!rfcCorrecto){ showModalMessageError("warning", "El RFC es incorrecto", 3000);   border_error([rfc]); return; }

    error += valid_imputs([rfc, razon, name]);

    if(error > 0){ showModalMessageError("warning", "Verifique campos en rojo", 3000); return; }


    const data = new FormData();
    data.append('rfc', document.getElementById("rfc").value);
    data.append('razon', document.getElementById("razon").value);
    data.append('name', document.getElementById("name").value);

    let url = `../../../app/api/complement.php?a=10`;

    fetch(url,{ method: 'POST', body: data})
        .then(function(response) {
        if(response.ok) {
            return response.json()
        } else {
            throw "Error en la llamada Ajax";
        }
        })
        .then(function(data) {
            console.log(data);
            if(data.code == 201)
            {
              if(data.status)
              {
                showModalMessageError("success", "El banco se ha registrado correctamente", 3000);
                $('#exampleModalCenter').modal('hide')
                get_bancos();

                $("#rfc").val("");
                $("#razon").val("");
                $("#name").val("");
                return;
              }
            }
            statusHTTP(data, "../../");
        })
        .catch(function(err) {
        console.log(err);
     });


});


function get_bancos()
{

  let url = `../../../app/api/complement.php?a=11`;
  fetch(url, { method: 'GET'})
      .then(function(response) {
      if(response.ok) {
          return response.json()
      } else {
          throw "Error en la llamada Ajax";
      }
      })
      .then(function(data) {
          console.log(data);
          if(data.code == 200)
          {
            console.log("entrando");
              $("#banktransmitter").html(data.data);
          }
      })
      .catch(function(err) {
      console.log(err);
   });
}



function convMayusculas(field)
{
    field.value = field.value.toUpperCase()
}
