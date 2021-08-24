<?php
require_once 'models/Model.php';
require_once 'models/Pagination.php';
class Mon extends Model
{
   public $maMon;
    public $tenMon;
public $moTa;
public $taoNgay;
public $suaNgay;
public $maBoMon;
public $soTiet;

    public $str_search = '';
    public function getAll($pageNumber,$numberPerPage,$maBoMon,$tenMon)
    {
        if(!empty($maBoMon))
        {
            $this->str_search .= " AND bomon.maBoMon =$maBoMon";
        }
        if (!empty($tenMon))
        {
            $tenMon=mb_strtoupper($tenMon);

            $this->str_search .= " AND upper(mon.tenMon) like '%$tenMon%'";
        }
        $pageRS = new Pagination();
        if ($pageNumber!=null)
            $pageRS->setPageNumber($pageNumber);
        if ($numberPerPage!=null)
            $pageRS->setNumberPerPage($numberPerPage);
        $from = ($pageRS->getPageNumber() - 1) * $pageRS->getNumberPerPage();
        $offset=$pageRS->getNumberPerPage();
          $obj_select = $this->connection
              ->prepare("SELECT mon.*, bomon.tenBoMon AS tenBoMon FROM mon
                        INNER JOIN bomon ON mon.maBoMon = bomon.maBoMon 
                        where TRUE $this->str_search
                        ORDER BY mon.taoNgay DESC Limit $from,$offset
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
            ->prepare("SELECT mon.*, bomon.tenBoMon AS tenBoMon FROM mon
                        INNER JOIN bomon ON mon.maBoMon = bomon.maBoMon 
                        where TRUE $this->str_search ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $monCount = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        $rowCount=count($monCount);

        $pageRS->setItems($mon);
        $pageRS->setItems2($bomon);

        $pageRS->setRowCount($rowCount);
        $pageRS->setPages();
        $pageRS->setPageCount();
        echo json_encode($pageRS);

    }
    public function update()
    {
        $obj_update = $this->connection
            ->prepare("UPDATE mon SET maBoMon=:maBoMon,tenMon=:tenMon, moTa=:moTa, sotiet=:sotiet,suaNgay=:suaNgay
                                where maMon=:maMon");
        $arr_update = [
            ':maBoMon' => $this->maBoMon,
            ':tenMon' => $this->tenMon,
            ':moTa' => $this->moTa,
            ':sotiet' => $this->soTiet,
            'maMon'=>$this->maMon,
            'suaNgay'=>$this->suaNgay

        ];
        return $obj_update->execute($arr_update);
    }
    public function delete($maMon)
    {
        $obj_delete = $this->connection
            ->prepare("DELETE FROM mon WHERE maMon = $maMon");
        return $obj_delete->execute();
    }
    public function getExel()
    {


        $obj_select = $this->connection
            ->prepare("SELECT mon.*, bomon.tenBoMon AS tenBoMon FROM mon
                        INNER JOIN bomon ON mon.maBoMon = bomon.maBoMon 
                        ORDER BY mon.taoNgay DESC
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $mon = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $mon;

    }
}