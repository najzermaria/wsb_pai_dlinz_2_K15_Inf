<?php
$pass= "tajne";
$hashPass = password_hash($pass, PASSWORD_ARGON2ID);


echo $hashPass;


$passUser = "tajne";
if(password_verify($passUser, $hashPass)){
    echo "ok";

}else{
    echo "error";
}