
<?php
    session_start();
    ob_start();
    if($_SESSION['userId']){
        $sessionId = $_SESSION['userId'];
    }else{
        header('location: ../index.php');
    }

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
       <title>Bootstrap Registration</title>
	   <meta charset="utf-8">
	   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<style type="text/css">

	 body{
	width: 100%;
	height: 100vh;
	background-image: url('../assets/image.png');
	background-size: cover;
	background-repeat: no-repeat;
}

		.chat{
			width: 100%;
			height: 100vh;
		}
		.card{
			position: relative;
			top: 0;
			width: 500px;
			margin: auto;
			height: 100vh;
		}
		.card .card-body{
			height: 80vh;
			overflow-y: scroll;
		}
		.card .card-body .message{
			background: #00FFFF;
		}
		.card .card-body p{
			font-size: 15px;
			line-height: 1.5rem;
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


	 <div class="chat">
		<div class="card">
		<div class="card-body p-0">
			<?php
		      include '../db/connection.php';
		      $doctorId = $_SESSION['userId'];
		        $patientId = $_GET['id'];
		        $select_message = "SELECT messages FROM chat WHERE patient_id='$patientId' AND doctor_id='$doctorId'";
		          $result = mysqli_query($conn, $select_message);
		            while ($row = mysqli_fetch_array($result)){
      		?>
		   <div class="message p-2 rounded mb-2">
				<p class="mb-0"><?php echo $row['messages']; ?></p>
			</div>
			<?php
				}
			?>
		</div>
		<div class="card-footer p-0">
			<?php
		      if(isset($_POST['submit'])){
		        include '../db/connection.php';
		        $patientId = $_GET['id'];
		        $doctorId = $_SESSION['userId'];
		        $message = $_POST['message'];
		        $q1 ="INSERT INTO chat (doctor_id,patient_id,messages) VALUES('$doctorId','$patientId','$message')";
		        $conn->query($q1);
		      }
		    ?>
			<form method="post">
				<div class="input-group">
				    <input type="text" class="form-control rounded-0 shadow-none" name="message" placeholder="Write message">
				    <div class="input-group-prepend p-0">
				      <div class="input-group-text p-0"><button type="submit" name="submit" class="btn btn-primary shadow-none">Send</button></div>
				    </div>
				 </div>
			</form>
		</div>
	</div>

	</div>			



	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>


</html>