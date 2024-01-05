<?php

$items = $model->all();
$prods = [];

if($items)
{

    while($item = $items->fetch_object())
    {
        if($item->edited == 1){
            $prods[] = $item;
        }
    }
}


if(count($prods)){
    
    $id = $cambioPrecioModel->create();

    foreach ($prods as $key => $item) {
        $item->descripcion = str_replace('"', '\"', $item->descripcion);

        $data = [
            "precio_id" => $id,
            "id" => $item->id,
            "precio" => $item->precio,
            "precio_aux" => $item->precio_aux,
            "data" => json_encode($item),
        ];
        $cambioPrecioDetalleModel->create($data);
        $model->update_price_aux($item->id, $item->precio);
    }

    $cambioPrecioModel->update($id, count($prods));
}

echo json_encode(["code" => 201, "error" => []]);
return;
?>