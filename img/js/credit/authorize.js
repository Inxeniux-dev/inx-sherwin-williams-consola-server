$(document).ready(function(){
    console.log('read');
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });
});

var color_border_error = "1px solid  #ff988e";
var color_border_normal = "1px solid  #c5c5c5";


$(".btn-add").click(function(){

    let numcredit = $("#numcredit");
    let credit = $("#credit");
    let days = $("#days");
    let especial = $("#especial");
    let desactivate = $("#desactivate");
    let error = 0;
    error += valid_imputs([numcredit, credit, days, especial, desactivate]);
    error += valid_no_cero([numcredit, days]);
    if(error > 0){ showModalMessageError("warning", "Verifique campos en rojo", 3000); return; }
    creditRegister();
});


function creditRegister()
{
    const data = new FormData();
    data.append('numcredit', $("#numcredit").val());
    data.append('credit', $("#credit").val());
    data.append('days', $("#days").val());
    data.append('especial', $("#especial").val());
    data.append('desactivate', $("#desactivate").val());
    data.append('indentified', indentified);
    data.append('edit', edit);


    let url =  "../../add/";

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      if(data.validation)
      {   if(!data.duplicate)
          {
              if(data.save)
              {
                  let text_operation = edit ? '¡El crédito se ha actualizado correctamente!' : '¡El crédito se ha registrado correctamente!';
                  let url_redirect = '../'+data.indentified+"/"
                  $("#b-add-customer").hide();
                  showModalMessageError("success", text_operation, 2200);
                  setTimeout(function(){  window.location = url_redirect; }, 2500);
                  return;
              }
              else{
                showModalMessageError("warning", "¡Error al realizar la operación!", 2200);
                $("#b-add-customer").show();
              }
          }
          else{
            showModalMessageError("error", "¡El número de crédito ingresado, ya está registrado!", 2200);
            $("#b-add-customer").show();
            document.getElementById("numcredit").style.border = color_border_error;
          }
      }
      else{
           showModalMessageError("error", "¡Error al realizar la operación!", 2200);
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
        console.log(err);
        showModalMessageError("error", "Error al realizar la operación", 2200);
        $("#b-add-customer").show();
    });

}
