<?php
class AppService
{

    function SumaroRestarFechas($fecha, $operacion, $cantidad, $tipo)
    {
        return date("Y-m-d",strtotime($fecha."".$operacion." ".$cantidad." ".$tipo));
    }



    public function get_nombre_dia($fecha){
       $fechats = strtotime($fecha); //pasamos a timestamp

    //el parametro w en la funcion date indica que queremos el dia de la semana
    //lo devuelve en numero 0 domingo, 1 lunes,....
      switch (date('w', $fechats)){
          case 0: return "Domingo"; break;
          case 1: return "Lunes"; break;
          case 2: return "Martes"; break;
          case 3: return "Miercoles"; break;
          case 4: return "Jueves"; break;
          case 5: return "Viernes"; break;
          case 6: return "Sabado"; break;
      }
    }




function sanear_string($string, $replace_enies = false)
{

    $string = trim($string);

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('¥', '¥', 'c', 'C',),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             "\"", "'"),
        '',
        $string
    );


    if($replace_enies)
    {
       $string = str_replace("¥", "Ñ", $string);
    }

    return $string;
}



function validar_formato_fecha($fecha){
	$valores = explode('-', $fecha);
	if(count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])){
		return true;
    }
	return false;
}




    function getPaginatorAjax($datos, $page){

        $paginas = 0;
        $registros = 0;
        $output = '';

        while($data = $datos->fetch_object())
        {
            $paginas = $data->contador;
            $registros = $data->pages;
        }

        if($paginas > 0){



                    $final = 0;
                    if($registros<10){
                        $inicio = 1;
                        $final = $registros;
                    }else{
                        $inicio=$page;
                        $final=9;

                        if(($final+$page)>$registros){
                            $final=$registros;

                            if($final-$inicio<9){
                                $inicio=$final-9;
                            }
                        }
                        else{
                            $final=$final+$page;
                        }
                    }

                    $back=$inicio;
                    $next=$final;
                    $back_list_class="pag-number";
                    $next_list_class="pag-number";

                    if($inicio>1){$back=$inicio-1; $back_class="";}else{$back=0; $back_class="disabled"; $back_list_class="";}
                    if($page<$registros){$next=$page+1; $next_class="";}else{$next=0; $next_class="disabled"; $next_list_class="";}


                    if ($final > 1 )
                    {

                        $output.='<nav aria-label="Page navigation example">
                        <ul class="pagination pagination-sm justify-content-center">';

                        $output.='<li  class="page-item '.$back_class.'"> <a href="javascript:void(0);" data='.$back.' class="page-link '.$back_list_class.'">«</a></li>';

                        for($x = $inicio; $x<=$final; $x++){
                            $active="";
                            if($x == $page){
                                $active="active";
                            }
                            $output.='<li class="page-item '.$active.'"><a href="javascript:void(0);" data='.$x.' class="page-link pag-number">'.$x.'</a></li>';
                        }

                            $output.='<li class="page-item '.$next_class.'"><a href="javascript:void(0);" data='.$next.'  class="page-link '.$next_list_class.'">»</a></li>';


                        $output.= ' </ul>
                                    </nav>';
                }
        }
        else
        {
            $output.='<div class="alert alert-info" role="alert">
                       <b>No hay resultados para mostrar.</b>
                    </div>';
        }
        return $output;
    }


}

?>
