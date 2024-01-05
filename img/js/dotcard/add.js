$(document).ready(function(){
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });

    console.log('read');
});

let color_border_error = "1px solid  #ff988e";
let color_border_normal = "1px solid  #c5c5c5";



function valida(f)
{    
   $("#b-add-dotcard").hide();
   $(".msg-validadion").html();

    let err = 0;
    if(f.card.value.trim() == "") {f.card.style.border = color_border_error; err++;}else{f.card.style.border = color_border_normal;}
    if(f.points.value.trim() == "") {f.points.style.border = color_border_error; err++;}else{f.points.style.border = color_border_normal;}
    if(f.direction.value.trim() == "") {f.direction.style.border = color_border_error; err++;}else{f.direction.style.border = color_border_normal;}
    if(f.name.value.trim() == "") {f.name.style.border = color_border_error; err++;}else{f.name.style.border = color_border_normal;}
    if(f.descount.value.trim() == "") {f.descount.style.border = color_border_error; err++;}else{f.descount.style.border = color_border_normal;}
    if(f.occupation.value.trim() == "") {f.occupation.style.border = color_border_error; err++;}else{f.occupation.style.border = color_border_normal;}

    if(err == 0){ 
        RegisterDotCard();
    }
    else{
        $("#b-add-dotcard").show();
        Swal.fire({
            type: 'warning',
            title: 'Espera..',
            text: '¡Verifica los campos marcados!',
            confirmButtonText: 'Aceptar'
          });
    }
    return false;
}


function RegisterDotCard()
{
    let params = $("#f-add").serialize()+"&&edit="+edit+"&&idc="+idc;
    let url = edit ? "../../register/" : "../register/";
    $.post(url, params, null, "json").done(( data, textStatus, jqXHR ) => {
        console.log( data );
        console.log(textStatus);

        if(data.validation)
        {
            if(!data.duplicate)
            {
                if(data.save)
                {   
                    let text_operation = edit ? '¡La tarjeta se ha actualizado correctamente!' : '¡La tarjeta se ha registrado correctamente!';
                    let url_redirect = edit ? '../../details/' + data.id + "/" : '../details/' + data.id + "/";
                    $("#b-add-dotcard").hide();
                    Swal.fire({
                        type: 'success',
                        title: 'Éxito',
                        text: text_operation,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Detalles',
                      }).then((result) => {
                        if (result.value) {
                            window.location = url_redirect;
                        }
                      }); 

                      $("#b-add-dotcard").show();
                }
                else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: '¡Error al realizar la operación!',
                        confirmButtonText: 'Aceptar'
                      });
                      $("#b-add-dotcard").show();
                }
            }
            else{
                Swal.fire({
                    type: 'warning',
                    title: 'Espera..',
                    text: '¡Serie o número de sucursal, duplicado!',
                    confirmButtonText: 'Aceptar'
                  });
                  $("#b-add-dotcard").show();
            }
        }
        else{
            $("#b-add-dotcard").show();

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
          $("#b-add-dotcard").show();
      });
}