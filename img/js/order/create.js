$("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");

});



$("#location").change(function()
{
    let location = $(this).val();
    let type =$(this).find(':selected').attr("data-t");
    console.log(type);
    if(type == 1)
    {
      $("#sugerido").removeAttr("disabled");
    }
    else {
      $("#sugerido").val(0);
      $("#sugerido").attr("disabled", true);
    }
});


$("#sugerido").change(function(){
    let tipo = $(this).val();
    if(tipo == 1)
    {
        $(".d-date").removeClass("d-none");
    }
    else {
        $(".d-date").addClass("d-none");
    }
});


$("#btn-next").click(function()
{
    loading_scrum();
      let location = $("#location").val();
      let sugerido = $("#sugerido").val();
      let dateini = $("#dateini");
      let datefin = $("#datefin");
      let err = 0;
      err += valid_imputs([dateini, datefin]);

      if(err > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

      let url = `../../app/api/order.php?a=2`;

      const data = new FormData();
      data.append('location', location);
      data.append('sugerido', sugerido);
      data.append('dateini', dateini.val());
      data.append('datefin', datefin.val());

      fetch(url,{method:'POST', body:data})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
          if(data.code == 200)
          {
            if(data.status)
            {
                showModalMessageError("success", "Pedido Creado", 2300);
                setTimeout(function(){ window.location = "../additem/"+data.id+"/" }, 2500);
                return;
            }
          }

          statusHTTP(data, "../../");
          stop_scrum();
      })
      .catch(function(err) {
          stop_scrum(); console.log(err);
      });

});
