<?php

$page_title = 'Add';
$active_page = basename($_SERVER['PHP_SELF'], ".php");
// Start the session
session_start();
// Check that user should be logged in
if (!(isset($_SESSION['login']) && $_SESSION['login'] != "")) {
	header ("Location: index.php");
}
include('includes/config.inc.php');
include('includes/header.inc.php');

$intentExample_1 = $_SESSION['intentExample_1']; $intentExample_2 = $_SESSION['intentExample_2']; $intentExample_3 = $_SESSION['intentExample_3']; $intentExample_4 = $_SESSION['intentExample_4']; $intentExample_5 = $_SESSION['intentExample_5'];
$intentExample_6 = $_SESSION['intentExample_6']; $intentExample_7 = $_SESSION['intentExample_7']; $intentExample_8 = $_SESSION['intentExample_8']; $intentExample_9 = $_SESSION['intentExample_9']; $intentExample_10 = $_SESSION['intentExample_10'];
$intentExample_11 = $_SESSION['intentExample_11']; $intentExample_12 = $_SESSION['intentExample_12']; $intentExample_13 = $_SESSION['intentExample_13']; $intentExample_14 = $_SESSION['intentExample_14'];	$intentExample_15 = $_SESSION['intentExample_15'];
$intentExample_16 = $_SESSION['intentExample_16']; $intentExample_17 = $_SESSION['intentExample_17']; $intentExample_18 = $_SESSION['intentExample_18']; $intentExample_19 = $_SESSION['intentExample_19'];	$intentExample_20 = $_SESSION['intentExample_20'];
$intentExample_21 = $_SESSION['intentExample_21']; $intentExample_22 = $_SESSION['intentExample_22']; $intentExample_23 = $_SESSION['intentExample_23']; $intentExample_24 = $_SESSION['intentExample_24'];	$intentExample_25 = $_SESSION['intentExample_25'];
$intentExample_26 = $_SESSION['intentExample_26']; $intentExample_27 = $_SESSION['intentExample_27']; $intentExample_28 = $_SESSION['intentExample_28']; $intentExample_29 = $_SESSION['intentExample_29'];	$intentExample_30 = $_SESSION['intentExample_30'];
$keyword = $_SESSION['keyword'];
$chatbot_id = $_GET['cid'];
$added_by = $_SESSION['firstname'] . " " . $_SESSION['surname'];

consoleMsg($_SESSION['keyword']);

foreach($_POST['responseType'] as $response) {
  $type .= "$response, ";
}
	$type = rtrim($type, ", ");

$responseExample_1 = $_POST['responseExample_1'];	$responseExample_2 = $_POST['responseExample_2']; $responseExample_3 = $_POST['responseExample_3'];	$responseExample_4 = $_POST['responseExample_4'];	$responseExample_5 = $_POST['responseExample_5'];
$responseExample_6 = $_POST['responseExample_6']; $responseExample_7 = $_POST['responseExample_7']; $responseExample_8 = $_POST['responseExample_8'];	$responseExample_9 = $_POST['responseExample_9'];	$responseExample_10 = $_POST['responseExample_10'];
$responseExample_11 = $_POST['responseExample_11']; $responseExample_12 = $_POST['responseExample_12']; $responseExample_13 = $_POST['responseExample_13'];	$responseExample_14 = $_POST['responseExample_14'];	$responseExample_15 = $_POST['responseExample_15'];
$responseExample_16 = $_POST['responseExample_16']; $responseExample_17 = $_POST['responseExample_17']; $responseExample_18 = $_POST['responseExample_18'];	$responseExample_19 = $_POST['responseExample_19'];	$responseExample_20 = $_POST['responseExample_20'];
$responseExample_21 = $_POST['responseExample_21']; $responseExample_22 = $_POST['responseExample_22']; $responseExample_23 = $_POST['responseExample_23'];	$responseExample_24 = $_POST['responseExample_24'];	$responseExample_25 = $_POST['responseExample_25'];
$responseExample_26 = $_POST['responseExample_26']; $responseExample_27 = $_POST['responseExample_27']; $responseExample_28 = $_POST['responseExample_28'];	$responseExample_29 = $_POST['responseExample_29'];	$responseExample_30 = $_POST['responseExample_30'];
$notes = $_POST['notes'];

$sql_insert_intent = "
INSERT INTO intent (chatbot_id, keyword, added_by, example_1, example_2, example_3, example_4, example_5, example_6, example_7, example_8, example_9, example_10, example_11, example_12, example_13, example_14, example_15, example_16,
example_17, example_18, example_19, example_20, example_21, example_22, example_23, example_24, example_25, example_26, example_27, example_28, example_29, example_30)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$sql_insert_response = "
INSERT INTO response (chatbot_id, type, added_by, example_1, example_2, example_3, example_4, example_5, example_6, example_7, example_8, example_9, example_10, example_11, example_12, example_13, example_14, example_15, example_16,
example_17, example_18, example_19, example_20, example_21, example_22, example_23, example_24, example_25, example_26, example_27, example_28, example_29, example_30, notes)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

