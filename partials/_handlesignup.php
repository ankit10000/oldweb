<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include './_dbconnect.php';
    $user_name = $_POST['username'];
    $user_email = $_POST['email'];
    $mobile = $_POST['signupMobile'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];
    $status = $_POST['status'];

    // Check whether this email exists
    $existSql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showError = "Email already in use";
    }
    else{
        if($pass == $cpass){
            // $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_name`,`user_email`, `user_mob`, `user_pass`, `timestamp`,`status`) VALUES ('$user_name', '$user_email', '$mobile', '$pass', current_timestamp(),$status)";
            $result = mysqli_query($conn, $sql);
            
            if($result){
                $showAlert = true;
                header("Location: /web/index.php?signupsuccess=true");
                exit();
            }

        }
        else{
            $showError = "Passwords do not match"; 
            
        }
    }
    header("Location: /web/index.php?signupsuccess=false&error=$showError");

}
?>