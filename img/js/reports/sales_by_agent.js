$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    getSales(1);
});


$(".table-iguals").on("click",".pag-number", function(){
    getSales($(this).attr("data"));
});

$("#dateInitial").change(function(){getSales(1); });
$("#dateInitial").change(function(){getSales(1); });
$("#btn-search").click(function(){getSales(1); });

function getSales(page)
{   loading_scrum();
    $(".r-pdf").attr("href", `javascript:void(0);`);
    $(".table-sales").html("<h5 class = 'text-primary'>Buscando ...</h5>");
    let fechini = $("#dateInitial").val();
    let fechfin = $("#dateFinaly").val();
    let id_agent = 1;

    let url = url_global_api+`sales/sales_by_agent.php?&&key=${api_key}&&fechini=${fechini}&&fechfin=${fechfin}&&idagent=${id_agent}`;

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
                            <th>Sucursal</th>
                            <th>%</th>
                            <th>Cliente</th>
                            <th style = 'text-align:left;'>Factura</th>
                            <th>f/Factura</th>
                            <th>f/Pago</th>
                            <th style = 'text-align:right;'>Días de C</th>
                            <th style = 'text-align:right;'>Importe</th>
                            <th style = 'text-align:right;'>sin IVA</th>
                        </thead>
                        <tbody>`;

          for(let x = 0; x < data.data.length; x++)
          {
              let datos = data.data[x];
              console.log(datos);

              let sucursal = data.data[x].sucursal;
              let ventas = data.data[x].ventas;


              for(let y = 0; y < ventas.length; y++)
              {
                  let venta = ventas[y];
                  console.log(venta);

                    output += `<tr>
                                  <td>${sucursal}</td>
                                  <td>${venta.descuentos}%</td>
                                  <td>${venta.cliente}</td>
                                  <td align = 'center'>${venta.folio_factura}</td>
                                  <td align = 'center'>${venta.fecha_de_factura}</td>
                                  <td align = 'center'>${venta.fecha_pago}</td>
                                  <td align = 'center'>${venta.dias}</td>
                                  <td align = 'right'>$${venta.total}</td>
                                  <td align = 'right'>$${venta.sin_iva}</td>
                              </tr>`;

              }

          }


          output += `</tbody></table>`;

          $(".table-sales").html(output);
          $(".r-pdf").attr("href", `../../report/sales_by_agent/${id_agent}/${fechini}/${fechfin}/`);
      }

    })
    .catch(function(err) {
        stop_scrum(); $(".table-sales").html("<h5 class = 'text-danger'>Error</h5>"); console.log(err);
    });
}
