$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });
    
    getSalesByClient(1);
    getCodesBySalesByClient(1);
});

var str_code = '';


$(".fechini").change(function(){
    getSalesByClient(1);
});


$(".fechfin").change(function(){
    getSalesByClient(1);
});


$(".fechini-c").change(function(){
    getCodesBySalesByClient(1);
});


$(".fechfin-c").change(function(){
    getCodesBySalesByClient(1);
});




function getSalesByClient(page)
{   console.log("consultando");
    let fechini = $(".fechini").val();
    let fechfin = $(".fechfin").val();
    let url = `../../../app/api/customer.php?a=2&&page=${page}&&fi=${fechini}&&ff=${fechfin}&&identified=${indentified}`;

    $.get(url, null, "json").done(( data, textStatus, jqXHR ) => {
        $("#list-sales-for-client").html(data);
        
        $(".r-pdf").attr("href", `../../../report/salesByClient/${fechini}/${fechfin}/${indentified}/`);
        $(".r-xls").attr("href", `../../../reportExcel/salesByClient/${fechini}/${fechfin}/${indentified}/`);

      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}

function getCodesBySalesByClient(page)
{   console.log("consultando");
let fechini = $(".fechini-c").val();
let fechfin = $(".fechfin-c").val();
    let url = `../../../app/api/customer.php?a=3&&page=${page}&&fi=${fechini}&&ff=${fechfin}&&identified=${indentified}`;
    $.get(url, null, "json").done(( data, textStatus, jqXHR ) => {
        $(".list-sales-by-code-for-client").html(data);
        console.log(textStatus);

        $(".r-pdf-c").attr("href", `../../../report/codesByClient/${fechini}/${fechfin}/${indentified}/`);
        $(".r-xls-c").attr("href", `../../../reportExcel/codesByClient/${fechini}/${fechfin}/${indentified}/`);
      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}


function detailsCode(code)
{   
    console.log("click...");
    str_code = code;
    getDetailsByCode(code, 1);
    $('html, body').stop().animate({ scrollTop: $("#list-code-detail-for-sale-by-client").offset().top }, 2000); 
    return false;
}


function getDetailsByCode(code, page)
{   
    let fechini = $(".fechini-c").val();
    let fechfin = $(".fechfin-c").val();
    let url = `../../../app/api/customer.php?a=4&&page=${page}&&fi=${fechini}&&ff=${fechfin}&&identified=${indentified}&&code=${code}`;

    //url = "../../../sales/getFoliosByClientByCode/"+indentified+"/2016-01-01/2020-01-01/"+code+"/"+page+"/";
    $.get(url, null, "json").done(( data, textStatus, jqXHR ) => {

        $("#list-code-detail-for-sale-by-client").html(data);
        console.log(textStatus);
      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}


$("#list-sales-for-client").on("click",".pag-number", function(){
    getSalesByClient($(this).attr("data"));
});

$(".list-sales-by-code-for-client").on("click",".pag-number", function(){
    getCodesBySalesByClient($(this).attr("data"));
});

$("#list-code-detail-for-sale-by-client").on("click",".pag-number", function(){
    getDetailsByCode(str_code, $(this).attr("data"));
});