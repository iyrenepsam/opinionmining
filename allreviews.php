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
        <h2 align="center"> All Reviews </h2>
        <br /><br />


        <form method="post" id="framework_form">


            <table class="table">
                <tr>

                    <?php
                   

                    include './db.php';


                    $sql = "SELECT `id`, `name` FROM `products` WHERE 1";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        echo "
                           <td> Select Phone </td>
                    <td>                         <select class='form-control' name='phoneId' >
";
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $Id = $row["id"];
                            $name = $row["name"];

                            echo "                            <option value='$Id'> $name </option>
";
                        }
                    } else {
                        echo "0 results";
                    }


                    ?>





                    </select>

                    </td>
                </tr>


                <tr>
                    <td> Select Feature </td>
                    <td> <select class='form-control' name="feature" id="">
                            <option value="all">All Features </option>

                            <option value="Overall">Overall </option>
                            <option value="Camera">Camera</option>

                            <option value="Build Quality">Build Quality</option>
                            <option value="Performance">Performance</option>



                        </select>

                    </td>
                </tr>




                <tr>
                    <td></td>
                    <td> <Button type="submit" name="but" class="btn btn-danger">SUBMIT</Button></td>
                </tr>
            </table>


            <?php
            
            include './db.php';
            if (isset($_POST["but"])) {
                $phoneId = $_POST["phoneId"];

                $feature = $_POST["feature"];

                $sql1 = "SELECT count(`id`) as cnt FROM `reviews` WHERE `prod_id`=$phoneId  and `polarity`=0 and active=1 ";
                $sql2 = "SELECT count(`id`) as cnt FROM `reviews` WHERE `prod_id`=$phoneId  and `polarity`=1 and active=1";
                $sql3 = "SELECT count(`id`) as cnt FROM `reviews` WHERE `prod_id`=$phoneId  and `polarity`= -1 and active=1";
                $result1 = $connection->query($sql1);
                $result2 = $connection->query($sql2);
                $result3 = $connection->query($sql3);

                if ($result1->num_rows > 0) {

                    // output data of each row
                    while ($row = $result1->fetch_assoc()) {
                        $cnt1 = $row["cnt"];
                    }
                }
                if ($result2->num_rows > 0) {

                    // output data of each row
                    while ($row = $result2->fetch_assoc()) {
                        $cnt2 = $row["cnt"];
                    }
                }
                if ($result3->num_rows > 0) {

                    // output data of each row
                    while ($row = $result3->fetch_assoc()) {
                        $cnt3 = $row["cnt"];
                    }
                }


                echo "
                        <div class='card' style='width:800px;height:200px' >
  
  <div class='card-img-overlay'>
  <h6 class='card-title'> Neutral Reviews </h6>
    <h4 class='card-title'>$cnt1</h4> ";


                echo "  <h6 class='card-title'>Positive Reviews </h6>
    <h4 class='card-title'>$cnt2</h4>


    <h6 class='card-title'> Negative Reviews </h6>
    <h4 class='card-title'>$cnt3</h4>
   
  </div>
</div>
<br>

";




                if ($feature == "all") {
                    $sql = "SELECT  u.name as uname,p.name,`review`, `feature`, `ip`, `polarity`, `active`, `dateTime` FROM `reviews` r join products p on p.id=r.`prod_id` join users u on u.id=r.`user_id`  where r.`prod_id`='$phoneId'  and `active`=1 ";
                } else {
                    $sql = "SELECT  u.name as uname,p.name,`review`, `feature`, `ip`, `polarity`, `active`, `dateTime` FROM `reviews` r join products p on p.id=r.`prod_id` join users u on u.id=r.`user_id`  where r.`prod_id`='$phoneId' and r.`feature`='$feature' and `active`=1 ";
                }



                $result = $connection->query($sql);

                if ($result->num_rows > 0) {

                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $name = $row["name"];
                        $Uname = $row["uname"];
                        $review = $row["review"];
                        $feature = $row["feature"];
                        $ip = $row["ip"];
                        $polarity = $row["polarity"];
                        $dateTime = $row["dateTime"];


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

  

  <p class='card-text'>Review By  : $Uname</p>
                        <p class='card-text'>Date : $dateTime</p>
   
  </div>
</div>
<br>

";
                    }
                } else {
                    echo "<script> alert('No Review Available')   </script>";
                }
            }

            ?>


    </div>
</body>

</html>