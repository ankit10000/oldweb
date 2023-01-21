<?php 
session_start();
include "_dbconnect.php";

$sno = $_GET['sno'];
$status = $_GET['status'];
$sql2 = "UPDATE users SET status=$status where sno=$sno";
mysqli_query($conn, $sql2);
session_unset();
session_destroy();
header("location:/web/index.php?deactivateaccount");
?>