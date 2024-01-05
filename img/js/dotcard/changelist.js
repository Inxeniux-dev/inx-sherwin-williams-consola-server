$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    getChanges(1);
});


$("#dateInitial").change(()=>{ getChanges(1); });
$("#dateFinaly").change(()=>{ getChanges(1); });
$("#btn-search").click(()=>{ getChanges(1); });
$(".table-changes").on("click",".pag-number", function(){
    getChanges($(this).attr("data"));
});

function getChanges(page)
{   loading_scrum();
    let fechini = document.getElementById("dateInitial").value;
    let fechfin = document.getElementById("dateFinaly").value;
    let url = `../../app/api/dotcard.php?a=2&&fechini=${fechini}&&fechfin=${fechfin}&&page=${page}`;

    fetch(url,{method:'GET'})
    .then(function(response) {return response.text();})
    .then(function(data) {
      stop_scrum();
      $(".table-changes").html(data);
      $(".r-pdf").attr("href", "../../report/changelist/"+fechini+"/"+fechfin+"/");
    })
    .catch(function(err) {
        stop_scrum(); console.log(err);
    });

}
