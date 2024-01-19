
function loading_scrum()
{
    $('body').loading({stoppable: false, message: " <i class='fas fa-stopwatch'></i> Espere ... " });
}

function stop_scrum()
{
    $('body').loading('stop');
}



/* VALIDACIONES */


function valid_imputs(inputs){

    let count = 0;

    for(let x = 0; x<inputs.length; x++)
    {
        if(inputs[x].val().length == 0){
            inputs[x].css("border", "1px solid #f64747");
            count++;
        }
        else
        {
            inputs[x].css("border", "1px solid #ced4da");
        }
    }
    return count;
}


function valid_numeric_positive(inputs)
{

    let count = 0;

    for(let x = 0; x<inputs.length; x++)
    {
        if(isNaN(inputs[x].val()) || inputs[x].val().length == 0){
            inputs[x].css("border", "1px solid #f64747");
            count++;
        }
        else
        {
          if(inputs[x].val() < 0)
          {
              inputs[x].css("border", "1px solid #f64747");
              count++;
          }
          else {
            inputs[x].css("border", "1px solid #ced4da");
          }
        }
    }
    return count;
}

function valid_no_cero(inputs)
{

    let count = 0;

    for(let x = 0; x<inputs.length; x++)
    {
        if(isNaN(inputs[x].val()) || inputs[x].val().length == 0){
            inputs[x].css("border", "1px solid #f64747");
            count++;
        }
        else
        {
          if(inputs[x].val() <= 0)
          {
              inputs[x].css("border", "1px solid #f64747");
              count++;
          }
          else {
            inputs[x].css("border", "1px solid #ced4da");
          }
        }
    }
    return count;
}



function border_error(inputs){
    for(let x = 0; x<inputs.length; x++)
    {
        inputs[x].css("border", "1px solid #f64747");
    }
    return;
}










/* Alerts */

function alertMessage(type, text_message, text_button, is_link, link_redirect)
{

    /*Error message */
    if(type == "warning")
    {
        if(is_link)
        {
            Swal.fire({
                type: 'warning',
                title: 'Atención',
                text: text_message,
                confirmButtonColor: '#3085d6',
                confirmButtonText: text_button,
                allowOutsideClick : false,
                allowEscapeKey : false,
            }).then((result) => {
                if (result.value) {
                    window.location = link_redirect;
                }
            });
        }
        else
        {
            Swal.fire({
                type: 'warning',
                title: 'Atención',
                text: text_message,
                confirmButtonColor: '#3085d6',
                confirmButtonText: text_button,
                allowOutsideClick : false,
                allowEscapeKey : false,
            });
        }
    }


      /*Error message */
      if(type == "success")
      {
          if(is_link)
          {
              Swal.fire({
                  type: 'success',
                  title: 'Éxito',
                  text: text_message,
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: text_button,
                  allowOutsideClick : false,
                  allowEscapeKey : false,
                  allowEnterKey : false,
              }).then((result) => {
                  if (result.value) {
                      window.location = link_redirect;
                  }
              });
          }
          else
          {
              Swal.fire({
                  type: 'success',
                  title: 'Éxito',
                  text: text_message,
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: text_button,
                  allowOutsideClick : false,
                  allowEscapeKey : false,
                  allowEnterKey : false,
              });
          }
      }


       /*Error message */
    if(type == "error")
    {
        if(is_link)
        {
            Swal.fire({
                type: 'error',
                title: '!Error!',
                text: text_message,
                confirmButtonColor: '#3085d6',
                confirmButtonText: text_button,
                allowOutsideClick : false,
                allowEscapeKey : false,
            }).then((result) => {
                if (result.value) {
                    window.location = link_redirect;
                }
            });
        }
        else
        {
            Swal.fire({
                type: 'Oops!',
                title: '!Error',
                text: text_message,
                confirmButtonColor: '#3085d6',
                confirmButtonText: text_button,
                allowOutsideClick : false,
                allowEscapeKey : false,
            });
        }
    }



}


function showFlashMessage(message)
{

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        background: '#e2ffe0',
        timer: 2000,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        type: 'success',
        title: message
        });
}


function showFlashMessageError(message)
{

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        background: '#ffff',
        timer: 2000,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        });

        Toast.fire({
        type: 'error',
        title: message
        });
}


function showModalMessageError(type, message, timer)
{

  Swal.fire({
    position: 'center',
    icon: 'error',
    title: message,
    type: type,
    showConfirmButton: false,
    timer: timer
  });
}


if(screen.height > 800)
{
    $("#sidebar").css("height", screen.height);
}




