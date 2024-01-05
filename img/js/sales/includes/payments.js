
var IDFP = 0;

$(".delete-payment").click(()=>{
    loading_scrum();
});

$(".payment-form").click(function(){

    $(".payment-form").removeClass("btn-primary");
    $(".payment-form").removeClass("btn-warning");
    $(".payment-form").addClass("my-btn-blue-light");

    $(this).removeClass("btn-info");
    $(this).removeClass("btn-warning");
    $(this).removeClass("my-btn-blue-light");
    $(this).addClass("btn-primary");

    IDFP = $(this).attr("data-key");
    let total = "";

    $(".payment-card").removeAttr("placeholder");
    $(".payment-card").attr("placeholder", "Ult 4 Dig");

    if(IDFP == 2)
    {
        $(".payment-card").removeAttr("placeholder");
        $(".payment-card").attr("placeholder", "No Cheque");
    }
    if(IDFP == 10)
    {
        $(".payment-card").removeAttr("placeholder");
        $(".payment-card").attr("placeholder", "No Referencia");
    }


    if(IDFP > 1)
    {
        $(".d-payment-card").removeClass("d-none");
        $(".payment-card").focus();

        total = document.getElementById("total_payment").innerText.trim();
        total = total.replace("$", "");
        total = total.replace(",", "");
    }
    else{
            $(".d-payment-card").addClass("d-none");
            $(".payment-import").focus();
    }

    AMOUNT_PAYMENT = total;
    $(".payment-import").val(total);

});


$(".payment-card").keyup(function(){

  if(IDFP == 10)
  {
      $(this).css("background", "#fff");
  }
  else
  {
      if(IDFP != 1)
      {
          if(!isNaN($(this).val()))
          {
              $(this).css("background", "#fff");
          }
          else
          {
              $(this).css("background", "#ffcfcf");
          }
      }
  }
});


$(".payment-import").keyup(function(event)
{
    if(!isNaN($(this).val()))
    {
        $(this).css("background", "#fff");
        console.log(IDFP);
        if(IDFP > 1)
        {
            if(parseFloat($(this).val()) > parseFloat(AMOUNT_PAYMENT))
            {
                $(this).css("background", "#ffcfcf");
                return;
            }
            else
            {
                $(this).css("background", "#fff");
            }
        }

        if(event.keyCode == 13)
        {
            addPayment();
        }
    }
    else
    {
        console.log("no entraa ");
        $(this).css("background", "#ffcfcf");
    }
});


$(".add-payment").click(()=>{
    addPayment();
});


function addPayment()
{
    if(IDFP == 0)
    {
        $(".payment-form").removeClass("btn-primary");
        $(".payment-form").addClass("btn-warning");
    }
    else
    {
        let ammount = $(".payment-import").val();
        let card = $(".payment-card").val();

        let validation = validaPayment(ammount, card);

        if(validation)
        {
                loading_scrum();
                const data = new FormData();
                data.append('identified', identified);
                data.append('ammount', ammount);
                data.append('card', card);
                data.append('IDFP', IDFP);

                let url = "../../addPaymentForSale/";

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
                                        if(data.save)
                                        {
                                            window.location = "../"+identified+"/";
                                        }
                                        else{ alertMessage("warning", "¡Error al realizar la operación!", "Aceptar", true, "../../additem/"+identified+"/"); }
                                    }
                                    else{ alertMessage("warning", "¡La ya ha sido finalizada!", "Ver detalles", true, "../../detail/"+identified+"/"); }
                                }
                                else { alertMessage("warning", "¡La venta no existe!", "Ir a listado", true, "../../"); }
                        }
                        else{ alertMessage("warning", "Los datos enviados son incorrectos", "Aceptar", false, null); stop_scrum(); }
                    }
                    else { alertMessage("warning", "¡La sessión ha expirado!", "Iniciar sesión", true, "../../../login/"); }
                })
                .catch(function(err) {
                    console.log(err);
                    alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../../additem/"+identified+"/");
                    stop_scrum();
                });

        }
        else
        { console.log("no pasa validacion ");}
    }

}


function validaPayment(ammount, card)
{   let err = 0;
    if(isNaN(ammount)) { err++; $(".payment-import").css("background", "#ffcfcf"); }
    if(ammount.length == 0) { err++; $(".payment-import").css("background", "#ffcfcf"); }

    console.log(ammount);
    console.log(AMOUNT_PAYMENT);
    if(IDFP > 1)
    {

      if(IDFP != 10)
      {
          if(isNaN(card))
          {
              err++; $(".payment-card").css("background", "#ffcfcf");
          }
          else{
              if(card.length >= 4){

              }
              else {
                  err++;  $(".payment-card").css("background", "#ffcfcf");
              }
          }

          if(parseFloat(ammount) > parseFloat(AMOUNT_PAYMENT))
          {
              err++;  $(".payment-import").css("background", "#ffcfcf");
          }
      }
    }

    if(IDFP == null || IDFP == 0 || IDFP.length <= 0) { err++; }
    if (err > 0) { return false; } else { return true; }
}
