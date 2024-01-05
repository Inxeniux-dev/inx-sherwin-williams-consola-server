$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
    getList(1);
});

$("#tipo").change(function(){ getList(1); });
$("#estado").change(function(){ getList(1); });
$("#btn-search").click(function(){ getList(1); });

function getList(page)
{

  let tipo = document.getElementById("tipo").value;
  let estado = document.getElementById("estado").value;

  loading_scrum();
  let url = `../../app/api/store.php?a=1&tipo=${tipo}&estado=${estado}`;
  fetch(url,{method:'GET'})
   .then(function(response) {return response.json();})
   .then(function(data) {
     console.log(data);
       if(data.code == 200)
       {
          $(".table-stores").html(data.output);
          $(".r-xls").attr("href", `../../reportExcel/storeList/`);
       }
       stop_scrum();
   })
   .catch(function(err) { showModalMessageError("error", "Error al consultar la información", 2500);  console.log(err); stop_scrum(); });
}
