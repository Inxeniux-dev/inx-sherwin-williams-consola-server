$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });
});


$(".btn-upd").click(function(){

    let discount = $("#discount");
    let err = 0;
    err += valid_imputs([discount]);
    err += valid_numeric_positive([discount]);

    if(err > 0){ showModalMessageError("warning", "Verifique campos en rojo", 3000); return; }

    let url = `../../../app/api/customer.php?a=6`;
    const data = new FormData();
    data.append('discount', discount.val());
    data.append('identified', identified);

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
        if(data.code == 201)
        {
          if(data.status)
          {
              showModalMessageError("success", "Descuento actualizado", 2500);
              $(".lbl-discount").html("<b>"+discount.val()+"% </b>");
              return;
          }
        }
        statusHTTP(data, "../../");
    })
    .catch(function(err) {
        console.log(err);
    });

});
