<?php
//echo "delete user";

require_once "./connect.php";
$sql = "DELETE FROM users WHERE `users`.`id` = $_GET[deleteUserId]";
$conn->query($sql);
//echo $conn->affected_rows;
if ($conn->affected_rows != 0) {
    //echo "Usunięto rekord";
    $deleteUser =  $_GET["deleteUserId"];
}else{
    //echo "Nie usunięto rekordu";
    //$deleteUserId = "Nie usunięto o id = $GET_[deleteUserId]";
    $deleteUser = 0;
}

header("location: ../database.php/2_db_table.php?deleteUser=$deleteUser");
?>
<script>
    //history.back();
</script>

