$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    getList(1);
});

$(".table-invoice").on("click",".pag-number", function(){
    getList($(this).attr("data"));
});


let IDF = 0;
let CO = 0;

$("#btn-search").click(function(){ getList(1); });
$("#tipo, #estatus, #proveedor, #almacen, #fechini, #fechfin").change(function(){ getList(1); });
$('#search').keyup(delay(function (e) {
    getList(1);
}, 700));


$(".table-prices").on("click",".pag-number", function(){
    getChanges($(this).attr("data"));
});

  function getList(page){
      let fechini = $("#fechini").val();
      let fechfin = $("#fechfin").val();
      let search = $("#search");
      let proveedor = $("#proveedor").val();
      let almacen = $("#almacen").val();
      let tipo = $("#tipo").val();
      let estatus = $("#estatus").val();
      let error = 0;

      if(search.val().length > 0)
      {
          error += valid_imputs([search]);
          error += valid_numeric_positive([search]);
          error += valid_no_cero([search]);
          if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }
      }

      loading_scrum();
      $(".table-invoice").html("");
      search = search.val();

      let url = `../../app/api/invoice.php?a=1&&page=${page}&fechini=${fechini}&fechfin=${fechfin}&proveedor=${proveedor}&almacen=${almacen}&estatus=${estatus}&tipo=${tipo}&search=${search}`;

      fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
        stop_scrum();
        if(data.code == 200)
        {
            $(".table-invoice").html(data.output);
            $(".r-xls").attr("href", `../../reportExcel/invoices/${fechini}/${fechfin}/${proveedor}/${almacen}/${estatus}/${tipo}/${search}/`);
        }

      })
      .catch(function(err) { stop_scrum(); console.log(err); });
}


function openModal(id, factura, doc, serie, cont)
{
    IDF = id;
    CO = cont;
    $(".d-doc").html(`Documento: <b>${doc}</b>`);
    $(".d-factura").html(`Factura: <b>${serie} ${factura}</b>`);
    $("#modalDate").modal();
    $('body').css('padding-right', '0px');
}



$(".btn-sync").click(() => {
    loading_scrum("Sincronizando Información, espere...");


    let fechini = $("#fechini").val();
    let fechfin = $("#fechfin").val();

    let url = `../../app/api/invoice.php?a=2`;

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      const {code, status, msg } = data;
      if(code == 201)
      {
          showModalMessageError("success", "Sincronización Finalizada", 2300);
          getList(1);
          stop_scrum();
          return;
      }

      statusHTTP(data, "../../");
      stop_scrum();
    })
    .catch(function(err) { stop_scrum(); console.log(err); });
});



$(".btn-save").click(() => {
  let date = $("#fecha");
  let error = 0;
  error += valid_imputs([date]);
  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

  loading_scrum();


  let url = `../../app/api/invoice.php?a=3`;
  const data = new FormData();
  data.append('id', IDF);
  data.append('date', date.val());

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
    const { code, status, date }  = data;
      if(code == 201)
      {
        $("#modalDate").modal('hide');
        $(".d-doc").html(``);
        $(".d-factura").html(``);
        $("#fp"+CO).html(`<b>${date}</b>`);
        $("#bt"+CO).html(``);

        showModalMessageError("success", "Fecha de pago agregada", 1800);
        stop_scrum();
        IDF = 0;
        CO = 0;
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });
});
