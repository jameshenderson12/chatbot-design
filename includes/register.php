<?php

	$page_title = 'Registration';

	// Sanitize incoming username and password
	$firstname = ucfirst(TRIM($_POST['firstname']));
	$surname = ucfirst(TRIM($_POST['surname']));
	$username = filter_var(TRIM($_POST['username'], FILTER_SANITIZE_STRING));
	$email = TRIM($_POST['email']);
	$user_type = filter_var(TRIM($_POST['user_type'], FILTER_SANITIZE_STRING));
	$location = filter_var(TRIM($_POST['location'], FILTER_SANITIZE_STRING));
	$password = filter_var(TRIM($_POST['password'], FILTER_SANITIZE_STRING));

/*
	if ($user_type == "Academic") {
		$user_type_id = 1;
	}
	if ($user_type == "Learner") {
		$user_type_id = 2;
	}
	if ($user_type == "Learning Technologist") {
		$user_type_id = 3;
	}
	if ($user_type == "Observer") {
		$user_type_id = 4;
	}
	if ($user_type == "Researcher") {
		$user_type_id = 5;
	}
	if ($user_type == "Software Developer") {
		$user_type_id = 6;
	}
	if ($user_type == "Subject Expert") {
		$user_type_id = 7;
	}
	if ($user_type == "Student") {
		$user_type_id = 8;
	}
	*/

	include 'db_connect/db_connect.inc.php';

	// Initial query to set intial positional values
	$stmt1 = mysqli_prepare($con_app, "INSERT INTO user (firstname, surname, username, email, user_type_id, user_type, location, password) VALUES (?,?,?,?,?,?,?,?)");

	// Bind the input parameters to the prepared statement
	mysqli_stmt_bind_param($stmt1, "ssssisss", $firstname, $surname, $username, $email, $user_type_id, $user_type, $location, md5($password));

	// Execute the query
	mysqli_stmt_execute($stmt1);

	// Close statement and connection
	mysqli_stmt_close($stmt1);

	// Close database connection
	mysqli_close($con_app);

?>

	<!DOCTYPE html>
	<html lang="en">
	  <head>
	    <meta charset="utf-8">
			<meta http-equiv="refresh" content="5;url=../index.php">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
			<?php include "includes/config.inc.php" ?>
			<title><?php echo $page_title.' - '.$config['application_name'].' - '.$config['project_acronym'].': '.$config['project_name']; ?></title>
	    <!-- Various CSS and Font links for including -->
	    <link rel="preconnect" href="https://fonts.gstatic.com">
	  	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato&display=swap">
	    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">
	  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	    <!-- Bootstrap core CSS -->
	    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	    <!-- Custom styles for this template -->
	    <link href="../css/signin.css" rel="stylesheet">
	    <link href="../css/registration.css" rel="stylesheet">
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
		      <p>You will now be automatically redirected back to the login page.</p>
		      <p>If you are not redirected automatically, please <a href='../index.php'>click here</a>.</p>

		      <div class="spinner"></div>

		      <div id="spacer"></div>

	      </article>
	      </div>

	     <div class="my-5 text-muted">Copyright © 2021 CEPEH Project</div>

    	<?php include('includes/logos.inc.php'); ?>
	   </div><!--.container-->

	  </body>
	</html>
