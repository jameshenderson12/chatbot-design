<?php

$page_title = 'Edit';
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

				<h1 class="mt-4">Edit chatbot instance</h1>

				<?php

					include('includes/db_connect/db_connect.inc.php');

					$sql_get_all_chatbots = "SELECT * FROM chatbot ORDER BY last_updated DESC";

					$chatbots = mysqli_query($con_app, $sql_get_all_chatbots);
					$sum_chatbots = mysqli_num_rows($chatbots);

					echo "<p class='lead'>There is currently $sum_chatbots chatbot(s) available to edit.</p>"
				?>

				<div class="row">
				<div class="col-md-12">

					<div class="table-responsive">
					<table class="table">
						<thead>
					    <tr>
					      <th scope="col" class="col-md-2">Chatbot Name</th>
								<th scope="col" class="col-md-2">Topic</th>
								<th scope="col" class="col-md-3">Keywords</th>
					      <th scope="col">Author</th>
								<!--<th scope="col">Created By</th>-->
					      <th scope="col">Last Updated By</th>
								<th></th>
					    </tr>
					  </thead>
						<tbody>

							<?php

								while($row = mysqli_fetch_array($chatbots)){
										$id = $row['id'];
										$name = $row['name'];
										$topic = $row['topic'];
										$keywords = explode(",", strtolower($row['keywords']));
										$author = $row['author'];
										$creator = $row['creator'];
										$create_time = date($config['date_format'], strtotime($row['create_time']));
										$last_updated_by = $row['last_updated_by'];
										$last_updated = $row['last_updated'];

									if (isset($row['last_updated'])) {
										$last_updated = date($config['date_format'], strtotime($row['last_updated']));
									}
									else {
										$last_updated = "Never";
									}

									if (isset($row['last_updated_by'])) {
										$last_updated_by = $row['last_updated_by'];
									}
									else {
										$last_updated_by = "Unknown";
									}

								echo "<tr><td><strong>$name</strong></td><td>$topic</td><td>";

								foreach ($keywords as $keyword) {
											echo "<span class='badge bg-light text-dark border border-secondary mx-1'>$keyword</span>";
									}

								echo "</td><td>$author</td><!--<td>$creator<br><font size='-1'>$create_time</font></td>--><td>$last_updated_by<br><font size='-1'>$last_updated</font></td><td><a href=\"editing.php?id=$id\" class='btn btn-primary d-grid gap-2' role='button'><i class='fa fa-edit' aria-hidden='true'></i>
Edit</a>
								</td></tr>";
								}

								mysqli_close($con_app);
							?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<?php include('includes/footer.inc.php'); ?>

  </body>
</html>