$.scrollUp({
	scrollText:"",
	scrollSpeed: 2000,
	easingType: "easeOutQuint"

});




function showMessageErrors(data)
{   let out_err = '';
    let count = 0;

    if(data != null){
        data.forEach(element => {
                out_err += '<p>'+element+'</p>';
                count++;
            });
    }

    if(count > 0)
    {
        $(".container-error").removeClass("d-none");
        $(".container-error-alert").html(out_err);
    }

    stop_scrum();
}



function ModalMsg(msg, url)
{
  showModalMessageError("success", msg, 2000);
  if(url != null){ window.location = url; return;}
  return;
}


function ModalMsgErr(msg, url)
{
  showModalMessageError("warning", msg, 2000);
  if(url != null){ window.location = url; return;}
  return;
}


function statusHTTP(data, urlback)
{
    console.log(data);

    if(data.code == 400)
    {
        showModalMessageError("error", "Operación desconocida", 3000);
        return;
    }

    if(data.code == 403)
    {
        showModalMessageError("error", "Inicie sesión nuevamente para continuar", 5000);
        return;
    }

    if(data.code == 401)
    {
        showModalMessageError("error", "No tienes permiso para realizar esta operación", 5000);
        return;
    }

    if(data.error.length > 0)
    {
        let msg_err = "";
        for(i=0; i <data.error.length; i++)
        {
            msg_err += data.error[i]+"<br>";
        }
        $(".alert-msg-err").removeClass("d-none");
        $(".alert-msg-err #msg").html(msg_err);

        showModalMessageError("warning", msg_err, 2500);
        return;
    }

}



function  rfcValido(rfcStr) {
    var strCorrecta;
    strCorrecta = rfcStr;   
    if (rfcStr.length == 12){
    var valid = '^(([A-ZÑ&]|[a-zñ&]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
    }else{
    var valid = '^(([A-ZÑ&]|[a-zñ&]|\s){1})(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
    }
    var validRfc=new RegExp(valid);
    var matchArray=strCorrecta.match(validRfc);
    if (matchArray==null) {
        return false;
    }
    else
    {
        return true;
    }
}



function ValidaRfc(rfc, aceptarGenerico = true) {
    const re       = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
    var   validado = rfc.match(re);

    if (!validado)  //Coincide con el formato general del regex?
        return false;

    //Separar el dígito verificador del resto del RFC
    const digitoVerificador = validado.pop(),
          rfcSinDigito      = validado.slice(1).join(''),
          len               = rfcSinDigito.length,

    //Obtener el digito esperado
          diccionario       = "0123456789ABCDEFGHIJKLMN&OPQRSTUVWXYZ Ñ",
          indice            = len + 1;
    var   suma,
          digitoEsperado;

    if (len == 12) suma = 0
    else suma = 481; //Ajuste para persona moral

    for(var i=0; i<len; i++)
        suma += diccionario.indexOf(rfcSinDigito.charAt(i)) * (indice - i);
    digitoEsperado = 11 - suma % 11;
    if (digitoEsperado == 11) digitoEsperado = 0;
    else if (digitoEsperado == 10) digitoEsperado = "A";

    //El dígito verificador coincide con el esperado?
    // o es un RFC Genérico (ventas a público general)?
    if ((digitoVerificador != digitoEsperado)
     && (!aceptarGenerico || rfcSinDigito + digitoVerificador != "XAXX010101000"))
        return false;
    else if (!aceptarGenerico && rfcSinDigito + digitoVerificador == "XEXX010101000")
        return false;
    return rfcSinDigito + digitoVerificador;
}



function number_format (number, decimals, decPoint, thousandsSep) {

  number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
  const n = !isFinite(+number) ? 0 : +number
  const prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
  const sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
  const dec = (typeof decPoint === 'undefined') ? '.' : decPoint
  let s = ''
  const toFixedFix = function (n, prec) {
    if (('' + n).indexOf('e') === -1) {
      return +(Math.round(n + 'e+' + prec) + 'e-' + prec)
    } else {
      const arr = ('' + n).split('e')
      let sig = ''
      if (+arr[1] + prec > 0) {
        sig = '+'
      }
      return (+(Math.round(+arr[0] + 'e' + sig + (+arr[1] + prec)) + 'e-' + prec)).toFixed(prec)
    }
  }
  // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec).toString() : '' + Math.round(n)).split('.')
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || ''
    s[1] += new Array(prec - s[1].length + 1).join('0')
  }
  return s.join(dec)
}
