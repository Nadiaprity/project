<?php
    session_start();
    ob_start();
    if($_SESSION['deases']){
        $session__deases = $_SESSION['deases'];
        $specialidze = "";
    }else{
        header('location: ../../../index.php');
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Bootstrap Registration</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style type="text/css">
    body {
        background-color: lightblue; 
        background-size: cover;
    }

    .card{
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 100%;
        border-radius: 10px;
    }
    .card-header{
        background-color: #ff6666;
    }



    </style>
</head>

<body>


    <div class="container py-5">
        <div class="row">
            <div class="col-6 m-auto">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="card-text">Suggested doctor for your diseases</h5>
                    </div>
                    <div class="card-body text-center">
                        <?php
                        include ('../../db/connection.php');
                        if($session__deases == 'fever'){
                            $select_department = "SELECT * FROM doctor_info WHERE specialist='medicine' LIMIT 1";
                            $res = mysqli_query($conn, $select_department);
                            while ($row = mysqli_fetch_array($res)){
                                ?>
                                <h5 class="text-capitalize">Name: <?php echo $row['name']; ?></h5>
                                <p>Specialidze: <?php echo $row['specialist']; ?></p>
                                <p>Rating: <?php echo $row['rating']; ?></p>
                                <p>Contact: <?php echo $row['number']; ?></p>
                                <p>E-mail: <?php echo $row['email']; ?></p>
                                <a href="../chat.php?id=<?php echo $row['id']; ?>">Continue Chat</a>
                        <?php
                            }
                        }
                        if($session__deases !== 'fever'){
                            $select_department = "SELECT * FROM doctor_info WHERE specialist !='medicine' LIMIT 1";
                            $res = mysqli_query($conn, $select_department);
                            while ($row = mysqli_fetch_array($res)){

                            ?>
                                <h5 class="text-capitalize">Name: <?php echo $row['name']; ?></h5>
                                <p>Specialidze: <?php echo $row['specialist']; ?></p>
                                <p>Rating: <?php echo $row['rating']; ?></p>
                                <p>Contact: <?php echo $row['number']; ?></p>
                                <p>E-mail: <?php echo $row['email']; ?></p>
                                <a href="../chat.php?id=<?php echo $row['id']; ?>">Continue Chat</a>
                        <?php
                    }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>