$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    getEdoCuenta();
});

$("#mes").change(()=>{ getEdoCuenta(); });
$("#anio").change(()=>{ getEdoCuenta(); });

function getEdoCuenta()
{
    $(".table-edo-cta").html("");
    let month = $("#mes").val();
    let year = $("#anio").val();

    if(month <= 0 || year <= 0){ return; }

    loading_scrum();
    let url = `../../../app/api/credit.php?a=5&&identified=${identified}&&month=${month}&&year=${year}`;

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      stop_scrum();
        console.log(data);

        if(data.code == 200)
        {
          if(data.status)
          {
            $(".table-edo-cta").html(data.data);
            $(".r-pdf").attr("href", `../../../report/edoCta/${identified}/${month}/${year}/`);
            return;
          }
        }
        statusHTTP(data, "../../");
    })
    .catch(function(err) {
        stop_scrum(); console.log(err);
    });

}
