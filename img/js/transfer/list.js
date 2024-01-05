$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");

    getTransfers(1);
});



function getTransfers(page)
{
    let status = document.getElementById("status").value;
    let fechini = document.getElementById("dateInitial").value;
    let fechafin = document.getElementById("dateFinaly").value;
    let location = 0;
    let type = document.getElementById("type").value;

    let url = "../transfers/getlist/"+page+"/"+status+"/"+fechini+"/"+fechafin+"/"+location+"/"+type+"/";
    $.get(url, null, "html").done(( data, textStatus, jqXHR ) => {
        console.log(textStatus);
        $(".table-transfers").html(data);
        $(".r-pdf").attr("href", `../report/transfer/${status}/${fechini}/${fechafin}/${location}/${type}/`);
        $(".r-xls").attr("href", `../reportExcel/transfer/${status}/${fechini}/${fechafin}/${location}/${type}/`);
      })
      .fail((jqXHR, textError, errorThrown) => {
          console.log("la solicitud ha fallado " + textError);
          console.log("la solicitud ha fallado " + errorThrown);
      });
}


$(".table-transfers").on("click",".pag-number", function(){
    getTransfers($(this).attr("data"));
});

$("#btn-search").click(()=>{ getTransfers(1); });
$("#dateInitial").change(()=>{ getTransfers(1); });
$("#dateFinaly").change(()=>{ getTransfers(1); });
$("#type").change(()=>{ getTransfers(1); });
$("#status").change(()=>{ getTransfers(1); });


$(".table-transfers").on("click",".delete-transfer", function(){
    let params = { "indentified" : $(this).attr("data") };
    $.post('../transfers/cancelTransfer/', params, null, "json").done((data, textStatus, jqXHR ) => {
        console.log(data);
        console.log(textStatus);

        console.log(data.res_prod);
        console.log(data.res_transfer);

        if(data.res_prod && data.res_transfer)
        {
                Swal.fire({
                    type: 'success',
                    title: 'Éxito',
                    text: 'El vale se ha cancelado correctamente',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick : false,
                    allowEscapeKey : false,
                    allowEnterKey : false,
                }).then((result) => {
                    if (result.value) {
                        window.location = "../transfers/";
                    }
                });
        }
        else{
            let msg = '';
            if(!data.res_prod)
            {
                msg += ' Los códigos del no se eliminaron correctamente. ';
            }
            if(!data.res_transfer)
            {
                msg += ' El vale no se ha cancelado. ';
            }
            else{
                msg += " El vale se canceló incorrectamente. "
            }

            Swal.fire({
                type: 'warning',
                title: 'Atención ...',
                text: msg,
                confirmButtonText: 'Aceptar',
                allowOutsideClick : false,
                allowEscapeKey : false,
                allowEnterKey : false,
              })
              .then((result) => {
                if (result.value) {
                    window.location = "../transfers/";
                }
              });

        }

    })
    .fail((jqXHR, textError, errorThrown) => {
        console.log("la solicitud ha fallado " + textError);
        console.log("la solicitud ha fallado " + errorThrown);
          Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: '¡Error al realizar la operación!',
              confirmButtonText: 'Aceptar',
              allowOutsideClick : false,
              allowEscapeKey : false,
              allowEnterKey : false,
          })
          .then((result) => {
              if (result.value) {
                window.location = "../transfers/";
              }
          });
    });


});
