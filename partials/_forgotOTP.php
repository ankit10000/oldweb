<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/_forggetPass.css">
    <title>Forgot Password</title>
</head>

<body>
    <?php
    require '_dbconnect.php';
    $sno = $_GET['sno'];
    
    if (isset($_POST['submit'])) {
        $recivedotp = $_POST['otp'];

        $sql = "SELECT * FROM `sendingotp` WHERE otp_time";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $storedotp = $row['otp_otp'];
        }
        if ($recivedotp == $storedotp) {
            header("location:_forgotChangePass.php?sno=$sno");
        } else {
            echo "wrong otp";
        }
    }
    ?>
    <div class="modal-dialog container">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="loginModalLabel">Forgot Password</h5>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                        <label for="exampleInputPassword1" class="form-label">OTP</label>
                        <input type="text" class="form-control" id="otp" name="otp" required>
                    </div>
                    <input type="submit" class="btn btn-outline-danger mx-3 my-3 px-5" name="submit" value="Submit" required>
                </div>
            </form>
        </div>
    </div>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>