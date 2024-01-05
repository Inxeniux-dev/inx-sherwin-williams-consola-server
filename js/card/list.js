$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
    getList(1);
});

$("#search").keyup(function(){ getList(1); });
$("#status").change(function(){ getList(1); });
$("#btn-search").click(function(){ getList(1); });

function getList(page)
{
  const data = new FormData();
  data.append('search', $("#search").val());
  data.append('status', $("#status").val());

  loading_scrum();
  let url = `../../app/api/card.php?a=1`;
  fetch(url,{method:'POST', body:data})
   .then(function(response) {return response.json();})
   .then(function(data) {
     console.log(data);
       if(data.code == 200)
       {
          $(".table-stores").html(data.output);
          $(".r-xls").attr("href", "../../reportExcel/cards/"+$("#status").val()+"/"+$("#search").val() + "/");
       }
       stop_scrum();
   })
   .catch(function(err) { showModalMessageError("error", "Error al consultar la información", 2500);  console.log(err); stop_scrum(); });
}



const  change_status = (id = 0, status = false) => {
  
  const data = new FormData();
  data.append('id', id);
  data.append('status', status);

  loading_scrum();
  let url = `../../app/api/card.php?a=4`;
  fetch(url,{method:'POST', body:data})
   .then(function(response) {return response.json();})
   .then(function(data) {
     console.log(data);
      
      if(data.code == 201)
      {
        showModalMessageError("success", "Estatus actualizado correctamente", 2300);
        getList(1);
        stop_scrum();
        return;
      }      
       stop_scrum();
       statusHTTP(data);
   })
   .catch(function(err) { showModalMessageError("error", "Error al realizar la operación", 2500);  console.log(err); stop_scrum(); });

}




const reportMonth = () => { 
    let year = $("#year").val();
    console.log(year);
    window.location.href = `../../reportExcel/cards_by_month/${year}/`;
}