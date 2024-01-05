$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
    getList(1);
});


function getList(page)
{
    const data = new FormData();
    data.append('fechini', $("#fechini").val());
    data.append('fechfin', $("#fechfin").val());
    data.append('estatus', $("#status").val());
    data.append('proyecto', $("#proyecto").val());

    loading_scrum("SINCRONIZANDO CON TIENDAS, ESPERE...");
    let url = `../../app/api/version.php?a=6`;

    fetch(url,{method:'POST', body:data})
     .then(function(response) {return response.json();})
     .then(function(data) {
       const {code, output } = data;
         if(code == 200)
         {
            $(".table-stores").html(output);
         }
         stop_scrum();
     })
     .catch(function(err) { showModalMessageError("error", "Error al consultar la información", 2500); console.log(err); stop_scrum();});
}
