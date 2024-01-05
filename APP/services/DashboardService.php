<?php
class DashboardService
{


    public function genera_fichero($paths)
    {
        foreach ($paths as $key => $value) {


              if(!file_exists($value)) {
                 @mkdir($value, 0777, true);
              }
        }
    }

}

?>
