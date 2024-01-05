$(".btn-agents").click(() => {  $(".table-modal-agent").html("Consultando..."); get_list_agent(1); });
$("#searchAgent").keyup(()=>{ get_list_agent(1); });
$("#btn-search-agent").click(()=>{ get_list_agent(1); });



function get_list_agent(page)
{   

    let url = `../../../app/api/agent.php?a=3`;
    const data = new FormData();
    data.append('page', page);
    data.append('search', $("#searchAgent").val());
    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
        if(data.code == 201)
        {
            $(".table-modal-agent").html(data.html);
        }
    })
    .catch(function(err) {
        console.log(err);
    });

}


$(".table-modal-agent").on("click",".pag-number", function(){
    get_list_agent($(this).attr("data"));
});



function changeSeller(id)
{
    const data = new FormData();
    data.append('id', id);
    data.append('identified', identified);

    let url = "../../../app/api/sale.php?a=20";
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
        if(data.code == 201)
        {   
            showModalMessageError("success", data.msg, 2000);
            setTimeout(function(){ window.location = "../../additem/"+identified+"/"; }, 2500);
            return;
        }

        statusHTTP(data, null);
    })
    .catch(function(err) {
        stop_scrum();
        console.log(err);
       alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../additem/"+identified+"/");
    });
}