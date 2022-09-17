<?php
session_start();
$login = false;
$showError = false;
include '_dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];


    // $sql = "Select * from users where username='$username'";
    $sql = "SELECT * FROM users WHERE  user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num) {
        $user_pass = mysqli_fetch_assoc($result);
        $login = true;
        // session_start();
        $_SESSION['loggedin'] == true;
        // $_SESSION['sno'] = $row['sno'];
        $_SESSION['user_email'] = $email;
       
        $user_pass = 'user_pass';
        if($user_pass){
            
         $showAlert = true;
        // echo"<p>hjyuy</p>";
        header("Location: /index.php?loggedin=true");
        echo "logged in". $email;
        }
    } 
    else{
        header("location: /index.php?loggedin=false");
        $showError = 'password\email do not match';
    }
    
    
}


?>
