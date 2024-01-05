$(document).ready(function(){
    console.log('read');
});

let color_border_error = "1px solid  #ff988e";
let color_border_normal = "1px solid  #c5c5c5";



function valida(f)
{    
   $("#b-add-location").hide();
   $(".msg-validadion").html();

    let err = 0;
    if(f.key.value.trim() == "") {f.key.style.border = color_border_error; err++;}else{f.key.style.border = color_border_normal;}
    if(f.name.value.trim() == "") {f.name.style.border = color_border_error; err++;}else{f.name.style.border = color_border_normal;}
    if(f.serie.value.trim() == "") {f.serie.style.border = color_border_error; err++;}else{f.serie.style.border = color_border_normal;}
    if(f.direc.value.trim() == "") {f.direc.style.border = color_border_error; err++;}else{f.direc.style.border = color_border_normal;}
    if(f.colonia.value.trim() == "") {f.colonia.style.border = color_border_error; err++;}else{f.colonia.style.border = color_border_normal;}
    if(f.numexterior.value.trim() == "") {f.numexterior.style.border = color_border_error; err++;}else{f.numexterior.style.border = color_border_normal;}
    if(f.numinterior.value.trim() == "") {f.numinterior.style.border = color_border_error; err++;}else{f.numinterior.style.border = color_border_normal;}
    if(f.cp.value.trim() == "") {f.cp.style.border = color_border_error; err++;}else{f.cp.style.border = color_border_normal;}
    if(f.municipio.value.trim() == "") {f.municipio.style.border = color_border_error; err++;}else{f.municipio.style.border = color_border_normal;}
    if(f.estado.value.trim() == "") {f.estado.style.border = color_border_error; err++;}else{f.estado.style.border = color_border_normal;}
    if(f.pais.value.trim() == "") {f.pais.style.border = color_border_error; err++;}else{f.pais.style.border = color_border_normal;}
    if(f.type.value.trim() == "") {f.type.style.border = color_border_error; err++;}else{f.type.style.border = color_border_normal;}
   
    if(err == 0){ 
        RegisterLocation();
    }
    else{
        $("#b-add-location").show();
        Swal.fire({
            type: 'warning',
            title: 'Espera..',
            text: '¡Verifica los campos marcados!',
            confirmButtonText: 'Aceptar'
          });
    }
    return false;
}

function RegisterLocation()
{
    let params = $("#f-add").serialize()+"&&edit="+edit+"&&il="+il;
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
                    let text_operation = edit ? '¡La sucursal se ha actualizado correctamente!' : '¡La sucursal se ha registrado correctamente!';
                   let url_redirect = edit ? '../../details/' + data.id : '../details/' + data.id;
                    $("#b-add-location").hide();
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

                      $("#b-add-location").show();
                }
                else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: '¡Error al realizar la operación!',
                        confirmButtonText: 'Aceptar'
                      });
                      $("#b-add-location").show();
                }
            }
            else{
                Swal.fire({
                    type: 'warning',
                    title: 'Espera..',
                    text: '¡Serie o número de sucursal, duplicado!',
                    confirmButtonText: 'Aceptar'
                  });
                  $("#b-add-location").show();
            }
        }
        else{
            $("#b-add-location").show();

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
          $("#b-add-location").show();
      });
    
}