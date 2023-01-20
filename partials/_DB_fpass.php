<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include './_dbconnect.php';
    $reset_Email = $_POST['resetEmail'];

    // Check whether this email exists
    $existSql = "SELECT * FROM `users` WHERE user_email = '$reset_Email' OR user_mob = '$reset_Email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        echo $reset_Email;
    }else{
        $showError = "wrong email or mobile";
        header("Location: /web/partials/_forggetPass.php");
    }

}
?>