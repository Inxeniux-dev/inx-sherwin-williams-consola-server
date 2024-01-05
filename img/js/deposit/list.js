$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
      $("#sidebar").toggleClass("active");
      $(".content").toggleClass("active");
    });
    console.log("read");
    getList();
});


function getList()
{   $(".r-pdf").attr("href", "javascript:void(0);");
    $(".r-xls").attr("href", "javascript:void(0);");
    let ini = document.getElementById("dateIni").value;
    let fin = document.getElementById("dateFin").value;
    let account = document.getElementById("account").value;
    loading_scrum();
    $(".table-deposit").html("");
    fetch(`../../app/api/deposit.php?a=1&&fechini=${ini}&&fechfinal=${fin}&&account=${account}`, {
            method: 'GET'
        })
        .then(function(response) {
        if(response.ok) {
            return response.json()
        }
        })
        .then(function(data) {
          stop_scrum();
            if(data.code == 200)
            {
                $(".table-deposit").html(data.data);
                $(".r-pdf").attr("href", `../../report/deposit/${ini}/${fin}/${account}/`);
                $(".r-xls").attr("href", `../../reportExel/deposit/${ini}/${fin}/${account}/`);
            }
            else
            {
                  $(".table-deposit").html("<div class = 'alert alert-danger'>Error</div>");
            }
        })
        .catch(function(err) {
          stop_scrum();
        console.log(err);
        $(".table-deposit").html("<div class = 'alert alert-danger'>Error</div>");
     });
}


$("#btn-search").click(()=>{ getList(); });
