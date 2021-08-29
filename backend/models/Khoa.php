<?php
require_once 'models/Model.php';
class Khoa extends Model
{

    public $str_search = '';

    function __construct(){
			$this->cn = new Model();
		}

    public function getAll()
    {
        $sql = "SELECT * FROM khoa";

        return $this->cn->FetchAll($sql); 
        // $obj_select = $this->connection
        // ->prepare("SELECT * FROM khoa");

        // $arr_select = [];

        // $obj_select->execute($arr_select);

        // $mon = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        // return $mon;
    }
    public function ThemKhoa($maMon, $tenMon, $maBoMon, $moTa)
	{
		$sql = "INSERT INTO mon(maMon, tenMon, moTa, maBoMon) VALUES($maMon, $tenMon, $moTa, $maBoMon)";

		return $this->cn->ExecuteQueryInsert($sql);
	}

}