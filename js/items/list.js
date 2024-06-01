$(document).ready(() => {
  $("#sidebarCollapse").on('click', function () {
    $("#sidebar").toggleClass("active");
    $(".content").toggleClass("active");
  });
  console.log("read");
  getItems(1);
  getPromociones();

});

let color_border_error = "1.5px solid  #ff988e";
let color_border_normal = "1px solid  #c5c5c5";
let color_border_success = "1.5px solid #00ad00";

function getItems(page) {
  $(".r-pdf").attr("href", "javascript:void(0);");
  let search = document.getElementById("search").value;
  let line = document.getElementById("line").value;
  let capacity = document.getElementById("capacity").value;

  const data = new FormData();
  data.append('search', search);
  data.append('capacity', capacity);
  data.append('line', line);
  data.append('page', page);

  let url = `../../app/api/item.php?a=11`;

  fetch(url, { method: 'POST', body: data })
    .then(function (response) { return response.json(); })
    .then(function (data) {
      console.log(data);
      const { code, output } = data;
      if (code == 200) {
        $(".table-items").html(output);
        //$(".r-pdf").attr("href", `../../report/items/${line}/${capacity}/${search}/`);
        $(".r-xls").attr("href", `../../reportExcel/items/${line}/${capacity}/0/${search}/`);
        $(".r-xls-p").attr("href", `../../reportExcel/items/${line}/${capacity}/1/${search}/`);
      }
      stop_scrum();
    })
    .catch(function (err) { showModalMessageError("error", "Error al consultar la información", 2500); console.log(err); stop_scrum(); });
}

$(".table-items").on("click", ".pag-number", function () {
  getItems($(this).attr("data"));
});

$("#btn-search").click(() => { getItems(1); });
$('#search').keyup(delay(function (e) {
  getItems(1);
}, 800));

$("#line").change(() => { getItems(1); });
$("#capacity").change(() => { getItems(1); });

function check_delete(id = 0) {
  Swal.fire({
    title: '¡Espera! ',
    text: "No podrás revertir esta opción una vez confirmada",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: 'rgb(193 77 77)',
    cancelButtonColor: '#3085d6',
    confirmButtonText: '¡Si, eliminar producto!',
    cancelButtonText: 'No'
  }).then((result) => {
    if (result.value) {
      delete_item(id);
      return;
    }
  });
}




function delete_item(id) {
  let url = `../../app/api/item.php?a=4`;
  const data = new FormData();
  data.append('id', id);

  fetch(url, { method: 'POST', body: data })
    .then(function (response) { return response.json(); })
    .then(function (data) {
      console.log(data);
      const { code } = data;
      if (code == 201) {
        showModalMessageError("success", "Producto eliminado", 2300);
        setTimeout(function () { window.location = `../list/` }, 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
    })
    .catch(function (err) { stop_scrum(); console.log(err); });
}


$(".table-items").on('click', '.i-price', function (event) {
  let row = $(this).attr("data-c");
  let price = $(".table-items #price-r" + parseInt(row)).attr("data-p" + parseInt(row));
  $(this).css("border", color_border_normal);
  $(".table-items #price-r" + parseInt(row)).html(`$${price}`);
});

$(".table-items").on('keyup', '.i-price', function (event) {
  let row = $(this).attr("data-c");
  let code = $(this).attr("data-code");
  let id = $(this).attr("data-id");
  let price = $(this);
  let error = 0;

  if (event.keyCode == 13 || event.keyCode == 9) {

    error += valid_imputs([price]);
    error += valid_numeric_positive([price]);
    //error += valid_no_cero([price]);

    if (error > 0) { price.css("border", color_border_error); return; } else { price.css("border", color_border_normal); }

    let url = `../../app/api/item.php?a=6`;

    const data = new FormData();
    data.append('id', id);
    data.append('code', code);
    data.append('precio', price.val());

    fetch(url, { method: 'POST', body: data })
      .then(function (response) { return response.json(); })
      .then(function (data) {
        console.log(data);
        const { code, status, update_at, precio } = data;
        if (code == 201) {
          price.css("border", color_border_success);
          $(".table-items #data-r" + (parseInt(row) + 1)).focus();
          $(".table-items #data-r" + (parseInt(row) + 1)).select();

          $(".table-items #update-r" + parseInt(row)).html(`<b>${update_at}</b>`);

          $(".table-items #price-r" + parseInt(row)).html(`<i class="fas fa-check-circle text-success"></i> $${precio}`);

          $(".table-items #price-r" + parseInt(row)).attr("data-p" + parseInt(row), precio);

          return;
        }
        else {
          price.css("border", color_border_error);
        }
        statusHTTP(data, "../../");
        stop_scrum();
      })
      .catch(function (err) { stop_scrum(); console.log(err); });

  }

});



$(".btn-xml").click(function () {

  let url = `../../app/api/item.php?a=7`;
  const data = new FormData();
  data.append('ok', "1");

  fetch(url, { method: 'POST', body: data })
    .then(function (response) { return response.text(); })
    .then(function (data) {
      console.log(data);
      const { code, status } = data;
      if (code == 201) {
        return;
      }
    })
    .catch(function (err) { stop_scrum(); console.log(err); });
});




function delay(callback, ms) {
  var timer = 0;
  return function () {
    var context = this, args = arguments;
    clearTimeout(timer);
    timer = setTimeout(function () {
      callback.apply(context, args);
    }, ms || 0);
  };
}


function getPromociones() {
  var url = '../../items/getPromociones';
  console.log(url)
  fetch(url)
    .then(function (response) {
      if (!response.ok) {
        throw new Error("Error al obtener el inventario desde el servidor");
      }
      console.log(response)
      return response.text();
    })
    .then(function (text) {

      try {
        var data = JSON.parse(text);
        console.log("Datos del inventario recibidos:", data);
        if (data.success) {
          if (data.data && Array.isArray(data.data)) {
            console.log(data);
          } else {
            console.error(
              "La propiedad 'data' no es un array o no está definida:",
              data.data
            );
          }
        } else {
          console.error("Error al obtener el inventario:", data.message);
        }
      } catch (e) {
        console.error("La respuesta no es JSON válida:", text);
        throw new Error("Error al analizar la respuesta JSON: " + e.message);
      }
    })
    .catch(function (error) {
      console.error("Error al obtener el inventario:", error);
    });
}
