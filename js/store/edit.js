$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
});


let update = () => {

  let id = $("#idsucursal").val();

  let clave = $("#clave");
  let nombre = $("#nombre");
  let serie = $("#serie");
  let telefono = $("#telefono");
  let correo = $("#correo");

  let direccion = $("#direccion");
  let cruzamiento = $("#cruzamiento");
  let no_interior = $("#no_interior");
  let no_exterior = $("#no_exterior");
  let colonia = $("#colonia");
  let cp = $("#cp");

  let municipio = $("#municipio");
  let estado = $("#estado");
  let pais = $("#pais");

  let activo = $("#activo");
  let check_activo = 1;
  if(activo.is(':checked') ) { check_activo = 0; }

  let foranea = $("#foranea");
  let check_foranea = 0;
  if(foranea.is(':checked') ) { check_foranea = 1; }

  let sunday = $("#sunday");
  let check_sunday = 0;
  if(sunday.is(':checked') ) { check_sunday = 1; }

  let ip = $("#ip");


  let error = 0;
  error += valid_imputs([clave, nombre, serie, telefono, correo, direccion, cruzamiento, no_exterior, colonia, cp, municipio, estado, pais, ip]);
  error += valid_numeric_positive([clave, telefono, cp]);
  error += valid_no_cero([clave, cp]);

  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

  loading_scrum();

  let url = `../../../app/api/store.php?a=3`;

  const data = new FormData();
  data.append('id', id);
  data.append('clave', clave.val());
  data.append('nombre', nombre.val());
  data.append('serie', serie.val());
  data.append('telefono', telefono.val());
  data.append('correo', correo.val());

  data.append('status', check_activo);
  data.append('direccion', direccion.val());
  data.append('cruzamiento', cruzamiento.val());
  data.append('no_interior', no_interior.val());
  data.append('no_exterior', no_exterior.val());
  data.append('colonia', colonia.val());
  data.append('cp', cp.val());

  data.append('municipio', municipio.val());
  data.append('estado', estado.val());
  data.append('pais', pais.val());

  data.append('sunday', check_sunday);
  data.append('foranea', check_foranea);

  data.append('ip', ip.val());

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
    const { code, status }  = data;
      if(code == 201)
      {
        showModalMessageError("success", "Sucursal Actualizada Correctamente", 2300);
        setTimeout(function(){ window.location =`../${id}/` }, 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });

}
