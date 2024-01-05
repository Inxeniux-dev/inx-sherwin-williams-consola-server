<?php
    $factor = isset($_POST["factor"]) ? $_POST["factor"] : 0;

    $itemModel = new ItemModel();
    $response = $itemModel->update_all_especial($factor);

    $model->factor_precio = $factor;
    $model->update_factor($factor);

    $code = $response ? 201 : 200;
    echo json_encode(["code" => $code, "status" =>$response]);
    return;
?>
