<?php
// echo "<pre>";
// print_r($_POST);
// echo"</pre>";

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
	// email duplikat
	if($_POST["email1"] = $sql = "SELECT * FROM `users` WHERE email = $_POST[email1]"){
		$error =1;
		$_SESSION["error"] = "Adres email jest już używany";
	}

	// $sql = "SELECT * FROM `users` WHERE email = $_POST[email1]";
	// $conn->query($sql);
	
	// if( $conn->affected_rows ==1){
	// 	//echo "Prawidłowo dodano rekord";
	// 	$_SESSION["error"]="Prawidłowo dodano rekord";
	// }else{
	// 	//echo "Nie dodano rekordu";
	// 	$_SESSION["error"]="Nie dodano rekordu";
	// }


	// $sql= "SELECT id from users where email = $_POST[email1]";
	// $result = mysqli_query($sql);
	// if(mysqli_num_rows($result) >0){
	// 	$_SESSION["error"] = "Adres email jest już używany";
	// }


	if($_POST["email1"] = $_POST["email1"]){
		$error =1;
		$_SESSION["error"] = "Adres email jest już używany";
	}


	
	if($error != 0){
			echo "<script>history.back();</script>";
		exit();
	}



	

require_once "./connect.php";
	$stmt = $conn->prepare("INSERT INTO users (`email`, `city_id`, `firstName`, `lastName`, `birthday`, `password`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, current_timestamp());");

	$pass = password_hash('$_POST["pass1"]', algo: PASSWORD_ARGON2ID);

	$stmt->bind_param('sissss', $_POST["email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $pass);

    $stmt->execute();

	echo $stmt->affected_rows;



	//echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT);

	if($stmt->affected_rows == 1){
		$_SESSION["success"] = "Dodano użytkownika! $_POST[firstName] $_POST[lastName]";
		
	}else{
		$_SESSION["error"] = "Nie udało się dodać rekordu!";
	}

	header("location: ../pages/register.php");

?>


<!-- 1) regulamin nie zaznaczony
2) adresy email są różne
3) hasła są różne

dodać zmienną pomocniczą error(0), jak będzie błąd to 1
jeśli error !=0 to cofamy użytkownika i wyświetlamy komunikat(zmienna sesyjna) o błędzie nad formularzem -->