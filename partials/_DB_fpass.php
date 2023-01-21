<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  
require_once 'vendor/autoload.php';
  
$mail = new PHPMailer(true);
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include './_dbconnect.php';
    $reset_Email = $_POST['resetEmail'];

    // Check whether this email exists
    $existSql = "SELECT * FROM `users` WHERE user_email = '$reset_Email' OR user_mob = '$reset_Email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    $pass = mysqli_fetch_assoc($result);
    $sno = $pass['sno'];
    if($numRows>0){
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';    //mailtrap SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'f5558a6375be83';   //username
            $mail->Password = '9b8fe42353b555';   //password
            $mail->Port = 465;                   //smtp port

            $mail->setFrom('noreply@artisansweb.net', 'Artisans Web');
            $mail->addAddress($reset_Email, 'Sajid');

            $mail->isHTML(true);

            $mail->Subject = 'OTP for reset password';
            $otpsend = rand(1000, 9999);
            $existSql1 = "INSERT INTO `sendingotp` (`otp_otp`,`otp_time`) VALUES ('$otpsend', current_timestamp())";
            $result1 = mysqli_query($conn, $existSql1);
            // $sql5= "DELETE FROM sendingotp WHERE otp_time >(NOW()- INTERVAL 10 SECOND)";
            // $result2 = mysqli_query($conn, $sql5);
            $sql = "SELECT * FROM `sendingotp` WHERE otp_time=current_timestamp()";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $otp = $row['otp_otp'];
            $mail->Body    = 'OTP for reset password ' . $otp . '';
            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                header("location:_forgotOTP.php?sno=$sno");
                // echo $sno;
            }
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    } else {
        $showError = "wrong email or mobile";
        header("Location: /web/partials/_forggetPass.php");
    }

}
?>