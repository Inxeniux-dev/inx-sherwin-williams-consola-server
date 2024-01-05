$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    console.log("read");
});



let addPaths = () => {

    let path_backup = $("#path_backup");
    let path_log = $("#path_log");
    let path_upload = $("#path_upload");
    let path_transfer = $("#path_transfer");
    let path_orders = $("#path_orders");
    let path_prices = $("#path_prices");

    let error = 0;
    error += valid_imputs([path_backup, path_log, path_upload, path_transfer, path_orders, path_prices]);
    if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

    const url = `../../app/api/settings.php?a=6`;
    const data = new FormData();
    data.append('path_backup', path_backup.val());
    data.append('path_log', path_log.val());
    data.append('path_upload', path_upload.val());
    data.append('path_transfer', path_transfer.val());
    data.append('path_orders', path_orders.val());
    data.append('path_prices', path_prices.val());

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      const {code, status, error } = data;
      if(code == 201)
      {
          showModalMessageError("success", "Datos actualizados correctamente", 2300);
          stop_scrum();
          return;
      }

      statusHTTP(data, "../../");
      stop_scrum();
    })
    .catch(function(err) { stop_scrum(); console.log(err); });
}




let updateSync = () => {

    let sync_lines = $("#sync_lines");
    let check_sync_lines= 0;
    if(sync_lines.is(':checked') ) { check_sync_lines = 1; }

    let sync_cards = $("#sync_cards");
    let check_sync_cards= 0;
    if(sync_cards.is(':checked') ) { check_sync_cards = 1; }

    let sync_users = $("#sync_users");
    let check_sync_users= 0;
    if(sync_users.is(':checked') ) { check_sync_users = 1; }

    let sync_stores = $("#sync_stores");
    let check_sync_stores= 0;
    if(sync_stores.is(':checked') ) { check_sync_stores = 1; }

    let sync_sellers = $("#sync_sellers");
    let check_sync_sellers= 0;
    if(sync_sellers.is(':checked') ) { check_sync_sellers = 1; }

    loading_scrum();
    const url = `../../app/api/settings.php?a=7`;
    const data = new FormData();
    data.append('sync_lines', check_sync_lines);
    data.append('sync_cards', check_sync_cards);
    data.append('sync_users', check_sync_users);
    data.append('sync_stores', check_sync_stores);
    data.append('sync_sellers', check_sync_sellers);

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      const {code, status, error } = data;
      if(code == 201)
      {
          showModalMessageError("success", "Datos actualizados correctamente", 2300);
          stop_scrum();
          return;
      }
      statusHTTP(data, "../../");
      stop_scrum();
    })
    .catch(function(err) { stop_scrum(); console.log(err); });
}


const updateConfigNotebook = () => {

    let user_db = $("#user_db");
    let pass_db = $("#pass_db");
    let host_db = $("#host_db");
    let port_db = $("#port_db");
    let name_db = $("#name_db");

    let error = 0;
    error += valid_imputs([user_db, pass_db, host_db, port_db, name_db]);
    if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

    const url = `../../app/api/settings.php?a=10`;
    const data = new FormData();
    data.append('user_db', user_db.val());
    data.append('pass_db', pass_db.val());
    data.append('host_db', host_db.val());
    data.append('port_db', port_db.val());
    data.append('name_db', name_db.val());


    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      const {code, status, error } = data;
      if(code == 201)
      {
          showModalMessageError("success", "Datos actualizados correctamente", 2300);
          stop_scrum();
          return;
      }

      statusHTTP(data, "../../");
      stop_scrum();
    })
    .catch(function(err) { stop_scrum(); console.log(err); });
}


const updateStoreConfig = () => {


    let points_for_money = $("#points_for_money");
    let points_percentage = $("#points_percentage");

    
    let error = 0;
    error += valid_imputs([points_for_money, points_percentage]);
    error += valid_numeric_positive([points_for_money, points_percentage]);
    if(error > 0 ){ showModalMessageError("warning", "¡Verifica los campos en rojo!", 2300); return; }

    const url = `../../app/api/settings.php?a=11`;
    const data = new FormData();
    data.append('points_for_money', points_for_money.val());
    data.append('points_percentage', points_percentage.val());

    fetch(url,{method:'POST', body:data})
    .then(function(response) {return response.json();})
    .then(function(data) {
      console.log(data);
      const {code, status, error } = data;
      if(code == 201)
      {
          showModalMessageError("success", "Datos actualizados correctamente", 2300);
          stop_scrum();
          return;
      }

      statusHTTP(data, "../../");
      stop_scrum();
    })
    .catch(function(err) { stop_scrum(); console.log(err); });

}