$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    getList(1);
});


$("#btn-search").click(function(){
  getList(1)
});

function getList(page)
{   $(".r-pdf").attr("href", "javascript:void(0);");
    let ini = document.getElementById("dateInitial").value;
    let fin = document.getElementById("dateFinal").value;
    let sucursal = document.getElementById("suc").value;
    let status = document.getElementById("status").value;
    let url = `../../app/api/order.php?a=1&&page=${page}&&fechini=${ini}&&fechfinal=${fin}&&suc=${sucursal}&&status=${status}`;

    loading_scrum();
    $(".table-order").html("");
    
    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
        stop_scrum();
        if(data.code == 200)
        {
            $(".table-order").html(data.data);
            $(".r-pdf").attr("href", `../../report/order/${ini}/${fin}/${sucursal}/${status}/`);
            $(".r-xls").attr("href", `../../reportExcel/order/${ini}/${fin}/${sucursal}/${status}/`);
            return;
        }
        statusHTTP(data, "../../");
    })
    .catch(function(err) {
        stop_scrum(); console.log(err); $(".table-order").html("<div class='alert alert-danger'>Error</div>");
    });
}




$(".table-order").on("click",".del-order",function(){
  const data = new FormData();
  data.append('id', $(this).attr("data-id"));
  let url = `../../app/api/order.php?a=8`;
  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) {
    console.log(data);
      if(data.code == 200)
      {
        if(data.status)
        {
            showModalMessageError("success", data.msg, 2000);
            getList(1);
            return;
        }
      }
      statusHTTP(data, "../../");
  })
  .catch(function(err) {
      stop_scrum(); console.log(err);
  });
});
