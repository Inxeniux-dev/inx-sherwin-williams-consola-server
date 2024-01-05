$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });
});



$(".fact-all").click(function(){
    let type = $(this).attr("data");
    let url = "../../../../app/api/sale.php?a=5";

    const data = new FormData();
    data.append('x', 0);

    let str_tipo = 'retimbrar';

    if(type == 1)
    {
        url = "../../app/api/sale.php?a=6";
        str_tipo = 'timbrar';
    }
    else
    {   let aux = identified_fact.split("-");
        data.append('serie', aux[0]);
        data.append('folio', aux[1]);
        data.append('type', 2);
    }

    loading_scrum();

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

        if(data.code == 400)
        {    stop_scrum();
            alertMessage("warning", "¡Error al realizar la operación!", "Aceptar", true, "../billing/");
        }
        else if(data.code == 403)
        {    stop_scrum();
            alertMessage("warning", "¡La sessión ha expirado!", "Iniciar sesión", true, "../../login/")
        }
        else if(data.code == 200)
        {
            stop_scrum();

            if(data.status)
            {
                if(type == 1)
                {
                    alertMessage("success", "!La factura se ha enviado a "+str_tipo+" correctamente, verifica el conector de ADVANS!", "Aceptar", true, "../all/");
                    return;
                }

                alertMessage("success", "!La factura se ha enviado a "+str_tipo+" correctamente, verifica el conector de ADVANS!", "Aceptar", false, null);
            }
            else
            {
                alertMessage("warning", "¡Error al "+str_tipo+"  la(s) remisión(es) de mostrador!", "Aceptar", false, null);
            }
        }
    })
    .catch(function(err) {
        console.log(err);
        stop_scrum();
        alertMessage("error", "¡Error Interno de Servidor, no se puede imprimir ticket!", "Aceptar", true, "../billing/");
    });
});
