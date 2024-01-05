$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});

$(".btn-delete").click(function(){

  loading_scrum('Eliminando, Espere...');

  let url = `../../../app/api/employee.php?a=6`;

  const data = new FormData();
  let id = $("#idemploye").val();
  data.append('id', id);

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
    const { code, status }  = data;
      if(code == 201)
      {
        showModalMessageError("success", "Empleado Eliminado Correctamente", 2300);
        setTimeout(function(){ window.location =`../../all/` }, 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });
});
