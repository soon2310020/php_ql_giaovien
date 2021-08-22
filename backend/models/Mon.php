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

    public $str_search = '';
    public function getAll($pageNumber,$numberPerPage)
    {

          $obj_select = $this->connection
              ->prepare("SELECT mon.*, bomon.tenBoMon AS tenBoMon FROM mon
                        INNER JOIN bomon ON mon.maBoMon = bomon.maBoMon
                        ORDER BY mon.taoNgay DESC
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $mon = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($mon);

    }

}