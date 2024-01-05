$(document).ready(function(){
    console.log('read');

    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });

    getComplements(1);
});

function getComplements(page)
{
    $(".r-pdf").attr("href", "javascript:void(0);");
    let fechini = document.getElementById('dateInitial').value;
    let fechfin = document.getElementById('dateFinaly').value;
    let type = document.getElementById('type').value;

    fetch(`../../app/api/complement.php?a=1&&page=${page}&&fi=${fechini}&&ff=${fechfin}&&type=${type}`, {
            method: 'GET'
        })
        .then(function(response) {
        if(response.ok) {
            return response.json()
        } else {
            throw "Error en la llamada Ajax";
        }
        })
        .then(function(data) {
            console.log(data);
            if(data.code == 200)
            {
                $(".table-complement").html(data.data);
                $(".r-pdf").attr("href", `../../report/complement/${fechini}/${fechfin}/${type}/`)
            }
            else
            {

            }
        })
        .catch(function(err) {
        console.log(err);
     });
}


$(".table-complement").on("click",".pag-number", function(){
    getComplements($(this).attr("data"));
});

$("#dateInitial").change(()=>{ getComplements(1); });
$("#dateFinaly").change(()=>{ getComplements(1); });
$("#type").change(()=>{ getComplements(1); });



function deleteComplement(identified_complement)
{

    const data = new FormData();
    data.append('identified', identified_complement);

    let url = "../../app/api/complement.php?a=7";

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

        if(data)
        {
            alertMessage("success", "¡El complemento se ha eliminado correctamente!", "Detalles",  true, "../all/");
        }
        else{
            alertMessage("warning", "¡Error al realizar la operación!", "Detalles",  true, "../all/");
        }
    })
    .catch(function(err) {
        stop_scrum();
        console.log(err);
        alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, true, "../all/");
    });
}
