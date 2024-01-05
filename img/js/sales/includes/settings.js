
$(".b-type-doc").click(function(){
    let order = $(this).attr("data");
    const data = new FormData();
    data.append('identified', identified);
    data.append('setting', order);

    let url = "../../../app/api/sale.php?a=14";

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();
      if(data.code == 200)
      {
        if(data.status)
        {
            ModalMsg(data.msg, "../../addItem/"+identified+"/");return;
        }
      }
      statusHTTP(data, "../../");
    })
    .catch(function(err) {
        stop_scrum(); console.log(err);
    });
});
