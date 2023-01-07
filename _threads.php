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
        /* button.btn.btn-primary.mr-7 {
    margin-left: 10px;
    margin-right: 10px;
} */
        #ques {
            min-height: 498px;
        }
    </style>
</head>

<body>
    <?php require 'partials/_dbconnect.php' ?>
    <?php require 'partials/_nav.php' ?>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $cat = $row['category_name'];
        $desc = $row['category_description'];
    }

    ?>
    <?php
    $showalert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        //insert into data 
        $thread_title = $_POST['title'];
        $thread_desc = $_POST['desc'];
        $sno = $_POST['sno'];
        $thread_title = str_replace("<", "&lt;", $thread_title);
        $thread_title = str_replace(">", "&gt;", $thread_title);
        $thread_desc = str_replace("<", "&lt;", $thread_desc);
        $thread_desc = str_replace(">", "&gt;", $thread_desc);
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`,`thread_user_id`, `timestamp`) VALUES ('$thread_title', '$thread_desc','$id','$sno' , current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showalert = true;
        if($showalert){
            echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your thread is added successfully in database so please wait for respond.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
            ';
        }


    }
    ?>

    <div class="container mt-3">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $cat; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>1.No Spam / Advertising / Self-promote in the forums.
            <br>
                2.Do not post copyright-infringing material.
            <br>
                3.Do not post “offensive” posts, links or images.
            <br>
                4.Do not cross post questions.
            <br>
                5.Remain respectful of other members at all times.</p>
            <!-- <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p> -->
        </div>
    </div>

    <hr class="my-4">

    <div class="container" id="ques">
        <h2>Browse Questions</h2>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;

        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo '
        <div class="media">
          <img class="mr-3" src="img/userdefoultimg.png" width="60px" alt=".....">
            <div class="media-body">
                <h5 class="my-0"><b>Ask By :- '. $row2['user_email'] . ' at '. $thread_time .'</b></h5>
                <h5 class="mt-0"><a href="thread.php?threadid=' . $id . '">' . $title . '</a></h5>
                ' . $desc . '
            </div>
        </div>';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid mt-3">
        <div class="container">
          <h1 class="display-4">No Thread found</h1>
          <p class="lead">Be the first persion to ask the question.</p>
        </div>
      </div>';
        }

        ?>
<?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
   echo'<h1 class="pt-5">Start a Discussion</h1> 
        <form class="mt-2 mb-5" action="'.$_SERVER["REQUEST_URI"].'" method="POST">
            <div class="mb-3">
                <label for="exampleInputtext1" class="form-label"><b>Problem title<b style="color: red;">*</b></b></label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="textHelp" required>
            </div>
            <input type="hidden" name="sno" value="'. $_SESSION["sno"] . '">
            <div class="mb-3">
                <label for="exampleInputTextarea1" class="form-label"><b>Ellaborate Your Concern<b style="color: red;">*</b></b></label>
                <textarea type="text" class="form-control" id="desc" name="desc" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>';
    }
    else{
        echo'
        <h1 class="pt-5">Start a Discussion</h1>
           <p class="lead">You are not logged in. Please login to be able to start a Discussion</p>
        ';
    }
        ?>

    </div>

    <?php require 'partials/_footer.php' ?>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>