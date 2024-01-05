$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    console.log("read");
});



$(".form-check-input").change(function(){
      let prop = $(this).attr("data");
      let check = 0;
      if(this.checked) {
          check = 1;
      }

      let url = `../../../app/api/settings.php?a=1`;
      const data = new FormData();
      data.append('prop', prop);
      data.append('id', id);
      data.append('check', check);

      fetch(url,{method:'POST', body:data})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);

          if(data.code == 200)
          {
              console.log("ok todo chido");
              if(data.status)
              {
                showFlashMessage('Permiso actualizado con éxito');
                return;
              }
          }

          statusHTTP(data, "../../");
      })
      .catch(function(err) {
          console.log(err);
      });

});
