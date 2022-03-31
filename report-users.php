<?php

$page_title = 'User Report';
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

			<h1 class="mt-4">User Report</h1>
			<p class="lead">A simple report showing the users of this system and their roles.</p>

			<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th scope="col" class="col-md-3">Name</th>
						<th scope="col" class="col-md-2">Role</th>
						<th scope="col" class="col-md-2">Location</th>
						<th scope="col" class="col-md-2">Registered Date</th>
						<th scope="col" class="col-md-2">Last Login Date</th>
						<th scope="col" class="col-md-1">Contributions</th>
					</tr>
				</thead>
				<tbody>

				<?php

				include('includes/db_connect/db_connect.inc.php');

				//$background = 'background=0D8ABC';
				$sql_get_all_users = "SELECT * FROM user ORDER BY create_time DESC LIMIT 100";
				$all_users = mysqli_query($con_app, $sql_get_all_users);

				while($row = mysqli_fetch_array($all_users)) {
						$id = $row['id'];
						$firstname = $row['firstname'];
						$surname = $row['surname'];
						$username = $row['username'];
						$email = $row['email'];
						$user_type = $row['user_type'];
						$location = $row['location'];
						$create_time = date($config['date_format'], strtotime($row['create_time']));
						$last_login = date($config['date_format'], strtotime($row['last_login']));;
						$contributions = $row['contributions'];

						if (isset($row['last_updated'])) {
							$last_updated = date("d/m/Y", strtotime($row['last_updated']));
						}
						else {
							$last_updated = "Never";
						}

						if (isset($row['contributions'])) {
							if ($row['contributions'] >= 10) {
								$background = 'af9500';
							}
							else if ($row['contributions'] >= 5) {
								$background = 'b4b4b4';
							}
							else if ($row['contributions'] >= 2) {
								$background = '6a3805';
							}
							else {
								$background = '0D8ABC';
							}
						}

						echo "<tr><td><strong>$firstname $surname</strong> ($username)<br><font size='-1'>$email</font></td><td>$user_type</td><td>$location</td><td>$create_time</td><td>$last_login</td><td class='text-center'><img src='https://eu.ui-avatars.com/api/?background=$background&color=fff&size=40&rounded=true&name=$contributions&font-size=0.5'></td></tr>";
				}
				mysqli_close($con_app);
				?>

				</tbody>
			</table>
			</div>

  	</div><!--.container-->

		<?php include('includes/footer.inc.php'); ?>

  </body>
</html>
