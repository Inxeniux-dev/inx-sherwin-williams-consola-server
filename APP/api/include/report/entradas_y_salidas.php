
<?php

$modelConvert = new ConversionModel();
$modelVales = new TransferModel();
$inventoryModel = new InventoryModel();

$fechini = isset($_GET["fechini"]) ? $_GET["fechini"] : $_SESSION["config"]["date_corte"];
$fechfin = isset($_GET["fechfin"]) ? $_GET["fechfin"] : $_SESSION["config"]["date_corte"];

$data_convert = $modelConvert->getProductsByDate($fechini, $fechfin);
$data_vales = $modelVales->getTransferList(-1, 0, $fechini, $fechfin, 0, 3);
$data_ventas = $model->getlist(-1, $fechini, $fechfin, 0, 0, 0, 0, null);
$data_dev = $model->get_return_by_date($fechini, $fechfin);
$inventory = $inventoryModel->getInventories(-1, $fechini, $fechfin, null);

$data_vales_ajuste = $modelVales->getTransferList(-1, 0, $fechini, $fechfin, 0, 3, 2);
$data_vales_ajuste_sal = $modelVales->getTransferList(-1, 0, $fechini, $fechfin, 0, 3, 6);
$data_ajustes = ["ent" => $data_vales_ajuste, "sal" => $data_vales_ajuste_sal];

$data = ["data_convert" => $data_convert, "data_vales" => $data_vales, "data_ventas" => $data_ventas, "data_dev" => $data_dev, "inventory" => $inventory, "data_ajustes" => $data_ajustes];
$data_module = get_module("entradas_y_salidas", $data);


echo json_encode(["code" => 200, "data" => $data_module]);
return;

function get_module($view, $data = []) {
  $file_to_include = getcwd()."\\include\\report\\".$view.'Module.php';
	$output = '';
	// Por si queremos trabajar con objeto
	//$d = json_decode(json_encode($data));

	if(!is_file($file_to_include)) {
		return false;
	}

	ob_start();
	require_once $file_to_include;
	$output = ob_get_clean();

	return $output;
}

?>
