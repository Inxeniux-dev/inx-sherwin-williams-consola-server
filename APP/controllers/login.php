<?php
class Login extends Controller
{

    public function __construct()
    {

    }


    public function index()
    {
        if(isset($_SESSION["datauser"]["iduser"]) && $_SESSION["datauser"]["iduser"] > 0)
        {
               if(MODE == "SERVER") {
                 echo "<script>window.location = '../dashboard/';</script>";
                //   $this->view('login/select', null);
                  return;
               }
                 else {
                    echo "<script>window.location = '../dashboard/';</script>";
                  return;
               }
        }
        $this->view('login/index', null);
    }

    public function close()
    {
        session_destroy();
        echo "<script>window.location = '../../login/';</script>";
    }


}
