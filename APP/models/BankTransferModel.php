<?php

class BankTransferModel
{
    private $conexion;

    public $id;
    public $sucursal;
    public $fecha_transferencia;
    public $fecha_confirmacion;
    public $fecha_confirmacion_store;
    public $importe;
    public $cuenta;
    public $comentarios;
    public $referencia;
    public $create_at;
    public $status;

    public $page = 0;
    public $limit = 30;
    public $search = '';
    public $fecha_final = '';

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }

    public function create()
    {
        $sql ="INSERT INTO transferencia_bancaria (idsucursal, fecha_transferencia, fecha_confirmacion, importe, idcuenta, comentario, referencia, create_at, status) VALUES ('".$this->sucursal."', '".$this->fecha_transferencia."', '".$this->fecha_confirmacion."', '".$this->importe."', '".$this->cuenta."', '".$this->comentarios."', '".$this->referencia."', '".$this->create_at."', '".$this->status."');";
        return  $this->conexion->query($sql);
    }

    public function one()
    {
         $sql ="SELECT transferencia_bancaria.idsucursal, nombre, fecha_transferencia, fecha_confirmacion, fecha_confirmacion_store, importe, cuenta, banco, comentario, referencia, create_at, transferencia_bancaria.status, idtransferencia, comentario_cont FROM transferencia_bancaria LEFT JOIN cuenta_bancaria_deposito ON transferencia_bancaria.idcuenta = cuenta_bancaria_deposito.idcuenta LEFT JOIN sucursal ON transferencia_bancaria.idsucursal = sucursal.idsucursal WHERE idtransferencia = '".$this->id."' LIMIT 1;";
        return  $this->conexion->query($sql);
    }

    public function allBySuc()
    {
        $inicio = ($this->page - 1) * $this->limit;
        $limit = " LIMIT ".$inicio.", ".$this->limit;

        $filter_account = $this->cuenta > 0 ? " AND idcuenta = ".$this->cuenta : " OR (status = 3 AND idsucursal = '".$this->sucursal."') ";

        $filter = " WHERE idsucursal = '".$this->sucursal."'  AND (create_at >= '".$this->create_at."' AND create_at <= '".$this->fecha_final."') ".$filter_account;
        
        $sql ="SELECT idsucursal, fecha_transferencia, fecha_confirmacion, importe, cuenta, banco, comentario, referencia, create_at, status, idtransferencia, fecha_confirmacion_store FROM transferencia_bancaria LEFT JOIN cuenta_bancaria_deposito ON transferencia_bancaria.idcuenta = cuenta_bancaria_deposito.idcuenta ".$filter." ORDER BY  create_at DESC, status DESC ".$limit.";";
        $transfer = $this->conexion->query($sql);

        $sql_p="SELECT COUNT(1) AS contador, CASE WHEN count(1) % ".$this->limit."> 0 THEN TRUNCATE(((count(1) /".$this->limit.")+1),0) ELSE TRUNCATE((count(1) /".$this->limit."),0) END AS pages FROM
        transferencia_bancaria ".$filter."; ";

        $paginator =  $this->conexion->query($sql_p);

        return array("transfer" => $transfer, "paginator" =>$paginator);

    }


    public function all()
    {
        $inicio = ($this->page - 1) * $this->limit;
        $limit = " LIMIT ".$inicio.", ".$this->limit;
        if($this->page == -1) { $limit = ""; }

        $filter_account = $this->cuenta > 0 ? " AND transferencia_bancaria.idcuenta = ".$this->cuenta : "";
        $filter_account .= $this->sucursal > 0 ? " AND transferencia_bancaria.idsucursal = ".$this->sucursal : "";
        $filter_account .= $this->status >= 0 ? " AND transferencia_bancaria.status = ".$this->status : $filter_account;
        $filter_account .= $this->importe > 0 ? " AND transferencia_bancaria.importe = ".$this->importe : "";
        $filter_account .=  " OR transferencia_bancaria.status = 3";

        $filter = " WHERE  (create_at >= '".$this->create_at."' AND create_at <= '".$this->fecha_final."') ".$filter_account;
        
        $sql ="SELECT transferencia_bancaria.idsucursal, nombre, fecha_transferencia, fecha_confirmacion, fecha_confirmacion_store, importe, cuenta, banco, comentario, referencia, create_at, transferencia_bancaria.status, idtransferencia, comentario_cont FROM transferencia_bancaria LEFT JOIN cuenta_bancaria_deposito ON transferencia_bancaria.idcuenta = cuenta_bancaria_deposito.idcuenta LEFT JOIN sucursal ON transferencia_bancaria.idsucursal = sucursal.idsucursal ".$filter." ORDER BY fecha_transferencia DESC,  transferencia_bancaria.status DESC ".$limit.";";
        $transfer = $this->conexion->query($sql);

        if($this->page == -1)
        {
            return $transfer;
        }

        $sql_p="SELECT COUNT(1) AS contador, CASE WHEN count(1) % ".$this->limit."> 0 THEN TRUNCATE(((count(1) /".$this->limit.")+1),0) ELSE TRUNCATE((count(1) /".$this->limit."),0) END AS pages FROM
        transferencia_bancaria ".$filter."; ";

        $paginator =  $this->conexion->query($sql_p);

        return array("transfer" => $transfer, "paginator" =>$paginator);

        }



        public function updateStatus(){
            $sql = "UPDATE transferencia_bancaria SET status = '".$this->status."', fecha_confirmacion = '".$this->fecha_confirmacion."', fecha_confirmacion_store = '".$this->fecha_confirmacion_store."' WHERE idtransferencia = '".$this->id."' LIMIT 1";
            return $this->conexion->query($sql);
        }


        public function updateComment(){
            $sql = "UPDATE transferencia_bancaria SET comentario_cont = '".$this->comentarios."' WHERE idtransferencia = '".$this->id."' LIMIT 1";
            return $this->conexion->query($sql);
        }
}
?>
