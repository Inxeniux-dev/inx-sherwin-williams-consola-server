<?php
/*Núcleo controlador, este se encarga de acceder a metodos como
la vista y modelo para cargar en modelos y renderizar */
class Controller
{
    public function model($model)
    {
       require_once './APP/models/'.$model.'.php';
       return new $model();
    }

    public function view($view, $data = [])
    {
        require_once './APP/views/'.$view.'.php';
    }

    public function service($service)
    {
        require_once './APP/services/'.$service.'.php';
        return new $service();
    }

    public function functions($function)
    {
        require_once './APP/function/'.$function.'.php';
        return new $function();
    }
}
