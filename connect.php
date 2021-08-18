<?php
	include('bdd.php');

	$obj = new MyDatabase("localhost", "my_meetic", "root", "password");
	$obj->connect_to_db();
	$data = $obj->do_user_exists($_POST['email'], $_POST['password']);
?>