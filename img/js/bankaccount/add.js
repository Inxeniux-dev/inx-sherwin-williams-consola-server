$(document).ready(function(){
    console.log('read');
});

let color_border_error = "1px solid  #ff988e";
let color_border_normal = "1px solid  #c5c5c5";


function valida(f)
{    
   $("#b-add-account").hide();
   $(".msg-validadion").html();

    let err = 0;
    if(f.account.value.trim() == "" || isNaN(f.account.value.trim())) {f.account.style.border = color_border_error; err++;}else{f.account.style.border = color_border_normal;}
    if(f.bankname.value.trim() == "") {f.bankname.style.border = color_border_error; err++;}else{f.bankname.style.border = color_border_normal;}

    if(err == 0){ 
        RegisterAccount();
    }
    else{
        $("#b-add-account").show();
        Swal.fire({
            type: 'warning',
            title: 'Espera..',
            text: '¡Verifica los campos marcados!',
            confirmButtonText: 'Aceptar'
          });
    }
    return false;
}


function RegisterAccount()
{
    let params = $("#f-add").serialize()+"&&edit="+edit+"&&iba="+iba;
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
                    let text_operation = edit ? '¡La cuenta se ha actualizado correctamente!' : '¡La cuenta se ha registrado correctamente!';
                   let url_redirect = edit ? '../../../bankaccount/': '../../bankaccount/';
                    $("#b-add-account").hide();
                    Swal.fire({
                        type: 'success',
                        title: 'Éxito',
                        text: text_operation,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick : false,
                        allowEscapeKey : false,
                        allowEnterKey : false
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
                      $("#b-add-account").show();
                }
            }
            else{
                Swal.fire({
                    type: 'warning',
                    title: 'Espera..',
                    text: '¡La cuenta ingresada ya esta registrada!',
                    confirmButtonText: 'Aceptar'
                  });
                  $("#b-add-account").show();
            }
        }
        else{
            $("#b-add-account").show();

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
          $("#b-add-account").show();
      });
    
}