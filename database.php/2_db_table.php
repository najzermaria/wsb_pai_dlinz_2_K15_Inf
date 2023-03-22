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
    $sql = "SELECT * FROM users u inner join cities c on c.id = u.city_id
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
           
        </tr>
USERSTABLE;
    while($user = $result->fetch_assoc()){
        echo <<< USERS
        <tr>
            <td>$user[firstName]</td>
            <td>$user[lastName]</td>
            <td>$user[birthday]</td>
            <td>$user[city]</td>
            <td>$user[states]</td>   
            <td>$user[country]</td>
            
        </tr>
USERS;
    }
    ?>
    </table>

</body>
</html>