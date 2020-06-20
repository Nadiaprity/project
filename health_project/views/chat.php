
<?php
    session_start();
    ob_start();
    if($_SESSION['userId']){
        $sessionId = $_SESSION['userId'];
        $step1 = "";
        $step2 = "";
        $name = "";
        $_SESSION['doctor_session_id'] =  $_GET['id'];
    }else{
        header('location: ../index.php');
    }

  ?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset="UTF-8">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" type="text/css" href="styleh2.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet"  href="css/all.min.css">
  <link rel="stylesheet"  href="css/fontawesome.min.css">
  
  <style type="text/css">
    .chat-box{
      width: 100%;
      height: 100vh;
      background: #ffffff;

    }
    .chat-box .patient-box{
      position: fixed;
      top: 0;
      left: 0;
      width: 300px;
      height: 1000vh;
      background: #ffffff;
      z-index: 3;
      border-right: 1px solid #555;
      padding-top: 80px;
    }
    .chat-box .main-chat-box{
      position: fixed;
      top: 0;
      width: 100%;
      height: 100vh;
      background: red;
      padding-left: 300px;
      padding-right: 300px;
      background: #ffffff;
    }
    .chat-box .doctor-box{
      position: fixed;
      top: 0;
      right: 0;
      width: 300px;
      height: 1000vh;
      background: #ffffff;
      z-index: 5;
      border-left: 1px solid #555;
      padding-top: 50px;
    }
    .chat-box .patient-box .content{
      padding-bottom: 20px;
      border-bottom: 1px solid #555;
    }
    .chat-box .patient-box .content ul li{
      list-style: none;
    }
    .chat-box .patient-box .patient-health{
      padding-bottom: 20px;
      border-bottom: 1px solid #555;
    }
    .chat-box .patient-box .patient-health ul li{
      list-style: none;
    }

    /*Doctor box*/
    .chat-box .doctor-box .dieases-title{
      background: #555;
      text-align: center;
      padding: 10px;
    } 
    .chat-box .doctor-box .should-eat{
      padding: 10px;
      background-color: #40E0D0;
    }
    .chat-box .doctor-box .should-eat ul li p{
      text-transform: capitalize;
    }


    .chat-box .main-chat-box{
      padding-top: 60px;
    }
    .chat-box .main-chat-box .chat-card{
      width: 100%;
      height: 90%;
      position: fixed;
      top: 0;
      left: 0;
      padding-left: 300px;
      padding-right: 300px;
      background: #ffffff;
      z-index: 9;
      overflow-y: scroll;
      padding-top: 60px;
    }
    .chat-box .main-chat-box .chat-card .left-message{
      padding: 5px 10px;
      border-radius: 5px;
      background: red;
      max-width: 400px;
      margin: 15px;
    }
    .chat-box .main-chat-box .chat-card .left-message p{
      color: #ffffff;
      font-size: 14px;
      margin: 0;
    }

    .chat-box .main-chat-box .chat-card .right-message{
      padding: 5px 10px;
      border-radius: 5px;
      background: brown;
      max-width: 400px;
      margin: 15px;
    }
    .chat-box .main-chat-box .chat-card .right-message p{
      color: #ffffff;
      font-size: 14px;
      margin: 0;
    }
    .chat-box .main-chat-box .chat-form{
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
      height: 60px;
      background: #ffffff;
      z-index: 9;
      border-top: 1px solid #555;
      padding-left: 300px;
      padding-right: 300px;
    }
    .chat-box .main-chat-box .chat-form .form-control{
      width: 530px;
      height: 60px;
      float: left;
    }
    .chat-box .main-chat-box .chat-form .btn{
      width: 130px;
      height: 60px;
      background: brown;
      color: #ffffff;
      border: 0;
      cursor: pointer;
    }

    .navbar{
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background: red;
      z-index: 99999;
    }

  </style>

</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Health help Line</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php"> Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index_dc.php">Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./doctor/doctor_contact.php">Doctor Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
      
    </ul>
  </div>
