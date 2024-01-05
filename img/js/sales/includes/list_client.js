


$(".btn-clients").click(() => {  $(".table-modal-customers").html("Consultando..."); get_list(1); });
$("#searchCustomer").keyup(()=>{ get_list(1); });
$("#btn-search-customer").click(()=>{ get_list(1); });
$("#typeCustomer").change(()=> { get_list(1); });


function get_list(page)
{
    let item = $("#searchCustomer").val();
    let type = document.getElementById("typeCustomer").value;
    let url = "../../listclient/"+page+"/"+type+"/"+identified+"/new/"+item+"/";
    console.log(url);
    $.get(url, null, "html").done(( data, textStatus, jqXHR ) => {
        console.log(textStatus);
        $(".table-modal-customers").html(data);
      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}


$(".table-modal-customers").on("click",".pag-number", function(){
    get_list($(this).attr("data"));
});


function addCustomer(idcustomer)
{
    window.location = "../../changeConfig/"+identified+"/4/"+idcustomer+"/";
}


$("#btn-new-customer").click(function(){
    console.log("eee");
    $("#exampleModal").modal("hide");
    $("#modalNewClient").modal("show");
});


function convMayusculas(field)
{
    field.value = field.value.toUpperCase()
}

function convMinusculas(field)
{
    field.value = field.value.toLowerCase()
}

let color_border_error = "1px solid  #ff988e";
let color_border_normal = "1px solid  #c5c5c5";


$(".btn-confirm-client").click(function(){

  let rfc = $("#rfc");
  let name = $("#name");
  let lastname = $("#lastname");
  let razon = $("#razon");
  let email = $("#email");
  let telefono = $("#telefono");
  let celular = $("#celular");
  let rfc_confirm = $("#rfc_confirm");

  let direc = $("#direc");
  let colonia = $("#colonia");
  let numexterior = $("#numexterior");
  let numinterior = $("#numinterior");
  let cp = $("#cp");
  let municipio = $("#municipio");
  let estado = $("#estado");
  let pais = $("#pais");
  let error = 0;

  let is_fisic = true;

  var rfcCorrecto = rfcValido(rfc.val());
  if(!rfcCorrecto){ showModalMessageError("warning", "El RFC es incorrecto", 3000);   border_error([rfc]); return; }

  if(rfc.val().length == 12)
  {
      is_fisic = false;
      error += valid_imputs([rfc, razon, rfc_confirm]);
  }
  if(rfc.val().length == 13)
  {
      error += valid_imputs([rfc, name, lastname, rfc_confirm]);
  }

  if(rfc_confirm.val() != rfc.val())
  {
      error += valid_numeric_positive([rfc_confirm]);
  }

  error += valid_imputs([cp, municipio, estado, pais, email]);

  if(error > 0){ showModalMessageError("warning", "Verifique campos en rojo", 3000); return; }

  RegisterCustomer();

});


function RegisterCustomer()
{

  const data = new FormData();
  data.append('rfc', $("#rfc").val());
  data.append('rfc_update', $("#rfc_update ").val());
  data.append('name', $("#name").val());
  data.append('lastname', $("#lastname").val());
  data.append('razon', $("#razon").val());
  data.append('email', $("#email").val());
  data.append('telefono', $("#telefono").val());
  data.append('celular', $("#celular").val());
  data.append('direc', $("#direc").val());
  data.append('colonia', $("#colonia").val());
  data.append('numexterior', $("#numexterior").val());
  data.append('numinterior', $("#numinterior").val());
  data.append('cp', $("#cp").val());
  data.append('municipio', $("#municipio").val());
  data.append('estado', $("#estado").val());
  data.append('pais', $("#pais").val());
  data.append('ic', 0);
  data.append('edit', false);

  let url = "../../../customers/register/";

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) {
    console.log(data);
    if(data.validation)
    {   if(!data.duplicate)
        {
            if(data.save)
            {
                $(".btn-confirm-client").hide();
                showModalMessageError("success", '¡El cliente se ha registrado correctamente!', 2200);
                $("#modalNewClient").modal("hide");
                cleanModalClient();
                addCustomer(data.id);
                return;
            }
            else{
              showModalMessageError("warning", "¡Error al realizar la operación!", 2200);
              $(".btn-confirm-client").show();
            }
        }
        else{
          showModalMessageError("error", "¡El RFC ingresado, ya está registrado!", 2200);
          $(".btn-confirm-client").show();
        }
    }
    else{
         showModalMessageError("error", "¡Error al realizar la operación!", 2200);
    }
  })
  .catch(function(err) {
      console.log(err);
      showModalMessageError("error", "Error al realizar la operación", 2200);
      $(".btn-confirm-client").show();
  });
}


$("#rfc").keyup(() => {
    document.getElementById("name").value = "";
    document.getElementById("lastname").value = "";
    document.getElementById("razon").value = "";

    if($("#rfc").val().length == 12){
        document.getElementById("name").disabled = true;
        document.getElementById("lastname").disabled = true;
        document.getElementById("razon").disabled = false;
        document.getElementById("rfc").style.border = color_border_normal;
    }
    else if($("#rfc").val().length == 13){
        document.getElementById("name").disabled = false;
        document.getElementById("lastname").disabled = false;
        document.getElementById("razon").disabled = true;
        document.getElementById("rfc").style.border = color_border_normal;
    }
    else{
        document.getElementById("name").disabled = true;
        document.getElementById("lastname").disabled = true;
        document.getElementById("razon").disabled = true;
        document.getElementById("rfc").style.border = color_border_error;
    }
});

function cleanModalClient()
{
  $("#rfc").val("");
  $("#rfc_update").val("");
  $("#name").val("");
  $("#lastname").val("");
  $("#razon").val("");
  $("#email").val("");
  $("#telefono").val("");
  $("#celular").val("");
  $("#direc").val("");
  $("#colonia").val("");
  $("#numexterior").val("");
  $("#numinterior").val("");
  $("#cp").val("");
  $("#municipio").val("");
  $("#estado").val("");
  $("#pais").val("");
  $(".btn-confirm-client").show();
}
