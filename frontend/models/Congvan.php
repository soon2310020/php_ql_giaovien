<?php
require_once 'models/Model.php';
require_once 'models/Pagination.php';
class Congvan extends Model
{
public $maCongVan;
public $tenCongVan;
public $noiDung;
public $maGiaoVien;
public $maBoMon;
public $taoNgay;
public $suaNgay;
public $file;
public $status;

    public $str_search = '';
    public function getAll($pageNumber,$numberPerPage,$maBoMon,$tenCongVan,$maGiaoVien,$status)
    {
        if(!empty($maBoMon))
        {
            $this->str_search .= " AND bomon.maBoMon =$maBoMon";
        }
        if(!empty($maGiaoVien))
        {
            $this->str_search .= " AND giaovien.maGiaoVien =$maGiaoVien";
        }
        if($status!=-1)
        {
            $this->str_search .= " AND congvan.status =$status";
        }
        if (!empty($tenCongVan))
        {
            $tenCongVan=mb_strtoupper($tenCongVan);

            $this->str_search .= " AND upper(congvan.tenCongVan) like '%$tenCongVan%'";
        }
        $pageRS = new Pagination();
        if ($pageNumber!=null)
            $pageRS->setPageNumber($pageNumber);
        if ($numberPerPage!=null)
            $pageRS->setNumberPerPage($numberPerPage);
        $from = ($pageRS->getPageNumber() - 1) * $pageRS->getNumberPerPage();
        $offset=$pageRS->getNumberPerPage();
        $obj_select = $this->connection
            ->prepare("SELECT congvan.*, bomon.tenBoMon AS tenBoMon,giaovien.tenGiaoVien as tenGiaoVien FROM congvan
                        left JOIN bomon ON congvan.maBoMon = bomon.maBoMon 
                        left JOIN giaovien ON congvan.maGiaoVien = giaovien.maGiaoVien 
                        where TRUE $this->str_search
                        ORDER BY congvan.taoNgay DESC Limit $from,$offset
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $mon = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        $obj_select = $this->connection
            ->prepare("SELECT * FROM bomon ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $bomon = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        $obj_select = $this->connection
            ->prepare("SELECT * FROM giaovien ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $giaoVien = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        $obj_select = $this->connection
            ->prepare("SELECT congvan.*, bomon.tenBoMon AS tenBoMon,giaovien.tenGiaoVien as tenGiaoVien FROM congvan
                        left JOIN bomon ON congvan.maBoMon = bomon.maBoMon 
                        left JOIN giaovien ON congvan.maGiaoVien = giaovien.maGiaoVien 
                        where TRUE $this->str_search ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $monCount = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        $rowCount=count($monCount);

        $pageRS->setItems($mon);
        $pageRS->setItems2($bomon);
        $pageRS->setItems3($giaoVien);

        $pageRS->setRowCount($rowCount);
        $pageRS->setPages();
        $pageRS->setPageCount();
        echo json_encode($pageRS);

    }
    public function update()
    {
        $obj_update = $this->connection
            ->prepare("UPDATE congvan SET status=:status,suaNgay=:suaNgay where maCongVan=:maCongVan");


          if ($this->status==0)
          {
              $arr_update = [
                  'suaNgay'=>$this->suaNgay,
                  ':maCongVan'=>$this->maCongVan,
                  ':status'=>1
              ];
          }
          else
          {
              $arr_update = [
                  'suaNgay'=>$this->suaNgay,
                  ':maCongVan'=>$this->maCongVan,
                  ':status'=>0
              ];
          }




        return $obj_update->execute($arr_update);
    }
    public function insert()
    {

        $obj_insert = $this->connection
            ->prepare("INSERT INTO congvan(maBoMon, tenCongVan, file, maGiaoVien,noiDung,status) 
                                VALUES (:maBoMon, :tenCongVan, :file, :maGiaoVien,:noiDung,:status)");
        if ($this->maGiaoVien=="")
        {
            $arr_insert = [
                ':maBoMon' => $this->maBoMon,
                ':tenCongVan' => $this->tenCongVan,
                ':noiDung' => $this->noiDung,
                ':file' => $this->file,
                ':maGiaoVien'=>null,
                ':status'=>1
            ];
        }

        elseif ($this->maBoMon=="")
        {
            $arr_insert = [
                ':maBoMon' => null,
                ':tenCongVan' => $this->tenCongVan,
                ':noiDung' => $this->noiDung,
                ':file' => $this->file,
                ':maGiaoVien'=>$this->maGiaoVien,
                ':status'=>1
            ];
        }
        else
        {
            $arr_insert = [
                ':maBoMon' => $this->maBoMon,
                ':tenCongVan' => $this->tenCongVan,
                ':noiDung' => $this->noiDung,
                ':file' => $this->file,
                ':maGiaoVien'=>$this->maGiaoVien,
                ':status'=>1
            ];
        }

        return $obj_insert->execute($arr_insert);
    }
    public function delete($maCongVan)
    {

        $obj_delete = $this->connection
            ->prepare("DELETE FROM congvan WHERE maCongVan = $maCongVan");
        return $obj_delete->execute();
    }

    public function getAll2($pageNumber,$numberPerPage,$maBoMon,$tenCongVan,$maGiaoVien,$status)
    {
        if (!empty($maBoMon)) {
            $this->str_search .= " AND bomon.maBoMon =$maBoMon";
        }
        if (!empty($maGiaoVien)) {
            $this->str_search .= " AND giaovien.maGiaoVien =$maGiaoVien";
        }
        if ($status != -1) {
            $this->str_search .= " AND congvan.status =$status";
        }
        if (!empty($tenCongVan)) {
            $tenCongVan = mb_strtoupper($tenCongVan);

            $this->str_search .= " AND upper(congvan.tenCongVan) like '%$tenCongVan%'";
        }
        $pageRS = new Pagination();
        if ($pageNumber != null)
            $pageRS->setPageNumber($pageNumber);
        if ($numberPerPage != null)
            $pageRS->setNumberPerPage($numberPerPage);
        $from = ($pageRS->getPageNumber() - 1) * $pageRS->getNumberPerPage();
        $offset = $pageRS->getNumberPerPage();
        $obj_select = $this->connection
            ->prepare("SELECT congvan.*, bomon.tenBoMon AS tenBoMon,giaovien.tenGiaoVien as tenGiaoVien FROM congvan
                        left JOIN bomon ON congvan.maBoMon = bomon.maBoMon 
                        left JOIN giaovien ON congvan.maGiaoVien = giaovien.maGiaoVien 
                        where TRUE $this->str_search
                        ORDER BY congvan.taoNgay DESC Limit $from,$offset
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $mon = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        $obj_select = $this->connection
            ->prepare("SELECT * FROM bomon ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $bomon = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        $obj_select = $this->connection
            ->prepare("SELECT * FROM giaovien ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $giaoVien = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        $obj_select = $this->connection
            ->prepare("SELECT congvan.*, bomon.tenBoMon AS tenBoMon,giaovien.tenGiaoVien as tenGiaoVien FROM congvan
                        left JOIN bomon ON congvan.maBoMon = bomon.maBoMon 
                        left JOIN giaovien ON congvan.maGiaoVien = giaovien.maGiaoVien 
                        where TRUE $this->str_search ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $monCount = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        $rowCount = count($monCount);

        $pageRS->setItems($mon);
        $pageRS->setItems2($bomon);
        $pageRS->setItems3($giaoVien);

        $pageRS->setRowCount($rowCount);
        $pageRS->setPages();
        $pageRS->setPageCount();
        echo json_encode($pageRS);
    }
}