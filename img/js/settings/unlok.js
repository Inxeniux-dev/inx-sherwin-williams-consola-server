$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
});



$(".btn-unlok").click(() =>{

  let key = $("#code_key");
  let md5 = $("#md5_key").val();
  let err = 0;
  err += valid_imputs([key]);
  if(err > 0){ showModalMessageError("warning", "Verifica los campos en rojo", 2000); }


  loading_scrum();

  let url = `../../app/api/settings.php?a=12`;
  const data = new FormData();
  data.append('code_key', key.val());
  data.append('md5_key', md5);

  fetch(url,{method:'POST', body: data})
      .then(function(response) {return response.json();})
      .then(function(data) {
      console.log(data);
      if(data.code == 200)
      {
          if(data.status)
          {
              showModalMessageError("success", "El sistema ha sido desbloqueado", 2200);
              setTimeout(function(){ window.location = '../../sales/create/' }, 2400);
              $("#code_key").val("");
          }
      }
      stop_scrum();
      statusHTTP(data, "../../");

      })
      .catch(function(err) {
          stop_scrum(); console.log(err);
      });



});
