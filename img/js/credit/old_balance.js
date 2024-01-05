$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });
});

var IDENTIFIED_C = 0;

$(".seach_balance").click(() => { getBalance(); });


function getBalance(page)
{

    //$(".table-balance").html('<div class = "alert alert-info"> <b>Consultando . . . </b></div> ');

    loading_scrum();
    let date = document.getElementById("dateInitial").value;
    let url = `../../app/api/credit.php?a=1&&page=${page}&&identified=${IDENTIFIED_C}&&date=${date}`;
    fetch(url, {
            method: 'GET'
        })
        .then(function(response) {
        if(response.ok) {
            return response.json()
        } else {
            throw "Error en la llamada Ajax";
        }
        })
        .then(function(data) {
            stop_scrum();
            console.log(data);
            if(data.code == 200)
            {
                $(".table-balance").html(data.data);
                $(".r-pdf").attr("href", `../../report/oldBalance/${IDENTIFIED_C}/${date}/`);
                $(".r-xls").attr("href", `../../reportExcel/oldBalance/${IDENTIFIED_C}/${date}/`);
            }
        })
        .catch(function(err) {
        console.log(err);
        stop_scrum();
     });
}


$(".btn-clients").click(() =>{
    getCustomers(1);
});


$(".table-modal-customers").on("click",".pag-number", function(){
    getCustomers($(this).attr("data"));
});

$("#btn-search").click(()=>{ getCustomers(1); });
$("#searchCustomer").keyup(()=>{ getCustomers(1); });


function getCustomers(page)
{
    let search = document.getElementById("searchCustomer").value;
    let url = `../../app/api/credit.php?a=2&&page=${page}&&type=2&&search=${search}`;
    fetch(url, {
            method: 'GET'
        })
        .then(function(response) {
        if(response.ok) {
            return response.json()
        } else {
            throw "Error en la llamada Ajax";
        }
        })
        .then(function(data) {
            console.log(data);
            if(data.code == 200)
            {
                $(".table-modal-customers").html(data.data);
            }
        })
        .catch(function(err) {
        console.log(err);
     });
}


function addCustomer(idclient, rfc, name)
{
    IDENTIFIED_C = idclient;
    $("#client").val(name);
    $(".btn-clean").show();
    $("#exampleModal").modal('hide');
    $("#searchCustomer").val("");
    $(".table-balance").html("");

    $(".d-clean").removeClass("d-none");
    $(".d-b-client").removeClass("col-2");
}


$(".btn-clean").click(() => {
    $("#client").val("");
    IDENTIFIED_C = 0;
    $(".table-balance").html("");
    $(".d-clean").addClass("d-none");
    $(".d-b-client").addClass("col-2");
});
