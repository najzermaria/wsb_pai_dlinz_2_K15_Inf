<?php
echo "<pre>";
print_r($_POST);
echo"</pre>";

session_start();


	foreach($_POST as $key => $value){
	
		if (empty($value)){
			$_SESSION["error"] = "Wypełnij wszystkie pola!";
			echo $_SESSION["error"];
			echo "<script>history.back();</script>";
			exit();
		}
	}

	$error = 0;
	
	//regulamin
	if (!isset($_POST["terms"])){
		$error = 1;
		$_SESSION["error"] = "Zatwierdź regulamin!";
	}
	if (!isset($_POST["gender"])){
		$error = 1;
		$_SESSION["error"] = "Zaznacz płeć!";
	}
	// hasło
	if($_POST["pass1"] != $_POST["pass2"]){
		$error =1;
		$_SESSION["error"] = "Hasła są różne";
	}
	// email
	if($_POST["email1"] != $_POST["email2"]){
		$error =1;
		$_SESSION["error"] = "Adresy email są różne";
	}


	// $sql= "SELECT id from users where email = $_POST[email1]";
	// $result = mysqli_query($sql);
	// if(mysqli_num_rows($result) >0){
	// 	$_SESSION["error"] = "Adres email jest już używany";
	// }


	// if($_POST["email1"] = $_POST["email1"]){
	// 	$error =1;
	// 	$_SESSION["error"] = "Adres email jest już używany";
	// }


	
	if($error != 0){
			echo "<script>history.back();</script>";
		exit();
	}


//duplikowanie maila
	require_once "./connect.php";
	$sql="SELECT * from users where email=?";
	$stmt= $conn->prepare($sql);
	$stmt->bind_param('s', $_POST["email1"]);
	$stmt->execute();
	$result=$stmt->get_result();
	

	if( $result->num_rows !=0){
		$_SESSION["error"] = "Adres email $_POST[email1] jest już używany";
		echo "<script>history.back();</script>";
		exit();
	}
	


//hasowanie hasla
require_once "./connect.php";
	$stmt = $conn->prepare("INSERT INTO users (`email`, `city_id`, `firstName`, `lastName`, `birthday`, `gender`, `awatar`,  `password`, `created_at`) VALUES (?, ?, ?, ?, ?, ?,?, ?, current_timestamp());");

	$pass = password_hash('$_POST["pass1"]', algo: PASSWORD_ARGON2ID);

	$awatar = ($_POST["gender"] == 'm') ? '/jpg/man.png' : './jpg/woman.png';

	// if($_POST["gender"]== "w"){
	// 	$awatar='women.jpg';
	// }else{
	// 	$awatar='men.jpg';
	// }

	$stmt->bind_param('sissssss', $_POST["email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $_POST["gender"], $awatar, $pass);



    $stmt->execute();

	echo $stmt->affected_rows;


	if($stmt->affected_rows == 1){
		$_SESSION["success"] = "Dodano użytkownika! $_POST[firstName] $_POST[lastName]";
		
	}else{
		$_SESSION["error"] = "Nie udało się dodać rekordu!";
	}

	//header("location: ../pages/register.php");

?>



<!-- dodać zmienną pomocniczą error(0), jak będzie błąd to 1
jeśli error !=0 to cofamy użytkownika i wyświetlamy komunikat(zmienna sesyjna) o błędzie nad formularzem --> 