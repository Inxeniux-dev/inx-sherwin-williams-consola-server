$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    checkInputs();
    getItems(1);
});

function checkInputs()
{
    if($(".type").val() == 0){ $(".fechini").attr("disabled", "disabled"); $(".fechfin").attr("disabled", "disabled");}
    else{$(".fechini").removeAttr("disabled"); $(".fechfin").removeAttr("disabled");}
}

$(".type").change(function(){checkInputs(); getItems(1);});
$(".fechini").change(function(){getItems(1);});
$(".fechfin").change(function(){getItems(1);});


function getItems(page)
{
  let ini = document.getElementById("fechini").value;
  let fin = document.getElementById("fechfin").value;
  let type = document.getElementById("type").value;
  let url = `../../app/api/item.php?a=1&&page=${page}&&fechini=${ini}&&fechfinal=${fin}&&type=${type}`;
  loading_scrum();

  $(".table-items").html("");

  fetch(url,{method:'GET'})
  .then(function(response) {return response.json();})
  .then(function(data) {
      stop_scrum();
      if(data.code == 200)
      {
          $(".table-items").html(data.data);
          $(".r-xls").attr("href", `../../reportExcel/notapplied/${ini}/${fin}/${type}/`);
          $(".r-pdf").attr("href", `../../report/notapplied/${ini}/${fin}/${type}/`);
          return;
      }
      statusHTTP(data, "../../");
  })
  .catch(function(err) {
      stop_scrum(); console.log(err); $(".table-items").html("<div class='alert alert-danger'>Error</div>");
  });

}


function aplicar_producto(id)
{
    const data = new FormData();
    data.append('id', id);

    let url = `../../app/api/item.php?a=4`;
    loading_scrum();

    fetch(url, { method: 'POST', body: data})
    .then(function(response) {return response.json();})
    .then(function(data) {
        console.log(data);
        stop_scrum();
        if(data.code == 200)
        {
          if(data.status)
          {
              alertMessage("success", data.msg, "Aceptar", true, "../../items/notapplied/");
              return;
          }
        }
        statusHTTP(data, "../../");
    })
    .catch(function(err) {
        stop_scrum(); console.log(err); $(".table-items").html("<div class='alert alert-danger'>Error</div>");
    });
}
