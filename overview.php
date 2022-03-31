<?php

$page_title = 'Overview';
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

<!-- Custom styles for this template -->
<link href="css/sticky-footer-navbar.css" rel="stylesheet">

  </head>
  <body class="d-flex flex-column h-100">

		<?php include('includes/navbar.inc.php'); ?>

		<div class="container p-2">

			<h1 class="mt-4">Application Overview</h1>
			<p class="lead">A simple overview of the application data for administrative reference.</p>

	<?php

	include('includes/db_connect/db_connect.inc.php');

	$sql_get_user_count = "SELECT COUNT(*) AS no_of_users FROM user";
	$sql_get_chatbot_count = "SELECT COUNT(*) AS no_of_chatbots FROM chatbot";
	$sql_get_intent_count = "SELECT COUNT(*) AS no_of_intents FROM intent";
	$sql_get_response_count = "SELECT COUNT(*) AS no_of_responses FROM response";
	$sql_get_latest_user = "SELECT firstname, surname, user_type FROM user ORDER BY create_time DESC LIMIT 1";
	$sql_get_last_contribution = "SELECT last_updated, last_updated_by FROM chatbot ORDER BY last_updated DESC LIMIT 1";
	$user_count = mysqli_query($con_app, $sql_get_user_count);
	$chatbot_count = mysqli_query($con_app, $sql_get_chatbot_count);
	$intent_count = mysqli_query($con_app, $sql_get_intent_count);
	$response_count = mysqli_query($con_app, $sql_get_response_count);
	while ($row = mysqli_fetch_assoc($user_count)) {
		$no_of_users = $row["no_of_users"];
	}
	while ($row = mysqli_fetch_assoc($chatbot_count)) {
		$no_of_chatbots = $row["no_of_chatbots"];
	}
	while ($row = mysqli_fetch_assoc($intent_count)) {
		$no_of_intents = $row["no_of_intents"];
	}
	while ($row = mysqli_fetch_assoc($response_count)) {
		$no_of_responses = $row["no_of_responses"];
	}

	$latest_user = mysqli_fetch_assoc(mysqli_query($con_app, $sql_get_latest_user));
  $latest_user_added = $latest_user['firstname']. " " .$latest_user['surname']. " (" .rtrim($latest_user['user_type']).") ";

	$last_contribution = mysqli_fetch_assoc(mysqli_query($con_app, $sql_get_last_contribution));
	$last_contribution_made = date($config['date_format'], strtotime($last_contribution['last_updated']));
	$last_contribution_made_by = $last_contribution['last_updated_by'];

//	$mysql_info = mysqli_get_server_info($con_app));

	mysqli_close($con_app);

	// Function to get the client IP address
	function get_client_ip() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

?>
			<div class="table-responsive">
				<table class="table table-striped">
				<tr>
					<th scope="row">Application Name</th>
					<td><?php echo $config['application_name']; ?></td>
				</tr>
				<tr>
					<th scope="row">Version</th>
					<td><?php echo $config['application_version']; ?></td>
				</tr>
				<tr>
					<th scope="row">Developer</th>
					<td><?php echo $config['developer']; ?></td>
				</tr>
				<tr>
					<th scope="row">Last Updated</th>
					<td><?php echo $config['last_update']; ?></td>
				</tr>
				<tr>
					<th scope="row">Base URL</th>
					<td><?php echo $config['base_url']; ?></td>
				</tr>
				<tr>
					<th scope="row">Server &amp; Client IP</th>
					<td><?php echo $_SERVER['SERVER_ADDR']; ?> / <?php print_r(get_client_ip()); ?></td>
				</tr>
				<tr>
					<th scope="row">OS &amp; Host Name</th>
					<td><?php echo php_uname(); ?></td>
				</tr>
				<tr>
					<th scope="row">PHP Version</th>
					<td><?php echo phpversion(); ?></td>
				</tr>
				<tr>
					<th scope="row">MySQL Version</th>
					<td>Unknown <!--<?php printf("Server version: %s\n", mysqli_get_server_info($con_app)); ?>--></td>
				</tr>
				<tr>
					<th scope="row">Chatbots Recorded</th>
					<td><?php echo $no_of_chatbots; ?></td>
				</tr>
				<tr>
					<th scope="row">Intents Recorded</th>
					<td><?php echo $no_of_intents; ?></td>
				</tr>
				<tr>
					<th scope="row">Responses Recorded</th>
					<td><?php echo $no_of_responses; ?></td>
				</tr>
				<tr>
					<th scope="row">Users Recorded</th>
					<td><?php echo $no_of_users; ?></td>
				</tr>
				<tr>
					<th scope="row">Latest User</th>
					<td><?php echo $latest_user_added; ?></td>
				</tr>
				<tr>
					<th scope="row">Last Contribution</th>
					<td><?php echo $last_contribution_made_by . " " . $last_contribution_made; ?></td>
				</tr>
				</table>
			</div>

    </div><!--.container-->

		<?php include('includes/footer.inc.php'); ?>

  </body>
</html>
