$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});

var PRICES = null;

$(".btn-search").click(function(){
    $(".table-prices").html("<h5 class = 'text-primary'><b>Consultando con el Servidor ... </b></h5>");
    loading_scrum();
    let url = `../../app/api/price.php?a=4`;
    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();
      PRICES = data.data;
        if(data.data != null)
        {
          verifica_cambios();
          return;
        }
          $(".table-prices").html("<h5 class = 'text-warning'><b>Finalizó, pero no es posible obtener la información del servidor </b></h5>");
    })
    .catch(function(err) { stop_scrum(); console.log(err); PRICES = null;
      $(".table-prices").html("<h5 class = 'text-danger'><b>No se puede conectar con el servidor</b></h5>");
    });
});


function verifica_cambios()
{   loading_scrum();
  $(".table-prices").html("<h5 class = 'text-primary'><b>Procesando Información ... </b></h5>");
  const data = new FormData();
  data.append('data', JSON.stringify(PRICES));
  let url = `../../app/api/price.php?a=1`;
  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.text();})
  .then(function(data) {
    stop_scrum();
    $(".table-prices").html(data);
  })
  .catch(function(err) { stop_scrum(); console.log(err);  $(".table-prices").html("<h5 class = 'text-danger'><b>Error al verificar los cambios</b></h5>"); });
}




  $(".table-prices").on("click", ".btn-confirm", function(){
  //  $(".table-prices").html("<h5 class = 'text-primary'><b>Actualizando precios ... </b></h5>");
    loading_scrum();
    const data = new FormData();
    data.append('data', JSON.stringify(PRICES));
    let url = `../../app/api/price.php?a=2`;
    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();

      if(data.code == 200 && data.status)
      {
        if(data.info.count_insert > 0)
        {
          alertMessage("success", data.msg, "Ver Detalles", true, "../detail/"+data.info.id+"/");
          return;
        }
        else
        {
          showModalMessageError("success", data.msg, 2000);
           $(".table-prices").html("");
          return;
        }
      }

      statusHTTP(data, "../../");
    })
    .catch(function(err) { stop_scrum(); console.log(err); });
});
