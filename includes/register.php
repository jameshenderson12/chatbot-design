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

	// Pass credentials to HTML email for mailing
	$to =  $email;
	$subject = "Successful registration for Chatbot Co-Creation Tool";
	$from = 'james.henderson@nottingham.ac.uk';
	$message = "
	<!DOCTYPE html>
	<html>
	<head>
	<img src='https://www.nottingham.ac.uk/~ntzjh/cepeh/chatbot-design/img/CEPEH-Logo.png' alt='CEPEH logo' width='150px'>
	<title>Educational Chatbot Crowd-based Co-creation Tool</title>
	</head>
	<body>
	<h2>Educational Chatbot Crowd-based Co-creation Tool</h2>
	<h3>Successful Registration</h3>
	<p>Thank you for registering to use the Educational Chatbot Crowd-based Co-creation Tool. This will enable you to provide a specific chatbot with data and information to help inform its design and implementation.</p>
	<p>For your records, please see below for your credentials to access this site.</p>
	<p><a href='https://www.nottingham.ac.uk/~ntzjh/cepeh/chatbot-design/index.php'>https://www.nottingham.ac.uk/~ntzjh/cepeh/chatbot-design/index.php</a></p>
	<table style='width: 65%; border: 1px solid #999'>
	<tr>
	<th width='15%' style='text-align: left'>Firstname</th>
	<th width='15%' style='text-align: left'>Lastname</th>
	<th width='22%' style='text-align: left'>Username</th>
	<th width='23%' style='text-align: left'>Password</th>
	<th width='15%' style='text-align: left'>User Role</th>
	<th width='20%' style='text-align: left'>Location</th>
	</tr>
	<tr>
	<td width='15%'>$firstname</td>
	<td width='15%'>$surname</td>
	<td width='22%'>$username</td>
	<td width='23%'>Stored securely (<a href='#'>Forgot?</a>)</td>
	<td width='15%'>$user_type</td>
	<td width='20%'>$location</td>
	</tr>
	</table>
	<p>We hope you enjoy designing a chatbot with us!</p>
	<p>Kind Regards,<br>The CEPEH Project Team (<a href='https://cepeh.eu'>https://cepeh.eu</a>)</p>
	</body>
	</html>
	";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	/* More headers
	$headers .= 'From: <james.henderson@nottingham.ac.uk>' . "\r\n";
	//$headers .= 'Cc: myboss@example.com' . "\r\n";
	*/

	// Create email headers
	$headers .= 'From: '.$from."\r\n".
			'Reply-To: '.$from."\r\n" .
			'X-Mailer: PHP/' . phpversion();

	// Sending email
	if(mail($to, $subject, $message, $headers)){
			consoleMsg('Your mail has been sent successfully.');
	}
	else {
			consoleMsg('Unable to send email. Please try again.');
	}

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

		 <div class="row justify-content-md-center my-5"><!-- style="opacity: 0.8" -->
		   <div class="col-md-auto">
		     <img src="../img/uon-logo-default.png" alt="University of Nottingham logo" width="150px" class="img-fluid center-block">
		   </div>
		   <div class="col-md-auto">
		     <img src="../img/AUTH-logo-en.png" alt="Aristotle University of Thessaloniki logo" width="180px" class="img-fluid center-block">
		   </div>
		   <div class="col-md-auto">
		     <img src="../img/CYENS-logo.png" alt="CYENS logo" width="200px" class="img-fluid center-block">
		   </div>
		   <div class="col-md-auto">
		     <img src="../img/ki-logo.png" alt="Karolinska Institutet logo" width="125px" class="img-fluid center-block">
		   </div>
		 </div>

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
