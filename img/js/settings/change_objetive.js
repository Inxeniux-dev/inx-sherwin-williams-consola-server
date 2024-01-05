$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    console.log("read");
});



$(".btn-upd").click(function(){
    let days = $("#days");
    let objetivo = $("#objetivo");

    let error = 0;
    error += valid_imputs([days, objetivo]);
    error += valid_numeric_positive([days, objetivo]);
    error += valid_no_cero([days, objetivo]);


    if(error > 0){   showModalMessageError("error", "Verifique campos en rojo", 3000); return; }

    let url = `../../app/api/settings.php?a=13`;
    const data = new FormData();
    data.append('days', days.val());
    data.append('objetivo', objetivo.val());
    data.append('mes', $("#mes").val());
    data.append('anio', $("#anio").val());

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
        if(data.code == 201)
        {
          if(data.status)
          {
              showModalMessageError("success", "Objetivo actualizado", 2500);
              return;
          }
        }
        statusHTTP(data, "../../");
    })
    .catch(function(err) {
        console.log(err);
    });



});
