$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});



function upload_backup(name)
{
    upload(name);
}


let upload = (name) => {

  console.log(name);
}
