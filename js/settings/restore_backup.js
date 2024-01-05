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
  
  loading_scrum("SOLICITUD INICIADA, ESPERANDO RESPUESTA DEL SERVIDOR...");
    let url = `../../app/api/settings.php?a=15`;
    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);

        if(data.code == 201)
        {
            showModalMessageError("success", data.msg, 2000);
            setTimeout(function(){ window.location = "../backup/"; }, 2000);
            stop_scrum();
            return;
        }

        stop_scrum();
        statusHTTP(data, "../../");
    })
    .catch(function(err) {
        console.log(err);
        stop_scrum();
    });
});