include('includes/db_connect/db_connect.inc.php');

$stmt1 = mysqli_prepare($con_app, $sql_insert_intent);
$stmt2 = mysqli_prepare($con_app, $sql_insert_response);

// Bind the input parameters to the prepared statement
mysqli_stmt_bind_param($stmt1, "issssssssssssssssssssssssssssssss", $chatbot_id, $keyword, $added_by, $intentExample_1, $intentExample_2, $intentExample_3, $intentExample_4, $intentExample_5, $intentExample_6, $intentExample_7, $intentExample_8, $intentExample_9, $intentExample_10, $intentExample_11, $intentExample_12, $intentExample_13, $intentExample_14, $intentExample_15,
$intentExample_16, $intentExample_17, $intentExample_18, $intentExample_19, $intentExample_20, $intentExample_21, $intentExample_22, $intentExample_23, $intentExample_24, $intentExample_25, $intentExample_26, $intentExample_27, $intentExample_28, $intentExample_29, $intentExample_30);


// STMT1 needs to be executed in order to get the auto-generated ID which can be passed to the $intent_id value
// ANOTHER IDEA is to do an INNER_JOIN on both ID fields of intent and response tables to keep linked
//////////////////////////////////////////////////////////////////////////////////////////////////////////


// Bind the input parameters to the prepared statement
mysqli_stmt_bind_param($stmt2, "isssssssssssssssssssssssssssssssss", $chatbot_id, $type, $added_by, $responseExample_1, $responseExample_2, $responseExample_3, $responseExample_4, $responseExample_5, $responseExample_6, $responseExample_7, $responseExample_8, $responseExample_9, $responseExample_10, $responseExample_11, $responseExample_12, $responseExample_13, $responseExample_14, $responseExample_15,
$responseExample_16, $responseExample_17, $responseExample_18, $responseExample_19, $responseExample_20, $responseExample_21, $responseExample_22, $responseExample_23, $responseExample_24, $responseExample_25, $responseExample_26, $responseExample_27, $responseExample_28, $responseExample_29, $responseExample_30, $notes);


// Attempt to execute the prepared statement
if ( (mysqli_stmt_execute($stmt1)) && (mysqli_stmt_execute($stmt2)) ) {
		//echo "<div class='alert alert-success'>Success: Database updated with your examples</div>";
		consoleMsg("Successfully added intent and response to DB");
		//echo "<div class='alert alert-success'>Successfully added detail to database...</div>";

		// Set last_updated_by to current session firstname/surname
		$updater_name = $added_by;
		$user_id = $_SESSION['id'];
		$sql_update_last_updated_by = "UPDATE chatbot SET last_updated_by = '$updater_name' WHERE id = $chatbot_id";
		$sql_update_contributions = "UPDATE user SET contributions = contributions + 1 WHERE id = $user_id";
		mysqli_query($con_app, $sql_update_last_updated_by);
		mysqli_query($con_app, $sql_update_contributions);
}
else {
		//consoleMsg("Failed to add intent to DB");
		//alertMsg(mysqli_error($con_app));
		printf("<div class='alert alert-warning'>Sorry, there has been an error inserting your INTENT and RESPONSE values: %s\n</div>", mysqli_error($con_app));
}

// Close statement and connection
mysqli_stmt_close($stmt1);
mysqli_stmt_close($stmt2);

for ($x = 1; $x <= 30; $x++) {
	$intentExample_x = "intentExample_$x";
	unset($_SESSION[$intentExample_x]);
}

mysqli_close($con_app);

?>

<!-- Custom styles for this template -->
<link href="css/sticky-footer-navbar.css" rel="stylesheet">

  </head>
  <body class="d-flex flex-column h-100">

		<?php include('includes/navbar.inc.php'); ?>

    <!-- Profile Information -->

				<div class="container p-2">
					<h1 class="mt-4">Adding conversation detail</h1>
					<p class="lead">Here you will provide any anticipated responses you would expect from the chatbot given your input.</p>

				</div>

				<div class="container bg-light border border-secondary mb-4 rounded">


					<div class="p-5 mb-4 bg-light rounded-3">
						<div class="container-fluid py-5">
					  	<h1 class="display-5 fw-bold">Thank you, <?php echo $_SESSION['firstname']; ?>.</h1>
					    <p class="col-md-8 fs-4">We would like to say a huge thank you to acknowledge your contribution in providing some conversation detail for <?php echo $name ?>.</p>
					    <a href="add-input1.php?cid=<?= $chatbot_id ?>" class="btn btn-primary btn-lg" type="button">Add more detail to the same chatbot</a>
							<a href="home.php" class="btn btn-primary btn-lg" type="button">Add detail for another chatbot</a>
							<p class="mt-5">If you are able to provide another XX contributions, you will be able to receive a certificate for your records.</p>
							<button class="btn btn-primary btn-lg disabled" type="button">Receive my certificate</button>
					    </div>
					</div>

				</div><!--.container-->


	<?php include('includes/footer.inc.php'); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	</body>
</html>
