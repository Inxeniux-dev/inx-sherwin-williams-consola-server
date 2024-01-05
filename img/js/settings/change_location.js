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



$(".location").change(function()
{
  let location = $(this).val();

  if(location > 0)
  {

      let url = `../../app/api/settings.php?a=11`;
      const data = new FormData();
      data.append('location', location);

      fetch(url,{method:'POST', body:data})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
          if(data.code == 201)
          {
            if(data.status)
            {
                showModalMessageError("success", "Cambio de Sucursal", 2500);
                setTimeout(function(){ window.location = './' }, 2600);
                return;
            }
          }
          statusHTTP(data, "../../");
      })
      .catch(function(err) {
          console.log(err);
      });
  }

});
