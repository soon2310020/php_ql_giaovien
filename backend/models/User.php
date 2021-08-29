<?php
require_once 'models/Model.php';
class User extends Model {

    private $cn;
    public $str_search = '';

		function __construct(){
			$this->cn = new Model();
		}

    public function getUserByUsernameAndPassword($username, $password) {

        $sql = "SELECT * FROM user WHERE tenUser LIKE '$username' AND matKhau LIKE '$password' LIMIT 1";

        return $this->cn->Fetch($sql); 
    }
    public function getUserByUsername($username) {

        $sql = "SELECT * FROM user WHERE tenUser LIKE '$username' LIMIT 1";

        return $this->cn->Fetch($sql); 
    }

    public function insertRegister($username, $password) {

        $now = date("Y-m-d H:i:s");

        $sql = "INSERT INTO user(`tenUser`,`matKhau`,`taoNgay`) VALUES('$username', '$password', '$now')";
        //return $sql;
        return $this->cn->ExecuteQuery($sql);
    }

}