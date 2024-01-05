$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});


let add = () => {

    let almacen = $("#almacen");
    let iduser = $("#iduser").val();
    let error = 0;
    error += valid_imputs([almacen]);
    error += valid_numeric_positive([almacen]);
    error += valid_no_cero([almacen]);
    if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

    loading_scrum();
    let url = `../../../app/api/user.php?a=6`;

    const data = new FormData();
    data.append('almacen', almacen.val());
    data.append('iduser', iduser);

    fetch(url,{method:'POST', body:data})
    .then((response) => { return response.json(); })
    .then((data) => {
      console.log(data);
      const { code, status, id }  = data;
        if(code == 201)
        {
            showModalMessageError("success", "Almacén asignado correctamente", 2300);
            setTimeout(function(){ window.location =`../${iduser}/` }, 2300);
            return;
        }
        statusHTTP(data, "../../");
        stop_scrum();
    })
    .catch((err) =>{ stop_scrum(); console.log(err); });

}



let eliminar = ( idalmacen,  id ) => {

  loading_scrum();
  let url = `../../../app/api/user.php?a=7`;

  const data = new FormData();
  data.append('almacen', idalmacen);
  data.append('iduser', id);

  let iduser = id;

  fetch(url,{method:'POST', body:data})
  .then((response) => { return response.json(); })
  .then((data) => {
    console.log(data);
    const { code, status, id }  = data;
      if(code == 201)
      {
          showModalMessageError("success", "Almacén eliminado del usuario correctamente", 2300);
          setTimeout(function(){ window.location =`../${iduser}/` }, 2300);
          return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch((err) =>{ stop_scrum(); console.log(err); });
}
