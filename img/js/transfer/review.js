$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});



$(".btn-search").click(function(){
      loading_scrum();
      $(".d-result").html("");
      $(".d-info").html("");
      $(".d-result-search").html("");

      let suc = $("#sucursal").val();
      let type = $("#type").val();
      let serie = $("#serie").val();
      let folio = $("#folio").val();

      let url = url_global_api+`transfer/review.php?&&key=${api_key}&&type=${type}&&serie=${serie}&&folio=${folio}&&idsuc=${suc}`;
      console.log(url);
      fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
        stop_scrum();

        if(data.code == 200)
        {
            if(data.status)
            {
                if(data.existe)
                {
                  $(".d-result-search").removeClass("d-none");
                  $(".d-result").removeClass("d-none");

                  let output = output_local(data);
                  let output_search = output_searh(data);
                  let alert = output_alert(data);
                  $(".d-info").html(alert);
                  $(".d-result").html(output);
                  $(".d-result-search").html(output_search);
                }
                else {
                    let alert = output_alert(data);
                    $(".d-info").html(alert);
                    $(".d-result-search").addClass("d-none");
                    $(".d-result").addClass("d-none");
                }
            }
            else {
                $(".d-info").html(`<div class = 'alert alert-warning'><b>${data.message}</div></div>`);
            }
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

function output_local(data)
{
  return `<div class="row ">
                        <div class="col-md-12">
                          <h5 class = 'text-info'><b>Detalles del Vale a Buscar</b></h5>
                        </div>
                        <div class="col-md-6 col-12">
                              <div class="table-responsive  mt-3">
                                    <table class="table  table-sm">
                                        <tbody>
                                        <tr>
                                            <td class="spacing">Sucursal:</td>
                                            <td class=" spacing" align = "right"><b>${data.data.sucursal}</b></td>
                                        </tr>
                                          <tr>
                                              <td class="spacing">Fecha:</td>
                                              <td class=" spacing" align = "right"><b>${data.data.fecha}</b></td>
                                          </tr>
                                        </tbody>
                                    </table>
                              </div>
                        </div>
                        <div class="col-md-6 col-12">
                              <div class="table-responsive  mt-3">
                                    <table class="table  table-sm">
                                        <tbody>
                                        <tr>
                                            <td class="spacing">Tipo:</td>
                                            <td class=" spacing" align = "right"><b>${data.data.tipo}</b></td>
                                        </tr>
                                          <tr>
                                              <td class="spacing">Total:</td>
                                              <td class=" spacing" align = "right"><b>$ ${data.data.total}</b></td>
                                          </tr>
                                        </tbody>
                                    </table>
                              </div>
                        </div>
                  </div>`;
}

function output_searh(data)
{
  return `<div class="row ">
                        <div class="col-md-12">
                            <h5 class = 'text-info'><b>Detalles del Vale Encontrado</b></h5>
                        </div>
                        <div class="col-md-6 col-12">
                              <div class="table-responsive  mt-3">
                                    <table class="table  table-sm">
                                        <tbody>
                                          <tr>
                                              <td class="spacing">Sucursal:</td>
                                              <td class=" spacing" align = "right"><b>${data.data_search.sucursal}</b></td>
                                          </tr>
                                          <tr>
                                              <td class="spacing">Fecha:</td>
                                              <td class=" spacing" align = "right"><b>${data.data_search.fecha}</b></td>
                                          </tr>
                                        </tbody>
                                    </table>
                              </div>
                        </div>
                        <div class="col-md-6 col-12">
                              <div class="table-responsive  mt-3">
                                    <table class="table  table-sm">
                                        <tbody>
                                          <tr>
                                              <td class="spacing">Tipo de Vale:</td>
                                              <td class=" spacing" align = "right"><b>${data.data_search.tipo}</b></td>
                                          </tr>
                                          <tr>
                                              <td class="spacing">Total:</td>
                                              <td class=" spacing" align = "right"><b>$ ${data.data_search.total}</b></td>
                                          </tr>
                                        </tbody>
                                    </table>
                              </div>
                        </div>
                  </div>`;
}
