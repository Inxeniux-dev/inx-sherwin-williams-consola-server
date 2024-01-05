$(document).ready(function(){
    console.log('read');
  
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






$(".table-invoices-complement ").on("click", ".btn-retimbrar-complement", function(){

  let params = {"indentified" : indentified, "indentifiedcomplement" : indentifiedcomplement };
  $.post('../../../generateTextForComplement/', params, null, "json").done((data, textStatus, jqXHR ) => {
      console.log(data);
      console.log(textStatus);
      if(data)
      {   
          Swal.fire({
              type: 'success',
              title: 'Éxito',
              text: "El archivo para facturarlo no se ha generado",
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Aceptar',
              allowOutsideClick : false,
              allowEscapeKey : false,
              allowEnterKey : false,
            }).then((result) => {
              if (result.value) {
                 window.location = "../../"+indentified+"/"+indentifiedcomplement+"/";
              }
            });
      }
      else{
          Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: '¡Error al generar el registro!',
              confirmButtonText: 'Aceptar',
              allowOutsideClick : false,
              allowEscapeKey : false,
              allowEnterKey : false,
            })
            .then((result) => {
              if (result.value) {
                 window.location = "../../"+indentified+"/"+indentifiedcomplement+"/";
              }
            });
      }

    })
    .fail((jqXHR, textError, errorThrown) => {
        console.log("la solicitud ha fallado " + textError);
        console.log("la solicitud ha fallado " + errorThrown);
        $(this).show();
    });
});

