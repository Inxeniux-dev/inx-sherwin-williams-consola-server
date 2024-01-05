<?php

class BackupService
{


   function createBucket($corte, $path)
   {
       $aux = explode("-",$corte);
       $anio = $aux[0];
       $mes = $aux[1];
       $dia = $aux[2];
       $path = $path."/".$anio."/".$mes;
      if(!file_exists($path))
      {
          if(!@mkdir($path, 0777, true)) { return null; }
      }
      return $path;
   }



    function DescomprimeBackup($path)
    {       
            $mysqlExportPath = $path."/";
            $mysqlExportZip = $path."/respaldo_actual.gz";
            $command = '"'.PATH_WINRAR.'" x -y -hp'.KEY_COMPRESS.' "'.$mysqlExportZip.'" "'.$mysqlExportPath.'"';
            @exec($command, $output=array(), $worked);
            if($worked == 0) { return true;}
            return false;
    }


    function restoreBackup($sucursal, $file)
    {
        $mysqlDatabaseName = "sucursal_".$sucursal;
        $mysqlUserName = DB_USERNAME;
        $mysqlPassword = DB_PASSWORD;
        $mysqlHostName = DB_HOST;
        $mysqlPort = DB_PORT;
        $mysqlImportPath = $file;
        $command = PATH_MYSQL.' --no-defaults -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' -P '.$mysqlPort.' ' .$mysqlDatabaseName .' < '.$mysqlImportPath;
        @exec($command,$output=array(),$worked);
        if($worked == 0) { return true;}
        return false;
    }

}
?>
