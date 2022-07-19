<?php

/**************************************************************
* Application: Educational Chatbot Crowd-based Co-Creation Tool
* File: actions.inc.php
* Created By: James Henderson
* Date: 11/11/2021
**************************************************************/

//include('db_connect/db_connect.inc.php');

function createChatbot() {

	if(isset($_POST['chatbotName'])) {
		$name = ucfirst($_POST['chatbotName']);
	}
	if(isset($_POST['chatbotTopic'])) {
		$topic = ucfirst($_POST['chatbotTopic']);
	}
	if(isset($_POST['chatbotKeywords'])) {
		$keywords = strtolower($_POST['chatbotKeywords']);
	}
	if(isset($_POST['chatbotAuthor'])) {
		$author = $_POST['chatbotAuthor'];
	}
		$creator = $_SESSION['firstname'] . " " .	$_SESSION['surname'];
		$last_updated_by = $creator;

	include('db_connect/db_connect.inc.php');

	// Create prepared statements for safer DB insertion
	$stmt1 = mysqli_prepare($con_app, "INSERT INTO chatbot (name, topic, keywords, author, creator, last_updated_by) VALUES (?,?,?,?,?,?)");

	// Bind the input parameters to the prepared statement
	mysqli_stmt_bind_param($stmt1, "ssssss", $name, $topic, $keywords, $author, $creator, $last_updated_by);

	// Execute prepared statement
 	mysqli_stmt_execute($stmt1);

	$rows_inserted = mysqli_stmt_affected_rows($stmt1);

	if($rows_inserted == 1) {
		//echo "<script type='text/javascript'>alert('Result: $rows_inserted row(s) affected');</script>";
		print "<p class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> The chatbot has been successfully added to the database.</p>";
		$user_id = $_SESSION['id'];
		$sql_update_contributions = "UPDATE user SET contributions = contributions + 1 WHERE id = $user_id";
		mysqli_query($con_app, $sql_update_contributions);
	}
	else {
		//echo "<script type='text/javascript'>alert('Result: $rows_inserted row(s) affected');</script>";
		print("<p class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> The chatbot could not be added to the database. Any related error information will be shown below.</p>");
  	printf("%s\n", mysqli_error($con_app));
	}
	// Close statements
	mysqli_stmt_close($stmt1);

	// Close database connection
	mysqli_close($con_app);
}

function editChatbot() {

	if(isset($_POST['chatbotName'])) {
		$name = ucfirst($_POST['chatbotName']);
	}
	if(isset($_POST['chatbotTopic'])) {
		$topic = ucfirst($_POST['chatbotTopic']);
	}
	if(isset($_POST['chatbotKeywords'])) {
		$keywords = strtolower($_POST['chatbotKeywords']);
	}
	if(isset($_POST['chatbotAuthor'])) {
		$author = $_POST['chatbotAuthor'];
	}
		$last_updated_by = $_SESSION['firstname'] . " " .	$_SESSION['surname'];
		$chatbot_id = $_GET['id'];

	include('db_connect/db_connect.inc.php');

	// Create prepared statements for safer DB insertion

	$stmt1 = mysqli_prepare($con_app, "UPDATE chatbot SET name = ?, topic = ?, keywords = ?, author = ?, last_updated_by = ? WHERE id = ?");

	// Bind the input parameters to the prepared statement
	mysqli_stmt_bind_param($stmt1, "sssssi", $name, $topic, $keywords, $author, $last_updated_by, $chatbot_id);

	// Execute prepared statement
 	mysqli_stmt_execute($stmt1);

	$rows_inserted = mysqli_stmt_affected_rows($stmt1);

	if($rows_inserted == 1) {
		//echo "<script type='text/javascript'>alert('Result: $rows_inserted row(s) affected');</script>";
		//print "<p class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> The chatbot has been successfully updated.</p>";
		echo "<script>location.href='edit.php';</script>";
	}
	else {
		//echo "<script type='text/javascript'>alert('Result: $rows_inserted row(s) affected');</script>";
		print("<p class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> The chatbot could not be updated. Any related error information will be shown below.</p>");
  	printf("%s\n", mysqli_error($con_app));
	}
	// Close statements
	mysqli_stmt_close($stmt1);

	// Close database connection
	mysqli_close($con_app);
}

function verifyChatbot() {

	if(isset($_POST['chatbotName'])) {
		$name = ucfirst($_POST['chatbotName']);
	}
	if(isset($_POST['chatbotTopic'])) {
		$topic = ucfirst($_POST['chatbotTopic']);
	}
	if(isset($_POST['chatbotKeywords'])) {
		$keywords = strtolower($_POST['chatbotKeywords']);
	}
	if(isset($_POST['chatbotAuthor'])) {
		$author = $_POST['chatbotAuthor'];
	}
		$last_updated_by = $_SESSION['firstname'] . " " .	$_SESSION['surname'];
		$chatbot_id = $_GET['id'];

	include('db_connect/db_connect.inc.php');

	// Create prepared statements for safer DB insertion

	// RETURN INTENTS AND RESPONSES INTO 2 COLUMNS WHICH CAN BE EASILY EDITED!!!!


	$stmt1 = mysqli_prepare($con_app, "UPDATE chatbot SET name = ?, topic = ?, keywords = ?, author = ?, last_updated_by = ? WHERE id = ?");

	// Bind the input parameters to the prepared statement
	mysqli_stmt_bind_param($stmt1, "sssssi", $name, $topic, $keywords, $author, $last_updated_by, $chatbot_id);

	// Execute prepared statement
 	mysqli_stmt_execute($stmt1);

	$rows_inserted = mysqli_stmt_affected_rows($stmt1);

	if($rows_inserted == 1) {
		//echo "<script type='text/javascript'>alert('Result: $rows_inserted row(s) affected');</script>";
		//print "<p class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> The chatbot has been successfully updated.</p>";
		echo "<script>location.href='verify.php';</script>";
	}
	else {
		//echo "<script type='text/javascript'>alert('Result: $rows_inserted row(s) affected');</script>";
		print("<p class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> The chatbot can not be verified. Any related error information will be shown below.</p>");
  	printf("%s\n", mysqli_error($con_app));
	}
	// Close statements
	mysqli_stmt_close($stmt1);

	// Close database connection
	mysqli_close($con_app);
}

function deleteChatbot() {
	// Get chatbot 'ID' value
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
	}

	include('db_connect/db_connect.inc.php');

	// Create SQL for multiple table deletion based on referred ID
	$sql_delete_chatbot = "DELETE FROM chatbot WHERE id = $id";

	if (mysqli_query($con_app, $sql_delete_chatbot)) {
		//header("Refresh:0");
		echo "<p class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> The chatbot has been deleted succesfully.</p>";
	}
	else {
		echo "<p class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> The chatbot has not been deleted.</p>";
		echo "Error deleting record: " . mysqli_error($con_app);
	}

mysqli_close($con_app);
}

?>
