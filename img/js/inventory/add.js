$(document).ready(function(){
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });

  //  $('.dropdown-toggle').dropdown();
});



let color_border_error = "1px solid  #ff988e";
let color_border_normal = "1px solid  #c5c5c5";



$(".b-next").click(function(){

      let auditor = $("#auditor");
      let encargado = $("#encargado");
      let coments = $("#coments");
      let error = 0;

      error += valid_imputs([auditor, encargado, coments]);
      if(error > 0){   showModalMessageError("error", "Verifica los campos en rojo", 2000); return; }

      const data = new FormData();
      data.append('auditor', auditor.val());
      data.append('encargado', encargado.val());
      data.append('coments', coments.val());

      let url = "../register/";


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
          if(data.pending)
          {
              showModalMessageError("warning", "¡Existe un inventario iniciado, pero no finalizado, revise en el listado!", 2000); return;
          }

          if(data.status)
          {
                showModalMessageError("success", "El inventario se ha iniciado correctamente", 2000);
                setTimeout(function(){  window.location = "../additems/"+data.identified+"/"; }, 2500);
                return;
          }
          showModalMessageError("error", "¡Error al realizar la operación!", 2000);
        }
          stop_scrum();
          displayMsgs(data.error);
      })
      .catch(function(err) {
          console.log(err);
          showModalMessageError("error", "¡Error al realizar la operación!", 2000);
          stop_scrum();
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
