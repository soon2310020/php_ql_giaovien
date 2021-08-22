<?php
require_once 'controllers/Controller.php';
require_once 'models/Mon.php';
class MonController extends Controller

{
    public  function  index()
    {
        $this->content = $this->render('views/mon/index.php');
        require_once 'views/layouts/main.php';

    }
    public function getAllMon()
    {
        $mon =new Mon();
        $pageNumber=$_GET['pageNumber'];
        $numberPerPage=$_GET['numberPerPage'];
        return $mon->getALL($pageNumber,$numberPerPage) ;
    }
}