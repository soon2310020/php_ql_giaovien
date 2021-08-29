<?php
require_once 'models/Model.php';
class Giaovien extends Model
{
    private $cn;
    public $str_search = '';

		function __construct(){
			$this->cn = new Model();
		}

    public function getAll()
    {
        $sql = "SELECT giaovien.*, BoMon.tenBoMon AS tenBoMon, User.tenUser as tenUser FROM giaovien
        LEFT JOIN BoMon ON GiaoVien.maBoMon = BoMon.maBoMon
        LEFT JOIN User ON GiaoVien.maUser = User.maUser";

        return $this->cn->FetchAll($sql); 
    }
    public function ThemGiaoVien($maGiaoVien, $tenGiaoVien, $maBoMon, $vaiTro, $maUser='null')
	  {
        $now = date("Y-m-d H:i:s");
        $sql = "INSERT INTO giaovien VALUES($maGiaoVien, '$tenGiaoVien', $maBoMon, '$now', '$vaiTro',$maUser)";
        //return $sql;
        return $this->cn->ExecuteQuery($sql);
	  }

    public function SuaGiaoVien($maGiaoVien, $tenGiaoVien, $maBoMon, $vaiTro)
	  {
        //$now = date("Y-m-d H:i:s");
        $sql = "UPDATE giaovien SET tenGiaoVien = '$tenGiaoVien',vaiTro = '$vaiTro',maBoMon = $maBoMon WHERE maGiaoVien = $maGiaoVien";

        //return $sql;
			  return $this->cn->ExecuteQuery($sql);
	  }
    
    public function TimKiem($maGiaoVien, $tenGiaoVien)
    {
        $maGiaoVien = trim($maGiaoVien) == ''? '" "' : $maGiaoVien;

        $timten = trim($tenGiaoVien) == ''? '' : "OR tenGiaoVien like '%$tenGiaoVien%'";

        $sql = "SELECT giaovien.*, BoMon.tenBoMon AS tenBoMon,User.tenUser as tenUser FROM GiaoVien
        LEFT JOIN BoMon ON GiaoVien.maBoMon = BoMon.maBoMon LEFT JOIN User ON GiaoVien.maUser = User.maUser WHERE maGiaoVien = $maGiaoVien $timten";
        
        return $this->cn->FetchAll($sql); 
    }
    function XoaGiaoVien($ma)
		{
			  $sql = "DELETE FROM giaovien WHERE maGiaoVien = $ma";

			  return $this->cn->ExecuteQuery($sql);
		}

}