<?php
session_start();
echo $_SESSION['user_email'];
echo $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="http://localhost/web/partials/_nav.php"></a>
    <a href="partials/_logout.php">logout</a>
    <a href="partials/_nav.php">n</a>
    <a href="partials/_footer.php"></a>
    <a href="partials/_loginmodal.php"></a>
    <a href="partials/_dbconnect.php"></a>
    
</body>
</html>