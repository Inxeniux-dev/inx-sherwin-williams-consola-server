$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    console.log("read");

    get_user();
});



function get_user(){

      let url = `../../app/api/settings.php?a=2`;
      fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);

          if(data.code == 200)
          {
              $(".table-users").html(data.data);
              return;
          }

          statusHTTP(data, "../../");
      })
      .catch(function(err) {
          console.log(err);
      });

}




$(".btn-sync").click(function(){
      loading_scrum();
      let url = `../../app/api/settings.php?a=14`;
      fetch(url,{method:'GET'})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);
          stop_scrum();
          if(data.code == 200)
          {
              alertMessage("success", data.msg, "Aceptar", false, "");
              get_user();
          }
          statusHTTP(data, "../../");
      })
      .catch(function(err) {
          stop_scrum(); console.log(err); $(".table-order").html("<div class='alert alert-danger'>Error</div>");
      });
});




function delete_user(id_user)
{
    Swal.fire({
        title: '¿Estás seguro de eliminar al usuario?',
        text: "¡No podrás revertir esto!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '¡Si, eliminar usuario!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
            del(id_user);
        }
      })
}


function del(id_user)
{

    let url = `../../app/api/settings.php?a=10`;
    const data = new FormData();
    data.append('id_user', id_user);

    console.log(id_user);

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);

        if(data.code == 200)
        {
            if(data.status)
            {
              $(".btn-add").css('display', 'none');
              alertMessage("success", "Usuario eliminado con éxito", "Aceptar", true, "../users/");
              return;
            }
        }

        statusHTTP(data, "../../");
    })
    .catch(function(err) {
        console.log(err);
    });

}
