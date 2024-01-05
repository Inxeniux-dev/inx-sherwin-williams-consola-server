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
    let fechini = $("#dateInitial").val();
    let fechfin = $("#dateFinaly").val();
    let url = `../../app/api/reports.php?a=1&&page=${page}&&fechini=${fechini}&&fechfin=${fechfin}`;

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();

      if(data.code == 200)
      {
          $(".table-iguals").html(data.data);
          $(".r-pdf").attr("href", `../../report/iguals/${fechini}/${fechfin}/`);
          $(".r-xls").attr("href", `../../reportExcel/iguals/${fechini}/${fechfin}/`);
      }

    })
    .catch(function(err) {
        stop_scrum(); console.log(err);
    });

}
