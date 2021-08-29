<?php
require_once 'models/Model.php';
require_once 'models/Pagination.php';
class LichGiangDay extends Model
{
public $maGiaoVien;
public $maMon;
public $thoiGian;
public $diaDiem;
public $soTiet;
public $ghiChu;
public $taoNgay;
public $suaNgay;

    public $str_search = '';
    public function getAll($pageNumber,$numberPerPage,$maMon,$maGiaoVien)
    {
        if(!empty($maMon))
        {
            $this->str_search .= " AND mon.maMon =$maMon";
        }
        if(!empty($maGiaoVien))
        {
            $this->str_search .= " AND giaovien.maGiaoVien =$maGiaoVien";
        }

        $pageRS = new Pagination();
        if ($pageNumber!=null)
            $pageRS->setPageNumber($pageNumber);
        if ($numberPerPage!=null)
            $pageRS->setNumberPerPage($numberPerPage);
        $from = ($pageRS->getPageNumber() - 1) * $pageRS->getNumberPerPage();
        $offset=$pageRS->getNumberPerPage();
        $obj_select = $this->connection
            ->prepare("SELECT giangday.*, mon.tenMon AS tenMon,giaovien.tenGiaoVien as tenGiaoVien FROM giangday
                        left JOIN mon ON giangday.maMon = mon.maMon 
                        left JOIN giaovien ON giangday.maGiaoVien = giaovien.maGiaoVien 
                        where TRUE $this->str_search
                        ORDER BY giangday.taoNgay DESC Limit $from,$offset
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $giangday = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        $obj_select = $this->connection
            ->prepare("SELECT * FROM mon ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $mon = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        $obj_select = $this->connection
            ->prepare("SELECT * FROM giaovien ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $giaoVien = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        $obj_select = $this->connection
            ->prepare("SELECT giangday.*, mon.tenMon AS tenMon,giaovien.tenGiaoVien as tenGiaoVien FROM giangday
                        left JOIN mon ON giangday.maMon = mon.maMon 
                        left JOIN giaovien ON giangday.maGiaoVien = giaovien.maGiaoVien 
                        where TRUE $this->str_search ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $monCount = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        $rowCount=count($monCount);

        $pageRS->setItems($giangday);
        $pageRS->setItems2($mon);
        $pageRS->setItems3($giaoVien);

        $pageRS->setRowCount($rowCount);
        $pageRS->setPages();
        $pageRS->setPageCount();
        echo json_encode($pageRS);

    }
    public function update()
    {
        $obj_update = $this->connection
            ->prepare("UPDATE giangday SET thoiGian=:thoiGian,diaDiem=:diaDiem,soTiet=:soTiet,ghiChu=:ghiChu,suaNgay=:suaNgay where maMon=:maMon and maGiaoVien=:maGiaoVien");


        $arr_update = [
            ':maMon' => $this->maMon,
            ':maGiaoVien' => $this->maGiaoVien,
            ':thoiGian' => $this->thoiGian,
            ':diaDiem' => $this->diaDiem,
            ':soTiet'=>$this->soTiet,
            ':ghiChu'=>$this->ghiChu,
            ':suaNgay'=>$this->suaNgay
        ];
        return $obj_update->execute($arr_update);
    }
    public function insert()
    {

        $obj_insert = $this->connection
            ->prepare("INSERT INTO `giangday` (`maGiaoVien`, `maMon`, `thoiGian`, `diaDiem`, `soTiet`, `ghiChu`) VALUES (:maGiaoVien, :maMon, :thoiGian,:diaDiem, :soTiet ,:ghiChu);");


            $arr_insert = [
                ':maMon' => $this->maMon,
                ':maGiaoVien' => $this->maGiaoVien,
                ':thoiGian' => $this->thoiGian,
                ':diaDiem' => $this->diaDiem,
                ':soTiet'=>$this->soTiet,
                ':ghiChu'=>$this->ghiChu
            ];

        return $obj_insert->execute($arr_insert);
    }
    public function delete($maMon,$maGiaoVien)
    {

        $obj_delete = $this->connection
            ->prepare("DELETE FROM giangday WHERE maMon = $maMon and maGiaoVien=$maGiaoVien");
        return $obj_delete->execute();
    }


}