$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });
    console.log("read");
    getItems(1);
});

let color_border_error = "1px solid  #ff988e";
let color_border_normal = "1px solid  #c5c5c5";

$(".table-items").on("click",".pag-number", function(){
    getItems($(this).attr("data"));
});

async function getItems(page)
{   console.log("entro");

    loading_scrum();
    $(".table-items").html("<h5>Consultando...</h5>");

    let url = "../../getitemsbyid/"+page+"/"+identified+"/";
    fetch(url)
    .then(function(response) {
        return response.json();
    })
    .then(function(data) {
        stop_scrum();
        $(".table-items").html(data.html);
        $(".table-items .ct-1").focus();

        if(data.btn == true)
        {
          $(".btn-add-count-items").removeClass("d-none");
        }

        $(".r-xls").attr("href", "../../../reportExcel/inventory_prods/"+identified+"/");
        $(".r-pdf").attr("href", "../../../report/inventory_prods/"+identified+"/");
    })
    .catch(function(err) {
        console.log(err);
        stop_scrum();
        $(".table-items").html("<h5 class ='text-danger'>Error</h5>");
    });
}


$(".table-items").on("keypress", ".cant-item", function(event){

    let cant = $(this).val();
    let input = $(this);
    let code = $(this).attr("data-code");
    let iconrow = $(this).attr("data-r");
    let err = 0;

    if(event.keyCode == 13 || event.keyCode == 9)
    {

        if(cant < 0) {  input.css("border", color_border_error); err ++; } else {input.css("border", color_border_normal); }

        if(err == 0 )
        {

            const data = new FormData();
            data.append('identified', identified);
            data.append('code', code);
            data.append('cant', cant);

            let url = "../../setcountforitem/";
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

                if(data.validation)
                {
                    if(!data.finaly)
                    {
                        if(data.save)
                        {
                            $("#ic-"+iconrow).html('<span class = "text-success"><i class="fa fa-check-circle"></i> <b>Capturado</b></span>');
                            console.log(".ct-"+(parseInt(iconrow)+1));
                            $(".table-items .ct-"+(parseInt(iconrow)+1)).focus();
                        }
                        else
                        {
                            Swal.fire({
                                type: 'warning',
                                title: 'Atención',
                                text: '¡Error al realizar la operación.',
                                confirmButtonText: 'Aceptar',
                                allowOutsideClick : false,
                                allowEscapeKey : false,
                                allowEnterKey : false,
                            });
                        }
                    }
                    else
                    {
                        Swal.fire({
                            type: 'warning',
                            title: 'Atención',
                            text: '¡El inventario ya está cerrado!, no es posible realizar la operación.',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick : false,
                            allowEscapeKey : false,
                            allowEnterKey : false,
                        });
                    }
                }
                else{
                    displayMsgs(data.error);
                }

            })
            .catch(function(err) {
                console.log(err);
            });


        }
        return;
    }
    else {
        $("#ic-"+iconrow).html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i>  Sin contar </span>');
    }

    if(isNaN(cant))
    {
        $(this).css("border", color_border_error);
    }
    else{
        $(this).css("border", color_border_normal);
    }

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
     else {
        msg_error += " Error desconocido <br>";
     }
     msg_error += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

     $(".msg-validadion").html(msg_error);
}



$(".btn-add-count-items").click(function() {
    let btn = $(this);
    btn.hide();

    const data = new FormData();
    data.append('identified', identified);
    let url = "../../confirmCount/";
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

        if(data.validation)
        {
            if(!data.finaly)
            {
                if(data.save)
                {
                  showModalMessageError("success", "Datos verificados y agregados correctamente", 2200);
                  setTimeout(function(){  window.location = "../../additems/"+data.identified+"/"; }, 2500);
                   return;
                }
                else
                {
                  showModalMessageError("warning", "¡Error al realizar la operación!", 2200);
                  btn.show();
                  displayMsgs(data.error);
                }
            }
            else
            {
                btn.show();
                showModalMessageError("warning", "¡El inventario ya está cerrado!", 2200);
            }
        }
        else
        {   btn.show();
            showModalMessageError("warning", "¡Error, inventario desconocido!", 2200);
        }

    })
    .catch(function(err) {
        console.log(err);
        showModalMessageError("error", "¡Error al realizar el proceso!", 2200);
    });


});

$(".btn-cancel").click(() =>{


  Swal.fire({
      title: '¿Estás seguro de cancelar el inventario?',
      text: "¡No podrás revertir esto!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: '¡Si, reiniciar inventario!',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
          cancel_inventory();
      }
    })

});



function cancel_inventory()
{


  let url = "../../cancel/";

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

      if(data.finaly)
      {
        showModalMessageError("warning", "¡El inventario ya está cerrado!", 2200); return;
        setTimeout(function(){ window.location = "../../details/"+identified+"/"; }, 2500);
      }
      else
      {
          if(data.delete)
          {
            showModalMessageError("success", "¡El inventario se ha cancelado existosamente!", 2200);
            setTimeout(function(){  window.location = "../../all/"; }, 2500);
            return;
          }
          else
          {
              showModalMessageError("error", "¡Error al realizar la operación!", 2000);
          }
      }
  })
  .catch(function(err) {
  console.log(err);  showModalMessageError("error", "¡Error al realizar la operación!", 2000);
  });

}
