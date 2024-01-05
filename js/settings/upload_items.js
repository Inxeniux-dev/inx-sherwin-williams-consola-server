$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});



$(".upload").on('click', function() {
      loading_scrum('Cargando archivo, espere...');
      var formData = new FormData();
      var files = $('#image')[0].files[0];
      let url = `../../app/api/settings.php?a=1`;
      console.log(url);

      formData.append('file',files);
      fetch(url,{method:'POST', body:formData})
      .then(function(response) {return response.json();})
      .then(function(data) { console.log(data);
        console.log(data);
        const {error, code, status } = data;
          if(code == 201 && status)
          {
                showModalMessageError("success", "Productos cargados correctamente", 2300);
                setTimeout(function(){ window.location =`../../items/list/` }, 2300);
             return;
          }
        stop_scrum();
        statusHTTP(data, '');
      })
      .catch(function(err) { stop_scrum(); console.log(err); });
});
