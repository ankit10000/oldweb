<?php session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/_forggetPass.css">
    <title>Forgot Password</title>
</head>

<body>
    <?php require './partials/_dbconnect.php' ?>
    <?php require './partials/_nav.php'; ?>
    <?php
    $email = $_SESSION["user_email"];
    $findresult = mysqli_query($conn, "SELECT * FROM users WHERE user_email= '$email'");
    if ($res = mysqli_fetch_array($findresult)) {
        $uname = $res['user_name'];
        $mobile = $res['user_mob'];
        $password = $res['user_pass'];
    }

    ?>
    <div class="modal-dialog container">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="loginModalLabel">Profile</h5>
            </div>
            <?php if (isset($_POST['update_profile'])) {
                $showError = false;
                $uname = $_POST['user_name'];
                $oldusername = $_POST['user_name'];
                $email = $_SESSION['user_email'];
                $mobile = $_POST['user_mob'];
                $password = $_POST['user_pass'];
                $sql = "SELECT * from users where user_name='$uname'";
                $res = mysqli_query($conn, $sql);
                if (mysqli_num_rows($res) != 0) {
                    $row = mysqli_fetch_assoc($res);
                    if ($uname == null || $email == null || $mobile == null || $password == null) {
                        $error[] = 'Please fill the blank input';
                    }
                    if ($oldusername != $_SESSION['user_name']) {
                        if ($uname == $row['user_name']) {
                            $error[] = 'Username alerady exist';
                        }
                    }
                }

                if (!isset($error)) {
                    $result = mysqli_query($conn, "UPDATE users SET user_name='$uname',user_mob='$mobile',user_pass='$password' WHERE user_email='$email'");
                    if ($result) {
                        $alert[] = 'Changes Saved';
                    } else {
                        $error[] = 'Something went wrong';
                    }
                }

                if (isset($alert)) {

                    foreach ($alert as $alert) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> ' . $alert . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                }
                if (isset($error)) {

                    foreach ($error as $error) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Warning!</strong> ' . $error . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    }
                }
            }



            ?>
            <form method="post" enctype='multipart/form-data' action="">
                <div class="form-group my-4 mx-4">
                    <div class="row">
                        <div class="col-3">
                            <label>Username</label>
                        </div>
                        <div class="col">
                            <input type="text" name="user_name" value="<?php echo $uname; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-4 mx-4">
                    <div class="row">
                        <div class="col-3">
                            <label>E-mail</label>
                        </div>
                        <div class="col">
                            <input type="text" name="user_email" value="<?php echo $email; ?>" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-4 mx-4">
                    <div class="row">
                        <div class="col-3">
                            <label>Mobile</label>
                        </div>
                        <div class="col">
                            <input type="text" name="user_mob" value="<?php echo $mobile; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-4 mx-4">
                    <div class="row">
                        <div class="col-3">
                            <label>Password</label>
                        </div>
                        <div class="col d-flex">
                            <input type="password" name="user_pass" value="<?php echo $password; ?>" class="form-control" id="id_password">
                            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20210917150049/eyeslash-300x240.png" width="25px" height="20px" style="margin-left: -12%;margin-top: 8px;display:inline;
                vertical-align: middle" id="togglePassword">
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-success" name="update_profile">Save Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script>
        const togglePassword =
            document.querySelector('#togglePassword');

        const password = document.querySelector('#id_password');

        togglePassword.addEventListener('click', function(e) {

            // Toggle the type attribute
            const type = password.getAttribute(
                'type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle the eye slash icon
            if (togglePassword.src.match(
                    "https://media.geeksforgeeks.org/wp-content/uploads/20210917150049/eyeslash.png")) {
                togglePassword.src =
                    "https://media.geeksforgeeks.org/wp-content/uploads/20210917145551/eye.png";
            } else {
                togglePassword.src =
                    "https://media.geeksforgeeks.org/wp-content/uploads/20210917150049/eyeslash.png";
            }
        });
    </script>
</body>

</html>