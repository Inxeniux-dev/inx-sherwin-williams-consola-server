$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});



$(".btn-save").click(function(){
  let version = $("#version");
  let proyecto = $("#proyecto");

  let error = 0;
  error += valid_imputs([version, proyecto]);
  error += valid_no_cero([proyecto]);

  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

  let url = `../../app/api/version.php?a=4`;
  const data = new FormData();
  data.append('version', version.val());
  data.append('proyecto', proyecto.val());

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
      if(data.code == 201)
      {
        showModalMessageError("success", "Versión Creada", 2300);
        setTimeout(function(){ window.location =`../edit/${data.id}/` }, 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });
});
