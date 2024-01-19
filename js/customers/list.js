$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    // console.log("read");
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
    // console.log(url);

    fetch(url,{method:'POST', body:data})
     .then(function(response) {return response.json();})
     .then(function(data) {
      // console.log('data', data);
       const { code, output }  = data;
      //  console.log('output', output);
         if(code == 200)
         {
            $(".table-items").html(output);
            $(".r-xls").attr("href", `../../reportExcel/customers/${type}/${search}/${apellido}/`);
            $(".r-pdf").attr("href", `../../report/customers/${type}/${search}/${apellido}/`);
         }
         stop_scrum();
     })
     .catch(function(err) {
      showModalMessageError("error", "Error al consultar la información", 2500);
      // console.log('CATCH ERROR getCustomers', err);
      stop_scrum();
    });
}

$(".table-items").on("click",".pag-number", function(){
  getCustomers($(this).attr("data"));
});

$("#btn-search").click(()=>{ getCustomers(1); });
$('#search').keyup(delay(function (e) { getCustomers(1); }, 800));
$("#searchApellido").keyup(delay(function (e) { getCustomers(1); }, 800));
$("#type").change(()=>{ getCustomers(1); });


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
