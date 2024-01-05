$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    detail();
});


function detail()
{
    loading_scrum('Sincronizando, espere...');

    let id = $("#idf").val();
    let doc = $("#doc").val();
    let factura = $("#factura").val();
    let idalmacen = $("#idalmacen").val();

    let url = `../../../app/api/invoice.php?a=4&id=${id}&doc=${doc}&factura=${factura}&idalmacen=${idalmacen}`;

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();
      const {code, status, output, error } = data;
      if(code == 201)
      {
        console.log(output);
          $(".table-codes").html(output);
      }
    })
    .catch(function(err) { stop_scrum(); console.log(err); });
}
