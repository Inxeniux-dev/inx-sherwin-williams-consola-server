$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    getList();
});


function getList()
{   $(".r-pdf").attr("href", "javascript:void(0);");
    let url = `../../app/api/order.php?a=2&&fechini=${identified}`;
    loading_scrum();
    $(".table-order-detail").html("");

    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
        stop_scrum();
        if(data.code == 200)
        {
            $(".table-order-detail").html(data.data);
            $(".r-pdf").attr("href", `../../report/order/${ini}/${fin}/${type}/${status}/`);
            return;
        }
        statusHTTP(data, "../../");
    })
    .catch(function(err) {
        stop_scrum(); console.log(err); $(".table-order-detail").html("<div class='alert alert-danger'>Error</div>");
    });
}