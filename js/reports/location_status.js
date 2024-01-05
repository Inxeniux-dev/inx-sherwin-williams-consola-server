$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});

$(".btn-search").click(function(){getConcentrate(); });

function getConcentrate()
{   loading_scrum();
    $(".r-xls").attr("activate", false);
    DATA_JSON = null;
    $(".table-concentrado").html("<h5 class = 'text-primary'>Buscando ...</h5>");
    let dateFinaly = $("#dateFinaly").val();
    let location = $("#location").val();

    let url = url_global_api+`location/version.php?&&key=${api_key}&&date=${dateFinaly}&&location=${location}`;

    console.log(url);

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();

      if(data.code == 200)
      {
          generaHTML(data.data);
      }

    })
    .catch(function(err) {
        stop_scrum(); $(".table-sales").html("<h5 class = 'text-danger'>Error</h5>"); console.log(err);   $(".table-concentrado").html(err);
    });
}



function generaHTML(data)
{

  let output = `<table class = 'table table-hover table-sm'>
                  <thead>
                      <th><b>Sucursal</b></th>
                      <th><b>Fecha Corte</b></th>
                      <th style = 'text-align:right'><b>Versión</th>
                      <th style = 'text-align:right'></th>
                  </thead>
                  <tbody>`;
                  for(let x = 0; x < data.length; x++)
                  {
                    let row = data[x];

                    let icon = '';
                    if(row.desface == 1)
                    {
                      icon = '<i class="fas fa-exclamation-triangle text-warning"></i>';
                    }

                    output += `<tr>
                                <td>${row.sucursal}</td>
                                <td>${row.corte}</td>
                                <td align = 'right'>${row.version}</td>
                                <td align = 'right'>${icon} ${row.msg}</td>
                              </tr>`;
                  }

     output += `</tbody></table>`;


  $(".table-location").html(output);
}
