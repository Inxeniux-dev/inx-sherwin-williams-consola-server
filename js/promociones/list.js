$(document).ready(() => {
  console.log("hola");
  $("#sidebarCollapse").on("click", function () {
    $("#sidebar").toggleClass("active");
    $(".content").toggleClass("active");
  });



  $("#estado").on("change", function () {
    var isChecked = $(this).is(":checked");

    if (isChecked) {
      $("#estadoLabel").text("Activo");
    } else {
      $("#estadoLabel").text("Inactivo");
    }
  });

  $("#formulario input[type='text'], #formulario input[type='date']").on(
    "change input",
    function () {
      if ($(this).val() === "") {
        $(this).css("border", "1px solid red");
        formValido = false;
      } else {
        $(this).css("border", "");
      }
    }
  );

  $("#formulario").on("submit", function (event) {
    event.preventDefault();

    var formValido = true;
    $("#formulario input[type='text'], #formulario input[type='date']")
      .not("#linea")
      .not("#cantidadMinima")
      .not("#cantidadMaxima")
      .not("#tipCliente")
      .not("#giroCliente")
      .not("#cliente3")
      .not("#cliente4")
      .not("#cliente5")
      .not("#cliente6")
      .not("#desc")
      .not("#desc30")
      .not("#subLinea")
      .not("#fechaFin")
      .each(function () {
        if ($(this).val() === "") {
          $(this).css("border", "1px solid red");
          formValido = false;
        } else {
          $(this).css("border", "");
        }
      });

    if (!formValido) {
      return;
    }

    var estado = $("#estado").is(":checked") ? "activo" : "inactivo";

    var formData = new FormData(this);
    formData.append("estado", estado);

    fetch("../../promociones/insertarPromocion", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("La solicitud no fue exitosa");
        }
        return response.json();
      })
      .then((data) => {
        console.log(data);
        showModalMessageError("success", "Promocion agregado correctamente", 2300);
      })
      .catch((error) => {
        showModalMessageError("error", "Error", 2300);
        console.error("Error al insertar la promoción:", error);
      });
  });
  obtenerLinea()
  function obtenerLinea() {
    var url = "../../promociones/getLinea";
    return fetch(url)
      .then(function (response) {
        if (!response.ok) {
          throw new Error("Error al obtener el inventario desde el servidor");
        }
        return response.json();
      })
      .then(function (data) {
        if (data && data.data) {
          console.log("Lista", data.data);
          // Obtener el select
          var select = document.getElementById("linea");


          select.innerHTML = "";


          var defaultOption = document.createElement("option");
          defaultOption.value = "";
          defaultOption.text = "Seleccione una opción";
          select.appendChild(defaultOption);


          data.data.forEach(function (item) {
            var option = document.createElement("option");
            option.value = item.descripcion;
            option.text = item.descripcion;
            select.appendChild(option);
          });
        } else {
          throw new Error("Error al obtener el último ID de lote: No se encontraron datos válidos");
        }
      })
      .catch(function (error) {
        console.error("Error:", error);
      });
  }
  obtenerMarca()
  function obtenerMarca() {
    var url = "../../promociones/getMarca";
    return fetch(url)
      .then(function (response) {
        if (!response.ok) {
          throw new Error("Error al obtener el inventario desde el servidor");
        }
        return response.json();
      })
      .then(function (data) {
        if (data && data.data) {
          console.log("Marca", data.data);

          var select = document.getElementById("familia");


          select.innerHTML = "";


          var defaultOption = document.createElement("option");
          defaultOption.value = "";
          defaultOption.text = "Seleccione una opción";
          select.appendChild(defaultOption);


          data.data.forEach(function (item) {
            var option = document.createElement("option");
            option.value = item.marca;
            option.text = item.marca;
            select.appendChild(option);
          });
        } else {
          throw new Error("Error al obtener el último ID de lote: No se encontraron datos válidos");
        }
      })
      .catch(function (error) {
        console.error("Error:", error);
      });
  }


});


