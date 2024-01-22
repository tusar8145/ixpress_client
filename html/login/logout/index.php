<?php
session_start();
require_once '../class.user.php';
echo $user = new USER();

if(!$user->is_logged_in())
{
	$user->redirect('../index');
}

if($user->is_logged_in()!="")
{
	$user->logout();	echo 1;
	$user->redirect('http://128.199.207.109/login');
}
?>