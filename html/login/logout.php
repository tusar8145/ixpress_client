<?php
session_start();
require_once 'class.user.php';
$user = new USER();

if(!$user->is_logged_in())
{
	$user->redirect('index');
}

if($user->is_logged_in()!="")
{
	$user->logout();	
	$user->redirect('http://128.199.207.109/login');
	//header("Location: http://128.199.207.109/login");
die();
}
?>