
$(".btn-search-code-igualma").click(()=>{
    getListCodesIgualMA(1);
});


$("#searchCodesIgualma").keyup(()=>{
    getListCodesIgualMA(1);
});



$(".list-codesigualma-search").on("click", ".pag-number", function(){
    getListCodesIgualMA($(this).attr("data"));
});


function getListCodesIgualMA(page)
{
  console.log(page);
    item = $("#searchCodesIgualma").val();
    let url = "../../listcodesforigualma/"+page+"/"+identified+"/"+item+"/";

    $.get(url, null, "html").done(( data, textStatus, jqXHR ) => {
        console.log(textStatus);
        $(".list-codesigualma-search").html(data);
      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}


$("#t_body_productos_igual_ma_list").on("click", ".del-code-item-igualcc", function(){
    $(this).parent().parent().remove();
    calc_totales_ma();
});

$("#t_body_productos_igual_ma_list").on("keyup", ".input-code-item-igualcc", function(){
    let val = $(this).val();

    if(isNaN(val))
    {
        $(this).css("background", "#ffcfcf");
    }
    else
    {
        $(this).css("background", "#fff");
    }

    calc_totales_ma();
});


function addItemIgualMa(codigo, descripcion, precio, existencia, discount)
{
   let count = 0;
   let rows = 0;
    $(".table-codes-for-igualma tbody tr").each(function(){
        let code_table = $(this).find("td").eq(0).text();
        let descuento_code = $(this).find("td").eq(2).children("input").val();
        if(code_table == codigo) { count ++; }

        if(rows == 0)
        {
            $("#igualma-descount").val(discount);
        }
        rows++;
    });

    if(count == 0)
    {
        let out = "<tr><td>"+codigo+"</td><td class = 'text-primary'>"+descripcion+"</td><td align = 'right' title = 'Descuento Máximo : "+discount+"%'><span> $ "+ formatNumber(precio)+" </span> <input type = 'hidden' value = '"+discount+"' class = 'input-discount' /></td><td align = 'right'>"+existencia+"</td><td>"+
        "<input type = 'text' class = 'form-control form-control-sm input-code-item-igualcc' placeholder = 'Cantidad' value = '1'>" +
        "</td><td><i class = 'fa fa-trash text-danger del-code-item-igualcc' style = 'cursor: pointer;'></i></td></tr>";

        $("#t_body_productos_igual_ma_list").append(out);
    }

    calc_totales_ma();
}


$("#igualma-price").keyup(()=>{
    calc_totales_ma();
});

$("#igualma-cant").keyup(()=>{
    calc_totales_ma();
});

$("#igualma-descount").keyup(()=>{
    let discount = document.getElementById("igualma-descount").value;
    if(isNaN(discount) || discount.length <= 0)
    {
        $("#igualma-descount").css("background", "#ffcfcf");
    }
    else
    {
        $("#igualma-descount").css("background", "#fff");
    }
    calc_totales_ma();
});


function calc_totales_ma()
{
    let cant = document.getElementById("igualma-cant").value;
    let price = document.getElementById("igualma-price").value;
    let precio_neto = 0;
    if(!isNaN(cant) && !isNaN(price)) { precio_neto = (cant * price); }
    if(isNaN(cant) || cant.length <= 0) { cant = 0; }

    let importe_descuento = ((0 * precio_neto) / 100);

    console.log(precio_neto);
    $(".import-igualma").html("$ " + formatNumber(precio_neto));
    $(".import-igualma-descount").html("$ " + formatNumber(importe_descuento));



    /* Codes */
    let subtotal_codes = 0;
    let codes_row = 0;
    DISCOUNT_IGUAL = 0;

    $(".table-codes-for-igualma tbody tr").each(function(){
        let cant_code = $(this).find("td").eq(4).children("input").val();
        let price_code = $(this).find("td").eq(2).children("span").text();
        let discount_code = $(this).find("td").eq(2).children("input").val();
        price_code = price_code.replace("$","").trim().replace(",", "").replace(".", "");
        subtotal_codes += (cant_code * price_code);
        codes_row++;

        if(codes_row == 1)
        {
            DISCOUNT_IGUAL = discount_code;
        }
    });

    let out = "";
    if(codes_row > 0)
    {
        out = "<b> El descuento máximo para campaña es en base al primer código de la siguiente lista: </b> <br> ";
    }

    $(".msg-discount").html(out);

    if(isNaN(subtotal_codes) || subtotal_codes.length <= 0) { cant = 0; }


    $(".import-product").html("$ " + formatNumber(subtotal_codes));


}



$("#igualma-line").change(function(){
      getCodesBlank();
});

$("#igualma-capacity").change(function(){
      getCodesBlank();
});



function getCodesBlank()
{
      console.log("Get capacitys");

      let line = $("#igualma-line").val();
      let capacity = $("#igualma-capacity").val();

      if(line <= 0 || capacity <= 0){ return; }

      loading_scrum();
      let url = `../../../app/api/item.php?a=3&&line=${line}&&capacity=${capacity}`;
      console.log(url);

      fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
        stop_scrum();

        if(data.code == 200)
        {
              $("#igualma-code-blanco").html(data.data);
        }

      })
      .catch(function(err) {
          stop_scrum(); console.log(err);
      });

}



