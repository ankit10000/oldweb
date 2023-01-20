<?php
$login = false;
$showError = false;
include '_dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];


    // $sql = "Select * from users where username='$username'";
    $sql = "Select * from users where  user_email='$email' And user_pass='$pass'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        $pass = mysqli_fetch_assoc($result);
        if ($pass['status'] == 1) {
            $login = true;
            
            if($pass){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['sno'] = $pass['sno'];
                $_SESSION['user_name'] = $pass['user_name'];
                $_SESSION['user_mob'] = $pass['user_mob'];
                $_SESSION['user_pass'] = $pass['user_pass'];
                $_SESSION['user_email'] = $email;
                $showAlert = true;
                header("Location: /web/index.php?loggedin=true");
                echo "logged in". $email; 
            }
        }else{
            header("location:/web/index.php");
        }
    } 
    else{
        header("location: /web/index.php?loggedin=false");
        $showError = true;
    }
    
    
}


?>
