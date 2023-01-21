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
        if ($_POST['Pass'] != $_POST['confirmPass']) {
            echo "Missmatch Password please check";
        }else{
            $sql = "SELECT * FROM `users` WHERE sno=$sno";
            $result = mysqli_query($conn, $sql);
            $row1 = mysqli_fetch_assoc($result);
            $resetmail = $row1['user_email'];
            $pass = $_POST['Pass'];
            $result1 = mysqli_query($conn, "UPDATE users SET user_pass='$pass' WHERE user_email='$resetmail'");
            if ($result1) {
                header("location:/web/index.php?reset_true");
            }else{
                echo "changes not saved";
            }
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
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="Pass" name="Pass" required>
                    </div>
                    <div class="mb-3"> 
                        <label for="exampleInputPassword1" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPass" name="confirmPass" required>
                    </div>
                    <input type="submit" class="btn btn-outline-danger mt-3 px-5" name="submit" value="Submit" required>
                </div>
            </form>
        </div>
    </div>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>