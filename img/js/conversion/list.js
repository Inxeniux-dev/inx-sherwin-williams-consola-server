$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
    });
    getConversion(1);
});


$(".table-conversion").on("click", ".delete-convert", function(){
    let identified = $(this).attr("data");
    loading_scrum();
    window.location = `../deleteConvertion/${identified}/`;
});


function getConversion(page)
{
    let fechini = document.getElementById('dateInitial').value;
    let fechfin = document.getElementById('dateFinaly').value;
    loading_scrum();

    fetch(`../../app/api/conversion.php?a=1&&page=${page}&&fi=${fechini}&&ff=${fechfin}`, {
            method: 'GET'
        })
        .then(function(response) {
        if(response.ok) {
            return response.json()
        } else {
            throw "Error en la llamada Ajax";
        }
        })
        .then(function(data) {
            console.log(data);
            if(data.code == 200)
            {
                $(".table-conversion").html(data.data);
                stop_scrum();
                return;
            }
              stop_scrum();
        })
        .catch(function(err) {
        console.log(err);
          stop_scrum();
     });
}


$(".table-conversion").on("click",".pag-number", function(){
    getConversion($(this).attr("data"));
});

$("#dateInitial").change(()=>{ getConversion(1); });
$("#dateFinaly").change(()=>{ getConversion(1); });
