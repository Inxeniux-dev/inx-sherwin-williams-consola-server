$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $("#content").toggleClass("active");
    });
    console.log("read");
    getLine(1);
});


function getLine(page)
{
    let search = $("#search").val();
    let url = `../../app/api/line.php?a=2&&page=${page}&&search=${search}`;
    loading_scrum();
    $(".table-order").html("");

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
        stop_scrum();
        if(data.code == 200)
        {
            $(".table-lines").html(data.data);
            return;
        }
        statusHTTP(data, "../../");
    })
    .catch(function(err) {
        stop_scrum(); console.log(err); $(".table-order").html("<div class='alert alert-danger'>Error</div>");
    });
}

$(".table-lines").on("click",".pag-number", function(){
    getLine($(this).attr("data"));
});


$("#btn-search").click(()=>{ getLine(1); });
$("#search").keyup(()=>{ getLine(1); });



$(".btn-sync").click(function(){
      loading_scrum();
      let url = `../../app/api/line.php?a=1`;
      fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
          stop_scrum();
          if(data.code == 200)
          {
              alertMessage("success", data.msg, "Aceptar", false, "");
              getLine(1);
          }
          statusHTTP(data, "../../");
      })
      .catch(function(err) {
          stop_scrum(); console.log(err); $(".table-order").html("<div class='alert alert-danger'>Error</div>");
      });
});
