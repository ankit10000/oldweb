<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/_thread.css">

    <title>iWay - || welcome to coding ||</title>
    <style>
        #ques {
            min-height: 200px;
        }
    </style>
</head>

<body>
    <?php require 'partials/_dbconnect.php' ?>
    <?php require 'partials/_nav.php' ?>
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
    }

    ?>

    <?php
    $showalert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        //insert into comment data 
        $comment_content = $_POST['comment'];
        $comment_content = str_replace("<", "&lt;", $comment_content);
        $comment_content = str_replace(">", "&gt;", $comment_content);
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment_content', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showalert = true;
        if ($showalert) {
            echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your comment is added successfully in database.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            ';
        }
    }
    ?>


    <div class="container mt-3">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>(1).No Spam / Advertising / Self-promote in the forums. <br>
                (2).Do not post copyright-infringing material.<br>
                (3).Do not post “offensive” posts, links or images.<br>
                (4).Do not cross post questions.<br>
                (5).Remain respectful of other members at all times.</p>
            <p class="lead">
                <a class="btn btn-primary btn-dark text-light bg-dark" role="button"><b>Created By :</b></a>
            </p>
        </div>
    </div>




    <div class="container mt-3" id="ques">
        <hr class="my-4">
        <h2>Comments</h2>
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $content_time = $row['comment_time'];
            $comment_by = $row['comment_by'];
            $sql1 = "SELECT user_name FROM `users` WHERE sno='$comment_by'";
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);


            echo '
        <div class="media">
          <img class="mr-3" src="img/userdefoultimg.png" width="60px" alt=".....">
            <div class="media-body">
            <p class="my-0"><b>' . $row1["user_name"] . ' at ' . $content_time . '</b></p>
                ' . $content . '
            </div>
        </div>';
        }

        ?>
    </div>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '    
        <div class="container mt-3 mb-3" id="ques">
        <hr class="my-5">
        <form action="' . $_SERVER["REQUEST_URI"] . '" method="POST">
        <h2>Post a Comment</h2>
        <div class="mb-3">
        <label for="exampleInputTextarea1" class="form-label"><b>Type Your Comment<b style="color: red;">*</b></b></label>
        <textarea type="text" class="form-control" id="comment" name="comment" required></textarea>
        <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
            </div>
            <button type="submit" class="btn btn-primary">Post Comment</button>
        </form>
    </div>';
    } else {
        echo '
        <div class="container mb-5" id="ques">
        <hr class="my-5">
        <h2>Post a Comment</h2>
        <p class="lead ">You are not logged in. Please login to be able to Post a Comment</p>
        </div>
        ';
    }
    ?>


    <?php require 'partials/_footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>