$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});


$(".btn-update").click(function(){
  let nombre = $("#nombre");
  let username = $("#username");
  let area = $("#area");
  let id = $("#iduser").val();

  let error = 0;
  error += valid_imputs([nombre, username, area]);
  error += valid_numeric_positive([area]);
  error += valid_no_cero([area]);
  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }
  loading_scrum();

  let url = `../../../app/api/user.php?a=5`;

  const data = new FormData();
  data.append('nombre', nombre.val());
  data.append('username', username.val());
  data.append('area', area.val());
  data.append('tipo_sistema', 2);
  data.append('id_user',  id);

  fetch(url,{method:'POST', body:data})
  .then((response) => { return response.json(); })
  .then((data) => {
    console.log(data);
    const { code, status, id }  = data;
      if(code == 201)
      {
          showModalMessageError("success", "Usuario Modificado Correctamente", 2300);
          stop_scrum();
          return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch((err) =>{ stop_scrum(); console.log(err); });
});
