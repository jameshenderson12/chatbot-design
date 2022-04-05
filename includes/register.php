<?php

	$page_title = 'Registration';

	// Sanitize incoming username and password
	$firstname = ucfirst(TRIM($_POST['firstname']));
	$surname = ucfirst(TRIM($_POST['surname']));
	$username = filter_var(TRIM($_POST['username']), FILTER_SANITIZE_STRING);
	$email = TRIM($_POST['email']);
	$user_type = $_POST['user_type'];
	$location = TRIM($_POST['location']);
	$password = filter_var(TRIM($_POST['password']), FILTER_SANITIZE_STRING);

	if ($user_type == "Academic") {
		$access_level = 3;
	}
	if ($user_type == "Learner") {
		$access_level = 2;
	}
	if ($user_type == "Learning Technologist") {
		$access_level = 4;
	}
	if ($user_type == "Observer") {
		$access_level = 1;
	}
	if ($user_type == "Researcher") {
		$access_level = 4;
	}
	if ($user_type == "Software Developer") {
		$access_level = 4;
	}
	if ($user_type == "Subject Expert") {
		$access_level = 3;
	}
	if ($user_type == "Student") {
		$access_level = 2;
	}

	include('config.inc.php');
	consoleMsg($firstname . ", " . $surname . ", " . $username . ", " .  $email . ", " .  $user_type . ", " . $access_level . ", " . $location . ", " . $password . ".");
	// Debug message: Scooby, Doo, scoobydoo, james.henderson@nottingham.ac.uk, Software Developer, 4, Angola, 56789Test.

	include 'db_connect/db_connect.inc.php';

	// Initial query to set intial positional values
	$stmt1 = mysqli_prepare($con_app, "INSERT INTO user (firstname, surname, username, email, user_type, access_level, location, password) VALUES (?,?,?,?,?,?,?,?)");

	// Bind the input parameters to the prepared statement
	mysqli_stmt_bind_param($stmt1, "sssssiss", $firstname, $surname, $username, $email, $user_type, $access_level, $location, md5($password));

	// Execute the query
	mysqli_stmt_execute($stmt1);

	// Close statement and connection
	mysqli_stmt_close($stmt1);

	// Close database connection
	mysqli_close($con_app);

function confirmationEmail() {

	$to =  $email; // "somebody@example.com, somebodyelse@example.com";
	$subject = "Successful registration for Chatbot Co-Creation Tool";

	$message = "
	<html>
	<head>
	<title>Educational Chatbot Crowd-based Co-creation Tool</title>
	</head>
	<body>
	<h1>Successful Registration</h1>
	<p>Thank you for registering to use the Chatbot Co-Creation Tool. This will enable you to provide a specific chatbot with data and information to help inform its design and implementation.</p>
	<p>For your records, please see below for your credentials to access this site.</p>
	<p><a href='https://www.nottingham.ac.uk/~ntzjh/cepeh/chatbot-design/index.php'>https://www.nottingham.ac.uk/~ntzjh/cepeh/chatbot-design/index.php</a></p>
	<table>
	<tr>
	<th>Firstname</th>
	<th>Lastname</th>
	<th>Username</th>
	<th>Password</th>
	<th>User Role</th>
	<th>Location</th>
	</tr>
	<tr>
	<td>$firstname</td>
	<td>$surname</td>
	<td>$username</td>
	<td>Stored securely</td>
	<td>$user_type</td>
	<td>$location</td>
	</tr>
	</table>
	</body>
	</html>
	";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <james.henderson@nottingham.ac.uk>' . "\r\n";
	//$headers .= 'Cc: myboss@example.com' . "\r\n";

	mail($to,$subject,$message,$headers);
}

?>


	<!DOCTYPE html>
	<html class="h-100" lang="en">
	  <head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
			<title><?php echo $page_title.' - '.$config['application_name'].' - '.$config['project_acronym'].': '.$config['project_name']; ?></title>
	    <!-- Various CSS and Font links for including -->
	  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	    <!-- Bootstrap core CSS -->
	    <link rel="stylesheet" href="../css/custom.css">
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	    <!-- Custom styles for this template -->
	    <link href="../css/signin.css" rel="stylesheet">
	    <link href="../css/registration.css" rel="stylesheet">
			<!-- Custom styles for this template -->
			<link href="../css/sticky-footer-navbar.css" rel="stylesheet">

			</head>
			<body>

		  <div class="container text-center">

	      <img src="../img/CEPEH-Logo.png" alt="CEPEH project logo" width="200px" class="img-fluid center-block">
	      <p class="lead text-center"><b>C</b>hatbots <b>E</b>nhance <b>P</b>ersonalised <b>E</b>uropean <b>H</b>ealthcare Curricula</p>
	      <h2 class="text-center">Educational Chatbot Crowdbased Co-Creation Tool</h2>


	      <div class="card bg-light">
	      <article class="card-body mx-auto">
	      	<h1 class="h3 mb-3 mt-3 fw-normal">Successful registration</h1>

					<p>Thank you for joining the Educational Chatbot Crowdbased Co-Creation Tool.</p>
					<p><i class="fa fa-thumbs-o-up fa-5x" aria-hidden="true"></i><p>
		      <p>You will now be taken back to the login page in <span id="counter">5</span> seconds.</p>
		      <p>If you are not redirected automatically, please <a href='../index.php'>click here</a>.</p>

		      <div class="spinner"></div>

		      <div id="spacer"></div>

	      </article>
	      </div>

	     <div class="my-5 text-muted">Copyright © 2021 CEPEH Project</div>

     </div><!--.container-->

		 <?php include('logos.inc.php'); ?>

		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		 <script>
			setInterval(function() {
					var div = document.querySelector("#counter");
					var count = div.textContent * 1 - 1;
					div.textContent = count;
					if (count <= 0) {
							window.location.replace("../index.php");
					}
			}, 1000);
		 </script>

	  </body>
	</html>
