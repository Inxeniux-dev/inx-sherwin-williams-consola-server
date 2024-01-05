$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");

    getLocations(1);
});

$(".table-locations").on("click",".pag-number", function(){
  getLocations($(this).attr("data"));
});

$("#btn-search").click(()=>{ getLocations(1); });

function getLocations(page)
{
    let search = document.getElementById("search").value;
    let url = "../locations/getlist/"+page+"/"+search+"/";
    $.get(url, null, "html").done(( data, textStatus, jqXHR ) => {

        console.log(textStatus);
        $(".table-locations").html(data);
      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}



$(".btn-sync").click(function(){
      loading_scrum();
      let url = `../app/api/location.php?a=1`;
      fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
          stop_scrum();
          if(data.code == 200)
          {
              alertMessage("success", data.msg, "Aceptar", false, "");
              getLocations(1);
          }
          statusHTTP(data, "../../");
      })
      .catch(function(err) {
          stop_scrum(); console.log(err); $(".table-order").html("<div class='alert alert-danger'>Error</div>");
      });
});


$(".table-locations").on("click", ".thash-location", function(){
    let params = {"indentified" : $(this).attr("data-indentified")};
    $.post('../../delLocation/', params, null, "json").done((data, textStatus, jqXHR ) => {
        console.log(textStatus);
        console.log(data);
        if(data.status)
        {
            Swal.fire({
                type: 'success',
                title: 'Éxito',
                text: 'La sucursal se ha eliminado correctamente',
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
                text: '¡Error al realizar la operación!',
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
      });
});
