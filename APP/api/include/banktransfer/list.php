<?php 

$page = isset($_GET["page"]) ? trim($_GET["page"]) : 0;

$fechini = isset($_GET["fechini"]) ? trim($_GET["fechini"]) : date("Y-m-d");
$fechfin = isset($_GET["fechfin"]) ? trim($_GET["fechfin"]) : date("Y-m-d");
$account = isset($_GET["account"]) ? trim($_GET["account"]) : 0;
$store = isset($_GET["store"]) ? trim($_GET["store"]) : 0;
$status = isset($_GET["status"]) ? trim($_GET["status"]) : -1;
$importe = isset($_GET["importe"]) ? trim($_GET["importe"]) : 0;
$importe = str_replace(",", "", $importe);

$model = new BankTransferModel();
$model->page = $page;
$model->sucursal = removeCeros($sucursal);
$model->create_at = $fechini." 00:00:00";
$model->fecha_final = $fechfin." 23:59:59";
$model->cuenta = $account;
$model->sucursal = $store;
$model->status = $status;
$model->importe = $importe;
$data = $model->all();

$service = new AppService();
$paginador = $service->getPaginatorAjax($data["paginator"], $page);


$permission = json_decode($_SESSION["datauser"]["permissions"])->Gestion->Transferencias_bancarias;

$table = '<table class = "table table-hover table-striped table-sm">
                <thead>
                    <tr>
                        <th>Sucursal</th>
                        <th style = "text-align:right">Importe</th>
                        <th>Cuenta</th>
                        <th>No. Aut</th>
                        <th style = "text-align:right"><small><b>F Transferencia</b></small></th>
                        <th style = "text-align:right"><small><b>F Contabilidad</b></small></th>
                        <th style = "text-align:right"><small><b>F Encargado</b></small></th>
                        <th style = "text-align:center">Estatus</th>
                    </tr>
                </thead>
                <tbody>';

while($row = $data["transfer"]->fetch_object()){

    $status = '';
    $button = '<button class = "btn btn-sm btn-info">Detalles</button>'; 
    $text_class = "class = 'text-danger'"; 
    if($row->status == 2) { $status = '<i class="fa fa-ban" aria-hidden="true"></i> Cancelada';  }
    if($row->status == 3) { $status = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i> No confirmado'; $button = '<button class = "btn btn-sm btn-success">Confirmar</button>';}
    if($row->status == 0 || $row->status == 1) { 
        $msg_status = $row->status == 1 ? "Confirmado" : '<i class="fa fa-check-circle" aria-hidden="true"></i> Finalizada';
        $status = '<i class="fa fa-check-circle" aria-hidden="true"></i> '.$msg_status;
        $text_class = "class = 'text-success'";  
    }

    $fecha_confirmacion = $row->fecha_confirmacion == "0000-00-00 00:00:00" ? "" : fechaCortaAbreviadaConHora($row->fecha_confirmacion);
    $fecha_confirmacion_store = ($row->fecha_confirmacion_store == "0000-00-00 00:00:00" || $row->fecha_confirmacion_store == null) ? "" : fechaCortaAbreviadaConHora($row->fecha_confirmacion_store);


     $table .= "<tr>
                    <td><b>".addCeros($row->idsucursal)."-".$row->nombre."</b><br><small>".fechaCortaAbreviadaConHora($row->create_at)."</small></td>
                    <td align = 'right'><b>$".number_format($row->importe, 2)."</td>
                    <td align = 'center'><b>".$row->banco."</b><br>".$row->cuenta."</td>
                    <td align = 'center'>".$row->referencia."</td>
                    <td align = 'right'>".fechaCortaAbreviada($row->fecha_transferencia)."</td>
                    <td align = 'right'>".$fecha_confirmacion."</td>
                    <td align = 'right'>".$fecha_confirmacion_store."</td>
                    <td align = 'center' ".$text_class.">".$status."</td>
                    <td align = 'center'>
                                <div class='dropdown'>
                                <button class='btn btn-default dropdown-toggle dropdown-toggle-remove-row btn-sm' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <i class='fa fa-ellipsis-h'></i>
                                </button>
                                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                <h6 class='dropdown-header'><b>Opciones</b></h6>
                                    <a class='dropdown-item' href='./detail/".$row->idtransferencia."/' ><i class='fa fa-search'></i> Ver detalles</a>";

                                    $btn_comment = strlen($row->comentario_cont) == 0 ? 
                                                    "<hr class='dropdown-divider'>
                                                        </li>
                                                            <a class='dropdown-item' href='javascript:void(0);' onclick = 'add_comment(".$row->idtransferencia.", 2);'>
                                                            <i class='fa fa-pencil' aria-hidden='true'></i> Agregar comentario</a>" : "";


                                    if($row->status == 3 && $permission->Editar == 1) {
                                        $table .= "<li><hr class='dropdown-divider'></li><a class='dropdown-item' href='javascript:void(0);' onclick = 'updateStatus(".$row->idtransferencia.", 1);'><i class='fas fa-check-circle'></i> Confirmar</a>
                                        <li><hr class='dropdown-divider'></li><a class='dropdown-item' href='javascript:void(0);' onclick = 'updateStatus(".$row->idtransferencia.", 2);'><i class='fa fa-ban' aria-hidden='true'></i> Cancelar</a>";
                                    }
                                    else{
                                        $table .= $btn_comment;
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