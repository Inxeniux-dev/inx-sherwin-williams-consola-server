$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});



$(".btn-add").click(function(){

    let nombre = $("#name");
    let username = $("#username");
    let pass = $("#pass");
    let type = $("#type");
    let err = 0;

    err += valid_imputs([nombre, username, pass, type]);

    if(err > 0)
    {
        showModalMessageError("error", "Verifica los campos en rojo", 2000);
    }


    let url = `../../app/api/settings.php?a=9`;
    const data = new FormData();
    data.append('name', nombre.val());
    data.append('username', username.val());
    data.append('pass', pass.val());
    data.append('type', type.val());

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);

        if(data.code == 200)
        {
            if(data.status)
            {
              $(".btn-add").css('display', 'none');
              alertMessage("success", "Usuario agregado con éxito", "Aceptar", true, "../users/");
              return;
            }
        }

        statusHTTP(data, "../../");
    })
    .catch(function(err) {
        console.log(err);
    });
});
