$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
});



$("#status").change(function(){
    let status = $(this).val();
    console.log(status);

    if(status == 0)
    {
      Swal.fire({
          title: '¡Espera! ',
          text: "No podrás revertir esta opción una vez confirmada",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: 'rgb(63 99 134)',
          cancelButtonColor: '#3085d6',
          confirmButtonText: '¡Si, confirmar estatus!',
          cancelButtonText: 'No'
        }).then((result) => {
          if (result.value) {
            update_status(status);
            return;
          }
        });
    }
    else {
      update_status(status);
    }
});


function update_status(status)
{
    let url = `../../../app/api/version.php?a=3`;
    const data = new FormData();
    data.append('id', id);
    data.append('status', status);

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) { console.log(data);
        if(data.code == 201)
        {
          showModalMessageError("success", "Configuración Guardada", 2300);
          setTimeout(function(){ window.location =`../../detail/${id}/` }, 2300);
          return;
        }
        statusHTTP(data, "../../");
        stop_scrum();
    })
    .catch(function(err) { stop_scrum(); console.log(err); });
}



$(".btn-save").click(function(){
  let descripcion = $("#descripcion");
  let error = 0;
  error += valid_imputs([descripcion]);
  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }
  let url = `../../../app/api/version.php?a=2`;
  const data = new FormData();
  data.append('id', id);
  data.append('descripcion', descripcion.val());

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
      if(data.code == 201)
      {
        showModalMessageError("success", "Descripción Agregada", 2300);
        setTimeout(function(){ window.location =`../${id}/` }, 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });
});



$(".btn-upload").click(function(){
  let file = $("#file");
  let nombre = $("#nombre");
  var archivo = file[0].files;

  let url = `../../../app/api/version.php?a=5`;

  const inputFile = document.querySelector("#file");

   if (inputFile.files.length > 0) {
        let formData = new FormData();
        formData.append("archivo", inputFile.files[0]); // En la posición 0; es decir, el primer elemento
        fetch(url, {
            method: 'POST',
            body: formData,
        })
            .then(respuesta => respuesta.text())
            .then(decodificado => {
                console.log(decodificado);
            });
    } else {
        // El usuario no ha seleccionado archivos
        alert("Selecciona un archivo");
    }


  return;

  let error = 0;
  error += valid_imputs([nombre]);
  if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }
  if(!archivo) { showModalMessageError("warning", "¡Debes de seleccionar un archivo!", 2300); return; }

  const archivosParaSubir = archivo;
   if (archivosParaSubir.length <= 0) {
       showModalMessageError("warning", "¡Debes de seleccionar un archivo!", 2300); return;
       return;
   }


  const data = new FormData();
  data.append('id', id);
  data.append('nombre', nombre.val());
  for (const archivo of archivosParaSubir) {
       data.append("archivos[]", archivo);
   }


   console.log(archivo);

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.text();})
  .then(function(data) { console.log(data);
      if(data.code == 201)
      {
        showModalMessageError("success", "Archivo Cargado Correctamente", 2300);
        setTimeout(function(){ window.location =`../${id}/` }, 2300);
        return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });
});


function deleteComent(idcoment)
{
  Swal.fire({
      title: '¡Espera! ',
      text: "No podrás revertir esta operación una vez confirmada",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: 'rgb(193 77 77)',
      cancelButtonColor: '#3085d6',
      confirmButtonText: '¡Si, eliminar!',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
          delComent(idcoment);
        return;
      }
    });
}

function delComent(idcoment)
{
      let url = `../../../app/api/version.php?a=9`;
      const data = new FormData();
      data.append('id', idcoment);
      data.append('idv', id);
      fetch(url,{method:'POST', body:data})
      .then(function(response) {return response.json();})
      .then(function(data) { console.log(data);
          if(data.code == 201)
          {
            showModalMessageError("success", "Descripción Eliminada Correctamente", 2300);
            $("#tr"+idcoment).remove();
            return;
          }
          statusHTTP(data, "../../");
          stop_scrum();
      })
      .catch(function(err) { stop_scrum(); console.log(err); });
}



function deleteFile(idfile)
{
  Swal.fire({
      title: '¡Espera! ',
      text: "No podrás revertir esta operación una vez confirmada, además se registrará en una bitácora",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: 'rgb(193 77 77)',
      cancelButtonColor: '#3085d6',
      confirmButtonText: '¡Si, eliminar archivo!',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
          delFile(idfile);
        return;
      }
    });
}


function delFile(idfile)
{
      let url = `../../../app/api/version.php?a=7`;
      const data = new FormData();
      data.append('id', idfile);
      data.append('idv', id);
      fetch(url,{method:'POST', body:data})
      .then(function(response) {return response.json();})
      .then(function(data) { console.log(data);
          if(data.code == 201)
          {
            showModalMessageError("success", "Archivo Eliminado Correctamente", 2300);
            setTimeout(function(){ window.location =`../${id}/` }, 2300);
            return;
          }
          statusHTTP(data, "../../");
          stop_scrum();
      })
      .catch(function(err) { stop_scrum(); console.log(err); });
}




$(".btn-upd-all").click(function(){
      update_store(0, 1);
});


$(".form-check-input").change(function(){
      let prop = $(this).attr("data");
      let check = 0;
      if(this.checked) {  check = 1;  }
      update_store(prop, check)
});

function update_store(id_store, accion)
{
  let url = `../../../app/api/version.php?a=8`;
  const data = new FormData();
  data.append('id', id);
  data.append('suc_clave', id_store);
  data.append('accion', accion);

  fetch(url,{method:'POST', body:data})
  .then(function(response) {return response.json();})
  .then(function(data) { console.log(data);
      if(data.code == 201)
      {
        if(id_store == 0)
        {
          showModalMessageError("success", "Configuración Actualizada", 2300);
          setTimeout(function(){ window.location =`../${id}/` }, 2300);
          return;
        }
      }
      statusHTTP(data, "../../");
      stop_scrum();
  })
  .catch(function(err) { stop_scrum(); console.log(err); });
}
