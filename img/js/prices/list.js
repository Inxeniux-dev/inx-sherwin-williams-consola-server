$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    getChanges(1);
});



$(".btn-search").click(function(){ getChanges(1); });

$(".table-prices").on("click",".pag-number", function(){
    getChanges($(this).attr("data"));
});

  function getChanges(page){
      $(".table-prices").html("");
      loading_scrum();

      let fechini = $("#fechini").val();
      let fechfin = $("#fechfin").val();

      let url = `../../app/api/price.php?a=3&&page=${page}&&fechini=${fechini}&&fechfin=${fechfin}`;

      fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
        stop_scrum();
        if(data.code == 200)
        {
            $(".table-prices").html(data.data);

            $(".r-pdf").attr("href", "../../report/prices/"+fechini+"/"+fechfin+"/");
            $(".r-xls").attr("href", "../../reportExcel/prices/"+fechini+"/"+fechfin+"/");
        }

      })
      .catch(function(err) { stop_scrum(); console.log(err); });
}
