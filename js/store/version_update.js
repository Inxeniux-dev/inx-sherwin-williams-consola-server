$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
});


$(".btn-upd").click(function(){

  let version = $("#version");
  let ip = $("#ip");
  let error = 0;
  error += valid_imputs([ip, version]);
  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

  version = version.val();
  if(version != 1)
  {
  	 showModalMessageError("warning", "¡No es posible actualizar los datos cuando la versión del PDV es antigua!", 2300); return;
  }

  if(!ValidateIPaddress(ip.val()))
  {
  	 showModalMessageError("warning", "¡Formato de IP incorrecto!", 2300); return;
  }


  Swal.fire({
          title: '¡Atención! ',
          text: "No podrás revertir esta operación una vez confirmada, asegúrate de que los datos sean de la sucursal correcta",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: 'rgb(63 99 134)',
          cancelButtonColor: '#3085d6',
          confirmButtonText: '¡Si, confirmar!',
          cancelButtonText: 'No'
        }).then((result) => {
          if (result.value) {
          		update_version(version, ip.val());
          }
        });
});


function update_version(version, ip)
{

   let url = `../../../app/api/store.php?a=2`;

   loading_scrum('CARGANDO PLANTILLA EN BD, CREANDO CARPETA DE RESPALDOS, ESPERE...');
  const data = new FormData();
  data.append('version', version);
  data.append('ip', ip);
  data.append('id', id);

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
      if(data.code == 201)
      {
        showModalMessageError("success", "Configuración Actualizada", 2300);
        setTimeout(function(){ window.location =`../../list/` }, 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err);  showModalMessageError("error", "Hay un problema al realizar el proceso", 2300); });
}
