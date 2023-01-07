<link rel="stylesheet" href="./css/_nav.css">
<?php

echo '   
 <nav class="navbar navbar-expand-lg navbar-dark nav">
<div class="container-fluid">
    <a class="navbar-brand" href="index.php">Digi-Query</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
$sql = "SELECT category_name, category_id FROM `categories` LIMIT 3";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo ' <li><a class="dropdown-item" href="_threads.php?catid=' . $row['category_id'] . '">' . $row['category_name'] . '</a></li>';
}

echo ' </ul>
</li>
<li class="nav-item">
<a class="nav-link" href="feedback.php">Feedback</a>
</li>
</ul>
            <!-- login and register buttens here -->
            <div class="mx-2" style="display: flex;">';


require 'partials/_loginmodal.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {


    echo '
            <form class="d-flex" method="GET" action="_search.php">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary" type="submit">Search</button>
                    <h6 class="row text-light mx-2">Welcome ' . $_SESSION['user_email'] . ' </h6>
                    <a href="partials/_logout.php" class="btn btn-outline-primary  mx-2">Logout</a>
            </form>
            
            
            ';
} else {
    echo '
    <form class="d-flex" method="GET" action="_search.php">
            <input class="form-control me-1" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-primary" type="submit">Search</button>
            </form>
            <button class="btn btn-outline-primary mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
    
            
            ';
}
echo '  </div>
        </div>
        </div>
        </nav>';

require 'partials/_signupmodal.php';

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You can login.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
}




?>