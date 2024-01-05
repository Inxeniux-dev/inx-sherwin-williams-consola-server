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

    let url = url_global_api+`sales/operation_days_global.php?&&key=${api_key}&&month=${month}&&year=${year}&&location=${location}`;

    console.log(url);

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();

      if(data.code == 200)
      {

        let output = `<table class = 'table table-hover table-sm'>
                        <thead>
                            <td><b>Sucursal</b></td>
                            <td><b>f/Sucursal</b></td>
                            <td align = 'right'><b>t/ventas (Cont + Cred)</b></td>
                            <td align = 'right'><b># Tickets</b></td>
                            <td align = 'right'><b>Tic. Promedio</b></td>
                            <td align = 'right'><b>d/Trabajados</b></td>
                            <td align = 'right'><b>v/prom. diaria</b></td>
                            <td align = 'right'><b>t/Articulos</b></td>
                            <td align = 'right'><b>t/Por Tiket</b></td>
                        </thead>
                        <tbody>`;

                        for(let x = 0; x < data.data.length; x++)
                        {     let row = data.data[x];

                                 output += `<tr>
                                                <td>${row.sucursal}</td>
                                                <td>${row.corte}</td>
                                                <td align = 'right'>$${row.importe}</td>
                                                <td align = 'right'>${row.comandas}</td>
                                                <td align = 'right'>${row.tiket_promedio}</td>
                                                <td align = 'right'>${row.dias}</td>
                                                <td align = 'right'>$${row.venta_promedio}</td>
                                                <td align = 'right'>${row.items}</td>
                                                <td align = 'right'>${row.articulo_por_tiket}</td>
                                           </tr>`;
                        }


                        output += `</tbody></table>`;

          $(".table-sales").html(output);
          $(".r-xls").attr("href", `../../reportExcel/operation_days_global/${month}/${year}/${location}/`);
      }

    })
    .catch(function(err) {
        stop_scrum(); $(".table-sales").html("<h5 class = 'text-danger'>Error</h5>"); console.log(err);
    });
}
