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
    let url = "../../../app/api/transfer.php?a=6";
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
              alertMessage("success", "¡Archivo de vale creado!", "Aceptar", false, "");
              stop_scrum();
              return;
          }
        }
        alertMessage("warning", "¡Archivo de vale NO creado!", "Aceptar", false, "");
        stop_scrum();
    })
    .catch(function(err) {
        console.log(err);
        alertMessage("error", "No se ha creado el archivo de vales", "Aceptar", false, "");
        stop_scrum();
    });
}
