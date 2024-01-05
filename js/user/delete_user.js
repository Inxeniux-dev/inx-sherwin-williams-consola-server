$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});


let deleteUser = (iduser, idsistema) => {
  Swal.fire({
      title: '¡No podrás revertir esto! ',
      text: "¿Deseas eliminar al usuario?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: '¡Si, eliminar!',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
          confirm(iduser, idsistema);
      }
    });
}



let confirm = (iduser, idsistema) => {

  loading_scrum();
  let url = `../../app/api/user.php?a=9`;

  const data = new FormData();
  data.append('iduser', iduser);
  data.append('idsistema', idsistema);

  fetch(url,{method:'POST', body:data})
  .then((response) => { return response.json(); })
  .then((data) => {
    console.log(data);
    const { code, status, id }  = data;
      if(code == 201)
      {
          showModalMessageError("success", "Usuario Eliminado Correctamente", 2300);
          setTimeout(function(){ window.location =`./` }, 2300);
          return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch((err) =>{ stop_scrum(); console.log(err); });
}
