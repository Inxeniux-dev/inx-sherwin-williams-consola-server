$(document).ready(function(){
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
    console.log("read");
    getKardex(1);
});


function getKardex(page)
{
    if(kv)
    {
        let dateStart = document.getElementById("dateInitial").value;
        let dateFinaly = document.getElementById("dateFinaly").value;
        let code = document.getElementById("code").value;
        let url = "../../../items/getlistkardex/"+page+"/"+dateStart+"/"+dateFinaly+"/"+code+"/";
        $.get(url, null, "html").done((data, textStatus, jqXHR ) => {
            $(".table-items-kardex").html(data);
            $(".r-pdf").attr("href", "../../../report/itemkardex/"+dateStart+"/"+dateFinaly+"/"+code+"/");
          })
          .fail((jqXHR, textError, errorThrown) => {
              console.log("la solicitud ha fallado " + textError);
              console.log("la solicitud ha fallado " + errorThrown);
          });
    }
}

$("#btn-search").click(()=>{ getKardex(1); });
$("#dateInitial").change(()=>{ getKardex(1); });
$("#dateFinaly").change(()=>{ getKardex(1); });
