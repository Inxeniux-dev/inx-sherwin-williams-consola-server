<?php

$sucursal = isset($_GET["sucursal"]) ? trim($_GET["sucursal"]) : '';
$page = isset($_GET["page"]) ? trim($_GET["page"]) : 0;

$fechini = isset($_GET["fechini"]) ? trim($_GET["fechini"]) : date("Y-m-d");
$fechfin = isset($_GET["fechfin"]) ? trim($_GET["fechfin"]) : date("Y-m-d");
$cuenta = isset($_GET["cuenta"]) ? trim($_GET["cuenta"]) : 0;
$status = isset($_GET["status"]) ? trim($_GET["status"]) : -1;

$model = new BankTransferModel();
$model->page = $page;
$model->sucursal = removeCeros($sucursal);
$model->create_at = $fechini." 00:00:00";
$model->fecha_final = $fechfin." 23:59:59";
$model->cuenta = $cuenta;
$data = $model->allBySuc();

$service = new AppService();
$paginador = $service->getPaginatorAjax($data["paginator"], $page);

$table = '<table class = "table table-hover table-striped table-sm">
                <thead>
                    <tr>
                        <th>Importe</th>
                        <th>No. Aut</th>
                        <th style = "text-align:right;">F Transferencia</th>
                        <th style = "text-align:right;">F solicitud</th>
                        <th style = "text-align:right;">F Contabilidad</th>
                        <th style = "text-align:right;">F Encargado</th>
                        <th style = "text-align:center;">Estatus</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>';

while($row = $data["transfer"]->fetch_object()){
    $status = '';
    $button = '';
    $text_class = "class = 'text-danger'"; 
    if($row->status == 3) { $status = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i> No confirmado'; }
    if($row->status == 2) { $status = '<i class="fa fa-ban" aria-hidden="true"></i> Cancelada';  }
    if($row->status == 0 || $row->status == 1) { 
        $status =  $row->status == 1 ? '<i class="fa fa-check-circle" aria-hidden="true"></i> Confirmado por contabilidad' : '<i class="fa fa-check-circle" aria-hidden="true"></i> <i class="fa fa-check-circle" aria-hidden="true"></i> Finalizada';
        $button = $row->status == 0 ? '<button class = "btn btn-sm btn-info">Detalles</button>' : '<button class = "btn btn-sm btn-info">Confirmar</button>'; 
        $text_class = "class = 'text-success'";  
    }

    $fecha_confirmacion = ($row->fecha_confirmacion == "0000-00-00 00:00:00" || $row->fecha_confirmacion == null) ? "" : fechaCortaAbreviadaConHora($row->fecha_confirmacion);

    $fecha_confirmacion_store = ($row->fecha_confirmacion_store == "0000-00-00 00:00:00" || $row->fecha_confirmacion_store == null) ? "" : fechaCortaAbreviadaConHora($row->fecha_confirmacion_store);

     $table .= "<tr>
                    <td align = 'right'><b>$".number_format($row->importe, 2)."</b><br>".$row->cuenta."-".$row->banco."</td>
                    <td align = 'center'>".$row->referencia."</td>
                    <td align = 'right'>".fechaCortaAbreviada($row->fecha_transferencia)."</td>
                    <td align = 'right'>".fechaCortaAbreviadaConHora($row->create_at)."</td>
                    <td align = 'right'>".$fecha_confirmacion."</td>
                    <td align = 'right'>".$fecha_confirmacion_store."</td>
                    <td align = 'center' ".$text_class.">".$status."</td>
                    <td>
                      <div class='dropdown'>
                                <button class='btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fa fa-ellipsis-h'></i>
                                </button>
                                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                <h6 class='dropdown-header'><b>Opciones</b></h6>
                                    <a class='dropdown-item' href='../detail/".$row->idtransferencia."/' ><i class='fa fa-search'></i> Ver detalles</a>";
                                    if($row->status == 1) {
                                        $table .= "<li><hr class='dropdown-divider'></li><a class='dropdown-item' href='javascript:void(0);' onclick = 'confirmTransfer(".$row->idtransferencia.");'><i class='fas fa-check-circle'></i> Aceptar Confirmación</a>";
                                    }
           $table .= "</div>
                            </div>
                     </td>
                </tr>";
}


$table .= "</tbody></table>";

$table .= "<div>".$paginador."</div>";



echo json_encode(["code" => 200, "data" => $table]);


?>