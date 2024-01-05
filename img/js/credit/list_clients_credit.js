$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    getClients(1);
});

$(".table-clients").on("click",".pag-number", function(){
    getClients($(this).attr("data"));
});

$("#btn-search").click(function(){
    getClients(1);
});

$("#type").change(function(){
    getClients(1);
});

function getClients(page)
{   loading_scrum();

    let input = $("#search").val();
    let type = $("#type").val();
    let url = `../../app/api/credit.php?a=3&&page=${page}&&type=${type}&&input=${input}`;

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      stop_scrum();
      $(".table-clients").html(data.data);
    })
    .catch(function(err) {
        stop_scrum(); console.log(err);
    });

}
