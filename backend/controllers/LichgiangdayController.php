<?php
require_once 'controllers/Controller.php';
require_once 'models/LichGiangDay.php';
class LichgiangdayController extends Controller

{
    public  function  index()
    {
        $this->content = $this->render('views/lichgiangday/index.php');
        require_once 'views/layouts/main.php';

    }
    public function getAll()
    {
        $giangday =new LichGiangDay();
        $pageNumber=$_GET['pageNumber'];
        $numberPerPage=$_GET['numberPerPage'];
        $maMon=$_GET['maMon'];
        $maGiaoVien=$_GET['maGiaoVien'];


        return $giangday->getALL($pageNumber,$numberPerPage,$maMon,$maGiaoVien) ;
    }
    public function add()
    {
        if (isset($_POST['maMon']))
            $maMon=$_POST['maMon'];
        if (isset($_POST['maGiaoVien']))
            $maGiaoVien=$_POST['maGiaoVien'];
        if (isset($_POST['soTiet']))
            $soTiet=$_POST['soTiet'];
        if (isset($_POST['ghiChu']))
            $ghiChu=$_POST['ghiChu'];
        if (isset($_POST['thoiGian']))
            $thoiGian=$_POST['thoiGian'];
        if (isset($_POST['diaDiem']))
            $diaDiem=$_POST['diaDiem'];
        $lichGiangDay =new LichGiangDay();

        $lichGiangDay->maMon=$maMon;
        $lichGiangDay->maGiaoVien=$maGiaoVien;
        $lichGiangDay->soTiet=$soTiet;
        $lichGiangDay->ghiChu=$ghiChu;
        $lichGiangDay->thoiGian=$thoiGian;
        $lichGiangDay->diaDiem=$diaDiem;

        $is_created=$lichGiangDay->insert();
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
            $maMon=$_POST['maMon'];
        if (isset($_POST['maGiaoVien']))
            $maGiaoVien=$_POST['maGiaoVien'];
        if (isset($_POST['soTiet']))
            $soTiet=$_POST['soTiet'];
        if (isset($_POST['ghiChu']))
            $ghiChu=$_POST['ghiChu'];
        if (isset($_POST['thoiGian']))
            $thoiGian=$_POST['thoiGian'];
        if (isset($_POST['diaDiem']))
            $diaDiem=$_POST['diaDiem'];
        $lichGiangDay =new LichGiangDay();

        $lichGiangDay->maMon=$maMon;
        $lichGiangDay->maGiaoVien=$maGiaoVien;
        $lichGiangDay->soTiet=$soTiet;
        $lichGiangDay->ghiChu=$ghiChu;
        $lichGiangDay->thoiGian=$thoiGian;
        $lichGiangDay->diaDiem=$diaDiem;
        $lichGiangDay->suaNgay=date('Y-m-d H:i:s');
        $is_updated=$lichGiangDay->update();
        if ($is_updated)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }

    }
    public function delete()
    {
        if (isset($_POST['maMon']))
            $maMon=$_POST['maMon'];
        if (isset($_POST['maGiaoVien']))
            $maGiaoVien=$_POST['maGiaoVien'];

        $giangday =new LichGiangDay();
        $is_deleted=$giangday->delete($maMon,$maGiaoVien);
        if ($is_deleted)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }


}