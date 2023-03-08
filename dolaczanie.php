<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dołącanie pliku</title>
</head>
<body>
    <h4>Początek strony</h4>
    <?php
   //inlude, include_once, require, require_once
        include "./skrypty/lista.php";
        include_once "./skrypty/lista.php"; //jak się wstawi @ to nie wyswietlaja się błędy
        require "./skrypty/lista.php";
        require_once "./skrypty/lista.php";
 

    ?>
    <h4>Koniec strony</h4>
</body>
</html>