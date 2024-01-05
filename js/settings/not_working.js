$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});


let addDate = () => {

  let date = $("#date");
  let concepto = $("#concepto");

  let error = 0;
  error += valid_imputs([date, concepto]);
  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

  loading_scrum();
  const url = `../../app/api/settings.php?a=8`;
  const data = new FormData();
  data.append('date', date.val());
  data.append('concepto', concepto.val());

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) {
    console.log(data);
    const {code, status, error } = data;
    if(code == 201)
    {
        showModalMessageError("success", "Fecha agregada correctamente", 2300);
        setTimeout(() =>{ window.location = './'; }, 2300);
        return;
    }

    statusHTTP(data, "../../");
    stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });
}



let deleteDate = (id) => {

    loading_scrum();
    const url = `../../app/api/settings.php?a=9`;
    const data = new FormData();
    data.append('id', id);

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      const {code, status, error } = data;
      if(code == 201)
      {
          showModalMessageError("success", "Fecha eliminada correctamente", 2300);
          setTimeout(() =>{ window.location = './'; }, 2300);
          return;
      }

      statusHTTP(data, "../../");
      stop_scrum();
    })
    .catch(function(err) { stop_scrum(); console.log(err); });
}
