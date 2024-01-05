$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
    getTransfers(1);
});

let IDTRANSFER = 0;

$(".table-transfer").on("click",".pag-number", function(){
    getTransfers($(this).attr("data"));
});


$("#fechini, #fechfin, #sucursal, #cuenta, #status").change( () => { getTransfers(1); });

const search = () => { getTransfers(1); }

const getTransfers = (page) =>{

    let fechini = $("#fechini").val();
    let fechfin = $("#fechfin").val();
    let store = $("#sucursal").val();
    let account = $("#cuenta").val();
    let status = $("#status").val();
    let importe = $("#importe").val();

    loading_scrum();
    $(".table-transfer").html("");
    let url = `../app/api/banktransfer.php?a=1&page=${page}&fechini=${fechini}&fechfin=${fechfin}&store=${store}&account=${account}&status=${status}&importe=${importe}`;
    
    console.log(url);

    fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) { console.log(data);
        $(".table-transfer").html(data.data);

        $(".r-xls").attr("href", `../reportExcel/banktransfer/${fechini}/${fechfin}/${store}/${account}/${status}`);
        stop_scrum();
      })
      .catch(function(err) { stop_scrum(); console.log(err); });

}



const updateStatus = (id, status) => {

    Swal.fire({
        title: '¡Espera! ',
        text: "No podrás revertir esta opción una vez confirmada",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'rgb(63 99 134)',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '¡Si, Aceptar!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
          update_status(id, status);
          return;
        }
      });
}


const update_status = (id, status) => {
    let url = `../app/api/banktransfer.php?a=2`;
    var data = new FormData();
    data.append('id', id);
    data.append('is_server', "true");
    data.append('status', status);

    loading_scrum();
    fetch(url,{method:'POST', body: data})
    .then(function(response) {return response.json();})
    .then(function(data) { 
        const { code, status }  = data;
        if(code == 201)
          {
            showModalMessageError("success", "Transferencia actualizada correctamente", 2300);
            setTimeout(function(){ window.location =`./` }, 2300);
            getTransfer(1);
            return;
          }
          statusHTTP(data, "../../");
          stop_scrum();
    })
    .catch(function(err) { stop_scrum(); console.log(err); });

}


const add_comment = (id_transfer) => {
        $("#commentModal").modal();
        IDTRANSFER = id_transfer;
}


const confirm_comment = () => {
    let comment = $("#comment");

    let error = 0;
    error += valid_imputs([comment]);
    if(error > 0 ){ return; }

    loading_scrum();
    let url = `../app/api/banktransfer.php?a=3`;

    const data = new FormData();
    data.append('idtransfer', IDTRANSFER);
    data.append('comment', comment.val());

    fetch(url,{method:'POST', body:data})
      .then(function(response) {return response.json();})
      .then(function(data) { console.log(data);
        const { code, status }  = data;
          if(code == 201)
          {
            showModalMessageError("success", "Comentario Agregado Correctamente", 2300);
            setTimeout(function(){ cancel_comment(); }, 2300);
            stop_scrum();
            getTransfers(1);
            return;
          }
          statusHTTP(data, "../../");
          stop_scrum();
      })
      .catch(function(err) { stop_scrum(); console.log(err); });
    
}


const cancel_comment = () => {
    $("#comment").val("");
    IDTRANSFER = 0;
    $("#comment").css("border", "1px solid #ced4da");
    $('#commentModal').modal('hide');
}