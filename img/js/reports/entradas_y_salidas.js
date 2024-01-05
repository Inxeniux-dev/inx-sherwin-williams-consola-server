$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");

    get_movs();
});



$("#dateInitial").change(function(){get_movs(); });
$("#dateFinaly").change(function(){get_movs(); });


function get_movs()
{
      loading_scrum();
     $(".r-pdf").attr("href", `javascript:void(0);`);
     $(".r-xls").attr("href", `javascript:void(0);`);

     let fechini = $("#dateInitial").val();
     let fechfin = $("#dateFinaly").val();
     let url = `../../app/api/reports.php?a=6&&&&fechini=${fechini}&&fechfin=${fechfin}`;

     fetch(url,{method:'GET'})
     .then(function(response) {return response.json();})
     .then(function(data) {
       console.log(data);
       stop_scrum();

       if(data.code == 200)
       {
           $(".d-contend").html(data.data);
           $(".r-pdf").attr("href", `../../report/ent_sal/${fechini}/${fechfin}/`);
           $(".r-xls").attr("href", `../../reportExcel/ent_sal/${fechini}/${fechfin}/`);
       }

     })
     .catch(function(err) {
         stop_scrum(); console.log(err);
     });
}
