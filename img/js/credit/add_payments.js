$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});


$("#paymentform").change(function(){
   let val = $(this).val();
   if(val==2 || val==3 || val==4 ){ $(".d-dv").removeClass("d-none");}
   else { $(".d-dv").addClass("d-none");}
});


$(".btn-modal").click(function(){

  Swal.fire({
      title: 'Esta operación no genera un comprobante fiscal \n ¿Estás seguro?',
      text: "¡No podrás revertir esto!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: '¡Si, continuar!',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
          $("#modaloperation").modal("show");
      }
    });
});

$(".btn-add-mov").click(function(){
    let importe = $("#import").val();
    let type = $("#type").val();
    let paymentform = $("#paymentform").val();
    let digit = $("#digit").val();

    if(isNaN(importe) || importe.length <= 0 || importe <= 0){   ModalMsgErr("El importe es incorrecto", null); return; }
    if(isNaN(type) || type <= 0){   ModalMsgErr("Tipo de movimiento incorrecto", null); return; }
    if(isNaN(paymentform) || paymentform <= 0){   ModalMsgErr("Forma de pago incorrecta", null); return; }
    if(paymentform == 2 || paymentform == 3 || paymentform == 4)
    {
      if(digit.length > 0 && isNaN(digit)){ ModalMsgErr("El dígito verificador es incorrecto", null); return; }
    }


    loading_scrum();

    const data = new FormData();
    data.append('importe', importe);
    data.append('type', type);
    data.append('paymentform', paymentform);
    data.append('digit', digit);
    data.append('identified', identified);

    let url = `../../../app/api/credit.php?a=6`;

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();
      if(data.code == 200)
      {
        if(data.status)
        {
            alertMessage("success", data.msg, "Aceptar", true, "../../invoicePayments//"+identified+"/");
            return;
        }
      }
      statusHTTP(data, "../../");
    })
    .catch(function(err) {
        stop_scrum(); console.log(err);
    });


});
