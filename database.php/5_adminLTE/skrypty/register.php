<?php

function sanitizeInput(&$input){
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlentities($input);
	return $input;
}
//$_POST["firstName"]= sanitizeInput($_POST["firstName"]);
echo $_POST["firstName"]." ==> ".sanitizeInput($_POST["firstName"]).", ilość znaków:".strlen($_POST["firstName"]);

exit();

if($_SERVER["REQUEST_METHOD"] == "POST"){
/*echo "<pre>";
print_r($_POST);
echo"</pre>";*/


$required_fields=["firstName", "lastName", "email1", "email2", "pass1", "pass2", "birthday", "city_id", "gender"];

// foreach($required_fields as $key => $value){
// 	echo "$key: $value<br>";
// }
// exit();



	session_start();


	// foreach($_POST as $key => $value){
	// if (empty($value)){
	// 		$_SESSION["error"] = "Wypełnij wszystkie pola!";
	// 		echo $_SESSION["error"];
	// 		echo "<script>history.back();</script>";
	// 		exit();
	// 	}
	// }

	$errors= [];
	foreach($required_fields as $value){
		if (empty($_POST[$value])){
				$errors[] = "Pole <b> $value</b> jest wymagane!";
			}
		}
	if(!empty($errors)){
			$_SESSION["error"] = implode("<br>", $errors);
			//echo "<script>history.back();</script>";
		}


	// 	foreach($required_fields as $value){
	// if (empty($_POST[$value])){
	// 		$_SESSION["error"] = "Wypełnij wszystkie pola!";
	// 		echo $_SESSION["error"];
	// 		echo "<script>history.back();</script>";
	// 		exit();
	// 	}
	// }

	//$error = 0;
	
	
	// email
	if($_POST["email1"] != $_POST["email2"]){
		$errors[]  = "Adresy email są różne";
	}
	//dodatkowy email
	if($_POST["additional_email1"] != $_POST["additional_email2"]){
		$errors[] = "Doadatkowe adresy email są różne";
	}else{
		if(empty($_POST["additional_email1"])){
			$_POST["additional_email1"] = NULL;
		}
	}
	// hasło
	if($_POST["pass1"] != $_POST["pass2"]){
		$errors[]  = "Hasła są różne";
	}else{
		//walidacja hasła
		if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s])\S{8,}$/', $_POST["pass1"])) {
			$errors[]  = "Hasło nie spełnia wymagań!";
			// echo $_SESSION["error"];
		}
	}
	//plec
	if (!isset($_POST["gender"])){
		$errors[]  = "Zaznacz płeć!";
	}
	//regulamin
	if (!isset($_POST["terms"])){
		$errors[] = "Zatwierdź regulamin!";
	}
	// echo "x:";
	// print_r($errors);
	//exit();

	// $sql= "SELECT id from users where email = $_POST[email1]";
	// $result = mysqli_query($sql);
	// if(mysqli_num_rows($result) >0){
	// 	$_SESSION["error"] = "Adres email jest już używany";
	// }


	// if($_POST["email1"] = $_POST["email1"]){
	// 	$error =1;
	// 	$_SESSION["error"] = "Adres email jest już używany";
	// }

//walidacja hasła
// if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s])\S{8,}$/', $_POST["pass"])) {
// $error = 1;
// $_SESSION["error"] = "Hasło nie spełnia wymagań!";
//}
	
	
	
	if(!empty($errors)){
		$_SESSION["error"] = implode ("<br>", $errors);
		//print_r($_SESSION["error"]);
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
	
	foreach($_POST as $key => $value){
		if (!$_POST["pass1"] && !$_POST["pass2"]){
			sanitizeInput($_POST["$key"]);
		}
	}


//hasowanie hasla
require_once "./connect.php";
	$stmt = $conn->prepare("INSERT INTO users (`email`, `additional_email`, `city_id`, `firstName`, `lastName`, `birthday`, `gender`, `awatar`,  `password`, `created_at`) VALUES (?,?, ?, ?, ?, ?, ?,?, ?, current_timestamp());");

	$pass = password_hash('$_POST["pass1"]', algo: PASSWORD_ARGON2ID);

	$awatar = ($_POST["gender"] == 'm') ? '/jpg/man.png' : './jpg/woman.png';

	// if($_POST["gender"]== "w"){
	// 	$awatar='women.jpg';
	// }else{
	// 	$awatar='men.jpg';
	// }

	$stmt->bind_param('ssissssss', $_POST["email1"], $_POST["additional_email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $_POST["gender"], $awatar, $pass);



    $stmt->execute();

	echo $stmt->affected_rows;


	if($stmt->affected_rows == 1){
		$_SESSION["success"] = "Dodano użytkownika! $_POST[firstName] $_POST[lastName]";
		
	}else{
		$_SESSION["error"] = "Nie udało się dodać rekordu!";
	}

}



	header("location: ../pages/register.php");

?>



<!-- dodać zmienną pomocniczą error(0), jak będzie błąd to 1
jeśli error !=0 to cofamy użytkownika i wyświetlamy komunikat(zmienna sesyjna) o błędzie nad formularzem --> 