</nav>

 <div class="chat-box">
   <div class="patient-box p-3">
     <div class="text-center mb-4">
       <h5>Patient Information</h5>
     </div>
     <div class="content">
       <ul>
        <?php 
          $userId = $_SESSION['userId'];
          include '../db/connection.php';
          $select_patient = "SELECT * FROM patient_info WHERE id='$userId'";
          $result = mysqli_query($conn, $select_patient);
            while ($row = mysqli_fetch_array($result)){  
              $name = $row['name'];
            ?>
            <h5>Patient Information</h5>
         <li><p class="mb-0 text-capitalize">Name: <?php echo $row['name']; ?></p></li>
         <li><p class="mb-0">Age: <?php echo $row['age']; ?></p></li>
         <li><p class="mb-0">Gender: <?php echo $row['gender']; ?></p></li>
         <?php
          }
          ?>
       </ul>
     </div>
     <div class="patient-health">
      
       <ul>
        <?php 
          $doctorId = $_GET['id'];
          $userId = $_SESSION['userId'];
          include '../db/connection.php';
          $select_info = "SELECT * FROM health_info WHERE user_id='$userId' ORDER BY id DESC LIMIT 1";
          $result = mysqli_query($conn, $select_info);
            while ($row = mysqli_fetch_array($result)){
              if($row['suger'] <= 50){
                $step1 = true;
              }
              if($row['suger'] > 50){
                $step2 = true;
              }
            ?>
            <h5>Health Condition</h5>
         <li><p class="mb-0">BP:<?php echo $row['pressure']; ?></p></li>
         <li><p class="mb-0">BS: <?php echo $row['suger']; ?></p></li>
         <li><p class="mb-0">Temperature: <?php echo $row['temperature']; ?></p></li>
        <?php
          }
        ?>
       </ul>
     </div>
   </div>


   <div class="main-chat-box">
     
    <div class="chat-card">

      <?php
      include '../db/connection.php';
      $patientId = $_SESSION['userId'];
        $doctorId = $_GET['id'];
        $select_message = "SELECT messages FROM chat WHERE patient_id='$patientId' AND doctor_id='$doctorId'";
          $result = mysqli_query($conn, $select_message);
            while ($row = mysqli_fetch_array($result)){
      ?>
      <div class="left-message">
        <p><?php echo $row['messages']; ?></p>
      </div>

      <?php
        }
      ?>

     

     <!--  <div class="right-message">
        <p>title meesage title meesagetitle meesagetitle meesagetitle meesagetitle meesage</p>
      </div> -->

    </div>

    <?php
      if(isset($_POST['submit'])){
        include '../db/connection.php';
        $patientId = $_SESSION['userId'];
        $doctorId = $_GET['id'];
        $message = $_POST['message'];
        $q1 ="INSERT INTO chat (doctor_id,patient_id,patient_name,messages) VALUES('$doctorId','$patientId','$name','$message')";
        $conn->query($q1);
      }
    ?>


     <div class="chat-form">
       <form method="post">
         <input type="text" class="form-control rounded-0 shadow-none" name="message" placeholder="Write message">
         <button type="submit" name="submit" class="btn">Send</button>
       </form>
     </div>
   </div>


   <div class="doctor-box">

    <?php
      if($step1){
    ?>
    <div class="step-1">
      <div class="dieases-title">
       <h5 class="md-0 text-white">Your health condition is not good</h5>
     </div>
     <div class="should-eat">
      <h5 class="md-0">You should eat</h5>
       <ul>
         <li><p class="mb-0">rice</p></li>
         <li><p class="mb-0">rice</p></li>
         <li><p class="mb-0">rice</p></li>
         <li><p class="mb-0">rice</p></li>
       </ul>
     </div>
     </div>
    <?php
      }
    ?>

    <?php
      if($step2){
    ?>
    <div class="step-1">
      <div class="dieases-title">
       <h5 class="md-0 text-white">Your health condition is good</h5>
     </div>
     <div class="should-eat">
      <h5 class="md-0">You should eat</h5>
       <ul>
         <li><p class="mb-0">Fried rice</p></li>
         <li><p class="mb-0">Burger</p></li>
         <li><p class="mb-0">Chicken</p></li>
       </ul>
     </div>
     </div>
    <?php
      }
    ?>


   </div>
 </div>
            

              



            </div>
       

        
       
        <footer>
          <p></p>
        </footer>
       </div>
</body>
</html>


