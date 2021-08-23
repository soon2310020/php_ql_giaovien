<?php
require_once 'controllers/Controller.php';
require_once 'models/Mon.php';
class HomeController extends Controller

{
    public  function  index()
    {
        $this->content = $this->render('views/home/index.php');
        require_once 'views/layouts/main.php';

    }

}