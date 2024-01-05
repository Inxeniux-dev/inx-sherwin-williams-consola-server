<?php
class Home extends Controller
{
    public function __construct()
    {

    }
    public function index($name = '')
    {
        echo "<script>window.location = '".PATH."dashboard/';</script>";
    }
}
