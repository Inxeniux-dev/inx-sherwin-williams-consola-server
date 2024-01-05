<?php

class InvoiceModel
{
    private $conexion;
    public $id;
    public $folio;
    public $serie;
    public $factura;
    public $otros_gastos;
    public $subtotal;
    public $iva;
    public $total_costo;
    public $total_venta;
    public $fecha_factura;
    public $fecha_corte;
    public $tipo_factura;
    public $idproveedor;
    public $idalmacen;
    public $idconcepto;
    public $create_at;
    public $update_at;

    /*Pagination*/
    public $page = 0;
    public $limit = 100;
    public $search = '';
    public $fechini = '';
    public $fechfin = '';
    public $estatus = 0;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }

    public function all()
    {
        $inicio = (($this->page - 1) * $this->limit);
        $limit = $this->page < 0 ? '' : ' LIMIT '.$inicio.','.$this->limit;

        $tipo = $this->tipo_factura == 0 ? '' : ' AND tipo_factura = '.$this->tipo_factura;
        $estatus = '';
        if($this->estatus == 1){ $estatus = ' AND LENGTH(fecha_pago) > 0 '; }
        if($this->estatus == 0){ $estatus = ' AND fecha_pago IS NULL '; }

        $filter = strlen($this->search) == 0 ? ' fecha_corte >= "'.$this->fechini.'" AND fecha_corte <= "'.$this->fechfin.'" AND idproveedor = "'.$this->idproveedor.'" AND idalmacen = "'.$this->idalmacen.'"' : ' idalmacen = "'.$this->idalmacen.'" AND (factura LIKE "%'.$this->search.'%" OR folio LIKE "%'.$this->search.'%") ';

        $sql = 'SELECT idcompra, folio, serie, factura, total_venta, fecha_corte, fecha_factura, total_costo, fecha_pago, subtotal FROM factura_proveedor WHERE '.$filter.$estatus.$tipo.' ORDER BY folio ASC '.$limit.';';
        if($this->page < 0) { $res = $this->conexion->query($sql);  return $res ? $res : false; }
        $facturas = $this->conexion->query($sql);

        /*Paginator*/
        $sql = 'SELECT COUNT(1) AS contador, CASE WHEN count(1) % '.$this->limit.'> 0 THEN TRUNCATE(((count(1) /'.$this->limit.')+1),0) ELSE TRUNCATE((count(1) /'.$this->limit.'),0) END AS pages FROM factura_proveedor WHERE '.$filter.$estatus.$tipo;
        $paginator =  $this->conexion->query($sql);
        return ["facturas" => $facturas, "paginator" => $paginator];
    }

    public function one()
    {
        $sql = 'SELECT idcompra, folio, serie, factura, total_venta, fecha_corte, fecha_factura, total_costo, fecha_pago, subtotal, idproveedor, idalmacen, otros_gastos, iva FROM factura_proveedor WHERE idcompra = "'.$this->id.'" LIMIT 1;';
        return $this->conexion->query($sql);
    }

    public function create()
    {
        $sql = "INSERT INTO factura_proveedor (folio, serie, factura, otros_gastos, subtotal, iva, total_costo, total_venta, fecha_factura, fecha_corte, create_at, update_at, tipo_factura, idproveedor, idalmacen) VALUES ('".$this->folio."', '".$this->serie."',  '".$this->factura."', '".$this->otros_gastos."', '".$this->subtotal."', '".$this->iva."', '".$this->total_costo."', '".$this->total_venta."', '".$this->fecha_factura."', '".$this->fecha_corte."', '".$this->create_at."', '".$this->update_at."', '".$this->tipo_factura."', '".$this->idproveedor."', '".$this->idalmacen."');";
        return $this->conexion->query($sql);
    }

    public function update()
    {
       $sql = "UPDATE factura_proveedor SET fecha_pago = '".$this->fecha_pago."', update_at = '".$this->update_at."' WHERE idcompra = '".$this->id."' LIMIT 1";
       return $this->conexion->query($sql);
    }


    public function countBySupplier()
    {
        $sql = "SELECT COUNT(*) AS total FROM factura_proveedor WHERE idproveedor = '".$this->idproveedor."';";
        return $this->conexion->query($sql);
    }
}

?>
