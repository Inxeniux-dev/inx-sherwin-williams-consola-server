$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    getCustomers(1);
});

let color_border_error = "1.5px solid  #ff988e";
let color_border_normal = "1px solid  #c5c5c5";
let color_border_success = "1.5px solid #00ad00";

function getCustomers(page)
{
    let search = document.getElementById("search").value;
    let apellido = document.getElementById("searchApellido").value;
    let type = document.getElementById("type").value;

    const data = new FormData();

    data.append('page', page);
    data.append('search', search);
    data.append('apellido', apellido);
    data.append('type', type);

    let url = `../../app/api/customer.php?a=11`;
    console.log(url);

    fetch(url,{method:'POST', body:data})
     .then(function(response) {return response.json();})
     .then(function(data) {
      console.log('data', data);
       const { code, output }  = data;
      //  console.log('output', output);
         if(code == 200)
         {
            $(".table-items").html(output);
            $(".r-xls").attr("href", `../../reportExcel/customers/${type}/${apellido}/${search}/`);
            $(".r-pdf").attr("href", `../../report/customers/${type}/${apellido}/${search}/`);
         }
         stop_scrum();
     })
     .catch(function(err) {
      showModalMessageError("error", "Error al consultar la información", 2500);
      console.log('CATCH ERROR getCustomers', err);
      stop_scrum();
    });
}

$(".table-items").on("click",".pag-number", function(){
  getCustomers($(this).attr("data"));
});

$("#btn-search").click(()=>{ getCustomers(1); });
// $('#search').keyup(delay(function (e) { getCustomers(1); }, 800));
// $("#searchApellido").keyup(delay(function (e) { getCustomers(1); }, 800));
$("#search").keyup(()=>{ getCustomers(1); });
$("#searchApellido").keyup(()=>{ getCustomers(1); });
$("#type").change(()=>{ getCustomers(1); });

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
  let url = `../../app/api/customer.php?a=4`;
  const data = new FormData();
  data.append('id', id);

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
    const {code } = data;
      if(code == 201)
      {
        showModalMessageError("success", "Producto eliminado", 2300);
        setTimeout(function(){ window.location =`../list/` }, 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });
}

function delay(callback, ms) {
    var timer = 0;
    return function() {
      var context = this, args = arguments;
      clearTimeout(timer);
      timer = setTimeout(function () {
        callback.apply(context, args);
      }, ms || 0);
    };
  }
