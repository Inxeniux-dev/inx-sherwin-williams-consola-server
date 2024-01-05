$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    getTransfers();
});


function getTransfers()
{
    let url_api = "../../transfers/getlistonserver/";
      $.ajax({
        type: "GET",
        dataType:"html",
        url: url_api,
        beforeSend: function(){
            console.log("consultando");
        },
        success: function(data){
            $(".d-transfer").html(data);
        },
        error: function(err){
               console.log(err.responseText);
               let output = '<div class = "col-md-12">' +
                            '<div class="alert alert-primary" role="alert"> ' +
                            ' Error al realizar la operación' +
                            '</div> ' +
                            '</div>';
               $(".d-transfer").html(output);
        }
    });
}
