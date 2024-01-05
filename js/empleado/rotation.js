$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });

    obtenerRotacion();
});


const obtenerRotacion = () => {

  loading_scrum();
  let idemploye = $("#idemploye").val();

  let url = `../../../app/api/employee.php?a=2&idemploye=${idemploye}`;
  console.log(url);
  fetch(url)
   .then(function(response) {return response.json();})
   .then(function(data) {
     console.log(data);
       if(data.code == 200)
       {
          $(".table-rotacion").html(data.output);
       }
       stop_scrum();
   })
   .catch(function(err) { showModalMessageError("error", "Error al consultar la información", 2500);  console.log(err); stop_scrum(); });
}


const create = () =>
{

  let idemploye = $("#idemploye").val();
  let sucursal = $("#sucursal");
  let expiracion = $("#expiracion");

  let unexpired = $("#unexpired");
  let check_unexpired = 0;
  if(unexpired.is(':checked')) { check_unexpired = 1; }

  let all = $("#all");
  let check_all = 0;
  if(all.is(':checked')) { check_all = 1; }

  let error = 0;

  if(check_all == 0)
  {
    error += valid_imputs([sucursal, expiracion]);
    error += valid_numeric_positive([sucursal]);
  }
  else {
    error += valid_imputs([expiracion]);
  }

  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

  loading_scrum();

  const data = new FormData();
  data.append('idemploye', idemploye);
  data.append('sucursal', sucursal.val());
  data.append('expiracion', expiracion.val());
  data.append('unexpired', check_unexpired);
  data.append('all', check_all);

  let url = `../../../app/api/employee.php?a=3`;

  fetch(url,{method:'POST', body:data})
  .then(response => response.json() )
  .then((data) =>{
      console.log(data);
      const { code }  = data;
      if(code == 201)
      {
        showModalMessageError("success", "Registro agregado correctamente", 2300);
        obtenerRotacion();
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch((err)  => { stop_scrum(); console.log(err); });

}


$(".btn-save").click(() => { create(); });

$("#unexpired").change( function(){
    if($(this).is(':checked')){ $("#expiracion").attr("disabled", "disabled"); }
    else{ $("#expiracion").removeAttr("disabled");}
});


const expirar = (id) => {

  const data = new FormData();
  data.append('idrotacion', id);

  let url = `../../../app/api/employee.php?a=4`;

  fetch(url,{method:'POST', body:data})
  .then(response => response.json() )
  .then((data) =>{
      console.log(data);
      const { code }  = data;
      if(code == 201)
      {
        showModalMessageError("success", "Registro expirado correctamente", 2300);
        obtenerRotacion();
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch((err)  => { stop_scrum(); console.log(err); });

};




$("#all").change(function(){
    if($(this).is(':checked'))
    {
        $("#sucursal").attr("disabled", "true");
    }
    else {
        $("#sucursal").removeAttr("disabled");
    }
});
