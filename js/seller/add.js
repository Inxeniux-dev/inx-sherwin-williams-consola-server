$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});



const addSeller = () =>
{
    let nombre = $("#nombre"); 
    let objetivo = $("#objetivo"); 

    let error = 0;
    error += valid_imputs([nombre, objetivo]);
    if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

    loading_scrum();
    let url = `../../app/api/seller.php?a=1`;

    const data = new FormData();
    data.append('nombre', nombre.val());
    data.append('objetivo', objetivo.val());

    fetch(url,{method:'POST', body:data})
      .then(function(response) {return response.json();})
      .then(function(data) { console.log(data);
        const { code, status }  = data;
          if(code == 201)
          {
            showModalMessageError("success", "Vendedor Agregado Correctamente", 2300);
            setTimeout(function(){ window.location =`../` }, 2300);
            return;
          }
          statusHTTP(data, "../../");
          stop_scrum();
      })
      .catch(function(err) { stop_scrum(); console.log(err); });

}