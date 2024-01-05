<?php

class CambioPrecioModel
{
    private $conexion;
    public $name;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }


    public function create()
    {
        $sql = "INSERT INTO cambio_precio (created_at, no_prod, user_id) VALUE('".date('Y-m-d H:i:s')."', 0, ".$_SESSION['datauser']['iduser'].")";
        $this->conexion->query($sql);
        return $this->conexion->insert_id;
    }

    public function update($id, $no_prods)
    {
        $sql = "UPDATE cambio_precio SET no_prod = '".$no_prods."' WHERE id = '".$id."' LIMIT 1;";
        return $this->conexion->query($sql);
    }
    
    function findAll($page, $fechini, $fechfin)
    {

        $ini=($page-1)*20;

        $limit = "LIMIT ".$ini.", 20;";

        $finaly_query = " ORDER BY id DESC ".$limit."";
        if($page == -1)
        {
        $finaly_query = " ORDER BY id DESC";
        }

            $sql = "SELECT id, created_at, no_prod, `user`.nombre FROM cambio_precio INNER JOIN user ON cambio_precio.user_id = `user`.iduser WHERE (created_at >= '".$fechini." 00:00:00' AND created_at <= '".$fechfin." 23:59:59') ".$finaly_query."";
            $prices = $this->conexion->query($sql); 

            if($page == -1)
            {
            return $prices;
            }



            $sql_p="SELECT COUNT(1) AS contador,
            CASE
            WHEN count(1) % 20 > 0
            THEN TRUNCATE(((count(1) /20)+1),0)
            ELSE TRUNCATE((count(1) /20),0)
            END AS pages
            FROM cambio_precio WHERE (created_at >= '".$fechini." 00:00:00' AND created_at <= '".$fechfin." 23:59:59');";
            $paginator =  $this->conexion->query($sql_p);

            return array("prices" => $prices, "paginator" =>$paginator);

    }


    function findById($id = 0)
    {
        $sql = "SELECT id, created_at, no_prod, `user`.nombre FROM cambio_precio INNER JOIN user ON cambio_precio.user_id = `user`.iduser WHERE id = '".$id."' LIMIT 1;";
        return  $this->conexion->query($sql);
    }


}

?>
