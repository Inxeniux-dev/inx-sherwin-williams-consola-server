$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });
    getCustomers(1);
});


function getCustomers(page)
{  
    let search = document.getElementById("search").value;
    search = search.replace(" ", "%20");
    let type = document.getElementById("type").value;
    let url = "../customers/getlist/"+page+"/"+type+"/"+search+"/";
    $.get(url, null, "html").done(( data, textStatus, jqXHR ) => {
        $(".table-customers").html(data);
        console.log(textStatus);
      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}

$(".table-customers").on("click",".pag-number", function(){
    getCustomers($(this).attr("data"));
});

$("#btn-search").click(()=>{ getCustomers(1); });
$("#search").keyup(()=>{ getCustomers(1); });
$("#type").change(()=>{ getCustomers(1); });