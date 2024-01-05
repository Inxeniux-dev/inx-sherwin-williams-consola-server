$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    getItems(1);
});


function getItems(page)
{   $(".r-pdf").attr("href", "javascript:void(0);");
    let search = document.getElementById("search").value;
    let type = document.getElementById("type").value;
    const data = new FormData();
    data.append('search', search);
    data.append('type', type)

    let url = `../../app/api/item.php?a=1`;

    fetch(url,{method:'POST', body:data})
     .then(function(response) {return response.json();})
     .then(function(data) {
       console.log(data);
       const { code, output }  = data;
         if(code == 200)
         {
            $(".table-items").html(output);
         }
         stop_scrum();
     })
     .catch(function(err) { showModalMessageError("error", "Error al consultar la información", 2500); console.log(err); stop_scrum();});
}

$(".table-items").on("click",".pag-number", function(){
    getItems($(this).attr("data"));
});

$("#btn-search").click(()=>{ getItems(1); });
$("#search").keyup(()=>{ getItems(1); });
$("#type").change(()=>{ getItems(1); });


function check_delete(id = 0)
{
    Swal.fire({
        title: '¡Espera! ',
        text: "No podrás revertir esta opción una vez confirmada",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'rgb(193 77 77)',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '¡Si, eliminar producto!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
          delete_item(id);
          return;
        }
      });
}


function delete_item(id)
{
  let url = `../../app/api/item.php?a=4`;
  const data = new FormData();
  data.append('id', id);

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
    const {code } = data;
      if(code == 201)
      {
        showModalMessageError("success", "Producto eliminado", 2300);
        setTimeout(function(){ window.location =`../changes/` }, 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });
}
