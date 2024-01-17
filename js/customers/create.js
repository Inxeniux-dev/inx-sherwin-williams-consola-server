$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});

$(".btn-save").click(function(){
  let producto = $("#producto");
  let cantidad = $("#cantidad");
  let precio = $("#precio");

  let error = 0;
  error += valid_imputs([producto, cantidad]);
  error += valid_numeric_positive([cantidad, precio]);
  error += valid_no_cero([cantidad, precio]);

  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

  let url = `../../app/api/item.php?a=2`;

  const data = new FormData();
  data.append('producto', producto.val());
  data.append('cantidad', cantidad.val());
  data.append('precio', precio.val());

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
    const { code, status }  = data;
      if(code == 201)
      {
        showModalMessageError("success", "Producto Agregado", 2300);
        setTimeout(function(){ window.location =`../changes/` }, 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });
});



$(".btn-update").click(function(){
  let producto = $("#producto");
  let cantidad = $("#cantidad");
  let precio = $("#precio");
  let id = $("#id").val();

  let error = 0;
  error += valid_imputs([producto, cantidad]);
  error += valid_numeric_positive([cantidad, precio]);
  error += valid_no_cero([cantidad, precio]);

  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

  let url = `../../../app/api/item.php?a=3`;

  const data = new FormData();
  data.append('producto', producto.val());
  data.append('cantidad', cantidad.val());
  data.append('precio', precio.val());
  data.append('id', id);

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
    const { code, status }  = data;
      if(code == 201)
      {
        showModalMessageError("success", "Producto Actualizado", 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });
});
