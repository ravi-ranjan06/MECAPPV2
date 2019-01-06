<?php
class Logout
{
	private $login_his_id;
	private $instance;

	public function __construct(Session $con)
	{
		$this->instance = $con;
		$this->login_his_id = $_SESSION['login_history_id'];
	}

	public function __destruct()
	{
		$query = "UPDATE `me_login_history` SET `logoutTime` = NOW() WHERE login_his_Id = '".$this->login_his_id."' LIMIT 1";

		$this->instance->execute($query);
		
		session_unset();
		session_destroy();
		mysqli_close($this->instance);
		header("Location:".BASE_URL."index");
		exit();
	}	
}
?>