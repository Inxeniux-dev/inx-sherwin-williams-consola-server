$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});



const editSupplier = () =>
{
    let id = $("#id_supplier").val();
    let rfc = $("#rfc"); 
    let razon = $("#razon"); 

    let error = 0;
    error += valid_imputs([rfc, razon]);
    if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

    loading_scrum();
    let url = `../../../app/api/supplier.php?a=2`;

    const data = new FormData();
    data.append('id', id);
    data.append('rfc', rfc.val());
    data.append('proveedor', razon.val());

    fetch(url,{method:'POST', body:data})
      .then(function(response) {return response.json();})
      .then(function(data) { console.log(data);
        const { code, status }  = data;
          if(code == 201)
          {
            showModalMessageError("success", "Proveedor Actualizado Correctamente", 2300);
            setTimeout(function(){ window.location =`../../` }, 2300);
            return;
          }
          statusHTTP(data, "../../");
          stop_scrum();
      })
      .catch(function(err) { stop_scrum(); console.log(err); });

}