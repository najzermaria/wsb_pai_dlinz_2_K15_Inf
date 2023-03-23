<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/table.css">
    <title>MIASTA</title>
</head>
<body>
    <h4>MIASTA</h4>
    <?php
    require_once "../skrypty/connect.php";
    $sql = "SELECT * FROM cities";
    $result = $conn->query($sql);
    echo <<< USERSTABLE
    <table>
        <tr>
            <th>Miasto</th>
        </tr>
USERSTABLE;

/*if($result->num_rows > 0){
    while($user = $result->fetch_assoc()){
    echo <<< USERSTABLE
        <tr>
            <td>$user[firstName]</td>
            <td>$user[lastName]</td>
            <td>$user[birthday]</td>
            <td>$user[city]</td>
            <td>$user[states]</td>  
            <td>$user[country]</td>
            <td><a href="../skrypty/delete_user.php?deleteUserId=$user[id]">Usuń</a></td>
        </tr>;
        USERSTABLE;
    }
}else{
    '<tr>
        <td>colspan="6">Brak wyników do wyświetlenia</td>
    </tr>';
}*/
//if(isset($_GET["deleteCity"])){}
    if(!$result || mysqli_num_rows($result)== 0){
    echo '<tr><td colspan="7">Brak wyników</td></tr>';
    }else{
    while($cities = $result->fetch_assoc()){
        echo <<< USERS
        <tr>
            <td>$cities[city]</td>
            <td><a href="../skrypty/delete_city.php?deleteCityId=$cities[id]">Usuń</a></td>
        </tr>
    USERS;
        }
    }
    echo "</table>";
    if(isset($_GET["deleteCity"])){
    if($_GET["deleteCity"] != 0){
        echo "<hr>Usunięto miasto o id= $_GET[deleteCity]";
    }else{
        echo "<hr>Nie usunięto miasta";
    }
    }
    ?>
   

</body>
</html>
