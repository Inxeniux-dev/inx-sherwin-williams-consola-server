$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});

$(".btn-delete").click(function(){
  let codigo = $("#codigo");
  let idprod  = $("#idprod").val();

  loading_scrum('Eliminando, Espere...');

  let url = `../../../app/api/item.php?a=13`;

    console.log(codigo.val());
    console.log(idprod);

  const data = new FormData();
  data.append('codigo', codigo.val());
  data.append('id', idprod);

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
    const { code, status }  = data;
      if(code == 201)
      {
        showModalMessageError("success", "Producto Eliminado Correctamente", 2300);
        setTimeout(function(){ window.location =`../../list/` }, 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });
});
