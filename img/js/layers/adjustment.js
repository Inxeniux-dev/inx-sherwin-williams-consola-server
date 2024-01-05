$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $("#content").toggleClass("active");
    });
    console.log("read");
});



$(".btn-confirm").click(function(){
  console.log("click");
  loading_scrum();
  let url = `../app/api/layers.php?a=1`;
  const data = new FormData();
  data.append('adj', 'ok');
  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) {
      if(data.code == 200)
      {
        showModalMessageError("success", "¡Ajuste de capas finalizado!", 2500);
      }

      stop_scrum();
  })
  .catch(function(err) {
      console.log(err);
      showModalMessageError("error", "¡Error al realizar la operación!", 2500);
      stop_scrum();
  });

});
