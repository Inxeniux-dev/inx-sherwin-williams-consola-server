$(document).ready(() =>{
    $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass("active");
        $(".content").toggleClass("active");
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    console.log("read");



    $(".btn-save-sale").click(function(){

          let folio = $("#folio_venta");
          let folio_factura = $("#folio_factura");
          let folio_devolucion = $("#folio_devolucion");
          let serie_venta = $("#serie_venta");
          let serie_factura = $("#serie_factura");
          let num_tickets = $("#num_tickets");
          let puntos_por_peso = $("#puntos_por_peso");
          let type_print = $("#type_print");
          let printer_name = $("#printer_name");

          let err = 0;
          err += valid_imputs([folio, folio_factura, folio_devolucion, serie_venta, serie_factura, num_tickets, puntos_por_peso, type_print, printer_name]);
          err += valid_numeric_positive([folio, folio_factura, folio_devolucion, num_tickets, puntos_por_peso, type_print]);
          if(err > 0){   showModalMessageError("error", "Verifique campos en rojo", 3000); return; }

          let url = `../../app/api/settings.php?a=3`;

          const data = new FormData();
          data.append('folio', folio.val());
          data.append('folio_factura', folio_factura.val());
          data.append('folio_devolucion', folio_devolucion.val());

          data.append('serie_venta', serie_venta.val());
          data.append('serie_factura', serie_factura.val());
          data.append('num_tickets', num_tickets.val());
          data.append('puntos_por_peso', puntos_por_peso.val());

          data.append('type_print', type_print.val());
          data.append('printer_name', printer_name.val());

          fetch(url,{method:'POST', body:data})
          .then(function(response) {return response.json();})
          .then(function(data) {
            console.log(data);
              if(data.code == 201)
              {
                if(data.status)
                {
                    showModalMessageError("success", "Configuración Guardada", 2500);
                    return;
                }
              }
              statusHTTP(data, "../../");
          })
          .catch(function(err) {
              console.log(err);
          });

    });





    $(".btn-save-transfer").click(function(){

          let folio_traspaso = $("#folio_traspaso");
          let dias_vale = $("#dias_vale");
          let folio_auditoria = $("#folio_auditoria");
          let format_vale = $("#format_vale");
          let folio_pedido = $("#folio_pedido");

          let vale_automatico = $("#vale_automatico");
          let check_automatico = 0;
          if(vale_automatico.is(':checked') ) { check_automatico = 1; }


          let err = 0;
          err += valid_imputs([folio_traspaso, dias_vale, folio_auditoria, format_vale, folio_pedido]);
          err += valid_numeric_positive([folio_traspaso, dias_vale, folio_auditoria, folio_auditoria, folio_pedido]);
          if(err > 0){   showModalMessageError("error", "Verifique campos en rojo", 3000); return; }

          let url = `../../app/api/settings.php?a=4`;

          const data = new FormData();
          data.append('folio_traspaso', folio_traspaso.val());
          data.append('dias_vale', dias_vale.val());
          data.append('folio_auditoria', folio_auditoria.val());
          data.append('format_vale', format_vale.val());
          data.append('folio_pedido', folio_pedido.val());
          data.append('check_automatico', check_automatico);


          fetch(url,{method:'POST', body:data})
          .then(function(response) {return response.json();})
          .then(function(data) {
            console.log(data);
              if(data.code == 201)
              {
                if(data.status)
                {
                    showModalMessageError("success", "Configuración Guardada", 2500);
                    return;
                }
              }
              statusHTTP(data, "../../");
          })
          .catch(function(err) {
              console.log(err);
          });
    });



    $(".btn-save-closing").click(function(){

          let lock_cierre = $("#lock_cierre");
          let check_lock = 0;
          if(lock_cierre.is(':checked') ) { check_lock = 1; }

          let backup_cierre = $("#backup_cierre");
          let check_backup = 0;
          if(backup_cierre.is(':checked') ) { check_backup = 1; }

          let lok_ent_sal = $("#lok_ent_sal");
          let chek_lok_ent_sal = 0;
          if(lok_ent_sal.is(':checked') ) { chek_lok_ent_sal = 1; }


          let fecha_corte = $("#fecha_corte");

          let err = 0;
          err += valid_imputs([fecha_corte]);
          if(err > 0){   showModalMessageError("error", "Verifique campos en rojo", 3000); return; }

          let url = `../../app/api/settings.php?a=5`;

          const data = new FormData();
          data.append('check_lock', check_lock);
          data.append('check_backup', check_backup);
          data.append('fecha_corte', fecha_corte.val());
          data.append('lok_ent_sal', chek_lok_ent_sal);

          fetch(url,{method:'POST', body:data})
          .then(function(response) {return response.json();})
          .then(function(data) {
            console.log(data);
              if(data.code == 201)
              {
                if(data.status)
                {
                    showModalMessageError("success", "Configuración Guardada", 2500);
                    return;
                }
              }
              statusHTTP(data, "../../");
          })
          .catch(function(err) {
              console.log(err);
          });

    });




    $(".btn-save-cobranza").click(function(){

          let folio_complemento = $("#folio_complemento");
          let credit_max = $("#credit_max");
          let ajuste_cartera = $("#ajuste_cartera");
          let check_ajuste= 0;
          if(ajuste_cartera.is(':checked') ) { check_ajuste = 1; }

          let err = 0;
          err += valid_imputs([credit_max, folio_complemento]);
          err += valid_numeric_positive([credit_max, folio_complemento]);
          if(err > 0){   showModalMessageError("error", "Verifique campos en rojo", 3000); return; }

          let url = `../../app/api/settings.php?a=6`;

          const data = new FormData();
          data.append('folio_complemento', folio_complemento.val());
          data.append('credit_max', credit_max.val());
          data.append('check_ajuste', check_ajuste);

          fetch(url,{method:'POST', body:data})
          .then(function(response) {return response.json();})
          .then(function(data) {
            console.log(data);
              if(data.code == 201)
              {
                if(data.status)
                {
                    showModalMessageError("success", "Configuración Guardada", 2500);
                    return;
                }
              }
              statusHTTP(data, "../../");
          })
          .catch(function(err) {
              console.log(err);
          });

    });



    $(".btn-save-inventory").click(function(){

          let folio_inventario = $("#folio_inventario");
          let folio_conversion = $("#folio_conversion");

          let precio_especial = $("#precio_especial");
          let check_especial = 0;
          if(precio_especial.is(':checked') ) { check_especial = 1; }

          let err = 0;
          err += valid_imputs([folio_inventario, folio_conversion]);
          err += valid_numeric_positive([folio_inventario, folio_conversion]);
          if(err > 0){   showModalMessageError("error", "Verifique campos en rojo", 3000); return; }

          let url = `../../app/api/settings.php?a=7`;

          const data = new FormData();
          data.append('folio_inventario', folio_inventario.val());
          data.append('folio_conversion', folio_conversion.val());
          data.append('check_especial', check_especial);

          fetch(url,{method:'POST', body:data})
          .then(function(response) {return response.json();})
          .then(function(data) {
            console.log(data);
              if(data.code == 201)
              {
                if(data.status)
                {
                    showModalMessageError("success", "Configuración Guardada", 2500);
                    return;
                }
              }
              statusHTTP(data, "../../");
          })
          .catch(function(err) {
              console.log(err);
          });

    });




    $(".btn-save-paths").click(function(){

          let path_winrar = $("#path_winrar");
          let path_mysqldump = $("#path_mysqldump");
          let path_backup = $("#path_backup");
          let api_server = $("#api_server");

          let err = 0;
          err += valid_imputs([path_winrar, path_mysqldump, api_server]);
          if(err > 0){   showModalMessageError("error", "Verifique campos en rojo", 3000); return; }

          let url = `../../app/api/settings.php?a=8`;

          const data = new FormData();
          data.append('path_winrar', path_winrar.val());
          data.append('path_mysqldump', path_mysqldump.val());
          data.append('path_backup', path_backup.val());
          data.append('api_server', api_server.val());

          fetch(url,{method:'POST', body:data})
          .then(function(response) {return response.json();})
          .then(function(data) {
            console.log(data);
              if(data.code == 201)
              {
                if(data.status)
                {
                    showModalMessageError("success", "Configuración Guardada", 2500);
                    return;
                }
              }
              statusHTTP(data, "../../");
          })
          .catch(function(err) {
              console.log(err);
          });

    });




});
