<?php
class CompraService 
{

    function validaPOST()
    {
        $validation = array();

        foreach($_POST as $campo => $valor){
            
              if ($campo == 'serie' && strlen($valor) == 0){
                    $validation [0] = $valor;
               } 

               if ($campo == 'folio' && strlen($valor) == 0){
                    $validation [1] = $valor;
                } 

                if ($campo == 'total' && strlen($valor) == 0){
                    $validation [2] =  "Total requerido";
                }
                else if ($campo == 'total' && strlen($valor) > 0 && !is_numeric($valor)){
                    $validation [2] = $valor;
                } 

                if ($campo == 'fecha' && strlen($valor) == 0){
                    $validation [3] = $valor;
                }
                else if ($campo == 'fecha' && strlen($valor) > 0)
                {
                    $valores = explode('-', $valor);
                    if(count($valores) != 3 ||  !checkdate($valores[1], $valores[2], $valores[0])){
                        $validation [3] = $valor;
                    }
                }
          }

          
          return $validation;
    }

}
?>

