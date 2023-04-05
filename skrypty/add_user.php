<?php
session_start();
//print_r($_POST);
$error = 0;
foreach($_POST as $key => $value){
   // echo "$key: $value<br>";

if (empty($value)){
    //echo "$key<br>";
    echo "<script>history.back();</script>";
    $_SESSION["error"]="Wypełnij wszystkie pola w formularzu";
    exit();
    }
}
    if (!isset($_POST["term"])){
        $_SESSION["error"] = "Zatwierdź regulamin!";
       $error++;
    }

    if ($error !=0){
        echo "<script> history.back();</script>";
        exit();
    }


require_once "./connect.php";
$sql = "INSERT INTO `users` (`id`, `city_id`, `firstName`, `lastName`, `birthday`) VALUES (NULL, '$_POST[city_id]', '$_POST[firstName]', '$_POST[lastName]', '$_POST[birthday]');";
$conn->query($sql);


if( $conn->affected_rows ==1){
    //echo "Prawidłowo dodano rekord";
    $_SESSION["error"]="Prawidłowo dodano rekord";
}else{
    //echo "Nie dodano rekordu";
    $_SESSION["error"]="Nie dodano rekordu";
}

header("location: ../database.php/2_db_table.php");

?>