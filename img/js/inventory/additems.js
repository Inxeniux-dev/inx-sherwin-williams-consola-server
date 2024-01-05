$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });
    console.log("read");
    getItems(1);

});


/*function getItems(page)
{
    let search = ""; /*no aplica
    let type = document.getElementById("type").value;
    let line = document.getElementById("line").value;
    let url = "../../getlistitems/"+page+"/"+type+"/"+line+"/"+search+"/";
    $.get(url, null, "html").done((data, textStatus, jqXHR ) => {
        $(".table-items").html(data);
        console.log(textStatus);
      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}
*/


$(".table-items").on("click",".pag-number", function(){
    getItems($(this).attr("data"));
});

$("#btn-search").click(()=>{ getItems(1); });
$("#search").keyup(()=>{ getItems(1); });
$("#type").change(()=>{ getItems(1); });
$("#line").change(()=>{ getItems(1); });


async function getItems(page)
{
    let search = ""; /*no aplica */
    let type = document.getElementById("type").value;
    let line = document.getElementById("line").value;
    let url = "../../getlistitems/"+page+"/"+type+"/"+line+"/"+search+"/";

    $(".r-xls").attr("href", "javascript:void(0);");
    $(".r-pdf").attr("href", "javascript:void(0);");

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
        if(data.code == 200)
        {
            $(".table-items").html(data.html);
            $(".r-xls").attr("href", "../../../reportExcel/inventorysearch/"+identified+"/"+type+"/"+line+"/"+search+"/");
            $(".r-pdf").attr("href", "../../../report/inventorysearch/"+identified+"/"+type+"/"+line+"/"+search+"/");

            if(data.btn == true)
            {
              $(".btn-add-items").removeClass("d-none");
            }
        }
    })
    .catch(function(err) {
      stop_scrum(); console.log(err);
      $(".r-xls").attr("href", "javascript:void(0);");
      $(".r-pdf").attr("href", "javascript:void(0);");
    });

}


$(".btn-add-items").click(function() {
    let btn =  $(this);
    btn.hide();

    let type = document.getElementById("type").value;
    let line = document.getElementById("line").value;
    const data = new FormData();
    data.append('identified', identified);
    data.append('type', type);
    data.append('line', line);

    let url = "../../setitemsforinventory/";
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

        if(!data.finaly)
        {
            if(data.save)
            {
              showModalMessageError("success", "Los productos se agregaron correctamente", 2300);
              setTimeout(function(){    window.location = "../../additems/"+data.identified+"/"; }, 2500);
              return;
            }
            else
            {
                showModalMessageError("error", "¡Error al realizar la operación!", 2000);
                btn.show();
                displayMsgs(data.error);
            }
        }
        else
        {
            showModalMessageError("error", "¡El inventario ya está cerrado!", 2000);
        }

    })
    .catch(function(err) {
        console.log(err);
        showModalMessageError("error", "¡Error al realizar la operación!", 2000);
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
     else {
        msg_error += " Error desconocido <br>";
     }
     msg_error += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

     $(".msg-validadion").html(msg_error);
}




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
