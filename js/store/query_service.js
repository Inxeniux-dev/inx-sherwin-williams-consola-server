$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
});



$(".btn-send").click(function(){

  let sentence = $("#sentence");
  let error = 0;
  error += valid_imputs([sentence]);
  if(error > 0 ){ showModalMessageError("warning", "¡Ingresa la sentencia SQL!", 2300); return; }

  Swal.fire({
          title: '¡Atención! ',
          text: "No podrás revertir esta operación una vez confirmada, asegúrate de que la sentencia SQL sea la correcta",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: 'rgb(63 99 134)',
          cancelButtonColor: '#3085d6',
          confirmButtonText: '¡Si, confirmar sentencia!',
          cancelButtonText: 'No'
        }).then((result) => {
          if (result.value) {
              loading_scrum("ENVIANDO INFORMACIÓN A LA SUCURSAL, ESPERE...");
          }
        });
});
