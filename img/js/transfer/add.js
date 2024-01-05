$(document).ready(function(){

    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });

    console.log('read');

    if($("#type").val() == 1 || $("#type").val() == 2 || $("#type").val() == 6)
    {
        $(".d-folio").removeClass("d-none");
        $(".d-auditor").addClass("d-none");
    }

    if($("#type").val() == 3)
    {
        $(".d-auditor").removeClass("d-none");
        $(".d-folio").addClass("d-none");
    }
});

let color_border_error = "1px solid  #ff988e";
let color_border_normal = "1px solid  #c5c5c5";


$("#b-add-transfer").click(function(){

  let type = $("#type");
  let folio = $("#folio");
  let dateout = $("#dateout");

  let location = $("#location");
  let locationauditor = $("#locationauditor");

  let neto = $("#neto");
  let subtotal = $("#subtotal");
  let iva = $("#iva");

  let coments = $("#coments");
  let error = 0;

  error += valid_imputs([coments, type]);


  console.log(type.val()+ "<---- type");

  if(type.val() == 17  || type.val() == 16)  //Entrada y Salida moneda
  {
      error += valid_numeric_positive([neto]);
      error += valid_no_cero([neto]);
      error += valid_imputs([locationauditor]);
  }
  else if(type.val() == 1 || type.val() == 2 || type.val() == 6)  //Entrada por Traspaso, salida o entrada por ajuste
  {
      error += valid_imputs([type]);
      error += valid_imputs([folio, dateout]);
      error += valid_numeric_positive([folio]);

      if(type.val() == 1)
      {
          error += valid_imputs([location]);
      }
  }
  else if(type.val() == 7)
  {
      error += valid_imputs([location]);
  }


  if(error > 0){ showModalMessageError("warning", "Verifique campos en rojo", 3000); return; }

    RegisterTransfer();
});


function RegisterTransfer()
{


  const data = new FormData();
  data.append('type', $("#type").val());
  data.append('folio', $("#folio").val());
  data.append('dateout', $("#dateout").val());
  data.append('location', $("#location").val());
  data.append('locationauditor', $("#locationauditor").val());
  data.append('neto', $("#neto").val());
  data.append('subtotal', $("#subtotal").val());
  data.append('iva', $("#iva").val());
  data.append('coments', $("#coments").val());

    let url = "../register/";

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);

        if(data.validation)
        {
            if(data.status)
            {
                if(data.isduplicate)
                {     showModalMessageError("warning", "¡El folio ingresado con la sucursal seleccionada ya esta registrado!", 2000);
                }
                else{
                    if(data.ismoney)
                    {
                          showModalMessageError("success", "El vale se ha registrado correctamente", 2000);
                          setTimeout(function(){ window.location =  "../details/"+data.identified+"/"; }, 2500);
                    }
                    else
                    {
                      showModalMessageError("success", "El vale se ha iniciado correctamente", 2000);
                      setTimeout(function(){ window.location =  "../additems/"+data.identified+"/"; }, 2500);
                    }
                }
            }
            else{
                showModalMessageError("warning", "¡Error al realizar la operación!", 2000);
            }
        }
        else{
            displayMsgs(data.error);
        }
        $("#b-add-transfer").show();
    })
    .catch(function(err) {
        console.log(err);
        showModalMessageError("error", "Error al realizar la operación", 2200);
      $("#b-add-transfer").show();
    });
}




function displayMsgs(errors)
{   console.log(errors)
    let msg_error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
     if(errors.length > 0)
     {
         for(let x=0; x<errors.length; x++)
         {
            msg_error += errors[x]+' <br>';
         }
     }
     msg_error += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

     $(".msg-validadion").html(msg_error);
}




$("#type").change(function(){

    console.log($(this).val());

    $("#subtotal").val("");
    $("#iva").val("");
    $("#neto").val("");

    $("#folio").val("");
    if($(this).val() == 6 || $(this).val() == 2){
        $(".d-location").addClass("d-none");
        $(".d-auditor").removeClass("d-none");
        $(".d-folio").removeClass("d-none");
        $(".d-moneda").addClass("d-none");
        $("#b-add-transfer").html('<i class="fas fa-check-circle"></i> Guardar y continuar');
    }
    else if ($(this).val() == 1){
        $(".d-auditor").addClass("d-none");
        $(".d-location").removeClass("d-none");
        $(".d-folio").removeClass("d-none");
        $(".d-moneda").addClass("d-none");
        $("#b-add-transfer").html('<i class="fas fa-check-circle"></i> Guardar y continuar');
    }
    else if ($(this).val() == 17 || $(this).val() == 16)
    {   $(".d-location").addClass("d-none");
        $(".d-auditor").removeClass("d-none");
        $(".d-folio").addClass("d-none");
        $(".d-moneda").removeClass("d-none");
        $("#b-add-transfer").html('<i class="fas fa-check-circle"></i> Finalizar');
    }
    else{
        $(".d-auditor").addClass("d-none");
        $(".d-location").removeClass("d-none");
        $(".d-folio").addClass("d-none");
        $(".d-moneda").addClass("d-none");
        $("#b-add-transfer").html('<i class="fas fa-check-circle"></i> Guardar y continuar');
    }
});



$("#neto").keyup(function(){
    let neto = $(this).val();

    if(neto.length > 0)
    {
        if(!isNaN(neto))
        {   $("#neto").css("border", color_border_normal);
            let iva = (neto*0.16);
            let subtotal = (neto-iva);
            $("#subtotal").val(Math.round(subtotal * 100 / 100));
            $("#iva").val(Math.round(iva * 100 / 100));
        }
        else
        {
            $("#subtotal").val("");
            $("#iva").val("");
            $("#neto").css("border", color_border_error);
        }
    }
});
