$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});



$(".btn-update").click(function()
{
  console.log("Restaurando ....");
  
      let url = `../../app/api/settings.php?a=15`;
      fetch(url,{method:'GET'})
      .then(function(response) {return response.text();})
      .then(function(data) {
        console.log(data);

          if(data.code == 201)
          {

              return;
          }

          statusHTTP(data, "../../");
      })
      .catch(function(err) {
          console.log(err);
      });
});
