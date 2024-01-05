$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});



const editLine = () =>
{ 

    let id = $("#id_line").val();
    let key = $("#key"); 
    let linea = $("#linea"); 
    let tipo = $("#tipo");
    let igualado = $("#igualado");
    let conversion = $("#conversion");

    let error = 0;
    error += valid_imputs([key, linea, tipo, igualado, conversion]);
    error += valid_no_cero([tipo, key]);
    if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

    loading_scrum();
    let url = `../../../app/api/line.php?a=2`;

    const data = new FormData();
    data.append('id', id);
    data.append('key', key.val());
    data.append('linea', linea.val());
    data.append('tipo', tipo.val());
    data.append('igualado', igualado.val());
    data.append('conversion', conversion.val());

    fetch(url,{method:'POST', body:data})
      .then(function(response) {return response.json();})
      .then(function(data) { console.log(data);
        const { code, status }  = data;
          if(code == 201)
          {
            showModalMessageError("success", "Línea Modificada Correctamente", 2300);
            setTimeout(function(){ window.location =`../../` }, 2300);
            return;
          }
          statusHTTP(data, "../../");
          stop_scrum();
      })
      .catch(function(err) { stop_scrum(); console.log(err); });

}