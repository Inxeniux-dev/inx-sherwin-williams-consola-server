$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    sync_points();
    transfer_pend();
    sync_user();
    sync_uuid();
});




function transfer_pend(){
      loading_scrum();
        console.log("Sync vales");
      let url = `../app/api/dashboard.php?a=1`;
      fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
          stop_scrum();
          if(data.code == 201)
          {
            $(".table-vales").html(htmlVales(data.folios));
            return;
          }

      })
      .catch(function(err) {
          stop_scrum(); console.log(err); $(".table-order").html("<div class='alert alert-danger'>Error</div>");
      });
};


function sync_points(){
    console.log("Sync points");
      let url = `../app/api/dashboard.php?a=2`;
      fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
      })
      .catch(function(err) {
         console.log(err);
      });
};



function sync_user()
{
  console.log("Sync user");
  let url = `../app/api/settings.php?a=14`;
  fetch(url,{method:'GET'})
  .then(function(response) {return response.json();})
  .then(function(data) {
    console.log(data);
  })
  .catch(function(err) {
     console.log(err);
  });
}



function sync_uuid()
{
  console.log("Sync UUID");
  let url = `../app/api/sale.php?a=25`;
  fetch(url,{method:'GET'})
  .then(function(response) {return response.json();})
  .then(function(data) {
    console.log(data);
  })
  .catch(function(err) {
     console.log(err);
  });
}



function htmlVales(data)
{
    let out = '';
    console.log(data.length );

    if(data.length > 0)
    {
         out = `<div class = 'alert alert-warning'><b><i class='fas fa-exclamation-triangle'></i>  Se ingresaron automáticamente los siguientes vales: </b></div>
                <table class = "table table-sm"><thead><tr><th>Folio</th><th>Sucursal que envía</th><th style = 'text-align:right;'>Días atraso</th></tr></thead><tbody>`;

              for(let x = 0; x < data.length; x++)
              {    let value = data[x];
                  out +=`<tr><td>${value.serie}-${value.folio}</td><td>${value.emisor}</td><td align = 'right'><b>${value.dias} días</b></td></tr>`;
              }

        out +=`</tbody></table>`;
    }
    else {
        out = `<div class = 'alert alert-success'><b>No hay vales pendientes por ingresar automáticamente</b></div>`;
    }
    return out;
}
