$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });
    console.log("read");
    getItems(1);

});

let color_border_error = "1px solid  #ff988e";
let color_border_normal = "1px solid  #c5c5c5";

$(".table-items").on("click",".pag-number", function(){
    getItems($(this).attr("data"));
});

async function getItems(page)
{   console.log("entro");
    let url = "../../getitemsbyidresult/"+page+"/"+identified+"/";
    fetch(url)
    .then(function(response) {
        return response.text();
    })
    .then(function(html) {
        $(".table-items").html(html);
        $(".r-xls-p").attr("href", "../../../reportExcel/inventory_prods/"+identified+"/");
        $(".r-pdf-p").attr("href", "../../../report/inventory_prods/"+identified+"/");

        $(".r-xls").attr("href", "../../../reportExcel/inventory_count/"+identified+"/");
        $(".r-pdf").attr("href", "../../../report/inventory_count/"+identified+"/");
    });
}



$("#btn-add-item").click(() =>{

    let code = document.getElementById("i-code").value;
    let cant = document.getElementById("i-cant").value;
    let err = 0;

    if(code.trim() == "") { document.getElementById("i-code").style.border = color_border_error; err++;}else{ document.getElementById("i-code").style.border = color_border_normal;}
    if(cant.trim() == "" || isNaN(cant.trim()) || cant.trim() < 0 ){ document.getElementById("i-cant").style.border = color_border_error; err++;}else{ document.getElementById("i-cant").style.border = color_border_normal;}


    if(err == 0)
    {
        const data = new FormData();
        data.append('identified', identified);
        data.append('code', code);
        data.append('cant', cant);

        let url = "../../addItemForInventory/";
        fetch(url, { method: 'POST', body: data })
        .then(function(response) {
        if(response.ok) {
            return response.json();
        } else {
            throw "Error en la llamada Ajax";
        }
        })
        .then(function(data) {

            console.log(data);

            if(!data.finaly)
            {
                if(data.save.save)
                {
                    Swal.fire({
                        type: 'success',
                        title: 'Éxito',
                        text: 'Los productos se agregaron correctamente',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick : false,
                        allowEscapeKey : false,
                        allowEnterKey : false,
                    }).then((result) => {
                        if (result.value) {
                             window.location = "../../additems/"+data.identified+"/";
                        }
                    });
                }
                else
                {
                    Swal.fire({
                        type: 'warning',
                        title: 'Atención',
                        text: '¡Error al realizar la operación.',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick : false,
                        allowEscapeKey : false,
                        allowEnterKey : false,
                    });

                    displayMsgs(data.save.error);
                }
            }
            else
            {
                displayMsgs(data.error);
            }
        })
        .catch(function(err) {
            console.log(err);
        });

    }
    else
    {
        Swal.fire({
            type: 'warning',
            title: 'Espera..',
            text: '¡Verifica los campos marcados!',
            confirmButtonText: 'Aceptar'
          });
    }

});




function displayMsgs(errors)
{   console.log(errors)
    let msg_error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
     if(errors.length > 0)
     {
         for(let x=0; x<errors.length; x++)
         {
            msg_error += errors[x]+' <br>';
         }
     }
     else {
        msg_error += " Error desconocido <br>";
     }
     msg_error += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

     $(".msg-validadion").html(msg_error);
}


$(".table-items").on("click", ".btn-pre-confirm", () => {
    $(".btn-confirm-inventory").show();
    document.getElementById("invent-auditor-pass").value = "";
});


