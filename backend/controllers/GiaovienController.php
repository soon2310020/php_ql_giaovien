<?php
require_once 'controllers/Controller.php';
require_once 'models/Bomon.php';
require_once 'models/Giaovien.php';
class GiaovienController extends Controller

{
    public  function  index()
    {
        
        $this->content = $this->render('views/giaovien/index.php');
        require_once 'views/layouts/main.php';
    }
    public function getAllGiaovien()
    {
        $bomon =new Giaovien();

        return $bomon->getALL() ;
    }
}