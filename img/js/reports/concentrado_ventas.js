$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});

var DATA_JSON = null;

$(".btn-search").click(function(){getConcentrate(); });

function getConcentrate()
{   loading_scrum();
    $(".r-xls").attr("activate", false);
    DATA_JSON = null;
    $(".table-concentrado").html("<h5 class = 'text-primary'>Buscando ...</h5>");
    let dateFinaly = $("#dateFinaly").val();
    let location = $("#location").val();

    let url = url_global_api+`closing/sales_concentrate.php?&&key=${api_key}&&date=${dateFinaly}&&location=${location}`;

    console.log(url);

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();

      if(data.code == 200)
      {
              DATA_JSON = data.data;
              send_data(data);
      }

    })
    .catch(function(err) {
        stop_scrum(); $(".table-sales").html("<h5 class = 'text-danger'>Error</h5>"); console.log(err);   $(".table-concentrado").html(err);
    });
}


function send_data(data_json)
{
    if(DATA_JSON != null)
    {
        let url = `../../reportExcel/chargin_concentrate/`;
        const data = new FormData();
        data.append('data', JSON.stringify(DATA_JSON));

        fetch(url, { method: 'POST', body: data })
        .then(function(response) {return response.text();})
        .then(function(data) {
            console.log(data);
            $(".table-concentrado").html(`<div class = 'alert alert-success'><b>La información se ha cargado correctamente</b> Ya puede generar el reporte. &nbsp; &nbsp; <b><a href = '../../reportExcel/sales_concentrate/' target="_blank"><i class="far fa-file-excel"></i> Exportar a Excel</a></b></div> <div class = 'alert alert-info'>inicio: ${data_json.time_init},  final : ${data_json.time_final}</div>`);
        })
        .catch(function(err) {
            console.log(err);
            stop_scrum();
        });
    }
};