$(".btn-confirm-inventory").click(() => {

    $(".btn-confirm-inventory").hide();

    const data = new FormData();
    data.append('identified', identified);
    data.append('upass', document.getElementById("invent-auditor-pass").value);
    data.append('coment', $(".table-items .coment-finaly").val());
    let pass = document.getElementById("invent-auditor-pass").value;

    if (pass.length > 0 )
    {
        document.getElementById("invent-auditor-pass").style.border = color_border_normal;

        let url = `../../../app/api/inventory.php?a=1`;

        fetch(url,{method:'POST', body:data})
        .then(function(response) {return response.json();})
        .then(function(data) {
          console.log(data);
          stop_scrum();
            if(data.code == 200)
            {
              if(data.status)
              {
                  alertMessage("success", data.msg, "Aceptar", true, "../../details/"+data.identified+"/");
                  return;
              }
            }
            $(".btn-confirm-inventory").show();
            statusHTTP(data, "../../");
        })
        .catch(function(err) {
            stop_scrum(); console.log(err);$(".btn-confirm-inventory").show();
        });



    /*    fetch(url, { method: 'POST', body: data })
        .then(function(response) {
        if(response.ok) {
            return response.json();
        } else {
            throw "Error en la llamada Ajax";
        }
        })
        .then(function(data) {
            console.log(data);

            stop_scrum();
        /*      if(data.code == 200)
              {
                if(data.status)
                {
                    alertMessage("success", data.msg, "Aceptar", true, "../../details/"+it+"/");
                    return;
                }
              }

            if(data.autenticate)
            {
                if(!data.finaly)
                {
                    if(data.save)
                    {
                        Swal.fire({
                            type: 'success',
                            title: 'Éxito',
                            text: '¡El inventario se ha finalizado existosamente!',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick : false,
                            allowEscapeKey : false,
                            allowEnterKey : false,
                        }).then((result) => {
                            if (result.value) {
                                 window.location = "../../additems/"+data.identified+"/";
                            }
                        });
                    }
                    else
                    {
                        Swal.fire({
                            type: 'warning',
                            title: 'Espera..',
                            text: '¡Error al realizar la operación!, no es posible finalizar.',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick : false,
                            allowEscapeKey : false,
                            allowEnterKey : false,
                          });

                        displayMsgs(data.error);
                    }
                }
                else
                {
                    Swal.fire({
                        type: 'warning',
                        title: 'Espera..',
                        text: '¡Este inventario ya se ha finalizado con anterioridad! no se ha realizado ninguna operación',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick : false,
                        allowEscapeKey : false,
                        allowEnterKey : false,
                      });
                }
            }
            else
            {
                Swal.fire({
                    type: 'warning',
                    title: 'Espera..',
                    text: '¡La contraseña es incorrecta!',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick : false,
                    allowEscapeKey : false,
                    allowEnterKey : false,
                  });
            }
        })
        .catch(function(err) {
            console.log(err);
        });  */


    }
    else
    {
        document.getElementById("invent-auditor-pass").style.border = color_border_error;
    }
});



$(".btn-cancel").click(() =>{
  Swal.fire({
      title: '¿Estás seguro de cancelar el inventario?',
      text: "¡No podrás revertir esto!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: '¡Si, reiniciar inventario!',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
          cancel_inventory();
      }
    });
});


function cancel_inventory()
{


  let url = "../../cancel/";

  const data = new FormData();
  data.append('identified', identified);

  fetch(url, { method: 'POST', body: data })
  .then(function(response) {
  if(response.ok) {
      return response.json();
  } else {
      throw "Error en la llamada Ajax";
  }
  })
  .then(function(data) {
      console.log(data);

      if(data.finaly)
      {
        showModalMessageError("warning", "¡El inventario ya está cerrado!", 2200); return;
        setTimeout(function(){ window.location = "../../details/"+identified+"/"; }, 2500);
      }
      else
      {
          if(data.delete)
          {
            showModalMessageError("success", "¡El inventario se ha cancelado existosamente!", 2200);
            setTimeout(function(){  window.location = "../../all/"; }, 2500);
            return;
          }
          else
          {
              showModalMessageError("error", "¡Error al realizar la operación!", 2000);
          }
      }
  })
  .catch(function(err) {
  console.log(err);  showModalMessageError("error", "¡Error al realizar la operación!", 2000);
  });

}






$(".return-step-three").click(() => {

    console.log("echo");

    let url = "../../returnStep/";

    const data = new FormData();
    data.append('step', 2);
    data.append('identified', identified);

    fetch(url, { method: 'POST', body: data })
    .then(function(response) {
    if(response.ok) {
        return response.json();
    } else {
        throw "Error en la llamada Ajax";
    }
    })
    .then(function(data) {
        console.log(data);

        if(data.finaly)
        {
            Swal.fire({
                type: 'warning',
                title: 'Espera..',
                text: '¡El inventario ya está cerrado!',
                confirmButtonText: 'Aceptar',
                allowOutsideClick : false,
                allowEscapeKey : false,
                allowEnterKey : false,
            }).then((result) => {
                if (result.value) {
                     window.location = "../../details/"+identified+"/";
                }
            });
        }
        else
        {
            if(data.change)
            {
                window.location = "../../additems/"+identified+"/";
            }
            else
            {
                Swal.fire({
                    type: 'warning',
                    title: 'Espera..',
                    text: '¡'+ data.error+"!",
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick : false,
                    allowEscapeKey : false,
                    allowEnterKey : false,
                }).then((result) => {
                    if (result.value) {
                         window.location = "../../additems/"+identified+"/";
                    }
                });
            }

        }

    })
    .catch(function(err) {
        console.log(err);
        Swal.fire({
            type: 'error',
            title: 'Ooops',
            text: '¡Error al realizar el proceso!',
            confirmButtonText: 'Aceptar',
            allowOutsideClick : false,
            allowEscapeKey : false,
            allowEnterKey : false,
        });
    });

});
