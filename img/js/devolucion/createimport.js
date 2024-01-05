$(document).ready(function(){
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
});


$(".form-check-input").change(function(){

  $(".d-import").addClass("d-none");
  $(".import").html("");
  
  let cheked = this.checked;
  $('.table-prods tbody tr').each(function(){
    var cant_code = $(this).find('td').eq(3).children("input").attr("data-cant");
    if(cheked) {
        $(this).find('td').eq(3).children("input").val(cant_code);
    }
    else {
      $(this).find('td').eq(3).children("input").val(0);
    }
  });

});



$(".gen-import").click(function(){

  $(".d-import").addClass("d-none");
  $(".import").html("");

  var itemsReturn = [];
  var num=0;
  var codes = '';
	var error = 0;
  var error_igualados = 0;

	$('.table-prods tbody tr').each(function(){
		var cantidad = $(this).find('td').eq(3).children("input").val();
    var id = $(this).find('td').eq(3).children("input").attr("data-i");
    var codigo = $(this).find('td').eq(3).children("input").attr("data-c");
    var cant_code = $(this).find('td').eq(3).children("input").attr("data-cant");
		num++;

    let item_error = 0;
    if((codigo == "IGUALCC" || codigo == "IGUALMA") && cantidad > 0)
    {
      if(cantidad != cant_code)
      {
          error++;
          item_error++;
          error_igualados++;
      }
    }

		if(cantidad.length <= 0){ error++; item_error++; }
		if(isNaN(cantidad)){ error++;  item_error++; }

    if(item_error == 0)
    {
        if(cantidad > 0)
        {
            let items = [cantidad, codigo, id, cant_code, "&_&"];
            itemsReturn.push(Array(items));
        }
    }

	});
  let msgigual = '';
  let timer = 2500;
  if(error_igualados >0){ msgigual = ", la cantidad de igualados debe de ser igual a la cantidad vendida.";  timer = 4500;}
  if(error > 0){ showModalMessageError("warning", "Verifique la cantidad"+msgigual, timer); return; }

  if(itemsReturn.length > 0)
  {
      loading_scrum();

      const data = new FormData();
      data.append('products', itemsReturn);
      data.append('identified', identified);

      let url = `../../../app/api/sale.php?a=24`;

      fetch(url,{method:'POST', body:data})
      .then(function(response) {return response.json();})
      .then(function(data) {
        console.log(data);

        $(".d-import").removeClass("d-none");
        $(".import").html(`<h4>El importe de la devolución es <b>$${data.total_format}</b></h4> <a class ="btn my-btn-blue-only-border" href = "../../../report/importdevolucion/${identified}/${data.total_format}/" target = "_blank"><i class="fas fa-print"></i> Imprimir</a>`);

        stop_scrum();
      })
      .catch(function(err) {
          stop_scrum(); console.log(err);
      });
  }
  else
  {
     showModalMessageError("warning", "Ingrese el importe de al menos un producto", 2000);
  }

});
