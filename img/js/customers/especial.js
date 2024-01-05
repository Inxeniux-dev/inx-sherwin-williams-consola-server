$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });
});


$(".btn-upd").click(function(){

    let especial = $("#especial").val();
    let err = 0;
    if(especial == null || (especial < 0 && especial > 1))
    {
        showModalMessageError("warning", "La opción seleccionada es incorrecta", 3000); return;
    }

    let url = `../../../app/api/customer.php?a=7`;
    const data = new FormData();
    data.append('especial', especial);
    data.append('identified', identified);

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
        if(data.code == 201)
        {
          if(data.status)
          {
              showModalMessageError("success", "Precio especial actualizado", 2500);
              $(".lbl-especial").html(especial == 1 ? "<b>Si</b>" : "<b>No</b>");
              return;
          }
        }
        statusHTTP(data, "../../");
    })
    .catch(function(err) {
        console.log(err);
    });

});
