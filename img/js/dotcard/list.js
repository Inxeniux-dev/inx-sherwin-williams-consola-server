$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    sync(1);
});


function getDotCards(page)
{
    let search = document.getElementById("search").value;
    let url = "../dotcards/getlist/"+page+"/"+search+"/";
    $.get(url, null, "html").done((data, textStatus, jqXHR ) => {
        $(".table-dotcards").html(data);
        console.log(textStatus);
      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}

$(".table-dotcards").on("click",".pag-number", function(){
    getDotCards($(this).attr("data"));
});


$("#btn-search").click(()=>{ getDotCards(1); });
$("#search").keyup(()=>{ getDotCards(1); });


$(".btn-sync").click(function(){sync();});

function sync(){
      loading_scrum();
      let url = `../app/api/dotcard.php?a=4`;
      fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
          stop_scrum();
          if(data.code == 200)
          {
              showModalMessageError("success", data.msg, 2000);
              getDotCards(1);
              return;
          }
          statusHTTP(data, "../../");
      })
      .catch(function(err) {
          stop_scrum(); console.log(err); getDotCards(1);
      });
};
