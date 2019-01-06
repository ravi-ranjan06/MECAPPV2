<?php
trait UserTrait
{
	public function getUserData($userEmail,$password)
	{
		$password = $this->getPassword($password);

		$query 	= "SELECT * FROM `me_user` WHERE `userEmail` = '$userEmail' AND `userPassword` = '$password' AND `status` = '1'";

		$result = $this->instance->getSingleRow($query);

		return $result;
	}

	private function getPassword($password)
	{
		return hash('sha256',$password);
	}

	public function getData($column_name = '*')
	{ 
		$password = $this->getPassword($_SESSION['password']);

		$query = "SELECT $column_name FROM `me_user` WHERE `userName` = '".$_SESSION['username']."' AND `userPassword` = '$password' AND `status` = '1' LIMIT 1";

		$result = $this->instance->jd($this->instance->getSingleRow($query));

		return $result;
	}
}
?>