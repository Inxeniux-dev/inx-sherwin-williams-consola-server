
$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
            $("#sidebar").toggleClass("active");
            $(".content").toggleClass("active");
    });

    $("#code").focus();
    getList(1);
});


$("#code").keyup(function(event){
  if(event.keyCode == 13)
  {
      $("#cant").focus();
  }
});

$("#cant").keyup(function(event){
  if(event.keyCode == 13)
  {
      addItem();
  }
});


$("#btn-add").click(function(){
    addItem();
});

function addItem()
{
      let code = $("#code").val();
      let cant = $("#cant").val();
      let url = `../../../app/api/order.php?a=3`;
      loading_scrum();
      const data = new FormData();
      data.append('code', code);
      data.append('cant', cant);
      data.append('id', id);

      fetch(url,{method:'POST', body:data})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
        stop_scrum();
          if(data.code == 200)
          {
            if(data.status)
            {
                  showFlashMessage('Código agregado');
                  $("#code").focus();
                  $("#cant").val("");
                  $("#code").val("");
                  getList(1);
                  return;
            }
          }

          statusHTTP(data, "../../");
      })
      .catch(function(err) {
          stop_scrum(); console.log(err);
      });

};



function addItems(code, cant)
{
      let url = `../../../app/api/order.php?a=3`;
      loading_scrum();
      const data = new FormData();
      data.append('code', code);
      data.append('cant', cant);
      data.append('id', id);

      fetch(url,{method:'POST', body:data})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
        stop_scrum();
          if(data.code == 200)
          {
            if(data.status)
            {
                  showFlashMessage('Código agregado');
                  $("#code").focus();
                  $("#cant").val("");
                  $("#code").val("");
                  getList(1);
                  return;
            }
          }

          statusHTTP(data, "../../");
      })
      .catch(function(err) {
          stop_scrum(); console.log(err);
      });

};



function getList(page)
{
  $(".finaly").addClass("d-none");
  let url = `../../../app/api/order.php?a=4&&page=${page}&&id=${id}`;
  fetch(url)
  .then(function(response) {return response.json();})
  .then(function(data) {
      if(data.code == 201)
      {
        $(".table-order").html(data.data);
        if(data.btn)
        {
            $(".finaly").removeClass("d-none");
            $(".i-msg").removeClass("d-none");
        }
      }
  })
  .catch(function(err) {
      console.log(err);
  });
}


$(".table-order").on("click",".pag-number", function(){
    getList
    ($(this).attr("data"));
});



$(".table-order").on("keyup",".i-cant", function(event){
    let code = $(this).attr("data-c");
    let cant = $(this).val();


    if(event.keyCode == 13)
    {
      if(isNaN(cant) || cant <= 0)
      {
        $(this).css("background", "#ffcfcf");
        return;
      }

      $(this).css("background", "#fff");
      updItem(code, cant);
    }

});


function updItem(code, cant)
{
  const data = new FormData();
  data.append('code', code);
  data.append('cant', cant);
  data.append('id', id);
  let url = `../../../app/api/order.php?a=5`;
  loading_scrum();
  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) {
    console.log(data);
    stop_scrum();
      if(data.code == 200)
      {
        if(data.status)
        {
              //alertMessage("success", "Código actualizado", "Continuar", false, "../additem/"+data.id+"/");
              showFlashMessage('Código actualizado');
              getList(1);
              return;
        }
      }

      statusHTTP(data, "../../");
  })
  .catch(function(err) {
      stop_scrum(); console.log(err);
  });
}



function deleteItem(id_item)
{
  loading_scrum();
  const data = new FormData();
  data.append('id_item', id_item);
  data.append('id', id);
  let url = `../../../app/api/order.php?a=6`;

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) {
    console.log(data);
      if(data.code == 200)
      {
        if(data.status)
        {
              showFlashMessage('Código eliminado');
              getList(1);
              stop_scrum();
              return;
        }
      }

      statusHTTP(data, "../../");
  })
  .catch(function(err) {
      stop_scrum(); console.log(err);
  });
}


$(".finaly").click(function(){
    Swal.fire({
        title: '¡Atención! ',
        text: "Si finalizas el pedido no podrás modificarlo posteriormente",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'rgb(63 99 134)',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '¡Si, finalizar pedido!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
              finaly_order();
        }
      });
});


function finaly_order(){
  loading_scrum();
  const data = new FormData();
  data.append('id', id);
  let url = `../../../app/api/order.php?a=7`;
  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) {
    console.log(data);
      if(data.code == 200)
      {
        if(data.status)
        {
          showModalMessageError("success", data.msg, 2200);
          setTimeout(function(){ window.location = "../../detail/"+id+"/" }, 2500);
          return;
        }
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) {
      stop_scrum(); console.log(err);
  });
}



$('#btn-search').on('click', function () {
    $(".body-codes").html("Espere un momento por favor....");
    getItemsByOrder(1);
});

$(".body-codes").on("click",".pag-number", function(){
    getItemsByOrder($(this).attr("data"));
});

$("#code-search").keyup(() => {
    getItemsByOrder(1);
});

$(".btn-bsq").click(function(){
  getItemsByOrder(1);
});

function getItemsByOrder(page)
{
    let search = $("#code-search").val();
    let url = `../../../app/api/order.php?a=10&&page=${page}&&search=${search}`;
    fetch(url,{method:'GET'})
    .then(function(response) {return response.json();})
    .then(function(data) {
        stop_scrum();
        if(data.code == 200)
        {
            $(".body-codes").html(data.data);
            return;
        }
        statusHTTP(data, "../../");
    })
    .catch(function(err) {
        stop_scrum(); console.log(err); $(".body-codes").html("<div class='alert alert-danger'>Error</div>");
    });
}



function display_cant(id)
{
    $("#lbl"+id).addClass("d-none");
    $("#inp"+id).removeClass("d-none");
    $("#inp"+id).focus();
    $("#inp"+id).select();
}
