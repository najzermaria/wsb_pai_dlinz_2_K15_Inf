<?php
//echo "delete user";

require_once "./connect.php";

$sql = "DELETE FROM cities WHERE `city`.`id` = $_GET[deleteCityId]";
try{
$conn->query($sql);

$deleteCity = 0;
if ($conn->affected_rows != 0) {
    //echo "Usunięto rekord";
    $deleteCity =  $_GET["deleteCityId"];
}else {
    //echo "Nie usunięto rekordu";
    //$deleteUserId = "Nie usunięto o id = $GET_[deleteUserId]";
    $deleteCity = 0;
        }
     } catch (Exception $e) {}
header("location: ../database.php/test.php?deleteCity=$deleteCity");
?>
<script>
    //history.back();
</script>

