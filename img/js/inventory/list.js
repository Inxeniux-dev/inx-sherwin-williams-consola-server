$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });
    console.log("read");

    getInventories(1);
});


function getInventories(page)
{
    let fechini = document.getElementById("dateInitial").value;
    let fechafin = document.getElementById("dateFinaly").value;

    let url = "../../inventory/getlist/"+page+"/"+fechini+"/"+fechafin+"/";
    $.get(url, null, "html").done(( data, textStatus, jqXHR ) => {
        console.log(textStatus);
        $(".table-inventories").html(data);
        $(".r-pdf").attr("href", "../../report/inventorylist/"+fechini+"/"+fechafin+"/");
        $(".r-xls").attr("href", "../../reportExcel/inventorylist/"+fechini+"/"+fechafin+"/");
      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}


$("#dateInitial").change(()=>{ getInventories(1); });
$("#dateFinaly").change(()=>{ getInventories(1); });
$("#btn-search").click(()=>{ getInventories(1); });
