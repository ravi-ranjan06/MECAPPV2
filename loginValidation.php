<?php
session_start();
require_once('util/class.connection.php');

$conn 	= new Connection();

require_once(BASE_PATH.'util/class.common.php');
require_once(BASE_PATH.'class/class.login.php');

if(isset($_REQUEST['email']) && isset($_REQUEST['password']))
{
	$common 	= new Common();
	$login 		= new Login($conn);

	$userEmail 	= $common->cleanText($_REQUEST['email']);
	$password  	= $common->cleanText($_REQUEST['password']);

	$token 		= $conn->generateToken(25);

	$validate 	= $login->authenticate($userEmail,$password);

	if($validate >= 1)
	{
		$ip 					= $common->getClientip();
		$data 					= $conn->jd($login->getUserData($userEmail,$password));

		$user 					= $data['userName'];
		$userLoginId 			= $data['userLoginId'];
		$role 					= $data['role'];
		$email 					= $data['userEmail'];
		$loginTime 				= date('Y-m-d h:i:s');

		$_SESSION['role'] 		= $role;
		$_SESSION['email'] 		= $email;
		$_SESSION['username'] 	= $user;
		$_SESSION['userLoginId']= $userLoginId;
		$_SESSION['token'] 		= $token;
		$_SESSION['timestamp'] 	= time();
		$_SESSION['base_path'] 	= BASE_PATH;

		$login->updateUserToken($token,$userName,$userLoginId);

		$last_insert_id = $login->logHistory($userLoginId,$ip,$token,$loginTime);

		$_SESSION['login_history_id'] = $last_insert_id;

		if($role == 'A' || $role == 'U' || $role == 'R' || $role == 'M')
		{
			header("Location:".BASE_URL."app/dashboard");
		}
		else
		{
			$message = base64_encode('Unauthorised Access is prevented!');
			header("Location:login?message=$message");
		}
	}
	else
	{
		$message = base64_encode('Invalid Email or Password!');
		header("Location:".BASE_URL."login?message=$message");
	}
}
else
{
	$message = base64_encode('Invalid Email or Password!');
	header("Location:".BASE_URL."login?message=$message");
}
?>