$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});


const edit = () => {

  let nombre = $("#nombre");
  let apellido = $("#apellido");
  let num_empleado = $("#num_empleado");
  let sucursal = $("#sucursal");
  let idempleado = $("#idemploye").val();
  let error = 0;

  error += valid_imputs([nombre, apellido, num_empleado, sucursal]);
  error += valid_numeric_positive([sucursal]);

  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }
  loading_scrum();

  let url = `../../../app/api/employee.php?a=5`;

  const data = new FormData();
  data.append('nombre', nombre.val());
  data.append('apellido', apellido.val());
  data.append('num_empleado', num_empleado.val());
  data.append('sucursal', sucursal.val());
  data.append('idempleado', idempleado);

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
    const { code, status }  = data;
      if(code == 201)
      {
        showModalMessageError("success", "Empleado Actualizado Correctamente", 2300);
        setTimeout(function(){ window.location =`../${idempleado}/` }, 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });
}



const saveSecurity = () => {


  let username = $("#username");
  let password = $("#password");
  let add_pintor = $("#add_pintor");
  let list_pintor = $("#list_pintor");
  let add_user = $("#add_user");
  let list_user = $("#list_user");
  let idempleado = $("#idemploye").val();

  let check_add_pintor = 0;
  if(add_pintor.is(':checked') ) { check_add_pintor = 1; }

  let check_list_pintor = 0;
  if(list_pintor.is(':checked') ) { check_list_pintor = 1; }

  let check_add_user = 0;
  if(add_user.is(':checked') ) { check_add_user = 1; }

  let check_list_user = 0;
  if(list_user.is(':checked') ) { check_list_user = 1; }

  let error = 0;

  error += valid_imputs([username, password]);
  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }
  loading_scrum();



  let url = `../../../app/api/employee.php?a=7`;

  const data = new FormData();
  data.append('username', username.val());
  data.append('password', password.val());
  data.append('add_pintor', check_add_pintor);
  data.append('list_pintor', check_list_pintor);
  data.append('add_user', check_add_user);
  data.append('list_user', check_list_user);
  data.append('idempleado', idempleado);

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
    const { code, status }  = data;
      if(code == 201)
      {
        showModalMessageError("success", "Empleado Actualizado Correctamente", 2300);
        setTimeout(function(){ window.location =`../${idempleado}/` }, 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });



}