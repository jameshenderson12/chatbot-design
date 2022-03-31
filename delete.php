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

<!-- Custom styles for this template -->
<link href="css/sticky-footer-navbar.css" rel="stylesheet">

<style>
.custom-upload {
	margin-bottom: 20px;
}
hr {
	margin: 5px;
	border: 0;
	height: 1px;
	background: #333;
	background-image: linear-gradient(to right, #ccc, #333, #ccc);
}
</style>

  </head>
  <body class="d-flex flex-column h-100">

		<?php include('includes/navbar.inc.php'); ?>

					<!--
					echo "<tr><td><img src='https://ui-avatars.com/api/?background=0D8ABC&color=fff&size=40&rounded=true&name=$firstname+$lastname&font-size=0.5'></td><td><strong>$firstname $lastname</strong><br><font size='-1'>$role</font></td><td>$preference<br><font size='-1'>$property</font></td><td>$last_updated</td><td><a onClick=\"javascript: return confirm('WARNING: You are about to permanently delete the profile of $firstname $lastname.\\n\\nAre you sure? Once deleted, this data cannot be recovered.');\" href=\"remove.php?id=$id\" class='btn btn-danger' role='button'>Delete</a>
					</td></tr>";
					}
				-->

			<div class="container p-2">

				<h1 class="mt-4">Delete chatbot instance</h1>

				<?php

					include('includes/db_connect/db_connect.inc.php');

					$sql_get_all_chatbots = "SELECT * FROM chatbot";

					$chatbots = mysqli_query($con_app, $sql_get_all_chatbots);
					$sum_chatbots = mysqli_num_rows($chatbots);

					echo "<p class='lead'>There is currently $sum_chatbots chatbot(s) available to delete.</p>"

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
										//$last_updated = date("d/m/Y (G:i)", strtotime($row['last_updated']));
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

								echo "</td><td>$author</td><!--<td>$creator<br><font size='-1'>$create_time</font></td>--><td>$last_updated_by<br><font size='-1'>$last_updated</font></td><td><button class='btn btn-danger d-grid gap-2' role='button' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal$id'><i class='fa fa-trash' aria-hidden='true'></i> Delete</button></td></tr>";

								echo "<div class='modal fade' id='confirmDeleteModal$id' tabindex='-1' aria-labelledby='confirmDeleteModalLabel' aria-hidden='true'>
							  <div class='modal-dialog'>
							    <div class='modal-content'>
							      <div class='modal-header'>
							        <h5 class='modal-title' id='confirmDeleteModalLabel'>Confirm Delete (#$id)</h5>
							        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
							      </div>
							      <div class='modal-body'>
							        <p>Are you sure you would like to delete the $topic chatbot called $name?</p>
											<p>Once deleted, this data cannot be recovered.</p>
							      </div>
							      <div class='modal-footer'>
											<form method='post' action='delete.php?id=$id'>
							        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
							        <button type='submit' name='submit' class='btn btn-danger'>Delete</button>
											</form>
							      </div>
							    </div>
							  </div>
							</div>";

							if(isset($_POST['submit'])) { //check if form was submitted
								include('includes/action.inc.php');
								deleteChatbot();
							}
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

	<script>
	$.ajax({
    type: "POST",
    url: "delete.php",
    data: "id="+id,
    success: function(){
        row.fadeOut(1000, function(){
            row.remove();
        });
    }
	});
	</script>

  </body>
</html>
