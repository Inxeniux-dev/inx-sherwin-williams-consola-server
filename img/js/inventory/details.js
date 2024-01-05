$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });
    console.log("read");
    getDetails(1);
    
});

let color_border_error = "1px solid  #ff988e";
let color_border_normal = "1px solid  #c5c5c5";

$(".table-items").on("click",".pag-number", function(){
    getDetails($(this).attr("data"));
});

$("#btn-search").click(()=>{ getDetails(1); });
$("#search").keyup(()=>{ getDetails(1); });
$("#type").change(()=>{ getDetails(1); });
$("#line").change(()=>{ getDetails(1); });

async function getDetails(page)
{   let line = document.getElementById("line").value;
    let type = document.getElementById("type").value;
    let search = document.getElementById("search").value;
    let url = "../../getdetailsbyid/"+page+"/"+identified+"/"+line+"/"+type+"/"+search+"/";
    fetch(url)
    .then(function(response) {
        return response.text();
    })
    .then(function(html) {
        $(".table-items").html(html);
    });   
}