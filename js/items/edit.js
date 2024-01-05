$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});

$(".btn-update").click(function(){
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

  let hidden = $("#cod-hidd").val();
  let bhidden = $("#bar-hidd").val();
  let idprod  = $("#idprod").val();

  let es_base = $("#es_base");
  let check_es_base = 0;
  if(es_base.is(':checked') ) { check_es_base = 1; }

  let desactivar = $("#status");
  let check_desactivar = 0;
  if(desactivar.is(':checked') ) { check_desactivar = 1; }


  let error = 0;
  error += valid_imputs([codigo, descripcion, precio, clave_sat, linea, capacidad, descuento, fechini, fechfin, peso, marca]);
  error += valid_numeric_positive([linea, capacidad, descuento, precio, peso, marca]);
  error += valid_no_cero([linea, capacidad, marca]);

  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

  loading_scrum();

  let url = `../../../app/api/item.php?a=12`;

  const data = new FormData();
  data.append('codigo', codigo.val());
  data.append('hidden', hidden);
  data.append('bhidden', bhidden);

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
  data.append('status', check_desactivar);
  data.append('marca', marca.val());

  data.append('id_prod', idprod);

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
    const { code, status }  = data;
      if(code == 201)
      {
        showModalMessageError("success", "Producto Actualizado Correctamente", 2300);
        setTimeout(function(){ window.location =`../${idprod}/` }, 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });
});
