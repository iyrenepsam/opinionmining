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
        <h2 align="center"> Product Review System </h2>
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
                            <option value="Overall">Overall </option>
                            <option value="Camera">Camera</option>

                            <option value="Build Quality">Build Quality</option>
                            <option value="Performance">Performance</option>



                        </select>

                    </td>
                </tr>


                <tr>
                    <td> Write Review </td>
                    <td>
                        <textarea class='form-control' name="review" id="" cols="30" rows="10" required>


                </textarea>

                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td> <Button type="submit" name="but" class="btn btn-danger">SUBMIT</Button></td>
                </tr>
            </table>
    </div>
</body>

</html>

<?php

include './db.php';
if (isset($_POST["but"])) {

    $phoneId = $_POST["phoneId"];

    $feature = $_POST["feature"];

    $Uid = $_SESSION['id'];

    $review = $_POST["review"];
    $foo = preg_replace('/\s+/', ' ', $review);

    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $foo);

    fclose($myfile);

    $polarity = file_get_contents("http://127.0.0.1:5000/predict");
    $IP = getHostByName(getHostName());


    $CheckSql = "SELECT count(`id`) cid FROM `reviews` WHERE `user_id`=$Uid and `prod_id`= $phoneId and ip='$IP' and DATE(dateTime)=DATE(now())";

    $resCheck = $connection->query($CheckSql);

    if ($result->num_rows > 0) {

        // output data of each row
        while ($row = $resCheck->fetch_assoc()) {

            $cid = $row["cid"];


            if ($cid >= 2) {


                $Upsql = "UPDATE `reviews` SET `active`=0  WHERE `user_id`=$Uid";

                $resCheck = $connection->query($Upsql);

                echo "<script> alert('System find out the Malicious Attempt to degrade a product. So Blocking all of your previous reviews')   </script>";
            } else {

                echo $sql = "INSERT INTO `reviews`( `prod_id`, `user_id`, `review`, `feature`, `ip`, `polarity`, `active`)
     VALUES($phoneId,$Uid,'$foo','$feature','$IP',$polarity,1) ";
                $res = $connection->query($sql);

                if ($res === true) {

                    echo "<script> alert('Succesfully Added')   </script>";


                    echo "<script> window.location.href='dashboard.php'  </script>";
                } else {
                    echo $connection->error;
                    echo "<script> alert('Error')   </script>";
                }
            }
        }
    }
}


?>