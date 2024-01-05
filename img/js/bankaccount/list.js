$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $("#content").toggleClass("active");
    });
    console.log("read");
    getAccounts(1);
});


function getAccounts(page)
{
    let search = document.getElementById("search").value;
    let url = "../bankaccount/getlist/"+page+"/"+search+"/";
    $.get(url, null, "html").done((data, textStatus, jqXHR ) => {
        $(".table-bankaccount").html(data);
        console.log(textStatus);
      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}

$(".table-bankaccount").on("click",".pag-number", function(){
    getAccounts($(this).attr("data"));
});


$("#btn-search").click(()=>{ getAccounts(1); });
$("#search").keyup(()=>{ getAccounts(1); });



$(".btn-sync").click(function(){
      loading_scrum();
      let url = `../app/api/bankaccount.php?a=1`;
      fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
          stop_scrum();
          if(data.code == 200)
          {
              alertMessage("success", data.msg, "Aceptar", false, "");
              getAccounts(1);
          }
          statusHTTP(data, "../../");
      })
      .catch(function(err) {
          stop_scrum(); console.log(err); $(".table-order").html("<div class='alert alert-danger'>Error</div>");
      });
});
