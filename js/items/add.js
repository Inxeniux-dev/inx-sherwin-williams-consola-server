$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});

$(".btn-save").click(function(){
  let codigo = $("#codigo");
  let barcode = $("#barcode");
  let codigo_asociado = $("#codigo_asociado");
  let precio = $("#precio");
  let descripcion = $("#descripcion");
  let clave_sat = $("#clave_sat");
  let linea = $("#line");
  let capacidad = $("#capacity");
  let descuento = $("#descuento");
  let fechini = $("#fechini");
  let fechfin = $("#fechfin");
  let peso = $("#peso");
  let marca = $("#marca");

  let es_base = $("#es_base");
  let check_es_base = 0;
  if(es_base.is(':checked') ) { check_es_base = 1; }


  let error = 0;
  error += valid_imputs([codigo, descripcion, precio, clave_sat, linea, capacidad, descuento, fechini, fechfin, peso, marca]);
  error += valid_numeric_positive([linea, capacidad, descuento, precio, peso, marca]);
  error += valid_no_cero([linea, capacidad, marca]);

  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

  loading_scrum();

  let url = `../../app/api/item.php?a=8`;

  const data = new FormData();
  data.append('codigo', codigo.val());
  data.append('barcode', barcode.val());
  data.append('codigo_asociado', codigo_asociado.val());
  data.append('precio', precio.val());
  data.append('descripcion', descripcion.val());
  data.append('clave_sat', clave_sat.val());
  data.append('es_base', check_es_base);
  data.append('linea', linea.val());
  data.append('capacidad', capacidad.val());
  data.append('descuento', descuento.val());
  data.append('fechini', fechini.val());
  data.append('fechfin', fechfin.val());
  data.append('peso', peso.val());
  data.append('marca', marca.val());

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
    const { code, status }  = data;
      if(code == 201)
      {
        showModalMessageError("success", "Producto Agregado Correctamente", 2300);
        setTimeout(function(){ window.location =`../list/` }, 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });
});
