$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});

var IDCLIENT = 0;

$(".table-iguals").on("click",".pag-number", function(){
    getSales($(this).attr("data"));
});

$("#dateInitial").change(function(){getSales(1); });
$("#dateFinaly").change(function(){getSales(1); });
$(".btn-search").click(function(){getSales(1); });

function getSales(page)
{   loading_scrum();
    $(".r-pdf").attr("href", `javascript:void(0);`);
    $(".table-sales").html("<h5 class = 'text-primary'>Buscando ...</h5>");
    let fechini = $("#dateInitial").val();
    let fechfin = $("#dateFinaly").val();
    let url = `../../app/api/reports.php?a=3&&page=${page}&&fechini=${fechini}&&fechfin=${fechfin}&&idcliente=${IDCLIENT}`;

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();

      if(data.code == 200)
      {
          $(".table-sales").html(data.data);
          $(".r-pdf").attr("href", `../../report/salesByClientAcum/${fechini}/${fechfin}/${IDCLIENT}/`);
          $(".r-xls").attr("href", `../../reportExcel/salesByClientAcum/${fechini}/${fechfin}/${IDCLIENT}/`);
      }

    })
    .catch(function(err) {
        stop_scrum(); console.log(err); $(".table-sales").html("<h5 class = 'text-danger'>Error</h5>");
    });

}






function addCustomer(rfc, name, id)
{
   IDCLIENT = id;
   $("#exampleModal").modal("hide");
   $(".t-client").html(`<b>${name}</b> &nbsp;&nbsp; <i class="fas fa-trash hand" title = 'Quitar Cliente' onclick = 'delCustomer();'></i>`);
   getSales(1);
}

function delCustomer()
{
    IDCLIENT = 0;
    $(".t-client").html(`<b>Todos los clientes</b>`);
    getSales(1);
}


  $(".btn-clients").click(() => {  $(".table-modal-customers").html("Consultando..."); get_list(1); });
  $('#searchCustomer').keyup(delay(function (e) {
      get_list(1);
  }, 500));

  $("#btn-search-customer").click(()=>{ get_list(1); });
  $("#typeCustomer").change(()=> { get_list(1); });


  function get_list(page)
  {   IDCLIENT = 0;
      let search = $("#searchCustomer").val();
      let type = document.getElementById("typeCustomer").value;
      let url =  `../../app/api/customer.php?a=5&&page=${page}&&type=${type}&&search=${search}`;

      fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) {
          stop_scrum();
          $(".table-modal-customers").html(data.data);
      })
      .catch(function(err) {
          stop_scrum(); console.log(err);
      });
  }


  $(".table-modal-customers").on("click",".pag-number", function(){
      get_list($(this).attr("data"));
  });


$("#sale_option").change(function(){
    GRUPO_REPORTE = $(this).val();
    getSales(1);
});


function delay(callback, ms) {
    var timer = 0;
    return function() {
      var context = this, args = arguments;
      clearTimeout(timer);
      timer = setTimeout(function () {
        callback.apply(context, args);
      }, ms || 0);
    };
  }
