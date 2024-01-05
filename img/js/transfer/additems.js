$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    $("#code").focus();
    getListItemsForTransfer();
});

var color_border_error = "1px solid  #ff988e";
var color_border_normal = "1px solid  #c5c5c5";



$("#code").keyup(function(event){
  if(event.keyCode == 13)
  {
      $("#cant").focus();
  }
});

$("#cant").keyup(function(event){
    if(event.keyCode == 13)
    {
        addItem($("#code").val(), $(this).val());
    }
});


$("#btn-add").click(function(){
    addItem($("#code").val(), $("#cant").val());
});


function addItem(code, cant)
{
    let err = 0;
    if(code.length <= 0) { document.getElementById("code").style.border = color_border_error; err++; } else { document.getElementById("code").style.border = color_border_normal; }
    if(cant <=0 || isNaN(cant)) { document.getElementById("cant").style.border = color_border_error; err++; } else { document.getElementById("cant").style.border = color_border_normal; }


    if(err == 0)
    {   let params = {"code": code, "cant":cant, "it": it, "update":0}
        let url = "../../registryitem/";
        $.post(url, params, null, "json").done(( data, textStatus, jqXHR ) => {
            console.log( data );
            console.log(textStatus);


            if(data.validation)
            {
                if(data.exist)
                {
                    if(data.available)
                    {
                        if(data.existtransfer)
                        {
                            if(!data.finaly)
                            {
                                if(data.save)
                                {
                                    window.location = "../"+it+"/";
                                }
                                else{
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Espera..',
                                        text: '¡Error al realizar la operación!',
                                        confirmButtonText: 'Aceptar',
                                        allowOutsideClick : false,
                                        allowEscapeKey : false,
                                        allowEnterKey : false
                                      });
                                }
                            }
                            else{
                                Swal.fire({
                                    type: 'warning',
                                    title: 'Espera..',
                                    text: '¡El vale ya se ha finalizado!',
                                    confirmButtonText: 'Aceptar',
                                    allowOutsideClick : false,
                                    allowEscapeKey : false,
                                    allowEnterKey : false
                                  });
                            }
                        }
                        else{
                            Swal.fire({
                                type: 'warning',
                                title: 'Espera..',
                                text: '¡El vale  no existe!',
                                confirmButtonText: 'Aceptar',
                                allowOutsideClick : false,
                                allowEscapeKey : false,
                                allowEnterKey : false
                              });
                        }
                    }
                    else{
                        Swal.fire({
                            type: 'warning',
                            title: 'Espera..',
                            text: '¡la cantidad ingresada es mayor a la cantidad actual del producto!',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick : false,
                            allowEscapeKey : false,
                            allowEnterKey : false

                          });
                    }
                }
                else{
                    Swal.fire({
                        type: 'warning',
                        title: 'Espera..',
                        text: '¡El código ingresado no existe!',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick : false,
                        allowEscapeKey : false,
                        allowEnterKey : false
                      });
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
        .fail((jqXHR, textError, errorThrown) => {
            console.log("la solicitud ha fallado " + textError);
            console.log("la solicitud ha fallado " + errorThrown);
            Swal.fire({
                type: 'error',
                title: 'Espera..',
                text: '¡Error al realizar la operación!',
                confirmButtonText: 'Aceptar',
                allowOutsideClick : false,
                allowEscapeKey : false,
                allowEnterKey : false
              });
        });
    }
}




function getListItemsForTransfer()
{
    let url = "../../getListItemsForTransfer/"+it+"/";
    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
          if(data.code == 200)
          {
              $(".table-items-transfer").html(data.html);
              if(data.btn){ $(".btn-finaly").removeClass("d-none");}
          }
    })
    .catch(function(err) {
        console.log(err);
    });

}




$(".table-items-transfer").on("click", ".delete", function(){
    let params = {"indentifiedelement" : $(this).attr("data-indentified"), "indentified" : it};
    console.log(params);
    $.post('../../delItemForTransfer/', params, null, "json").done((data, textStatus, jqXHR ) => {
        console.log(data);
        console.log(textStatus);

        if(data)
        {
            Swal.fire({
                type: 'success',
                title: 'Éxito',
                text: 'El código se ha eliminado correctamente',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
                allowOutsideClick : false,
                allowEscapeKey : false,
                allowEnterKey : false,
              }).then((result) => {
                if (result.value) {
                   window.location = "../"+it+"/";
                }
              });
        }
        else{
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: '¡Error al realizar la operación!',
                confirmButtonText: 'Aceptar',
                allowOutsideClick : false,
                allowEscapeKey : false,
                allowEnterKey : false,
              })
              .then((result) => {
                if (result.value) {
                    window.location = "../"+it+"/";
                }
              });
        }

      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: '¡Error al realizar la operación!',
                confirmButtonText: 'Aceptar',
                allowOutsideClick : false,
                allowEscapeKey : false,
                allowEnterKey : false,
            })
            .then((result) => {
                if (result.value) {
                    window.location = "../"+it+"/";
                }
            });
      });
});


