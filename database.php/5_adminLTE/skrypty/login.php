<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    //print_r($_POST);
    $errors=[];
    foreach($_POST as $key =>$value){
        //dodac tablice bledow, wyslac je do index i wyswietlic bledy
        if (empty($value)){
           // array_push($errors, "Pole $key jest wymagane");
           $errors[] = "pole <b>$key</b> jest wymagane";

        }//sprawdzamy czy wartosc jest pusta, jak jest pusta to wyskakuje blad
        //wyswietlamy w index
        //pole email jest wymagane 
        // pole pass jest wymagane
    } //$_SESSION["error"] = $errors;

    //print_r($errors);
    //echo $error_message;

    if(!empty($errors)){
        $error_message = implode("<br>", $errors);
        header("location: ../pages/index.php?error=".urlencode($error_message));
        exit();
    }

//     echo "email: ".$_POST["email"].", hasło: ".$_POST["pass"]."<br>";
    


//     echo htmlentities($_POST["email"]);
//     //$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
//    // echo $email;



require_once "./connect.php";
$stmt= $conn->prepare("SELECT * FROM users where email=?");
$stmt->bind_param("s", $_POST["email"]);
$stmt->execute();
$result= $stmt->get_result();
//echo $result-> num_rows;

$error =0;

if($result->num_rows != 0){
    $user = $result->fetch_assoc();
    //print_r($user);
    if(password_verify($_POST["pass"], $user["password"])){
        $_SESSION["logged"]["firstName"] = $user["firstName"];
        $_SESSION["logged"]["lastName"] = $user["lastName"];
       // $_SESSION["logged"]["role_id"] = $user["role_id"];

       print_r($_SESSION["logged"]);
       header("location: ../pages/logged.php");
       exit();
    }else{
        $error = 1;
    }
}else{
   $error = 1;
}

if($error !=0){
    $_SESSION["error"] = " Błędny login lub hasło";
    echo "<script>history.back();</script>";
    exit();
}

}else{
    header("location: ../pages");

}

?>