<?php
	include('bdd.php');

	$obj = new MyDatabase("localhost", "my_meetic", "root", "password");
	$obj->connect_to_db();
	$data = $obj->add_user_to_db($_POST['nom'], $_POST['prenom'], $_POST['naissance'], $_POST['genre'], $_POST['ville'], $_POST['email'], $_POST['password']);
?>