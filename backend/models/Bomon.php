<?php
require_once 'models/Model.php';
class Bomon extends Model
{
    private $cn;
    public $str_search = '';

		function __construct(){
			$this->cn = new Model();
		}

    public function getAll()
    {
        $sql = "SELECT bomon.*, khoa.tenKhoa AS tenKhoa FROM bomon
        INNER JOIN khoa ON bomon.maKhoa = khoa.maKhoa";

        return $this->cn->FetchAll($sql); 
    }
    public function ThemBoMon($maBoMon, $tenBoMon, $maKhoa, $moTa)
	  {
        $now = date("Y-m-d H:i:s");
        $sql = "INSERT INTO bomon VALUES($maBoMon, '$tenBoMon', '$moTa', $maKhoa, '$now', '$now')";

        return $this->cn->ExecuteQuery($sql);
	  }
    public function SuaBoMon($maBoMon, $tenBoMon, $maKhoa, $moTa)
	  {
        $now = date("Y-m-d H:i:s");
        $sql = "UPDATE bomon SET tenBoMon = '$tenBoMon',moTa = '$moTa',maKhoa = $maKhoa, suaNgay='$now' WHERE maBoMon = $maBoMon";

        //return $sql;
			  return $this->cn->ExecuteQuery($sql);
	  }
    public function TimKiem($maBoMon, $tenBoMon)
    {
        $maBoMon = trim($maBoMon) == ''? '" "' : $maBoMon;

        $timten = trim($tenBoMon) == ''? '' : "OR tenBoMon like '%$tenBoMon%'";

        $sql = "SELECT bomon.*, khoa.tenKhoa AS tenKhoa FROM bomon
        INNER JOIN khoa ON bomon.maKhoa = khoa.maKhoa WHERE maBoMon = $maBoMon $timten";
        
        return $this->cn->FetchAll($sql); 
    }
    function XoaBoMon($ma)
		{
			  $sql = "DELETE FROM bomon WHERE maBoMon = $ma";

			  return $this->cn->ExecuteQuery($sql);
		}

}