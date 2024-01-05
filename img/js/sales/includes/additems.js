

function addItem(code, edit, id_code)
{
    loading_scrum();
    const data = new FormData();
    data.append('identified', identified);
    data.append('item', code);
    data.append('edit', edit);
    data.append('id_code', id_code);

    let url = "../../addItemForSale/";

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

        if(data.session)
        {
            if(data.validation.validation)
            {
                if(data.sale != null)
                {
                    if(data.sale.status == 1)
                    {
                        if(data.code_exist)
                        {
                            if(data.save)
                            {
                                window.location = "../"+identified+"/";
                            }
                            else{ alertMessage("warning", "¡Error al realizar la operación!", "Aceptar", true, "../../additem/"+identified+"/"); }
                        }
                        else{ alertMessage("warning", "¡El código ingresado, no existe!", "Aceptar", false, null);  stop_scrum(); }
                    }
                    else{ alertMessage("warning", "¡La ya ha sido finalizada!", "Ver detalles", true, "../../detail/"+identified+"/"); }
                }
                else { alertMessage("warning", "¡La venta no existe!", "Ir a listado", true, "../../"); }
            }
            else{ alertMessage("warning", "Los campos son incorrectos", "Aceptar", false, null);  stop_scrum(); }
        }
        else { alertMessage("warning", "¡La sessión ha expirado!", "Iniciar sesión", true, "../../../login/"); }
    })
    .catch(function(err) {
        console.log(err);
        stop_scrum();
        alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../additem/"+identified+"/");
    });

}


$("#search").keyup(function(event){

    let item = $(this).val();

    if(event.keyCode == 27)
    {
        $(this).val("");
        $(".table-items-search").html("");
        return;
    }


    if(event.keyCode == 13)
    {
        if(item.toUpperCase() == "IGUALCC")
        {
          $(".panel-igual-cc").removeClass("d-none");
          $(".panel-items-add").addClass("d-none");
          $(".panel-igual-ma").addClass("d-none");
            return;
        }
        if(item.toUpperCase() == "IGUALMA")
        {
            $(".panel-igual-ma").removeClass("d-none");
            $(".panel-items-add").addClass("d-none");
            $(".panel-igual-cc").addClass("d-none");
            return;
        }

        addItem(item, true);
    }
    else
    {
        if(!item.includes("*"))
        {
            if(item.length > 0)
            {
                getListCodeSearch(1);
            }
            else
            {
                $(".table-items-search").html("");
            }
        }
    }
});


$(".table-items-search").on("click", ".pag-number", function(){
    getListCodeSearch($(this).attr("data"));
});


async function getListCodeSearch(page)
{
    let item = document.getElementById("search").value;
    if(!item.includes("*"))
    {
        let url = "../../getlistitem/"+identified+"/"+page+"/"+item+"/";

        const res = await fetch(url);
        const html = await res.text();
        $(".table-items-search").html(html);
    }
}

function addPriceItem(item, price, id_code)
{
    loading_scrum();
    const data = new FormData();
    data.append('identified', identified);
    data.append('price', price);
    data.append('code', item);
    data.append('id_code', id_code)

    let url = "../../addPriceForItem/";

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

        if(data.session)
        {
            if(data.validation.validation)
            {
                if(data.sale != null)
                {
                    if(data.sale.status == 1)
                    {
                        if(data.sale.status == 1)
                         {
                            if(data.save)
                            {
                                window.location = "../"+identified+"/";
                            }
                            else{ alertMessage("warning", "¡Error al realizar la operación!", "Aceptar", true, "../../additem/"+identified+"/"); }
                        }
                        else{ alertMessage("warning", "¡El cliente no cuenta con precio especial!", "Ver detalles", true, "../../additem/"+identified+"/"); }
                    }
                    else{ alertMessage("warning", "¡La ya ha sido finalizada!", "Ver detalles", true, "../../detail/"+identified+"/"); }
                }
                else { alertMessage("warning", "¡La venta no existe!", "Ir a listado", true, "../../"); }
            }
            else{ alertMessage("warning", "Los campos son incorrectos", "Aceptar", false, null);   stop_scrum(); }
        }
        else { alertMessage("warning", "¡La sessión ha expirado!", "Iniciar sesión", true, "../../../login/"); }
    })
    .catch(function(err) {
        console.log(err);
        stop_scrum();
        alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../additem/"+identified+"/");
    });
}



function addDescount(item, discount, id_code, is_points)
{
    loading_scrum();
    const data = new FormData();
    data.append('identified', identified);
    data.append('item', item);
    data.append('id_code', id_code)
    data.append('discount', discount);
    data.append('is_points', is_points);

    let url = "../../addDescountForItem/";


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

        if(data.session)
        {
            if(data.validation.validation)
            {
                if(data.sale != null)
                {
                    if(data.sale.status == 1)
                    {
                        if(data.save.save)
                        {
                            window.location = "../"+identified+"/";
                        }
                        else{ alertMessage("warning", "¡Error al realizar la operación!", "Aceptar", true, "../../additem/"+identified+"/"); }
                    }
                    else{ alertMessage("warning", "¡La ya ha sido finalizada!", "Ver detalles", true, "../../detail/"+identified+"/"); }
                }
                else { alertMessage("warning", "¡La venta no existe!", "Ir a listado", true, "../../"); }
            }
            else{ alertMessage("warning", "Los campos son incorrectos", "Aceptar", false, null);   stop_scrum(); }
        }
        else { alertMessage("warning", "¡La sessión ha expirado!", "Iniciar sesión", true, "../../../login/"); }
    })
    .catch(function(err) {
        console.log(err);
        stop_scrum();
        alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../additem/"+identified+"/");
    });
}





function addItemPoint(code, identified_item)
{
    addDescount(code, 100, identified_item, 1)
}



function displayIgual(id)
{
  if ($(".igual"+id).hasClass('d-none')){
       $(".igual"+id).removeClass("d-none");
   }else{
        $(".igual"+id).addClass("d-none");
   }
}
