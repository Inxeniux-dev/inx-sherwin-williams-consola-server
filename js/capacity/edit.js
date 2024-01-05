$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});


const updateCapacity = () =>
{

    let id = $("#id_capacity").val();
    let key = $("#key"); 
    let capacity = $("#capacity"); 
    let unidad = $("#unidad");
    let type = $("#type");

    let error = 0;
    error += valid_imputs([key, capacity, unidad, type]);
    error += valid_numeric_positive([capacity]);
    error += valid_no_cero([type, key]);
    if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

    loading_scrum();
    let url = `../../../app/api/capacity.php?a=2`;

    const data = new FormData();
    data.append('id', id);
    data.append('key', key.val());
    data.append('capacity', capacity.val());
    data.append('unidad', unidad.val());
    data.append('type', type.val());

    fetch(url,{method:'POST', body:data})
      .then(function(response) {return response.json();})
      .then(function(data) { console.log(data);
        const { code, status }  = data;
          if(code == 201)
          {
            showModalMessageError("success", "Capacidad Actualizada Correctamente", 2300);
            setTimeout(function(){ window.location =`../../` }, 2300);
            return;
          }
          statusHTTP(data, "../../");
          stop_scrum();
      })
      .catch(function(err) { stop_scrum(); console.log(err); });

}