<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>iWay - || welcome to coding ||</title>
    <style>
        #ques {
            min-height: 433px;
        }
    </style>
</head>

<body>
    <?php require 'partials/_dbconnect.php' ?>
    <?php require 'partials/_nav.php' ?>

    <!-- Search Results -->
  <div class="container my-3" id="maincontainer" style="height: 84.8vh;">
        <h1 class="py-3">Search results for <em>"<?php echo $_GET['search']?>"</em></h1>

        <?php  
        $noresults = true;
        $query = $_GET["search"];
        $sql = "SELECT * FROM threads WHERE match (thread_title, thread_desc) against ('$query')"; 
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_desc']; 
            $thread_id= $row['thread_id'];
            $url = "thread.php?threadid=". $thread_id;
            $noresults = false;
            
            // Display the search result
            echo '<div class="result">
            <h3><a href="'. $url. '" class="text-dark">'. $title. '</a> </h3>
            <p>'. $desc .'</p>
            </div>'; 
        }
        if ($noresults){
            echo '<div class="jumbotron jumbotron-fluid" style="background-color: #e1e1e1;">
            <div class="container">
            <p class="display-4">No Results Found</p>
            <p class="lead"> Suggestions: <ul>
            <li>Make sure that all words are spelled correctly.</li>
            <li>Try different keywords.</li>
            <li>Try more general keywords. </li></ul>
            </p>
            </div>
            </div>';
        }        
        ?>
        

  
  </div>
    <?php require 'partials/_footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>