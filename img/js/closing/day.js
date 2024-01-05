$(document).ready(function(){
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
});



$(".ver_cierre").click(function(){
    loading_scrum();
    let date = $("#dateInitial").val();
    window.location = '../'+date+"/";
  });




$(".r-pdf").click(function(){
    Swal.fire({
        title: '¡No podrás revertir esto! ',
        text: "Si generas el reporte, el punto de venta será bloqueado y ya no podrás ingresar movimientos. \n Si vas a realizar tu cierre del día puedes continuar, de lo contrario regresa más tarde.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '¡Si, generar reporte!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
              let date = $("#dateInitial").val();
              window.open("../../../report/closing/"+date+"/", '_blank');
        }
      });
});



$(".r-xls").click(function(){
    Swal.fire({
        title: '¡No podrás revertir esto! ',
        text: "Si generas el reporte, el punto de venta será bloqueado y ya no podrás ingresar movimientos. \n Si vas a realizar tu cierre del día puedes continuar, de lo contrario regresa más tarde.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '¡Si, generar reporte!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
              let date = $("#dateInitial").val();
              window.open("../../../reportExcel/closing/"+date+"/", '_blank');
        }
      });
});






$(".btn-close-day").click(function(){

    loading_scrum();

  /*  $('#modal-backup').modal({
            backdrop: 'static',
            keyboard: false
        }); */

    let url = `../../../app/api/closing.php?a=1`;
    const data = new FormData();
    data.append('code_key', $("#code_key").val());
    data.append('md5_key', $("#md5_key").val());

    fetch(url,{method:'POST', body: data})
        .then(function(response) {return response.json();})
        .then(function(data) {
        console.log(data);
        $('#modal-backup').modal('hide');

        if(data.code == 200)
        {
            if(data.status)
            {
              window.location = '../';
            }
            else {
              stop_scrum();
            }

        }

        stop_scrum();
        statusHTTP(data, "../../");

        })
        .catch(function(err) {
            stop_scrum(); console.log(err);  $('#modal-backup').modal('hide');

        });

});
