$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
    getList(1);
});

$("#proyecto").change(function(){ getList(1); });
$("#status").change(function(){ getList(1); });
$("#fechini").change(function(){ getList(1); });
$("#fechfin").change(function(){ getList(1); });
$("#btn-search").click(function(){ getList(1); });

function getList(page)
{
  const data = new FormData();
  data.append('fechini', $("#fechini").val());
  data.append('fechfin', $("#fechfin").val());
  data.append('estatus', $("#status").val());
  data.append('proyecto', $("#proyecto").val());

  loading_scrum();
  let url = `../../app/api/version.php?a=1`;

  fetch(url,{method:'POST', body:data})
   .then(function(response) {return response.json();})
   .then(function(data) {
     console.log(data);
       if(data.code == 200)
       {
          $(".table-version").html(data.output);
       }
       stop_scrum();
   })
   .catch(function(err) { showModalMessageError("error", "Error al consultar la información", 2500); console.log(err); stop_scrum();});
}
