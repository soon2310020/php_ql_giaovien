<?php
require_once 'controllers/Controller.php';
require_once 'models/Congvan.php';
require_once 'models/Model.php';
require_once "Classes/PHPExcel.php";
class CongvanController extends Controller

{
    public  function  index()
    {
        $this->content = $this->render('views/congvan/index.php');
        require_once 'views/layouts/main.php';

    }
    public function getAll()
    {
        $congvan =new Congvan();
        $pageNumber=$_GET['pageNumber'];
        $numberPerPage=$_GET['numberPerPage'];
        $maBoMon=$_GET['maBoMon'];
        $tenCongVan=$_GET['tenCongVan'];
        $maGiaoVien=$_GET['maGiaoVien'];

        return $congvan->getALL($pageNumber,$numberPerPage,$maBoMon,$tenCongVan,$maGiaoVien) ;
    }
    public function add()
    {
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
        $mon->suaNgay=date('Y-m-d H:i:s');

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
    public function delete()
    {
        $maMon="";
        if (isset($_POST['maMon']))
        {
            $maMon=$_POST['maMon'];
        }
        $mon =new Mon();
        $is_deleted=$mon->delete($maMon);
        if ($is_deleted)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
    public function excel()
    {
        $mon =new Mon();
        $data = $mon->getExel();

        $excel = new PHPExcel();
        $excel->setActiveSheetIndex(0);
        $excel->getActiveSheet()->setTitle('Danh sách Môn Học');

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);


        $excel->getActiveSheet()->setCellValue('A1', 'Mã môn học');
        $excel->getActiveSheet()->setCellValue('B1', 'Tên môn học');
        $excel->getActiveSheet()->setCellValue('C1', 'Mô tả');
        $excel->getActiveSheet()->setCellValue('D1', 'Số tiết');
        $excel->getActiveSheet()->setCellValue('E1', 'Bộ môn');
        $excel->getActiveSheet()->setCellValue('F1', 'Ngày tạo');
        $excel->getActiveSheet()->setCellValue('G1', 'Ngày cập nhật');
        $numRow = 2;
        foreach ($data as $item) {


            $excel->getActiveSheet()->setCellValue('A' . $numRow, $item['maMon']);
            $excel->getActiveSheet()->setCellValue('B' . $numRow, $item['tenMon']);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, $item['moTa']);
            $excel->getActiveSheet()->setCellValue('D' . $numRow, $item['sotiet']);
            $excel->getActiveSheet()->setCellValue('E' . $numRow, $item['tenBoMon']);
            $excel->getActiveSheet()->setCellValue('F' . $numRow, $item['taoNgay']);
            $excel->getActiveSheet()->setCellValue('G' . $numRow, $item['suaNgay']);

            $numRow++;
        }
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="DanhSachMonHoc_'.date('Y-m-d').'.xls"');
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');

    }
}