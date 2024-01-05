$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
    getList(1);
});

$("#btn-search").click(() => { getList(1); });
$("#sucursal").change(() => { getList(1); });
$("#mes").change(() => { getList(1); });
$("#orden").change(() => { getList(1); });
$("#anio").change(() => { getList(1); });

const getList = (page) => {
  loading_scrum();

  let sucursal = $("#sucursal").val();
  let mes = $("#mes").val();
  let anio = $("#anio").val();
  let orden = $("#orden").val();

  let url = `../../app/api/asistencia.php?a=2&sucursal=${sucursal}&mes=${mes}&anio=${anio}&orden=${orden}`;
  console.log(url);
  fetch(url)
   .then(function(response) {return response.text();})
   .then(function(data) {
     console.log(data);

          $(".table-bitacora").html(data);
          $(".r-xls").attr("href", `../../reportExcel/bitacoraGlobal/${sucursal}/${mes}/${anio}/${orden}/`);

       stop_scrum();
   })
   .catch(function(err) { showModalMessageError("error", "Error al consultar la información", 2500);  console.log(err); stop_scrum(); });
}
