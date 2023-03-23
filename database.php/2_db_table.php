<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/table.css">
    <title>Użytkownicy</title>
</head>
<body>
    <h4>Użytkownicy</h4>
    <?php
    require_once "../skrypty/connect.php";
    $sql = "SELECT u.id, firstName, lastName, city, states, country, birthday FROM users u inner join cities c on c.id = u.city_id
    inner join states s on s.id = c.state_id
    inner join countries k on k.id = s.country_id";
    $result = $conn->query($sql);
    echo <<< USERSTABLE
    <table>
        <tr>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Data urodzenia</th>
            <th>Miasto</th>
            <th>Województwo</th>
            <th>Państwo</th>
           <th></th>
        </tr>
USERSTABLE;

/*if($result->num_rows < 0){
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
if(!$result || mysqli_num_rows($result)== 0){
    echo '<tr><td colspan="7">Brak wyników</td></tr>';
}else{
    while($user = $result->fetch_assoc()){
        echo <<< USERS
        <tr>
            <td>$user[firstName]</td>
            <td>$user[lastName]</td>
            <td>$user[birthday]</td>
            <td>$user[city]</td>
            <td>$user[states]</td>  
            <td>$user[country]</td>
            <td><a href="../skrypty/delete_user.php?deleteUserId=$user[id]">Usuń</a></td>
        </tr>
USERS;
    }
} 
    echo "</table>";
    if(isset($_GET["deleteUser"])){}
   /* if($_GET["deleteUser"] != 0){
        echo "<hr>Usunięto użytkownika o id= $_GET[deleteUser]";
    }else{
        echo "<hr>Nie usunięto użytkownika";
    }
*/

    ?>
   
</body>
</html>