$(".cancel-transfer").click(() => {
    console.log(it);
    let params = { "indentified" : it };
    $.post('../../cancelTransfer/', params, null, "json").done((data, textStatus, jqXHR ) => {
        console.log(data);
        console.log(textStatus);

        console.log(data.res_prod);
        console.log(data.res_transfer);

        if(data.res_prod && data.res_transfer)
        {
          showModalMessageError("success", 'El vale se ha cancelado correctamente', 2000);
          setTimeout(function(){ window.location = "../../"; }, 2500);
        }
        else{
            let msg = '';
            if(!data.res_prod)
            {
                msg += ' Los códigos del no se eliminaron correctamente. ';
            }
            if(!data.res_transfer)
            {
                msg += ' El vale no se ha cancelado. ';
            }
            else{
                msg += " El vale se canceló incorrectamente. "
            }
            showModalMessageError("warning", msg, 2000);
            setTimeout(function(){ window.location = "../../"; }, 2500);
        }

    })
    .fail((jqXHR, textError, errorThrown) => {
        console.log("la solicitud ha fallado " + textError);
        console.log("la solicitud ha fallado " + errorThrown);
        showModalMessageError("error", '¡Error al realizar la operación!', 2200);
        setTimeout(function(){ window.location = "../../"; }, 2500);
    });

});




$(".btn-finaly").click(function(){

  loading_scrum();
  const data = new FormData();
  data.append('indentified', it);
  let url = `../../../app/api/transfer.php?a=2`;

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) {
    console.log(data);
    stop_scrum();
      if(data.code == 200)
      {
        if(data.status)
        {
          showModalMessageError("success", data.msg, 2000);
          setTimeout(function(){ window.location = "../../details/"+it+"/" }, 2100);
          return;
        }
      }
      getListItemsForTransfer();
      statusHTTP(data, "../../");
  })
  .catch(function(err) {
      stop_scrum(); console.log(err);
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



$('#btn-search').on('click', function () {
    $(".body-codes").html("Espere un momento por favor....");
    getItemsByTransfer(1);
});


$(".body-codes").on("click",".pag-number", function(){
    getItemsByTransfer($(this).attr("data"));
});


$("#code-search").keyup(() => {
    getItemsByTransfer(1);
});

$(".btn-bsq").click(function(){
  getItemsByTransfer(1);
});

function getItemsByTransfer(page)
{
    let item = $("#code-search").val();

    let url = "../../getItemsByTransfer/"+page+"/"+it+"/"+item+"/";
    $.get(url, null, "html").done((data, textStatus, jqXHR ) => {
        $(".body-codes").html(data);
        console.log(textStatus);
      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}

$(".body-codes").on("click", ".b-code", function(){
    let code = $(this).attr("data-code");
    console.log(code)
    addItem(code, 1);
});



$(".table-items-transfer").on("keyup", ".i-cant", function(event){

    let cant = $(this).val();

    if(isNaN(cant)) { $(this).addClass("input-red"); return; }else { $(this).removeClass("input-red"); }


    if(event.keyCode == 13)
    {
        loading_scrum();

        let code = $(this).attr("data-code");
        let url = `../../../app/api/transfer.php?a=1`;

        const data = new FormData();
        data.append('code', code); data.append('identified', it); data.append('cant', cant);  data.append('upd', 1);

        fetch(url, { method: 'POST',  body: data })
        .then(function(response) {
            if(response.ok) { return response.json()} else {throw "Error en la llamada Ajax"; }
        })
        .then(function(data) {
            console.log(data);
            if(data.code == 403) { window.location = "../../../login/close/"; return; }
            if(data.error == 0 && (data.message == null || data.message.length == 0)) { window.location = "../"+it+"/"; return; }
            showMessageErrors(data.message);
        })
        .catch(function(err) {  console.log(err);  alertMessage("error", "No es posible ralizar la operación", "Aceptar", true, "../"+it+"/"); return; });
    }
});



function display_cant(id)
{
    $("#lbl"+id).addClass("d-none");
    $("#inp"+id).removeClass("d-none");
    $("#inp"+id).focus();
    $("#inp"+id).select();
}
