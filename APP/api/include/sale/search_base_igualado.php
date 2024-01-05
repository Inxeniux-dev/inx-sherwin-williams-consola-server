<?php

$itemModel = new ItemModel();
$data = $itemModel->getItems($page, null, $idline, null, "igualcc",  $idcapacity);
$paginator = $this->appService->getPaginatorAjax($data["paginator"], $page);
$data_venta = $this->saleModel->getData($identified);
$discount = $this->saleModel->getDescuentoMaximo($data_venta->idtipo_descuento, null, $data_venta->idcliente, $data_venta->idpintor, $identified, null);
$res = $this->service->getListTableBase($data["items"], $paginator, $discount, $data_venta);
echo $res;

?>
