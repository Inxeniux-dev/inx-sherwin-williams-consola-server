$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
    getItems();
});


async function getItems(page)
{
  loading_scrum();
  let url = `../../../app/api/sale.php?a=11&&identified=${ids}`;
  fetch(url,{method:'GET'})
  .then(function(response) {return response.text();})
  .then(function(data) {
    $(".table-iguals").html(data);
    stop_scrum();
  })
  .catch(function(err) {
      stop_scrum(); console.log(err);
  });
}
