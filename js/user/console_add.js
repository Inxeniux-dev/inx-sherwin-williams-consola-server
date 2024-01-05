$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});


$(".btn-save").click(function(){
  let nombre = $("#nombre");
  let username = $("#username");
  let password = $("#password");
  let repeat_password = $("#repeat_password");
  let area = $("#area");

  let error = 0;
  error += valid_imputs([nombre, username, password, repeat_password, area]);
  error += valid_numeric_positive([area]);
  error += valid_no_cero([area]);
  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

  if(password.val() != repeat_password.val())
  {
    showModalMessageError("warning", "¡El password no coincide!", 2300); return;
  }

  loading_scrum();

  let url = `../../app/api/user.php?a=3`;

  const data = new FormData();
  data.append('nombre', nombre.val());
  data.append('username', username.val());
  data.append('password', password.val());
  data.append('repeat_password', repeat_password.val());
  data.append('area', area.val());
  data.append('tipo_sistema', 1);

  fetch(url,{method:'POST', body:data})
  .then((response) => { return response.json(); })
  .then((data) => {
    console.log(data);
    const { code, status, id }  = data;
      if(code == 201)
      {
          showModalMessageError("success", "Usuario Agregado Correctamente", 2300);
          setTimeout(function(){ window.location =`../consolePermission/${id}/` }, 2300);
          return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch((err) =>{ stop_scrum(); console.log(err); });
});
