<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="'UTF-8">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <meta name="viewport" content="width= 
        , initial-scale=1.0">
        <title> Document</title>
    </head>
    <body>
        <h4>Lista</h4>
        <ul>
            <li>wielkopolska</li>
            <ol>
                <li>Poznań</li>
                <li>Gniezno</li>
                <li>Września</li>
            </ol>

            <li>śląskie</li>
            <?php
                $city = "Wrocław";
                echo "<ol>";
                    echo "<li>Legnica</li>";
                    echo "<li>$city</li>";
            //echo "</ol>";
            ?>
             <li>Bolesławiec</li>
             </ol>
            <li>kujawsko-pomorskie</li>
    <ul>
</body>
</html>