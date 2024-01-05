


$(".btn-cards").click(() => {  $(".table-modal-cards").html("Consultando..."); get_list_cards(1); });
$("#searchCards").keyup(()=>{ get_list_agent(1); });
$("#btn-search-cards").click(()=>{ get_list_agent(1); });



function get_list_cards(page)
{   
    item = $("#searchCards").val();
    let url = "../../listcards/"+page+"/"+identified+"/"+item+"/";
    console.log(url);
    $.get(url, null, "html").done(( data, textStatus, jqXHR ) => {
        console.log(textStatus);
        $(".table-modal-cards").html(data);
      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}


$(".table-modal-cards").on("click",".pag-number", function(){
    get_list_cards($(this).attr("data"));
});


function addCard(idcard)
{   
    const data = new FormData();
    data.append('idcard', idcard);
    data.append('identified', identified);

    let url = "../../../app/api/sale.php?a=8";
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
            window.location = "../../additem/"+identified+"/";
        }
    })
    .catch(function(err) {
        stop_scrum();
        console.log(err);
       alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../additem/"+identified+"/");
    });

    //ESTO FUNCIONA DEPENDE DE LA CONFIGURACIÓN DEL PUNTO DE VENTA
   //   window.location = "../../changeConfig/"+identified+"/5/"+idcard+"/";
}




$(".validate-card").click(()=>{
    
    const data = new FormData();
    data.append('identified', identified);
    let url = "../../../app/api/sale.php?a=9";
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
            if(data.sale)
            {
                console.log("La venta ya ha sido finalizada");
                return;
            }

            if(data.response.response && data.response.status == 0)
            {  console.log("no entro");
                alertMessage("warning", "El pintor aún no ha sido identificado", "Aceptar", false, ""); 
                return;
            }
            if(data.response.response && data.response.status == 1)
            {  console.log("no entro");
                alertMessage("success", "El pintor ha sido identificado exitosamente", "Aceptar", true, "../../additem/"+identified+"/"); 
            }
            
        }
    })
    .catch(function(err) {
        stop_scrum();
        console.log(err);
       alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../additem/"+identified+"/");
    });

});


$(".cancel-card").click(()=>{
         window.location = "../../changeConfig/"+identified+"/5/1/";
 });