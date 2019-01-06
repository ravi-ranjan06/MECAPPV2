<?php
require_once('class.connection.php');

class Session extends Connection
{
	private $allowedrole;
	private $userEmail;
	private $userRole;
	private $roleFlag;
	private $login_his_id;
	private $idletime;

	public function __construct($role)
	{
		parent::__construct();

		$this->allowedrole 	= $role;
		$this->userEmail    = $_SESSION['useremail'];
		$this->userRole 	= $_SESSION['role'];
		$this->roleFlag 	= '0';
		$this->login_his_id = $_SESSION['login_history_id'];
	}
}
?>