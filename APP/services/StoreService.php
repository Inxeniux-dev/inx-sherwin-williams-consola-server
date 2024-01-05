<?php

Class StoreService
{

    public function genera_bat_uploads($locations)
    {
        if($locations)
        {
            $output .= "@echo off \n";
            $output .= "cd C:\AppServ\MySQL\bin \n";

            while($value = $locations->fetch_object()) {

                if($value->version == 1)
                {
                        $sucursal = "sucursal_".addCeros($value->idsucursal);
                        $sucursal_name = $value->nombre;

                        $output .= '@echo  Restaurando Sucursal '.$sucursal." - ".$sucursal_name;
                        $output .= "\n";
                        $output .= 'del "F:\Respaldos\\'.$sucursal.'\\'.$sucursal.'.sql"';
                        $output .= "\n";
                        $output .= '@echo - Descomprimiendo '.$sucursal.' - '.$sucursal_name;
                        $output .= "\n";
                        $output .= '"C:\Program Files\WinRAR\winrar.exe" x -hp2eae72fea4132b283a7a701199ab6c80efd42a6f "F:\Respaldos\\'.$sucursal.'\respaldo_actual.gz" "F:\Respaldos\\'.$sucursal.'\"';
                        $output .= "\n";
                        $output .= 'cd C:\AppServ\MySQL\bin';
                        $output .= "\n";
                        $output .= '@echo - Restaurando '.$sucursal.' - '.$sucursal_name.' ...';
                        $output .= "\n";
                        $output .= 'mysql -u root -pGCHydra.16* '.$sucursal.' < F:\Respaldos\\'.$sucursal.'\\'.$sucursal.'.sql';
                        $output .= "\n";
                        $output .= "\n\n\n";
                }
            }


            //Se crea el archivo automaticamente
            $file = fopen(PATH_FILES_BACKUPS."upload_backups.bat", "w");

            if(!fwrite($file, $output . PHP_EOL))
            {
               return false;
            }

            if(!fclose($file))
            {
                return true;
            }

            return true;
        }

        return false;
    }

}
