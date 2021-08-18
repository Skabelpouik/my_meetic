<?php
/**
 * 
 */
class MyDatabase
{
	private $bdd;
	private $localhost;
	private $dbname;
	private $dbuser;
	private $dbpassword;

	public function __construct($localhost, $dbname, $dbuser, $dbpassword)
	{
		$this->localhost = $localhost;
		$this->dbname = $dbname;
		$this->dbuser = $dbuser;
		$this->dbpassword = $dbpassword;
	}

	public function connect_to_db(){
		try
		{
    		$this->bdd = new PDO('mysql:host=localhost;dbname=my_meetic;charset=utf8', 'root', 'password');
		}
		catch(Exception $e)
		{
        	die('Erreur : '.$e->getMessage());
		}
	}

	public function add_user_to_db($firstname, $name, $birth, $gender, $city, $email, $password){
		$pass_hash = password_hash($password, PASSWORD_DEFAULT);
		$sql = 'INSERT INTO users(nom, prenom, date_naissance, genre, ville, email, password) 
		VALUES(:firstname, :name, :birth, :gender, :city, :email, :password)';
		$sth = $this->bdd->prepare($sql);
		$result = $sth->execute(array(':firstname' => $firstname,
							':name' => $name,
							':birth' => $birth,
							':gender' => $gender,
							':city' => $city,
							':email' => $email,
							':password' => $pass_hash
							));
		if ($result){
			echo "Success";
		}
		else{
			echo "Failed";
		}
	}

	public function do_user_exists($email, $password){
		/*$req = $this->$bdd->prepare('SELECT email, password FROM users WHERE email = :email');
		$req->execute(array(
    		'email' => $email));
		$resultat = $req->fetch();

		// Comparaison du pass envoyé via le formulaire avec la base
		$isPasswordCorrect = password_verify($password, $resultat['password']);
		if ($resultat && $isPasswordCorrect)
		{
    		echo 'Success';
		}
		else
		{
        	echo 'Failed';
		}*/
		$req = $this->bdd->prepare("SELECT email, password FROM users WHERE email = :email");
		$result = $req->execute(array(
			'email' => $email));
        $data = $req->fetch());
		if ($result)
		{
			if ($data['password'] == $password) {
            	echo 'Success';
           		return true;
        	}
        	else{
            	echo 'Failed';
            	return false;
        	}     
		}
		else{
			echo "Failed";
		}
                      
	}
}
?>