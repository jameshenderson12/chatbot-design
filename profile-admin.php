<?php

$page_title = 'Profile';
$active_page = basename($_SERVER['PHP_SELF'], ".php");
// Start the session
session_start();
// Check that user should be logged in
if (!(isset($_SESSION['login']) && $_SESSION['login'] != "")) {
	header ("Location: index.php");
}
include('includes/config.inc.php');
include('includes/header.inc.php');
//include('includes/db_connect/db_connect.inc.php');

?>

  </head>
  <body>

<?php include('includes/main_nav.inc.php'); ?>

<?php

	include('includes/db_connect/db_connect.inc.php');

	if(isset($_GET['id'])){
		// Set up variable to capture result of SQL query to retrieve data from database tables
		// WHERE id='".$_GET["id"]."'";
		$sql_getuserinfo = "SELECT * FROM overview WHERE id = '".$_GET["id"]."'";

		$userdata = mysqli_fetch_assoc(mysqli_query($con_ro, $sql_getuserinfo));

		$firstname = ucfirst($userdata["firstname"]);
		$lastname = ucfirst($userdata["lastname"]);
		if (($firstname) && ($lastname)) {
			$initials = substr($firstname, 0, 1). "" . substr($lastname, 0, 1);
		}
		$role = $userdata["role"];
		$description = $userdata["description"];
		$age = $userdata["age_range"];
		$ethnic_bg = $userdata["ethnic_background"];
		$gender = $userdata["gender"];
		$added = date($config['date_format'], strtotime($userdata["added"]));
		$admin = $config["admin_user"];
	}
	else {
		echo "<script type='text/javascript'>alert('No profiles found with this ID number!');</script>";
	}

	mysqli_close($con_ro);
?>

    <!-- Profile Information -->
    <div class="container">
     	<div class="row">
			<div class="col-md-3">
			 	<img id="profileImage" class="profile img-circle">
			</div>
       		<div class="col-md-8">
       			<div class="page-header">
	        		<h1 class="profileHeading"><?php echo $firstname . " " . $lastname; ?></h1>
					<h2 class="profileSubHeading text-uppercase"><?php echo $role; ?></h2>
				</div>
				<p><?php echo $description; ?></p><p class="small text-muted text-right">Added to database on <?php echo $added; ?></p><br>
			</div>
		</div>

     	<!-- Contact Information -->
     	<div class="row">
     		<div class="col-md-6">
     		<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h2 class="panel-title"><span class="glyphicon glyphicon-user"></span> Overview</h2>
				</div>
			  	<div class="panel-body">
			  	<table class="table table-condensed table-striped table-responsive" style="padding: 0px; margin: 0px; border: none;">
			  	<tr>
					<td>Age Range:</td>
					<td><?php echo $age; ?></td>
				</tr>
				<tr>
					<td>Ethnic Background:</td>
					<td><?php echo $ethnic_bg; ?></td>
				</tr>
				<tr>
					<td>Gender:</td>
					<td>Profile gender</td>
				</tr>
				<tr>
					<td>Condition/Illness:</td>
					<td>Profile condition/illness yes/no</td>
				</tr>
				<tr>
					<td>Email:</td>
					<td>Profile email address</td>
				</tr>
				<tr>
					<td>Mobile Phone:</td>
					<td>Profile mobile no.</td>
				</tr>
				<tr>
					<td>Other Phone:</td>
					<td>Profile other phone no.</td>
				</tr>
				<tr>
					<td>Address:</td>
					<td>Profile address line 1<br>Profile address line 2<br>Profile address line 3<br></td>
				</tr>
				<tr>
					<td>City/Town:</td>
					<td>Profile city/town<br></td>
				</tr>
				<tr>
					<td>Country:</td>
					<td>Profile country</td>
				</tr>
				<tr>
					<td>Postcode:</td>
					<td>Profile postcode</td>
				</tr>
				<tr>
					<td>Contact Preference:</td>
					<td>Profile contact preference</td>
				</tr>
			  	</table>

			  	</div>
			</div>

     		<!-- Organisational Identity -->
     		<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h2 class="panel-title"><span class="glyphicon glyphicon-tower"></span> Organisational Identity</h2>
				</div>
			  	<div class="panel-body">

			  	<table class="table table-condensed table-responsive" style="padding: 0px; margin: 0px; border: none;">
			  	<tr>
					<td>Start Date:</td>
					<td>Profile start date</td>
				</tr>
				<tr>
					<td>End Date:</td>
					<td>Profile end date (N/A if still on scheme)</td>
				</tr>
				<tr>
					<td>Divisional Affiliation:</td>
					<td>Profile divisional affiliation</td>
				</tr>
				<tr>
					<td>Member of Group(s):</td>
					<td>Profile group membership</td>
				</tr>
				<tr>
					<td>Other Group(s):</td>
					<td>Profile other group membership</td>
				</tr>
				<tr>
					<td>University Username:</td>
					<td>Profile UoN username</td>
				</tr>
				<tr>
					<td>Casual Workers Scheme:</td>
					<td>Profile registered on scheme yes/no</td>
				</tr>
				<tr>
					<td>Payroll ID:</td>
					<td>Profile payroll ID</td>
				</tr>
				<tr>
					<td>Assignment ID:</td>
					<td>Profile assignment ID</td>
				</tr>
				<tr>
					<td>Assignment ID Start Date:</td>
					<td>Profile assignment ID start date</td>
				</tr>
				<tr>
					<td>Assignment ID End Date:</td>
					<td>Profile assignment ID end date</td>
				</tr>
			  	</table>

			  	</div>
			</div>
			</div>

     		<div class="col-md-6">
			<!-- Areas of Experience/Interest -->
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h2 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> Areas of Experience/Interest</h2>
				</div>
			  	<div class="panel-body">
			  		<ul>
						<li>Profile area of experience/interest 01</li>
						<li>Profile area of experience/interest 02</li>
						<li>Profile area of experience/interest 03</li>
					</ul>
			  	</div>
			</div>

			<!-- Types of Work Interest -->
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h2 class="panel-title"><span class="glyphicon glyphicon-briefcase"></span> Types of Work Interested In</h2>
				</div>
			  	<div class="panel-body">
			  		<ul>
						<li>Profile type of work interested in 01</li>
						<li>Profile type of work interested in 02</li>
						<li>Profile type of work interested in 03</li>
					</ul>
			  	</div>
			</div>

			<!-- Additional Requirements -->
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h2 class="panel-title"><span class="glyphicon glyphicon-info-sign"></span> Additional Requirements</h2>
				</div>
			  	<div class="panel-body">

				<p>Description of additional requirements...</p>
			  	</div>
			</div>
			</div>


		</div>

    </div><!--.container-->

<?php include('includes/footer.inc.php'); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/initial.js-master/initial.js"></script>
	<script>
		$('.profile').initial({charCount:2, name:"<?php echo $initials ?>", width:150, height:150});
	</script>
  </body>
</html>
