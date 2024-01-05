$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");

    getData();
});

$(".btn-search").click(function(){getData(); });


function getData()
{   loading_scrum();
    $(".table-concentrado").html("<h5 class = 'text-primary'>Buscando ...</h5>");
    let fechini = $("#dateInitial").val();
    let fechfin = $("#dateFinaly").val();
    let location = $("#location").val();

    let url = url_global_api+`sales/cancel_sales.php?&&key=${api_key}&&fechini=${fechini}&&fechfin=${fechfin}&&location=${location}`;

    console.log(url);

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();
      if(data.code == 200)
      {
          $(".table-sales").html(genera_html(data.data));
          $(".r-pdf").attr("href", `../../reportExcel/sales_canceled/${fechini}/${fechfin}/${location}/`);
          $(".r-pdf").attr("href", `../../report/sales_canceled/${fechini}/${fechfin}/${location}/`);
      }

    })
    .catch(function(err) {
        stop_scrum(); $(".table-sales").html("<h5 class = 'text-danger'>Error</h5>"); console.log(err);;
    });
}

function genera_html(data)
{
  console.log(data);
    let output = `<table class = 'table table-hover table-sm'>
                  <thead>
                      <th>Folio</th>
                      <th>Fecha</th>
                      <th>Cliente</th>
                      <th align = 'right'>Total</th>
                  </thead>
                  <tbody>`;

                  for(let x = 0; x < data.length; x++)
                  {     let row = data[x];

                    output += `<tr class = 'table-info'>
                                   <td colspan = '4'><b>${row.sucursal}</b></td>
                               </tr>`;
                        let total = 0;
                        for(let y = 0; y< row.data.length; y++)
                        {
                          let value = row.data[y];
                          output += `<tr>
                                         <td>${value.serie}-${value.folio}</td>
                                         <td>${value.fecha}</td>
                                         <td><b>${value.rfc}</b><br>${value.cliente}</td>
                                         <td align = 'right'>$${value.total}</td>
                                     </tr>`;
                            total += parseFloat(value.total.replace(",", ""));
                        }

                        total = number_format(total, 2);
                    output += `<tr>
                                   <td colspan = '3'></td><td align = 'right'><b>$${total}</b></td>
                               </tr>`;

                  }

    output += `</tbody></table>`;
  return output;
}
