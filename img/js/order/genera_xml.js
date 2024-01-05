$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});


$(".btn-xml").click(function(){
    genera_xml();
});


function genera_xml()
{
    loading_scrum();
    let url = "../../../app/api/order.php?a=9";
    const data = new FormData();
    data.append('identified', identified);
    fetch(url, { method: 'POST', body: data })
    .then(function(response) {
    if(response.ok) {
        return response.json();
    } else {
        throw "Error en la llamada Ajax";
    }
    })
    .then(function(data) {
        console.log(data);
        if(data.code == 200)
        {
          if(data.status == 201)
          {
              showModalMessageError("success", "¡Archivo de pedido creado!", 2000);
              stop_scrum();
              return;
          }
        }
        showModalMessageError("warning",  "¡Archivo de pedido NO creado!", 2000);
        stop_scrum();
    })
    .catch(function(err) {
        console.log(err);
        showModalMessageError("error",  "No se ha creado el archivo de pedido", 2000);
        stop_scrum();
    });
}
