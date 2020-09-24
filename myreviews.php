<?php
session_start();
include './db.php';

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
</head>

<body>

    <nav class="navbar navbar-expand-sm bg-danger navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link " href="dashboard.php"> Product Review System </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link " href="myreviews.php">My Reviews </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link " href="allreviews.php">All Reviews </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php">LogOut</a>
            </li>

        </ul>
    </nav>
    <br /><br />
    <div class="container" style="width:600px;">
        <h2 align="center"> My Products Review </h2>
        <br /><br />


        <form method="post" id="framework_form">


            <table class="table">

                <?php
                

                $Uid = $_SESSION['id'];
                include './db.php';


                $sql = "SELECT  p.name,`review`, `feature`, `ip`, `polarity`, `active`, `dateTime` FROM `reviews` r join products p on p.id=r.`prod_id` where `user_id`=$Uid";
                $result = $connection->query($sql);

                if ($result->num_rows > 0) {

                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $name = $row["name"];
                        $review = $row["review"];
                        $feature = $row["feature"];
                        $ip = $row["ip"];
                        $polarity = $row["polarity"];
                        $dateTime = $row["dateTime"];
                        $active = $row["active"];


                        echo "
                        <div class='card' style='width:800px;height:200px' >
  
  <div class='card-img-overlay'>
  <h6 class='card-title'>Phone Model</h6>
    <h4 class='card-title'>$name</h4> ";
                        if ($polarity == 0) {
                            echo " <p class='text-primary'>$review</p>";
                        } else if ($polarity == 1) {
                            echo " <p class='text-success'>$review</p>";
                        } else {
                            echo " <p class='text-danger'>$review</p>";
                        }




                        echo "  <p class='card-text'>Feature : $feature</p>

    <p class='card-text'>Date : $dateTime</p>";



                        if ($active == 0) {
                            echo " <p class='text-danger'>Message Blocked Due to Malicious attempt </p>";
                        }

                        echo "
  </div>
</div>
<br>

";
                    }
                } else {
                    echo "0 results";
                }


                ?>



            </table>
    </div>
</body>

</html>