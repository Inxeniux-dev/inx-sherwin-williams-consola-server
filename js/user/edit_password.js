$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});


let updatePass = () => {

    let password = $("#password");
    let repassword = $("#repassword");
    let iduser = $("#iduser").val();
    let id_sistema = $("#id_sistema").val();

    let error = 0;
    error += valid_imputs([password, repassword]);
    if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

    if(password.val() != repassword.val())
    {
      showModalMessageError("warning", "¡El password no coincide!", 2300); return;
    }

    loading_scrum();
    let url = `../../../app/api/user.php?a=8`;

    const data = new FormData();
    data.append('password', password.val());
    data.append('repassword', repassword.val());
    data.append('iduser', iduser);
    data.append('idsistema', id_sistema);

    fetch(url,{method:'POST', body:data})
    .then((response) => { return response.json(); })
    .then((data) => {
      console.log(data);
      const { code, status, id }  = data;
        if(code == 201)
        {
            showModalMessageError("success", "Password Actualizado Correctamente", 2300);
            setTimeout(function(){ window.location =`../${iduser}/` }, 2300);
            return;
        }
        statusHTTP(data, "../../");
        stop_scrum();
    })
    .catch((err) =>{ stop_scrum(); console.log(err); });

}
