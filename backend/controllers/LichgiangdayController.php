<?php
require_once 'controllers/Controller.php';
require_once 'models/Mon.php';
class LichgiangdayController extends Controller

{
    public  function  index()
    {
        $this->content = $this->render('views/lichgiangday/index.php');
        require_once 'views/layouts/main.php';

    }

}