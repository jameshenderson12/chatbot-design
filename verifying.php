<?php

$page_title = 'Verify';
$active_page = basename($_SERVER['PHP_SELF'], ".php");
// Start the session
session_start();
// Check that user should be logged in
if (!(isset($_SESSION['login']) && $_SESSION['login'] != "")) {
	header ("Location: index.php");
}
if(isset($_POST['submit'])) { // check if form was submitted
	if ((isset($_POST['chatbotName'])) && (isset($_POST['chatbotTopic'])) && (isset($_POST['chatbotKeywords'])) && (isset($_POST['chatbotAuthor']))) {
		include('includes/action.inc.php');
		verifyChatbot();
		header("Location: verify.php");
		exit; // Location header is set, stop the script
	}
}
include('includes/config.inc.php');
include('includes/header.inc.php');
include('includes/db_connect/db_connect.inc.php');
$sql_get_chatbot_info = "SELECT * FROM chatbot WHERE id = $_GET[id]";
$get_chatbot_info = mysqli_query($con_app, $sql_get_chatbot_info);
while($row = mysqli_fetch_array($get_chatbot_info)){
		$id = $row['id'];
		$name = $row['name'];
		$topic = $row['topic'];
		$keywords = $row['keywords'];
		$author = $row['author'];
	}
mysqli_close($con_app);
?>

<!-- Custom styles for this template -->
<link href="css/sticky-footer-navbar.css" rel="stylesheet">

  </head>
  <body class="d-flex flex-column h-100">

		<?php include('includes/navbar.inc.php'); ?>

				<div class="container p-2">

					<h1 class="mt-4">Verify chatbot data</h1>
					<p class="lead">Verify the data for this existing chatbot.</p>

				</div>

				<div class="container bg-light border border-secondary">
					<form id="verifyForm" method="POST">
						<div class="row mb-3">
							<div class="col-md-6 bg-secondary text-light"><h4>Intents</h4></div>
							<div class="col-md-6 bg-secondary text-light"><h4>Responses</h4></div>
						</div>
						<div class="row mb-5">
							<div class="col-md-6">
							  <label for="chatbotName" class="form-label"><strong>1. Provide a name for the new chatbot:</strong></label>
							  <input type="text" class="form-control" id="chatbotName" name="chatbotName" value="<?php echo $name ?>">
								<div id="nameHelp" class="form-text small">This needs to be unique. Enter a name to check if available.</div>
							</div>
							<div class="col-md-6 bg-light">
								<p class="p-0 m-0">
									<em>A human name such as "Alison", "Elena", "George" or "Peter".
									<br>A mechanical or technical sounding name such as "JBot22" or "SupportBot2000".
									<br>An abbreviation of name or topic such as "CYBERSEC" or "GEOCHAT".</em>
								</p>
							</div>
						</div>
						<div class="row mb-5">
							<div class="col-md-6">
								<label for="chatbotTopic" class="form-label"><strong>2. Provide the subject area or topic for the new chatbot:</strong></label>
								<input type="text" class="form-control" value="<?php echo $topic ?>" id="chatbotTopic" name="chatbotTopic">
								<!--<div id="emailHelp" class="form-text small">We'll never share your email with anyone else.</div>-->
							</div>
							<div class="col-md-6 bg-light">
								<p class="p-0 m-0">
									<em>Cybersecurity
									<br>Healthcare assistant
									<br>Critical appraisal</em>
								</p>
							</div>
						</div><!--.row-->
						<div class="row mb-5">
							<div class="col-md-6">
								<label for="chatbotAuthor" class="form-label"><strong>3. Provide the name of lead author (responsible for content) for the new chatbot:</strong></label>
								<input type="text" class="form-control" value="<?php echo $author ?>" id="chatbotAuthor" name="chatbotAuthor">
								<!--<div id="emailHelp" class="form-text small">We'll never share your email with anyone else.</div>-->
							</div>
							<div class="col-md-6 bg-light">
								<p class="p-0 m-0">
									<em>Stathis Konstantinidis
									<br>Matthew Pears
									<br>James Henderson</em>
								</p>
							</div>
						</div><!--.row-->
						<div class="row mb-5">
							<div class="col-md-6">
							  <label for="" class="form-label"><strong>4. Provide a short list of keywords to summarise this new chatbot:</strong></label>
							  <input type="text" class="form-control" id="chatbotKeywords" value="<?php echo $keywords ?>" id="chatbotKeywords" name="chatbotKeywords">
								<div id="keywordsHelp" class="form-text small">Separate listed words with a comma.</div>
							</div>
							<div class="col-md-6 bg-light">
								<p class="p-0 m-0">
									<em>Cybersecurity, online, safety, security, protection, users, learning
									<br>Healthcare, assistant, help, support, health, clinical, practice, learning
									<br>Critical, appraisal, research, literature, dissertation, thesis, review</em>
								</p>
							</div>
						</div><!--.row-->
						<div class="row mb-5">
							<div class="col-md-6">
							  <button class="btn btn-primary col-md-3" name="submit" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Update</button>
								<button class="btn btn-outline-secondary col-md-3" type="reset"><i class="fa fa-repeat" aria-hidden="true"></i> Reset</button>
							</div>
							<!--
							<div class="col-md-5 bg-light">
								<button class="btn btn-secondary col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#helpModal">Help</button>
							</div>-->
						</div><!--.row-->
					</form>
				</div><!--.container-->

	<?php include('includes/footer.inc.php'); ?>

	</body>
</html>
