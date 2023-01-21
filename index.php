<?php session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/_nav.css">
    <link rel="stylesheet" href="css/_index.css">
    <title>Digi-Query - || welcome to Digi-Query ||</title>
    <style>
 
    </style>
</head>

<body>
    <?php require 'partials/_dbconnect.php'; ?>
    
    <?php require 'partials/_handlelogin.php'; ?>
    <?php require 'partials/_handlesignup.php'; ?>
    <?php require 'partials/_nav.php'; ?>
    
    <?php

  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            echo'
            <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You login successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
            ';
        }
        else if(isset($_GET['reset_true'])){
            echo'
            <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> Password reset successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
            ';
        }
        else if(isset($_GET['deactivateaccount'])){
            echo'
            <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> Deactivate account successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
            ';
        }
?>


    <!-- imgage slider -->

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/photo-1593720218746-e13e4a422a3b (2).jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/source.unsplash.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/source.unsplash1.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container mt-3" id="ques">
        <h2 class="text-center">iWay - Categories</h2>
        <div class="row">
            <!-- fetch all the Categories -->

            <?php
      $sql = "SELECT * FROM `categories`";
      $result = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['category_id'];
      $cat = $row['category_name'];
      $desc = $row['category_description'];
        echo '<div class="col-md-4 my-2 ">
          <div class="card card1 colcard" style="width: 18rem;">
          <a href="_threads.php?catid='. $id .'"><img src="https://source.unsplash.com/400x300/?'. $cat .',coding" class="card-img-top colimg" alt="..."></a>
              <div class="card-body">
                  <h5 class="card-title"><a href="_threads.php?catid='. $id .'">'. $cat .'</a></h5>
                  <p class="card-text" style="text-align: justify;">'. substr($desc, 0,100) .'....</p>
                  <a href="_threads.php?catid='. $id .'" id="btnthread" class="btn btn-primary mb-3">Veiw Thread</a>
              </div>
          </div>
        </div>';
      }

      ?>


        </div>
    </div>

    <?php require 'partials/_footer.php' ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

   
</body>

</html>