$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});


$(".table-iguals").on("click",".pag-number", function(){
    getSales($(this).attr("data"));
});

$("#dateInitial").change(function(){getOperation(1); });
$("#dateInitial").change(function(){getOperation(1); });
$(".btn-search").click(function(){getOperation(1); });

function getOperation(page)
{   loading_scrum();
    $(".r-xls").attr("href", `javascript:void(0);`);
    $(".table-sales").html("<h5 class = 'text-primary'>Buscando ...</h5>");
    let month = $("#month").val();
    let year = $("#year").val();
    let location = $("#location").val();

    let url = url_global_api+`sales/operation_days.php?&&key=${api_key}&&month=${month}&&year=${year}&&location=${location}&&json_only=0`;

    console.log(url);

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();

      if(data.code == 200)
      {
          $(".table-sales").html(data.output);
          $(".r-xls").attr("href", `../../reportExcel/operation_days/${month}/${year}/${location}/`);
      }

    })
    .catch(function(err) {
        stop_scrum(); $(".table-sales").html("<h5 class = 'text-danger'>Error</h5>"); console.log(err);
    });
}
