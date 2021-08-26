<?php
require_once 'controllers/Controller.php';
require_once 'models/Congvan.php';
require_once 'models/Model.php';
require_once "Classes/PHPExcel.php";
class CongvanController extends Controller

{
    public  function  index()
    {
        if($_SESSION['user']['vaiTro']==2)
        {
            $this->content = $this->render('views/congvan/indexForGiaoVien.php');
        }
        else
        {
            $this->content = $this->render('views/congvan/indexForBoMon.php');
        }

        require_once 'views/layouts/main.php';

    }
    public function getAllForBoMon()
    {
        $status=-1;
        $congvan =new Congvan();
        $pageNumber=$_GET['pageNumber'];
        $numberPerPage=$_GET['numberPerPage'];
        $maBoMon=$_SESSION['user']['maBoMon'];
        $tenCongVan=$_GET['tenCongVan'];
        if (isset($_GET['status']))
        $status=$_GET['status'];

        return $congvan->getALL($pageNumber,$numberPerPage,$maBoMon,$tenCongVan,"",$status) ;
    }
    public function getAllForGiaoVien()
    {
        $status=-1;
        $congvan =new Congvan();
        $pageNumber=$_GET['pageNumber'];
        $numberPerPage=$_GET['numberPerPage'];
        $maGiaoVien=$_SESSION['user']['maGiaoVien'];
        $tenCongVan=$_GET['tenCongVan'];
        if (isset($_GET['status']))
            $status=$_GET['status'];

        return $congvan->getALL($pageNumber,$numberPerPage,"",$tenCongVan,$maGiaoVien,$status) ;
    }
    public function add()
    {
        $maBoMon=NULL;
        $maGiaovien=NULL;
        if (isset($_POST) && !empty($_FILES['file'])) {
            $filename= $_FILES['file']['name'];
            $dir_uploads = __DIR__ . '/../assets/uploads';
            @unlink($dir_uploads . '/' . $filename);
            if (!file_exists($dir_uploads)) {
                mkdir($dir_uploads);
            }
            $filename = time()."-"  . $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], $dir_uploads . '/' . $filename);
            if (isset($_POST['maBoMon']))
                $maBoMon=$_POST['maBoMon'];
            if (isset($_POST['tenCongVan']))
                $tenCongVan=$_POST['tenCongVan'];
            if (isset($_POST['maGiaoVien']))
                $maGiaovien=$_POST['maGiaoVien'];
            if (isset($_POST['noiDung']))
                $noiDung=$_POST['noiDung'];
            $congvan =new Congvan();

            $congvan->maBoMon=$maBoMon;
            $congvan->tenCongVan=$tenCongVan;
            $congvan->maGiaoVien=$maGiaovien;
            $congvan->noiDung=$noiDung;
            $congvan->file=$filename;
            $is_created=$congvan->insert();
        }

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

            if (isset($_POST['maCongVan']))
                $maCongVan=$_POST['maCongVan'];
        if (isset($_POST['status']))
            $status=$_POST['status'];

            $congvan =new Congvan();
            $congvan->maCongVan=$maCongVan;
            $congvan->status=$status;
            $congvan->suaNgay=date('Y-m-d H:i:s');
            $is_updated=$congvan->update();
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
        $maCongVan="";
        $file="";
        if (isset($_POST['maCongVan']))
        {
            $maCongVan=$_POST['maCongVan'];
        }

        if (isset($_POST['file']))
        {
            $file=$_POST['file'];
        }
        $congvan =new Congvan();
        $is_deleted=$congvan->delete($maCongVan);
        if ($is_deleted)
        {
            $dir_uploads = __DIR__ . '/../assets/uploads';
            @unlink($dir_uploads . '/' . $file);
            echo 1;
        }
        else
        {
            echo 0;
        }
    }

}