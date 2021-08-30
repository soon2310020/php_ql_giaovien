<?php
require_once 'controllers/Controller.php';
require_once 'models/Bomon.php';
require_once 'models/Khoa.php';
class BomonController extends Controller

{
    public  function  index()
    {
        
        $this->content = $this->render('views/bomon/index.php');
        require_once 'views/layouts/main.php';
    }
    public function getAllBoMon()
    {
        $bomon =new Bomon();
        $pageNumber=$_GET['pageNumber'];
        $numberPerPage=$_GET['numberPerPage'];
        return $bomon->getALL($pageNumber,$numberPerPage) ;
    }
}