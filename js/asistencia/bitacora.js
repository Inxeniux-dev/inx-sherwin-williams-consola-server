$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
    getList(1);
});

$("#btn-search").click(() => { getList(1); });
$("#sucursal").change(() => { getList(1); });
$("#movimiento").change(() => { getList(1); });
$("#orden").change(() => { getList(1); });
$("#fecha").change(() => { getList(1); });

const getList = (page) => {
  loading_scrum();

  let sucursal = $("#sucursal").val();
  let movimiento = $("#movimiento").val();
  let fecha = $("#fecha").val();
  let orden = $("#orden").val();

  let url = `../../app/api/asistencia.php?a=1&sucursal=${sucursal}&movimiento=${movimiento}&fecha=${fecha}&orden=${orden}`;
  console.log(url);
  fetch(url)
   .then(function(response) {return response.json();})
   .then(function(data) {
     console.log(data);
       if(data.code == 200)
       {
          $(".table-bitacora").html(data.output);
          $(".r-xls").attr("href", `../../reportExcel/bitacoraAsistencia/${sucursal}/${movimiento}/${fecha}/${orden}/`);
       }
       stop_scrum();
   })
   .catch(function(err) { showModalMessageError("error", "Error al consultar la información", 2500);  console.log(err); stop_scrum(); });
}
