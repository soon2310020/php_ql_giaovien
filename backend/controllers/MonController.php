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
        $maBoMon=$_GET['maBoMon'];
        $tenMon=$_GET['tenMon'];
        return $mon->getALL($pageNumber,$numberPerPage,$maBoMon,$tenMon) ;
    }
    public function add()
    {
     if (isset($_POST['maBoMon']))
        $maBoMon=$_POST['maBoMon'];
        if (isset($_POST['tenMon']))
        $tenMon=$_POST['tenMon'];
        if (isset($_POST['sotiet']))
        $sotiet=$_POST['sotiet'];
        if (isset($_POST['mota']))
        $moTa=$_POST['mota'];
       $mon =new Mon();
       $mon->soTiet=$sotiet;
       $mon->moTa=$moTa;
       $mon->tenMon=$tenMon;
       $mon->maBoMon=$maBoMon;
       $is_created=$mon->insert();
       if ($is_created)
       {
           echo 1;
       }
    else
    {
        echo 0;
    }

    }
    public function update()
    {
        if (isset($_POST['maMon']))
        {
            $maMon=$_POST['maMon'];
        }
        if (isset($_POST['maBoMon']))
            $maBoMon=$_POST['maBoMon'];
        if (isset($_POST['tenMon']))
            $tenMon=$_POST['tenMon'];
        if (isset($_POST['sotiet']))
            $sotiet=$_POST['sotiet'];
        if (isset($_POST['moTa']))
            $moTa=$_POST['moTa'];
        $mon =new Mon();
        $mon->soTiet=$sotiet;
        $mon->moTa=$moTa;
        $mon->tenMon=$tenMon;
        $mon->maBoMon=$maBoMon;
        $mon->maMon=$maMon;
        $is_updated=$mon->update();
        if ($is_updated)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }

    }
}