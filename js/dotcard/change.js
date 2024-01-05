$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
});


var prods = [];
var remision = 0;

$(".type_change").change(function(){
   let val = $(this).val();

    prods = [];
    $(".t-prods").html("");
    $(".d-total").html("");
    $(".btn-change").addClass("d-none");
    $(".d-codes").addClass("d-none");

   if(val == 1)
   {
     $(".i-fol").removeClass("d-none");
     $(".d-prod-server").addClass("d-none");
     $(".d-prod-local").addClass("d-none");
   }
   else if(val == 2) {
      $(".i-fol").addClass("d-none");
      $(".d-prod-server").removeClass("d-none");
      $(".d-prod-local").addClass("d-none");
   }
   else {
     $(".i-fol").addClass("d-none");
     $(".d-prod-server").addClass("d-none");
     $(".d-prod-local").addClass("d-none");
   }
});



$(".btn-remision").click(function(){

    let folio = $("#remision").val();
    remision = folio;
    
    if(isNaN(folio))
    {
        showModalMessageError("error", "El folio de remisión es incorrecto", 2000);
        return;
    }


    prods = [];
    $(".t-prods").html("");
    $(".d-total").html("");
    $(".btn-change").addClass("d-none");
    $(".d-codes").addClass("d-none");

    loading_scrum();
    const data = new FormData();
    data.append('folio', folio);

    let url = `../../../app/api/dotcard.php?a=5`;

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();

      if(data.code == 201)
      {
          $(".d-prod-local").removeClass("d-none");
          let output = '<option value = "0">Seleccione</option>';
          let items = data.items;
          for(let x = 0; x < items.length; x++)
          {
              output += `<option data-cant = "${items[x]["cantidad"]}" data-price = "${items[x]["precio"]}" data-desc = "${items[x]["codigo"]} ${items[x]["descripcion"]}"  value = "${items[x]["id"]}">${items[x]["codigo"]} - ${items[x]["descripcion"]}  [${items[x]["cantidad"]} PZS]</option>`;
          }

          $(".prods-local").html(output);

        stop_scrum();
        return;
      }

      stop_scrum();
      statusHTTP(data, "../../");
    })
    .catch(function(err) { stop_scrum(); console.log(err); });


});






$(".prods").change(function(){
      let val = $(this).val();
      var price = $('option:selected', this).attr('data-price');
      var desc = $('option:selected', this).attr('data-desc');
      var item_cant = $('option:selected', this).attr('data-cant');

      if(val > 0){ addTable(val, price, desc, item_cant); }
      console.log(prods);
});


function addTable(val, price, desc, item_cant)
{
  var descrip = "";
  let count = 0;
  let cantidad = 0;
  $(".table-prods tbody tr").each(function(){
      descrip = $(this).find("td").eq(0).text().trim();
      if(descrip == desc.trim()){ cantidad++; }
  });

  if(cantidad < item_cant)
  {
    $(".t-prods").append("<tr class ='trow'><td class='spacing' data-i ='"+val+"'>"+desc+"</td><td class='spacing' align = 'right'>$"+price+" &nbsp; <i class='fas fa-trash text-danger hand b-del'></i></td></tr>");
    caltotal();
  }

   $(".prods option[value='0']").attr("selected", true);
}

$(".table-prods").on("click", ".b-del", function(){
    console.log("eliminando ...");
    $(this).parent().parent().remove();
    caltotal();
});


function caltotal()
{
    var total = 0;
    prods = [];
    $(".table-prods tbody tr").each(function(){
        let price = $(this).find("td").eq(1).text().trim().replace("$", "");
        let desc = $(this).find("td").eq(0).text().trim();
        let val = $(this).find("td").eq(0).attr("data-i").trim();
        total+=parseFloat(price);
        prods.push([val, desc, price]);
    });

    $(".d-total").html("<h4 class = 'text-primary'>Total $"+total+"</h4>");

    if(total > 0){ $(".btn-change").removeClass("d-none"); $(".d-codes").removeClass("d-none"); }
    else { $(".btn-change").addClass("d-none");  $(".d-codes").addClass("d-none"); }
}

function removeItemFromArr (arr, item ) {
    var i = arr.indexOf( item );

    if ( i !== -1 ) {
        arr.splice( i, 1 );
    }
}



$(".btn-change").click(function(){

    loading_scrum();

    const data = new FormData();
    data.append('products', JSON.stringify(prods));
    data.append('identified', identified);
    data.append('token', token);
    data.append('no_card', $("#no_card").val());

    if($(".type_change").val() == 1)
    {
        data.append('remision', remision);
    }
    else {
        data.append('remision', 0);
    }


    let url = `../../../app/api/dotcard.php?a=1`;

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();

      if(data.code == 200)
      {
        if(data.status)
        {
            alertMessage("success", data.msg, "Aceptar", true, "../../changedetail/"+data.id_canje+"/");
            $(".btn-change").hide();
            return;
        }
      }

      statusHTTP(data, "../../");

    })
    .catch(function(err) { stop_scrum(); console.log(err); });
});




$(".validate-card").click(function(){

    const data = new FormData();
    data.append('identified', identified);
    data.append('token', token);
    let url = `../../../app/api/dotcard.php?a=3`;

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      stop_scrum();

      if(data.code == 200)
      {
        if(data.status)
        {
            alertMessage("success", data.msg, "Aceptar", false, "");
            $(".d-change").removeClass("d-none");
            $(".d-prod-server").addClass("d-none");
            $(".d-prod-local").addClass("d-none");
            $(".d-val").addClass("d-none");
            $("#info").append('<tr><td class="text-blanco spacing">TOKEN :</td><td class="text-blanco spacing" align = "right">'+token+'</td></tr>');
            return;
        }
      }

      statusHTTP(data, "../../");
    })
    .catch(function(err) { stop_scrum(); console.log(err); });
});
