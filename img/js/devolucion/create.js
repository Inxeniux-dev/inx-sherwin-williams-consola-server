$(document).ready(function(){
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });

    console.log('read');
    $("#ammount-modal").modal({backdrop: 'static', keyboard: false});

    $("#ammount").focus();
});

var ammount = 0;
var itemsReturn = [];
var itemsReturnDouble = [];



$(".btn-add-ammount").click(function(){
    let importe = $("#ammount").val();
    console.log("click");
    if(isNaN(importe) || importe < 0 || importe.length == 0)
    {
        $("#ammount").css("background", "#F47983");
        return;
    }
    else {
      $("#ammount").css("background", "#87D37C");
    }

    ammount = importe;

    $(".import").html("<b>$"+ammount+"<b> <i class='fas fa-edit hand' title = 'modificar'></i>");
    $("#ammount-modal").modal('hide');
});



$(".import").on("click", ".fa-edit", function(){
  $("#ammount-modal").modal({backdrop: 'static', keyboard: false});
  $("#ammount").css("background", "#fff");
});



function addToReturn(item_code, points)
{
    let c_exist = 0;
    let items = [item_code, points];
    let item = [item_code];

    if(itemsReturnDouble.length > 0)
    {
        for(x = 0; x < itemsReturnDouble.length; x++)
        {
            if(item_code == itemsReturnDouble[x][0].trim() && points.trim() == itemsReturnDouble[x][1].trim())
            {   c_exist++;
                break;
            }
        }
    }
    if(c_exist == 0)
    {
        itemsReturn.push(item);
        itemsReturnDouble.push(items);
    }

    console.log(itemsReturn);

    if(itemsReturn.length > 0)
    {
      loading_scrum();
        let url = "../../../sales/getItemsReturn/";
        const data = new FormData();
        data.append('identified', identified);
        data.append('items', itemsReturn);

        fetch(url, { method: 'POST', body: data })
        .then(function(response) {
        if(response.ok) {
            return response.text();
        } else {
            throw "Error en la llamada Ajax";
        }
        })
        .then(function(data) {
            $(".table-return").html(data);

            $('html, body').animate({
                scrollTop: $(".table-return").offset().top
                }, 1500);
            stop_scrum();
        })
        .catch(function(err) {
            console.log(err);
            stop_scrum();
        });

    }
}



$(".table-return").on("keyup",".cant-code-return", function(){

    let cant = $(this).val();
    let price = $(this).attr("data-price");
    let cant_return = $(this).attr("data-cant");
    let row = $(this).attr("data-row");
    let discount = $(this).attr("data-discount");

    let descuento = 0;
    if(discount >= 100)
    {
        descuento = 1;
    }
    else
    {
        descuento =  discount.replace(",", "");
        if(descuento >= 10){
            descuento = "0."+descuento;
        }
        else{
             descuento = "0.0"+descuento;
        }
    }


    let subtotal = (cant * price) - (cant * price * descuento);
    let err = 0;

    if(isNaN(cant)){ err++; }
    if(Number.parseInt(cant.trim()) > Number.parseInt(cant_return.trim())) { err++; }
    if(cant.length <= 0){ err++; }
    if(!esEntero(cant)){ err++; }

    if(err > 0)
    {
        $(this).css("background", "#fcff");
        $(".subtotal-"+row).html(formatNumber(0));
    }
    else
    {
        $(this).css("background", "#fff");
        $(".subtotal-"+row).html(formatNumber(subtotal));
    }

});


function removeItem(item, evento, idcode)
{
    evento.preventDefault();
    item.closest('tr').remove();

    /** Remover del array */

    console.log(itemsReturn);
    i = 0;
    itemsReturn.forEach(element => {
        console.log(element);
        console.log(element[0] + " - " + idcode);
        if(element[0] == idcode)
        {
            itemsReturn.splice(i,1);
            itemsReturnDouble.splice(i,1);
        }
        i++;
    });

    let count = 0;
    $(".table-return tbody tr").each(function(){
        count++;
    });

    if(count == 0)
    {
         $(".table-return").html("");
    }
}



$(".table-return").on("click",".btn-finaly-return", function(){

    $(".err-msg-conv").addClass("d-none");
    $(".err-msg-conv").html("");

    let products = Array();
    let err = 0;
    let count = 0;
    $(".table-return tbody tr").each(function(){
        let cant_code = $(this).find("td").eq(2).children("input").val();
        let cant_code_max = $(this).find("td").eq(2).children("input").attr("data-cant");
        let code = $(this).find("td").eq(0).text().trim();
        let idcode = $(this).find("td").eq(2).children("input").attr("data-idprod");
        count++;
        if(isNaN(cant_code) || cant_code <= 0 || cant_code.length == 0 || (cant_code > cant_code_max)){
            $(this).find("td").eq(2).children("input").css("background", "#ffcfcf");
            err++;
        }
        products.push(Array(cant_code, idcode));
    });

    if(count == 0 ) { err++; }

    if(err == 0)
    {
        loading_scrum();

        const data = new FormData();
        data.append('products', products);
        data.append('identified', identified);
        data.append('ammount', ammount);

        let url = `../../../app/api/sale.php?a=12`;

        fetch(url,{method:'POST', body:data})
        .then(function(response) {return response.json();})
        .then(function(data) {
          console.log(data);
          stop_scrum();
          if(data.code == 200)
          { console.log("entro");
            if(data.status)
            {  console.log("entro 2");
                alertMessage("success", data.msg, "Aceptar", true, "../../../sales/detail/"+identified+"/");
                return;
            }
          }
          statusHTTP(data, "../../");

        })
        .catch(function(err) {
            stop_scrum(); console.log(err);
        });
    }
    else
    {
        console.log("No se puede finalizar");
    }

});





function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}


function esEntero(numero){
    if (numero % 1 == 0) {
       return true;
    } else {
       return false;
    }
}
