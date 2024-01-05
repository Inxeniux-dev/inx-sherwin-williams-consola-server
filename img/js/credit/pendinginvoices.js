$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    getInvoices(1);
});


$(".table-factures").on("click",".pag-number", function(){
    getInvoices($(this).attr("data"));
});

$("#type").change(function(){
    getInvoices(1);
});

$("#dateInitial").change(function(){
    getInvoices(1);
});

$("#dateFinaly").change(function(){
    getInvoices(1);
});

$("#btn-search").click(function(){
    getInvoices(1);
});


function getInvoices(page)
{   loading_scrum();

    let type = $("#type").val();
    let dateInitial = $("#dateInitial").val();
    let dateFinaly = $("#dateFinaly").val();

    let url = `../../../app/api/credit.php?a=4&&page=${page}&&id=${id}&&type=${type}&&dateInitial=${dateInitial}&&dateFinaly=${dateFinaly}`;

    fetch(url,{method:'GET'})
    .then(function(response) {return response.text();})
    .then(function(data) {
      stop_scrum();
      $(".table-factures").html(data);
      $(".r-pdf").attr("href", `../../../report/pendinginvoices/${id}/${type}/${dateInitial}/${dateFinaly}/`);
      $(".r-xls").attr("href", `../../../reportExcel/pendinginvoices/${id}/${type}/${dateInitial}/${dateFinaly}/`);

      return;
    })
    .catch(function(err) {
        stop_scrum(); console.log(err);
    });

}
