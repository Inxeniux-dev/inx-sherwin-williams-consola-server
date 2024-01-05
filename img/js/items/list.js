$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    getItems(1);
});


function getItems(page)
{   $(".r-pdf").attr("href", "javascript:void(0);");
    let search = document.getElementById("search").value;
    let type = document.getElementById("type").value;
    let line = document.getElementById("line").value;
    let url = "../items/getlist/"+page+"/"+type+"/"+line+"/"+search+"/";
    $.get(url, null, "html").done((data, textStatus, jqXHR ) => {
        $(".table-items").html(data);
        console.log(textStatus);
        $(".r-pdf").attr("href", "../report/items/"+page+"/"+type+"/"+line+"/"+search+"/");
        $(".r-xls").attr("href", "../reportExcel/items/"+page+"/"+type+"/"+line+"/"+search+"/");
      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}

$(".table-items").on("click",".pag-number", function(){
    getItems($(this).attr("data"));
});

$("#btn-search").click(()=>{ getItems(1); });
$("#search").keyup(()=>{ getItems(1); });
$("#type").change(()=>{ getItems(1); });
$("#line").change(()=>{ getItems(1); });
