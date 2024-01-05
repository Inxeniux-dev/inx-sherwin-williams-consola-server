$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});



const addMark = () =>
{
    let marca = $("#marca");   
    let error = 0;
    error += valid_imputs([marca]);
    if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

    loading_scrum();
    let url = `../../app/api/mark.php?a=1`;

    const data = new FormData();
    data.append('marca', marca.val());

    fetch(url,{method:'POST', body:data})
      .then(function(response) {return response.json();})
      .then(function(data) { console.log(data);
        const { code, status }  = data;
          if(code == 201)
          {
            showModalMessageError("success", "Marca Agregada Correctamente", 2300);
            setTimeout(function(){ window.location =`../` }, 2300);
            return;
          }
          statusHTTP(data, "../../");
          stop_scrum();
      })
      .catch(function(err) { stop_scrum(); console.log(err); });

}