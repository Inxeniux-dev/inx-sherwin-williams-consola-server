$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});



const deleteSupplier = (id) =>
{
       Swal.fire({
          title: '¡Espera! ',
          text: "No podrás revertir esta opción una vez confirmada",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: 'rgb(63 99 134)',
          cancelButtonColor: '#3085d6',
          confirmButtonText: '¡Si, Eliminar!',
          cancelButtonText: 'No'
        }).then((result) => {
          if (result.value) {
            confirmDelete(id);
            return;
          }
        });
}

const confirmDelete = (id) => 
{
   loading_scrum();
    let url = `../app/api/supplier.php?a=3`;

    const data = new FormData();
    data.append('id', id);

    fetch(url,{method:'POST', body:data})
      .then(function(response) {return response.json();})
      .then(function(data) { console.log(data);
        const { code, status }  = data;
          if(code == 201)
          {
            showModalMessageError("success", "Proveedor Eliminado Correctamente", 2300);
            setTimeout(function(){ window.location =`../supplier/` }, 2300);
            return;
          }
          statusHTTP(data, "../../");
          stop_scrum();
      })
      .catch(function(err) { stop_scrum(); console.log(err); });
}