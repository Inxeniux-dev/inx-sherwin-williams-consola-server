$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });

    document.getElementById("name").disabled = true;
    document.getElementById("lastname").disabled = true;
    document.getElementById("razon").disabled = true;

    if($("#rfc").val().length == 12){
        document.getElementById("name").disabled = true;
        document.getElementById("name").value = "";
        document.getElementById("lastname").disabled = true;
        document.getElementById("lastname").value = "";
        document.getElementById("razon").disabled = false;
        document.getElementById("rfc").style.border = color_border_normal;
        llenaRegimen(1);
    }
    else if($("#rfc").val().length == 13){
        document.getElementById("name").disabled = false;
        document.getElementById("lastname").disabled = false;
        document.getElementById("razon").disabled = true;
        document.getElementById("razon").value = "";
        document.getElementById("rfc").style.border = color_border_normal;
        llenaRegimen(0);
    }
    else{
        document.getElementById("name").disabled = true;
        document.getElementById("name").value = "";
        document.getElementById("lastname").disabled = true;
        document.getElementById("lastname").value = "";
        document.getElementById("razon").disabled = true;
        document.getElementById("razon").value = "";
        document.getElementById("rfc").style.border = color_border_normal;
        llenaRegimen(-1);
    }
});

function convMayusculas(field) {
  field.value = field.value.toUpperCase()
}

function convMinusculas(field) {
  field.value = field.value.toLowerCase()
}

let color_border_error = "1px solid  #ff988e";
let color_border_normal = "1px solid  #c5c5c5";

$(".btn-update").click(function(){
  let rfc = $("#rfc");
  let rfc_confirm = $("#rfc_confirm");
  let name = $("#name");
  let lastname = $("#lastname");
  let razon = $("#razon");
  let email = $("#email");
  let telefono = $("#telefono");
  let celular = $("#celular");

  let direccion = $("#direccion");
  let colonia = $("#colonia");
  let numexterior = $("#numexterior");
  let numinterior = $("#numinterior");
  let cp = $("#cp");
  let municipio = $("#municipio");
  let estado = $("#estado");
  let pais = $("#pais");
  let regimen = $("#regimen");
  let idcust = $("#idcust").val();

  let error = 0;

  var rfcCorrecto = rfcValido(rfc.val());
  if (!rfcCorrecto) { showModalMessageError("warning", "El RFC es incorrecto", 2300); border_error([rfc]); return; }

  if (rfc.val().length == 12) {
    error += valid_imputs([rfc, razon, rfc_confirm]);
  }
  if (rfc.val().length == 13) {
    error += valid_imputs([rfc, name, lastname, rfc_confirm]);
  }

  if (rfc_confirm.val() != rfc.val()) {
    error += valid_numeric_positive([rfc_confirm]);
  }

  error += valid_imputs([cp, municipio, estado, pais, regimen]);
  error += valid_numeric_positive([regimen]);
  if (error > 0) { showModalMessageError("warning", "Verifique campos en rojo", 2300); return; }

  loading_scrum();

  let url = `../../../app/api/customer.php?a=12`;

  const data = new FormData();

  data.append('rfc', rfc.val());
  data.append('rfc_confirm', rfc_confirm.val());
  data.append('name', name.val());
  data.append('lastname', lastname.val());
  data.append('razon', razon.val());
  data.append('email', email.val());
  data.append('telefono', telefono.val());
  data.append('celular', celular.val());

  data.append('direccion', direccion.val());
  data.append('colonia', colonia.val());
  data.append('numexterior', numexterior.val());
  data.append('numinterior', numinterior.val());
  data.append('cp', cp.val());
  data.append('municipio', municipio.val());
  data.append('estado', estado.val());
  data.append('pais', pais.val());
  data.append('regimen', regimen.val());
  data.append('id_cust', idcust);

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
    const { code, status }  = data;
      if(code == 201)
      {
        showModalMessageError("success", "Cliente Actualizado Correctamente", 2300);
        setTimeout(function(){ window.location =`../../list/` }, 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });
});

$("#rfc").keyup(() => {
  document.getElementById("name").value = "";
  document.getElementById("lastname").value = "";
  document.getElementById("razon").value = "";

  if($("#rfc").val().length == 12){
      document.getElementById("name").disabled = true;
      document.getElementById("lastname").disabled = true;
      document.getElementById("razon").disabled = false;
      document.getElementById("rfc").style.border = color_border_normal;
      llenaRegimen(1);
  }
  else if($("#rfc").val().length == 13){
      document.getElementById("name").disabled = false;
      document.getElementById("lastname").disabled = false;
      document.getElementById("razon").disabled = true;
      document.getElementById("rfc").style.border = color_border_normal;
      llenaRegimen(0);
  }
  else{
      document.getElementById("name").disabled = true;
      document.getElementById("lastname").disabled = true;
      document.getElementById("razon").disabled = true;
      document.getElementById("rfc").style.border = color_border_error;
      llenaRegimen(-1);
  }
});

const llenaRegimen = (tipo) => {
  if (tipo == -1) {
    $("#regimen").html(`<option value='-1'>Seleccione</option>`);
  }

  if (tipo == 0) {
    let out = `<option value='-1'>Seleccione</option>`;
    data_fisica.forEach(element => {
      out += `<option value='${element.id}'>${element.clave}-${element.descripcion}</option>`;
    });
    $("#regimen").html(out);
  }

  if (tipo == 1) {
    let out = `<option value='-1'>Seleccione</option>`;
    data_moral.forEach(element => {
      out += `<option value='${element.id}'>${element.clave}-${element.descripcion}</option>`;
    });
    $("#regimen").html(out);
  }
}