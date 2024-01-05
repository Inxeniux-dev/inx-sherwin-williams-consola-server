$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});

function getSubmodule(module){

    loading_scrum();
    $(".table-invoice").html("");

    let url = `../../app/api/settings.php?a=4&module=${module}`;

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();
      if(data.code == 200)
      {
          $(".table-submodulo tbody").html(data.output);
      }

    })
    .catch(function(err) { stop_scrum(); console.log(err); });
}



let addSubmodulo = (submodulo, idmodulo) => {

    const url = `../../app/api/settings.php?a=5`;
    const data = new FormData();
    data.append('submodulo', submodulo);
    data.append('modulo', idmodulo);

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      const {code, status, error } = data;
      if(code == 201)
      {
          showModalMessageError("success", "Permiso del súbmodulo creado", 2300);
          $("#submodulo").val('');
          $("#modulo").val("0").change();
          getSubmodule(idmodulo);
          stop_scrum();
          return;
      }

      statusHTTP(data, "../../");
      stop_scrum();
    })
    .catch(function(err) { stop_scrum(); console.log(err); });
}


$(".btn-save").click(() => {
      let submodulo = $("#submodulo");
      let modulo = $("#modulo");
      let error = 0;
      error += valid_imputs([submodulo]);
      error += valid_numeric_positive([modulo]);
      error += valid_no_cero([modulo]);
      if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }
      modulo = modulo.val();
      submodulo = submodulo.val();
      addSubmodulo(submodulo,modulo);
});
