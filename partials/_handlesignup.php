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
    $existSql = "SELECT * FROM `users`";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);

    while ($row = mysqli_fetch_assoc($result)) {
        if ($_POST['username'] == $row['user_name']) {
            header("Location: /web/index.php?signupsuccess_false_user_name_alerady_in_use");
        }
        else if ($_POST['email'] == $row['user_email']) {
            header("Location: /web/index.php?signupsuccess_false_user_email_alerady_in_use");
        }
        else if ($_POST['signupMobile'] == $row['user_mob']) {
            header("Location: /web/index.php?signupsuccess_false_user_mob_alerady_in_use");
        }
        else if ($pass != $cpass) {
            $showError = "passwordnotmatched";
            header("Location: /web/index.php?signupsuccess_false_password_not_matched_alerady_in_use");
        }

    }
    $sql = "INSERT INTO `users` (`user_name`,`user_email`, `user_mob`, `user_pass`, `timestamp`,`status`) VALUES ('$user_name', '$user_email', '$mobile', '$pass', current_timestamp(),$status)";
    $result1 = mysqli_query($conn, $sql);

    if ($result1) {
        $showAlert = true;
        header("Location: /web/index.php?signupsuccess=true");
        exit();
    } else {
        echo "";
    }
}
?>