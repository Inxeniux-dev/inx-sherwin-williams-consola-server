$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
    getList(1);
});

$("#tipo").change(function(){ getList(1); });
$("#rows").change(function(){ getList(1); });
$("#suc").change(function(){ getList(1); });
$("#btn-search").click(function(){ getList(1); });

function getList(page)
{

  let tipo = $("#tipo").val();
  let rows = $("#rows").val();

  loading_scrum();
  let url = `../../../app/api/card.php?a=2&id=${id}&tipo=${tipo}&rows=${rows}&suc=${suc}`;
  fetch(url)
   .then(function(response) {return response.json();})
   .then(function(data) {
     console.log(data);
       if(data.code == 200)
       {
          $(".table-bitacora").html(data.output);
       }
       stop_scrum();
   })
   .catch(function(err) { showModalMessageError("error", "Error al consultar la información", 2500);  console.log(err); stop_scrum(); });
}



let addMov  = () => {

  let idcard = $("#idcard").val();
  let tipo = $("#tipo_mov");
  let puntos = $("#puntos");
  let concepto = $("#concepto");

  console.log(tipo.val());
  console.log(puntos.val());
  console.log(concepto.val());

  let error = 0;
  error += valid_imputs([tipo, puntos, concepto]);
  error += valid_numeric_positive([tipo, puntos]);
  error += valid_no_cero([tipo, puntos]);
  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

  let url = `../../../app/api/card.php?a=3`;

  loading_scrum();
  const data = new FormData();
  data.append('tipo', tipo.val());
  data.append('puntos', puntos.val());
  data.append('concepto', concepto.val());
  data.append('id_tarjeta', idcard);

  fetch(url,{method:'POST', body:data})
  .then((response) => { return response.json(); })
  .then((data) => {
    console.log(data);
    const { code, status, id }  = data;
      if(code == 201)
      {
          showModalMessageError("success", "Movimiento Agregado Correctamente", 2300);
          setTimeout(function(){ window.location =`../${idcard}/` }, 2300);
          return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch((err) =>{ stop_scrum(); console.log(err); });

}
