$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});


$(".check-per").change(function(){
    let check = 0;
    if(this.checked) {
        check = 1;
    }
    let value = $(this).val();

    let url = `../../../app/api/user.php?a=4`;

    const data = new FormData();
    data.append('value', value);
    data.append('id', $("#iduser").val());
    data.append('check', check);

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.text();})
    .then(function(data) {
      console.log(data);

        if(data.code == 201)
        {
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
