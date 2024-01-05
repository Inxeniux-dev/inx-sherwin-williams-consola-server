<?php
class ClosingService 
{


    function valida_next_day($closing_day)
    {
        $date = $_SESSION["config"]["date_corte"];
        if($date >= $closing_day)
        {
            return false;
        }
        return true;
    }

}
?>