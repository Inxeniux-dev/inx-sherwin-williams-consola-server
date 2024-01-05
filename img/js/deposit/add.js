$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
      $("#sidebar").toggleClass("active");
      $(".content").toggleClass("active");
    });
    console.log("read");
});





$(".btn-add").click(function(){

  let iaccount = $("#account");
  let iform = $("#form");
  let iimport = $("#import");
  let idate = $("#date_deposit");

  let account = iaccount.val();
  let form = iform.val();
  let ammount = iimport.val();
  let date_deposit = idate.val();
  let err = 0;
  let msg = '';
  if(form == 0) { err++; msg+="Seleccione la forma de dep&oacute;sito <br>";}
  if(account == 0) { err++; msg+="Seleccione una cuenta<br>";}
  if(date_deposit.length <= 0) { err++; msg+="Selecciona la fecha del dep&oacute;sito<br>";}
  if(isNaN(ammount) || ammount <= 0) { err++; msg+="El importe es incorrecto <br>";}

  if(err > 0)
  {
    $(".dm").html("<div class = 'col-md-12'><div class = 'alert alert-warning my-2'>"+msg+"</div></div>");
  }
  else{  $(".dm").html(''); addDeposit(account, form, ammount, date_deposit);}

});


function addDeposit(account, form, ammount, date_deposit)
{
  const data = new FormData();
  data.append('account', account);
  data.append('form', form);
  data.append('ammount', ammount);
  data.append('date', date);
  data.append('date_deposit', date_deposit);
  let url = "../../../app/api/deposit.php?a=2";

  fetch(url, { method: 'POST', body: data})
  .then(function(response) {
  if(response.ok) {
      return response.json();
    } else {throw "Error en la llamada Ajax";}
  })
  .then(function(data) {
    console.log(data);
      if(data.code == 200)
      {
        if(data.error.length == 0)
        {
              alertMessage("success", "Deposito agregado", "Aceptar", true, "../"+date+"/"); return;
        }
        alertMessage("warning", "¡Error al realizar la operación!", "Aceptar", true, "../"+date+"/");
        return;
      }

      alertMessage("warning", "¡Error al realizar la operación!", "Aceptar", true, "../"+date+"/");
      return;
  })
  .catch(function(err) { stop_scrum(); console.log(err); alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../new/"+date+"/"); });
}




$("#btn-search").click(function(){
    let date_dep = $("#date_search").val();
    location.href = "../"+date_dep+"/";
});



$("#date_search").change(function(){
    loading_scrum();
    let date_dep = $(this).val();
    location.href = "../"+date_dep+"/";
});


function delImport(id)
{

  Swal.fire({
      title: '¿Estas seguro?',
      text: "¡No podrás revertir esto!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: '¡Si, eliminar deposito!',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
          del(id);
      }
    });

}



function del (identified)
{
  
    loading_scrum();
    const data = new FormData();
    data.append('identified', identified);
    let url = "../../../app/api/deposit.php?a=3";

    fetch(url, { method: 'POST', body: data })
    .then(function(response) {
    if(response.ok) {
        return response.json();
    } else { throw "Error en la llamada Ajax"; }
    })
    .then(function(data) {
        console.log(data);

        if(data.code == 200)
        {
          if(data.error.length == 0)
          {
                alertMessage("success", "Deposito eliminado", "Aceptar", true, "../"+date+"/"); return;
          }

          alertMessage("warning", "¡Error al realizar la operación!", "Aceptar", true, "../"+date+"/");
          return;
        }

        alertMessage("warning", "¡Error al realizar la operación!", "Aceptar", true, "../"+date+"/");
    })
    .catch(function(err) {
        console.log(err);
        stop_scrum();
        alertMessage("error", "¡Error Interno de Servidor!", "Aceptar", true, "../"+date+"/");
    });
}





function filterFloat(evt,input){
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57){
        if(filter(tempValue)=== false){
            return false;
        }else{
            return true;
        }
    }else{
          if(key == 8 || key == 13 || key == 0) {
              return true;
          }else if(key == 46){
                if(filter(tempValue)=== false){
                    return false;
                }else{
                    return true;
                }
          }else{
              return false;
          }
    }
}
function filter(__val__){
    var preg = /^([0-9]+\.?[0-9]{0,2})$/;
    if(preg.test(__val__) === true){
        return true;
    }else{
       return false;
    }

}
