<?php
class Backup extends Controller
{
    protected $model;
    protected $configModel;

    public function __construct()
    {
        $this->configModel = $this->model('ConfigModel');
    }

    public function index()
    {
          $this->view('error/not_found');
    }

    public function files($key = "0")
    {
      /*  ORDENARLO POR FECHA

      $files = array();
            if ($handle = opendir('.')) {
              while (false !== ($file = readdir($handle))) {
                  if ($file != "." && $file != "..") {
                     $files[filemtime($file)] = $file;
                  }
              }
              closedir($handle);

              // sort
              ksort($files);
              // find the last modification
              $reallyLastModified = end($files);

              foreach($files as $file) {
                  $lastModified = date('F d Y, H:i:s',filemtime($file));
                  if(strlen($file)-strpos($file,".swf")== 4){
                     if ($file == $reallyLastModified) {
                       // do stuff for the real last modified file
                     }
                     echo "<tr><td><input type=\"checkbox\" name=\"box[]\"></td><td><a href=\"$file\" target=\"_blank\">$file</a></td><td>$lastModified</td></tr>";
                  }
              }
            }
      */


      $config = $this->configModel->one();
      $config = $config->fetch_object();

      $files = array();

      $path = $config->path_backup.'sucursal_'.$key; // c/carpeta/sucursal_01

      if(file_exists($path)) {
          if (is_dir($path)){

                  $gestor = opendir($path);
                   // Recorre todos los elementos del directorio

                   $count = 0;
                   while (($archivo = readdir($gestor)) !== false)  {
                    
                       $ruta_completa = $ruta . "/" . $archivo;

                       // Se muestran todos los archivos y carpetas excepto "." y ".."
                       if ($archivo != "." && $archivo != "..") {
                           // Si no es un directorio no se recorre recursivamente
                           if (!is_dir($ruta_completa)) {

                                $tem_ext = explode(".", $archivo);
                                if(count($tem_ext) > 1)
                                {
                                    $extension = $tem_ext[1];
                                    $file_error = 0;
                                    if(strtolower($extension) != "gz" && strtolower($extension) != "zip")
                                    {
                                        $file_error++;
                                    }


                                    $name_archivo = $tem_ext[0];
                                    $file =  fechaCortaAbreviadaConHora(date("Y-m-d H:i:s", filemtime($path."/".$archivo)));
                                    $fecha_corte = '';


                                    if($file_error == 0)
                                    {
                                       $count++;
                                        $temp_name = explode("_", $name_archivo);
                                        $tamanio_nombre = count($temp_name);

                                        if($tamanio_nombre== 2 || $tamanio_nombre == 4)
                                        {
                                            if($tamanio_nombre == 2 && strtoupper($name_archivo) != "RESPALDO_ACTUAL")
                                            {
                                                $file_error++;
                                            }
                                            if($tamanio_nombre == 4 && (strtoupper($temp_name[0]) != "SUCURSAL" || $key != $temp_name[1]))
                                            {
                                                $file_error++;
                                            }

                                            $fecha_corte = conver_to_date($temp_name[2]);
                                            if($fecha_corte) {
                                                $hora_corte = conver_to_hour($temp_name[3]);
                                                $fecha_corte = fechaCortaAbreviadaConHora($fecha_corte." ".$hora_corte);

                                            }
                                        }

                                        $files[] =  ["file" => $archivo, "date" => $file, "corte" => $fecha_corte,  "file_error" => $file_error];
                                    }


                              }
                           }
                       }

                       if($count == 100) { break; }
                   }

                   // Cierra el gestor de directorios
                   closedir($gestor);
          }
      }

        $this->view('backup/files', $files);
    }

}

?>
