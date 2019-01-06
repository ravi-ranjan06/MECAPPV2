<?php
session_start();

$allowedrole= "A,U,M,R";

require_once('util/class.session.php');
require_once('class/class.logout.php');

$session = new Session($allowedrole);

$logout = new Logout($session);
?>