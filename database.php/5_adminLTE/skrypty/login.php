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

    
    //echo $error_message;
    if(!empty($errors)){
        $error_message = implode("<br>", $errors);
        header("location: ../pages/index.php?error=".urlencode($error_message));
        exit();
    }

    echo "email: ".$_POST["email"].", hasło: ".$_POST["pass"]."<br>";


    echo htmlentities($_POST["email"]);
    //$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
   // echo $email;


}else{
    header("location: ../pages");
}
//header("location: ../pages");
?>