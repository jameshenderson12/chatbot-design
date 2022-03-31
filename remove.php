<?php

$page_title = 'Delete';
$active_page = basename($_SERVER['PHP_SELF'], ".php");
// Start the session
session_start();
// Check that user should be logged in
if (!(isset($_SESSION['login']) && $_SESSION['login'] != "")) {
	header ("Location: index.php");
}
include('includes/config.inc.php');
include('includes/header.inc.php');

?>

  </head>
  <body>

<?php include('includes/main_nav.inc.php'); ?>

    <!-- Profile Information -->
    <div class="container">
     	<div class="row">
			<div class="col-md-12">
       			<div class="page-header">
	        		<h1 class="profileHeading">Administration</h1>
					<h2 class="profileSubHeading text-uppercase">Delete an existing profile</h2>
				</div>

				<?php
					include('includes/action.inc.php');
					deleteProfile();
				?>
																											
				<a class="btn btn-default" href="delete.php" role="button">Delete another profile</a>
				<a class="btn btn-default" href="home.php" role="button">Return to home page</a>
			</div><!--.col-md-12-->
		</div><!--.row-->

    </div><!--.container-->

<?php include('includes/footer.inc.php'); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