function validateMA()
  {

        let err = 0;
        let msg = "";

        let line = document.getElementById("igualma-line").value;
        let capacity = document.getElementById("igualma-capacity").value;
        let description = document.getElementById("igualma-description").value;
        let cant = document.getElementById("igualma-cant").value;
        let price = document.getElementById("igualma-price").value;

        let blanco = document.getElementById("igualma-code-blanco").value;


        if(line == 0) { err++; msg += "Seleccione linea <br> " }
        if(capacity == 0) { err++; msg += "Seleccione capacidad <br> " }
        if(blanco <= 0) { err++; msg += "Seleccione el código de blanco <br> " }
        if(description.length < 4 ) { err++; msg += "Ingrese una descripción <br>" }
        if(isNaN(cant) || cant == 0) { err++;  msg += "Ingrese una cantidad <br> " }
        if(isNaN(cant) || price == 0) { err++;  msg += "Ingrese el precio del igualado <br> " }

        let counts = 0;
        let products = Array();
        let count_cant_incorrectas = 0;
        $(".table-codes-for-igualma tbody tr").each(function(){
            counts++;
            let cant_code = $(this).find("td").eq(4).children("input").val();
            let exist_code = $(this).find("td").eq(3).text();
            let code = $(this).find("td").eq(0).text().trim();

            if(isNaN(cant_code) || cant_code <= 0 || cant_code.length == 0){
                $(this).find("td").eq(4).children("input").css("background", "#ffcfcf");
                err++;
                if(count_cant_incorrectas == 0)
                {
                    msg += "Existen códigos con cantidades incorrectas <b>";
                }
                count_cant_incorrectas++;
            }

            if(venta_con_kardex)
            {   if(!vender_sin_existencias)
                {   if(tipo_documento == 1)
                    {
                      if(Math.abs(cant_code) > Math.abs(exist_code))
                      {
                          err++; msg += "Existen códigos con existencias insuficientes ";
                      }
                    }
                }
            }

            products.push(Array(cant_code, code));
        });

        if(counts == 0) { err++;  msg += "Se necesita añadir productos para igualar <br> " }

        if(err > 0)
        {
            let out = '<div class="alert alert-warning alert-dismissible fade show" role="alert"> ' +
                            '<strong>¡No es posible agregar el igualado!</strong> <br> ' + msg +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> ' +
                            '<span aria-hidden="true">&times;</span> ' +
                            '</button> ' +
                        '</div> ';

            $(".msg-igualma").html(out);

            return [false, null];
        }
        else
        {   $(".msg-igualma").html("");

            const data = new FormData();
            data.append('line', line);
            data.append('capacity', capacity);
            data.append('description', description);
            data.append('cant', cant);
            data.append('price', price);
            data.append('products', products);
            data.append('identified', identified);
            data.append('blanco', blanco);

            return [true, data];

        }
  }



$(".btn-add-igualma").click(function(){

let validation = validateMA();

console.log(validation);

    if(validation[0])
    {
        loading_scrum();
        let url = "../../../app/api/sale.php?a=23";
        fetch(url, { method: 'POST', body: validation[1] })
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
                if(data.status)
                {
                    showModalMessageError("success", "Igualado Agregado Correctamente", 1500);
                    setTimeout(function(){ window.location = "../../changeConfig/"+identified+"/7/"+data.tipo_descuento+"/"; }, 1100);
                    return;
                }
            }

            stop_scrum();
            statusHTTP(data, null);
        })
        .catch(function(err) {
            console.log(err);
            stop_scrum();
            alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../aditems/"+identified+"/");
        });
    }
});
