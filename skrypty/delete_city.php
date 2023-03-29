<?php

require_once "./connect.php";

$sql = "DELETE FROM cities WHERE `cities`.`id` = $_GET[deleteCity]";
echo $sql;
try{
$conn->query($sql);

$deleteCity = 0;
if ($conn->affected_rows != 0) {
    //echo "Usunięto rekord";
    $deleteCity =  $_GET["deleteCity"];
    echo $deleteCity;
}else {
    //echo "Nie usunięto rekordu";
    //$deleteUserId = "Nie usunięto o id = $GET_[deleteUserId]";
    echo "test";
    $deleteCity = 0;
        }
     } catch (Exception $e) {
        $deleteCity = 0;
     }
header("location: ../database.php/test.php?deleteCity=$deleteCity");
?>
<script>
    //history.back();
</script>

