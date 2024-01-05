$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});

var TYPE = 0;

$("#searchSalida").click(() => {
    $(".list-codes-search").html("");
    TYPE = 0;
    getCodes(1, TYPE);
});


$("#searchEntrada").click(() => {
    $(".list-codes-search").html("");
    TYPE = 1;
    getCodes(1, TYPE);


});

function getCodes(page, type)
{

    if(type == 1)
    {
        $("#hmodal").html("Entrada");
    }
    else
    {
        $("#hmodal").html("Salida");
    }


    console.log("consultando .... ");
    let search = document.getElementById('searchCodeItem').value;

    fetch(`../../../app/api/conversion.php?a=2&&page=${page}&&type=${type}&&identified=${identified}&&search=${search}`, {
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

            if(data.code == 200)
            {
                $(".list-codes-search").html(data.data);
            }
            else
            {
                console.log(data);

                $(".list-codes-search").html("<div class = 'alert alert-danger'>Error al realizar la operación. Código de error : <b>"+data.code+"</b></div>");
            }

        })
        .catch(function(err) {
        console.log(err);
     });
}


$(".list-codes-search").on("click",".pag-number", function(){
    getCodes($(this).attr("data"), TYPE);
});

$("#searchCodeItem").keyup(function()
{
    getCodes(1, TYPE);
});



function addInput(code)
{
    console.log(code);
    addItem(code, 1);
}

function addOutput(code)
{
    console.log(code);
    addItem(code, 0);
}


function addItem(code, type)
{   loading_scrum();
    const data = new FormData();
    data.append('code', code);
    data.append('cant', 1);
    data.append('action', 0);
    data.append('type', type);
    data.append('identified', identified);

    let url = "../../../app/api/conversion.php?a=3";
    fetch(url, { method: 'POST', body: data})
    .then(function(response) {
    if(response.ok) {
        return response.json();
    } else {
        throw "Error en la llamada Ajax";
    }
    })
    .then(function(data) {

        if(data.code == 200)
        {
            if(data.validation.length > 0)
            {   stop_scrum();
                alertMessage("warning", "¡El código no se puede ingresar!", "Aceptar", false, null);

                    let out = "";
                    for(x = 0; x < data.validation.length; x++)
                    {
                        out += "<span>" + data.validation[x] + "</span> <br>";
                    }
                    $(".msg-err").removeClass("d-none");
                    $(".msg-err").html(out);

            }
            else
            {
                window.location = `../../add/${identified}/`;
            }
        }
    })
    .catch(function(err) {
        stop_scrum();
        console.log(err);
        alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../add/"+identified+"/");
    });
}





$(".btn-finaly").click(() => {
    loading_scrum();
    $(".msg-err").addClass("d-none");

    const data = new FormData();
    data.append('identified', identified);

    let url = "../../../app/api/conversion.php?a=4";
    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();
        if(data.code == 200)
        {
          if(data.status)
          {
             showModalMessageError("success", data.msg, 2000);
             setTimeout(function(){ window.location = "../../details/"+identified+"/"; }, 2100);
             return;
          }
        }
        statusHTTP(data, "../../");
        stop_scrum();
    })
    .catch(function(err) {
        stop_scrum(); console.log(err);
    });
});




function deleteItem(idcode, identified)
{
    loading_scrum();
    window.location = `../../delete/${idcode}/${identified}/`;
}



$(".upd-out").keyup(function(){
    let code = $(this).attr("data-code");
    let cant = $(this).val();

    if(event.keyCode == 13)
    {
        updItem(code, cant, 0);
    }
});

$(".upd-inp").keyup(function(event){
    let code = $(this).attr("data-code");
    let cant = $(this).val();

    if(event.keyCode == 13)
    {
        updItem(code, cant, 1);
    }
});


function updItem(code, cant, type)
{

    loading_scrum();
    const data = new FormData();
    data.append('code', code);
    data.append('cant', cant);
    data.append('type', type);
    data.append('action', 1);
    data.append('identified', identified);

    let url = "../../../app/api/conversion.php?a=3";
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
        if(data.code == 200)
        {
            if(data.validation.length > 0)
            {   stop_scrum();
                alertMessage("warning", "¡El código no se puede actualizar!", "Aceptar", false, null);

                    let out = "";
                    for(x = 0; x < data.validation.length; x++)
                    {
                        out += "<span>" + data.validation[x] + "</span> <br>";
                    }
                    $(".msg-err").removeClass("d-none");
                    $(".msg-err").html(out);

            }
            else
            {
                window.location = `../../add/${identified}/`;
            }
        }
    })
    .catch(function(err) {
        stop_scrum();
        console.log(err);
        alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../add/"+identified+"/");
    });
}



function display_cant(id)
{
    $("#lbl"+id).addClass("d-none");
    $("#inp"+id).removeClass("d-none");
    $("#inp"+id).focus();
    $("#inp"+id).select();
}

function display_cant_e(id)
{
    $("#lble"+id).addClass("d-none");
    $("#inpe"+id).removeClass("d-none");
    $("#inpe"+id).focus();
    $("#inpe"+id).select();
}
