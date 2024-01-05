$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
});



$("#btn-search").click(function(){
    search();
});

$("#code").keyup(function(e){
      if(e.which == 13) {
          search();
      }
});

function search(){
  let codigo = $("#code");
  let err = 0;
  err+= valid_imputs([codigo]);

  if(err > 0){ showModalMessageError("warning", "Verifica los campos en rojo", 1800); return; }

  loading_scrum();
  $(".table-codes").html("");
  let url = `../../app/api/item.php?a=5`;
  const data = new FormData();
  data.append('code', codigo.val());

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) {
    console.log(data);
      stop_scrum();
      if(data.code == 201)
      {
          $(".table-codes").html(data.data);
      }
      statusHTTP(data, "../../");
  })
  .catch(function(err) {
      stop_scrum(); console.log(err); $(".table-codes").html("<div class='alert alert-danger'>Error</div>");
  });
}
