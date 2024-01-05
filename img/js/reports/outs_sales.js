$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    getIguals(1);
});


$(".table-iguals").on("click",".pag-number", function(){
    getIguals($(this).attr("data"));
});

$("#dateInitial").change(function(){getIguals(1); });
$("#dateFinaly").change(function(){getIguals(1); });
$("#btn-search").click(function(){getIguals(1); });

function getIguals(page)
{   loading_scrum();
    $(".r-pdf").attr("href", `javascript:void(0);`);
    $(".table-sales").html("<h5 class = 'text-primary'>Buscando ...</h5>");
    let fechini = $("#dateInitial").val();
    let fechfin = $("#dateFinaly").val();
    let url = `../../app/api/reports.php?a=2&&page=${page}&&fechini=${fechini}&&fechfin=${fechfin}`;

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();

      if(data.code == 200)
      {
          $(".table-sales").html(data.data);
          $(".r-pdf").attr("href", `../../report/outsSales/${fechini}/${fechfin}/`);
      }

    })
    .catch(function(err) {
        stop_scrum(); console.log(err); $(".table-sales").html("<h5 class = 'text-danger'>Error</h5>");
    });

}
