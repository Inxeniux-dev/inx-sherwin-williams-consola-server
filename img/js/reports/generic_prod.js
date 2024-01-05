$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});


$(".btn-search").click(function(){getConcentrate(); });

function getConcentrate()
{

  $(".table-prods").html("");
  $(".r-pdf").attr("href", `#`);
  $(".r-xls").attr("href", `#`);

  loading_scrum();
    let dateFinaly = $("#dateFinaly").val();
    let location = $("#location").val();

    let url = `../../app/api/reports.php?a=7&&date=${dateFinaly}&&location=${location}`;

    console.log(url);

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();
      if(data.code == 200)
      {
        $(".table-prods").html(data.data);
        $(".r-pdf").attr("href", `../../report/genericProd/${dateFinaly}/${location}/`);
        $(".r-xls").attr("href", `../../reportExcel/genericProd/${dateFinaly}/${location}/`);
      }
    })
    .catch(function(err) {
        stop_scrum();  console.log(err);
    });
}
