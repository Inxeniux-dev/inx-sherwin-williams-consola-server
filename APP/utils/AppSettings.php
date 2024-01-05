<?php

  //funciones generales que ayuden a obtener folios, ids, urls, sesiones, etc

  function get_config($conexion)
  {
      $sql = "SELECT id, sync_lines, sync_cards, sync_stores, factor_precio, path_backup, path_log, path_upload, path_transfer FROM config WHERE id = 1 ;";
      $response = $conexion->query($sql);
      if($response){ return $response->fetch_object(); }
      return null;
  }

  function get_serie_venta($conexion)
  {
        $sql = "SELECT serie FROM configuracion WHERE idconfiguracion = 1 LIMIT 1;";
        $response = $conexion->query($sql);
        if($response){ return $response->fetch_object()->serie; }
        return null;
  }


  function get_date_corte($conexion)
  {
        $sql = "SELECT fecha_corte FROM configuracion WHERE idconfiguracion = 1 LIMIT 1;";
        $response = $conexion->query($sql);
        if($response){ return $response->fetch_object()->fecha_corte; }
        return null;
  }

  function get_folio_traspaso($conexion)
  {
        $sql = "SELECT folio_vale_traspaso FROM configuracion WHERE idconfiguracion = 1 LIMIT 1;";
        $response = $conexion->query($sql);
        if($response){ return $response->fetch_object()->folio_vale_traspaso; }
        return null;
  }



  function get_version_db($conexion)
  {
        $sql = "SELECT version, clave_sucursal FROM configuracion WHERE idconfiguracion = 1 LIMIT 1;";
        $response = $conexion->query($sql);
        if($response){ return $response->fetch_object(); }
        return null;
  }




  function get_paginator($pages, $conexion, $query)
  {
        $sql = "SELECT serie FROM configuracion WHERE idconfiguracion = 1 LIMIT 1;";
        $response = $conexion->query($sql);
        if($response){ return $response->fetch_object()->serie; }
        return null;
  }

?>
