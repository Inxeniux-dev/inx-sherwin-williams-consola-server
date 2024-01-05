<?php 

class Error extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {   
        $data = [
            "error" => 1
        ];

        $this->view('error/index', $data);    
    }
}

?>