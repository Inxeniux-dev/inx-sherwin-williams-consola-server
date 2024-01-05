$(document).ready(function(){
    console.log('read');

    $(document).ready(function(){
        $("#sidebarCollapse").on('click', function(){
            $("#sidebar").toggleClass("active");
            $(".content").toggleClass("active");
        });
    });
});


$(".btn-refact").click(() => {

    const data = new FormData();
    data.append('identified', identified);
    let url = "../../../app/api/complement.php?a=8";

    fetch(url, { method: 'POST', body: data})
    .then(function(response) {
    if(response.ok) {
        return response.json();
    } else {
        throw "Error en la llamada Ajax";
    }
    })
    .then(function(data) {
        console.log(data);

        if(data.status)
        {
            alertMessage("success", "Complemento retimbrado correctamente. Verifica el timbrador de ADVANS", "Aceptar", false, null);
        }
        else
        {
            alertMessage("warning", "¡El complemento no se ha retimbrado!", "Aceptar", true, "../../detail/"+identified+"/");
        }
    })
    .catch(function(err) {
        stop_scrum();
        console.log(err);
        alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../detail/"+identified+"/");
    });
});
