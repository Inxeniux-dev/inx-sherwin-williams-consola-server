$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});



$(".btn-search").click(function(){
      loading_scrum();
      $(".table-tansfer").html("");
      $(".r-pdf").attr("href", "javascript:void(0);");

      let fechini = $("#fechini").val();
      let fechfin = $("#fechfin").val();
      let view = $("#view").val();

      let url = url_global_api+`transfer/review_list.php?&&key=${api_key}&&fechini=${fechini}&&fechfin=${fechfin}&&view=${view}`;
      console.log(url);
      fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
        stop_scrum();

        if(data.code == 200)
        {
              $(".table-tansfer").html(output_table(data.transfer));
              $(".r-pdf").attr("href", `../../report/transferReview/${fechini}/${fechfin}/${view}/`);
              $(".r-xls").attr("href", `../../reportExcel/transferReview/${fechini}/${fechfin}/${view}/`);
        }

      })
      .catch(function(err) {
          stop_scrum(); console.log(err); $(".d-result").html(`<h5 class = 'text-danger'>Error</h5>`);
      });

});


function output_alert(data)
{
    return `<div class="alert ${data.class}">${data.message}</div>`;
}

function output_table(data)
{
  let output = `<table class = 'table table-hover table-sm'>
                  <thead>
                      <th>Entrada Faltante</th>
                      <th>Fecha Recibido</th>
                      <th style = 'text-align:right;'>Importe</th>
                      <th style = 'text-align:right;'>Sucursal de Salida</th>
                      <th style = 'text-align:center;'>Folio Vale</th>
                      <th>Fecha de Salida</th>
                      <th style = 'text-align:right;'>Importe de Salida</th>
                      <th>Estatus</th>
                  </thead>
                  <tbody>`;

                for(let x = 0; x < data.length; x++)
                {
                    output += `<tr class = '${data[x]["css_class"]}'>
                                    <td>${data[x]["sucursal_entrada"]}</td>
                                    <td>${data[x]["fecha_ent"]}</td>
                                    <td align = 'right'>$${data[x]["total_entrada"]}</td>
                                    <td align = 'right'>${data[x]["sucursal"]}</td>
                                    <td align = 'center'><b>${data[x]["serie"]}-${data[x]["folio"]}</b></td>
                                    <td>${data[x]["fecha_sal"]}</td>
                                    <td align = 'right'>$${data[x]["total"]}</td>
                                    <td align = 'right'>${data[x]["msg"]}</td>
                              </tr>`;
                }

      output += `</table>`;

  return output;
}
