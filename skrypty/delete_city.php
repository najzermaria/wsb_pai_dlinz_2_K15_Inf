<?php
//echo "delete user";

require_once "./connect.php";
$sql = "DELETE FROM cities WHERE `city`.`id` = $_GET[deleteCityId]";
//$sql = "DELETE city FROM cities";
$conn->query($sql);
//if(isset($_GET["deleteCityId"])){}
//echo $conn->affected_rows;
$deleteCity =0;
if ($conn->affected_rows != 0) {
    //echo "Usunięto rekord";
    $deleteCity =  $_GET["deleteCityId"];
}else {
    //echo "Nie usunięto rekordu";
    //$deleteUserId = "Nie usunięto o id = $GET_[deleteUserId]";
    $deleteCity = 0;
}
//return $_GET[deleteUserId];
header("location: ../database.php/test.php?deleteCity=$deleteCity");
?>
<script>
    //history.back();
</script>
