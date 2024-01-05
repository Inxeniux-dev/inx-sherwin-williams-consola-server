$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    getTransfersDetail();
});


function getTransfersDetail()
{
      let url = `../../../../../../transfers/getdetailonserver/${name}/${indentified}/${suc_ent}/${suc_sal}/`;
      loading_scrum();
      fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
        stop_scrum();
        if(data.code == 201)
        {
            $("#emite").html(data.head.suc_sal);
            $("#recibe").html(data.head.suc_ent);
            $("#fecha").html(data.head.fecha);
            $("#comentario").html(data.head.coment);
            $(".d-btn").html(data.btn);
            $(".d-transfer-detail").html(data.data);
        }

      })
      .catch(function(err) { stop_scrum(); console.log(err); });

    /*    $.ajax({
          type: "GET",
          dataType:"html",
          url: url_api,
          beforeSend: function(){
              console.log("consultando");
          },
          success: function(data){
              $(".d-transfer-detail").html(data);
          },
          error: function(err){
                 console.log(err.responseText);
                 let output = '<div class = "col-md-12">' +
                              '<div class="alert alert-danger" role="alert"> ' +
                              ' Error al realizar la operación' +
                              '</div> ' +
                              '</div>';
                 $(".d-transfer-detail").html(output);
          }
      });*/
}




$(".d-btn").on("click", ".btn-finaly", () => {
    loading_scrum();
    $(".d-btn .btn-finaly").hide();

    let url_api = "../../../../../../app/api/transfer.php?a=5&&name="+name+"&&indentified="+indentified+"&&suc_ent="+suc_ent+"&&suc_sal="+suc_sal;
    $.ajax({
      type: "GET",
      dataType:"json",
      url: url_api,
      beforeSend: function(){
          console.log("consultando");
      },
      success: function(data){
          console.log(data);
          stop_scrum();
          if(data.code == 200)
          {
            if(data.status)
            {

                let out = "<div class='invoi mb-2' style='min-height: 100px; margin: 0; text-align: center;'>"+
                "<div class='row justify-content-md-center'> <div class = 'col-md-12'>"+
                "<div class = 'alert alert-success'><b><i class = 'fas fa-thumbs-up'></i> Vale Ingresado Exitosamente</b><br><br>"+
                "<span>Folio de Vale: <b>"+data.data.folio+"</b></span> &nbsp;&nbsp; <br> <span>Fecha de operación: <b>"+data.data.date+"</b></span></div>"+
                "</div><div class = 'col-md-4 mt-4'><a href = '../../../../../details/"+data.identified+"/' class = 'btn btn-info'><i class = 'fas fa-file-invoice'></i> Ver Detalles</a></div>"+
                "<div class = 'col-md-4 mt-4'><a href = '../../../../../onserver/' class = 'btn my-btn-blue'><i class='fas fa-check-circle'></i> Ingresar Más Vales</a></div></div></div>";

              if(data.data.no_aplicados.length > 0)
              {
                out += "<div class='invoi mb-2 my-3' style='min-height: 100px; margin: 0; text-align: center;'>"+
                            "<div class='row justify-content-md-center'> <div class = 'col-md-12'>"+
                                "<div class = 'alert alert-warning'><b><i class = 'fas fa-exclamation-triangle'></i> Se aplicaron automáticamente los siguientes códigos</b><br><br>"+
                                    "<div class='row justify-content-md-center'> <div class = 'col-md-12'>";

                                        for(x = 0; x<data.data.no_aplicados.length; x++)
                                        {   let indice = data.data.no_aplicados[x];
                                            out += "<span>"+indice.codigo+" - <b>"+ indice.descrip +"</b></span>, &nbsp;&nbsp; Cantidad: <b>"+indice.cantidad+"</b> Pzs <br>"
                                        }

                                 out +="</div>"+
                            "</div>"+

                            "</div><div class = 'col-md-6 mt-4'><a href = '../../../../../../items/notapplied/' class = 'btn btn-info'><i class = 'fas fa-file-invoice'></i> Ver Productos Aplicados</a></div>"+
                        "</div>";
                }

                $(".d-transfer-detail").html(out);

                return;
            }
          }
          statusHTTP(data, "../../");
        //  displayMsgs(data.error);
        $(".d-btn .btn-finaly").show();
      },
      error: function(err){
            stop_scrum();
             console.log(err.responseText);
             $(".d-btn .btn-finaly").show();

             let output = '<div class = "col-md-12">' +
                          '<div class="alert alert-danger" role="alert"> ' +
                          ' Error al realizar la operación' +
                          '</div> ' +
                          '</div>';
             $(".d-transfer-detail").html(output);
             $(".d-transfer-detail .btn-finaly").show();
      }
  });
});


function showAlert(tipo, msg)
{
    if(tipo = "warning")
    {
        titletxt =  'Atención';
        $(".d-transfer-detail .btn-finaly").show();
    }
    else if (tipo = "success")
    {
        titletxt =  'Éxito';
    }

    Swal.fire({
        type: tipo,
        title: titletxt,
        text: msg,
        confirmButtonText: 'Aceptar',
        allowOutsideClick : false,
        allowEscapeKey : false,
        allowEnterKey : false,
    });
}


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
     msg_error += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

     $(".msg-validadion").html(msg_error);
}
