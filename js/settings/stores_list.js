$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
          $(".content").toggleClass("active");
    });
    getList(1);
});

$("#tipo").change(function(){ getList(1); });
$("#btn-search").click(function(){ getList(1); });

function getList(page)
{
  const data = new FormData();
  data.append('tipo', $("#tipo").val());
  loading_scrum();
  let url = `../../app/api/v2/store.php?a=1&key=${API_KEY}`;
  fetch(url,{method:'POST', body:data})
   .then(function(response) {return response.json();})
   .then(function(res) {
     console.log(res);
     const { code, data } = res;
       if(code == 200)
       {
            let output = '';
            for(x=0; x< data.length; x++)
            {
                let suc = data[x];
                let icon = '';
                let downicon = '-';
                let btn = `<div class="dropdown">
                              <button class="btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fa fa-ellipsis-h"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <h6 class="dropdown-header"><b>Opciones</b></h6>`;
                let css = '';
                if(suc.msg.length > 0)
                {
                    icon = '<i class="fas fa-exclamation-triangle text-danger"></i>';
                    btn += ` <a class="dropdown-item"  href = "../../backup/files/${suc.clave}/"><i class="fas fa-folder"></i> Listado de Respaldos</a>
                             <div class="dropdown-divider"></div> `;

                    if(suc.file.length > 0) {
                          btn += `<a class="dropdown-item"><i class="fas fa-database"></i> Actualizar Respaldo Local</a>`;
                    }

                    btn += `<a class="dropdown-item" onclick = 'obtenerBackup(${suc.clave});'><i class="fas fa-network-wired"></i> Obtener Respaldo desde Sucursal</a>
                            <div class="dropdown-divider"></div>
                            <h6 class="dropdown-header"><b>Avanzado</b></h6>
                            <a class="dropdown-item"><i class="fas fa-database"></i> Restaurar Todos Los Respaldos Faltantes</a>`;

                          $(".btn-all").removeClass("d-none");
                  css = 'class = "table-info"';
                }
                else {
                    btn += `<a class="dropdown-item" href = "../../backup/files/${suc.clave}/"><i class="fas fa-folder"></i> Listado de Respaldos</a>`;
                }

                btn += `    </div>
                        </div>`;


                if(suc.file.length > 0)
                {
                   downicon = `<i class="fas fa-download" title = "Descargar"></i>`;
                }


                output += `<tr ${css}>
                              <td><b>${suc.sucursal}</b></td>
                              <td align = "center">${suc.corte}</td>
                              <td align = "center"><b>${suc.version}</b></td>
                              <td align = "center">${suc.file} ${downicon}</td>
                              <td align = "center">${suc.path}</td>
                              <td align = "center"><b>${icon} ${suc.msg}</b></td>
                              <td align = "center">${btn}</td>
                          </tr>`;
            }

            $(".table-stores tbody").html(output);
       }
       stop_scrum();
   })
   .catch(function(err) { showModalMessageError("error", "Error al consultar la información", 2500);  console.log(err); stop_scrum(); });
}


$(".btn-all").click(() => {
      restore_all();
});



let restore_all = () => {

  let url = `../../app/api/v2/backup.php?a=3&key=${API_KEY}`;
  fetch(url,{method:'GET'})
   .then(function(response) {return response.text();})
   .then(function(res) {
     console.log(res);
     const { code, data } = res;
       if(code == 200)
       {
       }
       stop_scrum();
   })
   .catch(function(err) { showModalMessageError("error", "Error al consultar la información", 2500);  console.log(err); stop_scrum(); });
}



const obtenerBackup = (clave) => 
{
  loading_scrum("Obteniendo Respaldo, Espere...");

  let url = `../../app/api/v2/backup.php?a=4&suc=${clave}&key=${API_KEY}`;
  fetch(url,{method:'GET'})
   .then(function(response) {return response.json();})
   .then(function(res) {
     console.log(res);
     const { code, data } = res;
       if(code == 201)
       {
          showModalMessageError("success", res.msg, 2400);
          stop_scrum();
          return;
       }
       stop_scrum();
       statusHTTP(res, null);
   })
   .catch(function(err) { showModalMessageError("error", "Error al consultar la información", 2500);  console.log(err); stop_scrum(); });
}