<?php
require_once 'configs/Database.php';
class Model {
  public $connection;
  private $link;//bien ket noi csdl

  public function __construct() {
    $this->connection = $this->getConnection();
    $this->link=mysqli_connect("localhost",Database::DB_USERNAME,Database::DB_PASSWORD,Database::DB_NAME);
  }

  public function getConnection() {
    try {
      $connection = new PDO(Database::DB_DSN, Database::DB_USERNAME, Database::DB_PASSWORD);
    } catch (PDOException $e) {
      die("Kết nối CSDL theo PDO thất bại: " . $e->getMessage());
    }

    return $connection;
  }

  public function closeConnection() {
    $this->connection = null;
  }
  function ExecuteQuery($sql)
	{
		mysqli_query($this->link,"set names 'utf8'");
		return mysqli_query($this->link, $sql);
	}
	function ExecuteQueryInsert($sql)
	{
		$result=$this->ExecuteQuery($sql);
		if($result > 0)
		{
			return mysqli_insert_id($this->link);// tra ve id vua moi insert
		}
		else
			return 0;
	}
	
	function Fetch($sql)
	{
		$result=$this->ExecuteQuery($sql);
		return mysqli_fetch_assoc($result);
	}
	function NumRows($sql)
	{
		$result=$this->ExecuteQuery($sql);
		return mysqli_num_rows($result);
	}
	function FetchAll($sql)
	{
		$result=$this->ExecuteQuery($sql);
		$arr=array();
		while($row=mysqli_fetch_assoc($result))
		{
			$arr[]=$row;
		}
		mysqli_free_result($result);
		return $arr;
	}
}