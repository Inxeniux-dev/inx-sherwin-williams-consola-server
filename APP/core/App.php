<?php

class App
{
    /*Definimos el controlador de falla y el metodo de falla */
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
       $url = $this->parseUrl();

       if(substr(isset($_GET['url']) ? $_GET["url"] : '', -1) != "/")
       {   $port = $_SERVER["SERVER_PORT"] == 80 ? '' : $_SERVER["SERVER_PORT"];
          // echo "<script> window.location = 'http://".$_SERVER["SERVER_NAME"].":".$port.$_SERVER["REQUEST_URI"]."/"."'</script>";
       }

       /*Verificamos si el controlador existe*/
       if(file_exists('./APP/controllers/'.$url[0].'.php'))
       {
            $this->controller = $url[0];
            unset($url[0]);
       }

       require_once './APP/controllers/'.$this->controller.'.php';

       /*Si el controlador existe, ahora reemplazamos el controlador por una
       misma instancia de este */
       $this->controller =  new $this->controller;

       if(isset($url[1]))
       {
           if(method_exists($this->controller, $url[1]))
           {
              $this->method = $url[1];
              unset($url[1]);
           }
       }

      $this->params = $url ? array_values($url) : [];
      call_user_func_array([$this->controller, $this->method], $this->params);
    }


    public function parseUrl()  /*Explota y sana la url */
    {
        if(isset($_GET['url']))
        {
           // return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
           return $url = explode('/', rtrim($_GET['url'], '/'));
        }
    }
}
