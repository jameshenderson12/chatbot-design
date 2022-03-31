<?php

$page_title = 'New';
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

				<div class="container p-2">

					<?php

							if(isset($_POST['submit'])) { //check if form was submitted
								if ((isset($_POST['chatbotName'])) && (isset($_POST['chatbotTopic'])) && (isset($_POST['chatbotKeywords'])) && (isset($_POST['chatbotAuthor']))) {
									include('includes/action.inc.php');
									createChatbot();
								}
							}
					?>

					<h1 class="mt-4">New chatbot instance</h1>
					<p class="lead">Create a new instance of a chatbot for which data can be subsequently added.</p>

				</div>

				<div class="container bg-light border border-secondary">
					<form class="" method="post" action="new.php">
						<div class="row mb-3">
							<div class="col-md-7 bg-secondary text-light"><h4>Administration input</h4></div>
							<div class="col-md-5 bg-secondary text-light"><h4>Examples</h4></div>
						</div>
						<div class="row mb-5">
							<div class="col-md-7">
							  <label for="chatbotName" class="form-label"><strong>1. Provide a name for the new chatbot:</strong></label>
							  <input type="text" class="form-control" id="chatbotName" name="chatbotName" placeholder="">
								<div id="nameHelp" class="form-text small">This needs to be unique. Enter a name to check if available.</div>
							</div>
							<div class="col-md-5 bg-light">
								<p class="p-0 m-0">
									<em>A human name such as "Alison", "Elena", "George" or "Peter".
									<br>A mechanical or technical sounding name such as "JBot22" or "SupportBot2000".
									<br>An abbreviation of name or topic such as "CYBERSEC" or "GEOCHAT".</em>
								</p>
							</div>
						</div>
						<div class="row mb-5">
							<div class="col-md-7">
								<label for="chatbotTopic" class="form-label"><strong>2. Provide the subject area or topic for the new chatbot:</strong></label>
								<input type="text" class="form-control" placeholder="" id="chatbotTopic" name="chatbotTopic">
								<!--<div id="emailHelp" class="form-text small">We'll never share your email with anyone else.</div>-->
							</div>
							<div class="col-md-5 bg-light">
								<p class="p-0 m-0">
									<em>Cybersecurity
									<br>Healthcare assistant
									<br>Critical appraisal</em>
								</p>
							</div>
						</div><!--.row-->
						<div class="row mb-5">
							<div class="col-md-7">
								<label for="chatbotAuthor" class="form-label"><strong>3. Provide the name of lead author (responsible for content) for the new chatbot:</strong></label>
								<input type="text" class="form-control" placeholder="" id="chatbotAuthor" name="chatbotAuthor">
								<!--<div id="emailHelp" class="form-text small">We'll never share your email with anyone else.</div>-->
							</div>
							<div class="col-md-5 bg-light">
								<p class="p-0 m-0">
									<em>Stathis Konstantinidis
									<br>Matthew Pears
									<br>James Henderson</em>
								</p>
							</div>
						</div><!--.row-->
						<div class="row mb-5">
							<div class="col-md-7">
							  <label for="" class="form-label"><strong>4. Provide a short list of keywords to summarise this new chatbot:</strong></label>
							  <input type="text" class="form-control" id="chatbotKeywords" placeholder="" id="chatbotKeywords" name="chatbotKeywords">
								<div id="keywordsHelp" class="form-text small">Separate listed words with a comma.</div>
							</div>
							<div class="col-md-5 bg-light">
								<p class="p-0 m-0">
									<em>Cybersecurity, online, safety, security, protection, users, learning
									<br>Healthcare, assistant, help, support, health, clinical, practice, learning
									<br>Critical, appraisal, research, literature, dissertation, thesis, review</em>
								</p>
							</div>
						</div><!--.row-->
						<div class="row mb-5">
							<div class="col-md-7">
							  <button class="btn btn-primary col-md-3" name="submit" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
								<button class="btn btn-outline-secondary col-md-3" type="reset"><i class="fa fa-repeat" aria-hidden="true"></i> Reset</button>
							</div>
							<!--<div class="col-md-5 bg-light">
								<button class="btn btn-warning col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#helpModal">Help</button>
							</div>-->
						</div><!--.row-->
					</form>
				</div><!--.container-->

    </div><!--.container-->
	</div>

	<!-- Help Modal -->
	<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="helpModalLabel">Help creating a new chatbot</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
					<p><strong>Hints/tips</strong></p>
					<ul>
						<li>Enter a unique name for the chatbot instance</li>
					</ul>
	      </div>
				<!--
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
			-->
	    </div>
	  </div>
	</div>

	<?php include('includes/footer.inc.php'); ?>

	</body>
</html>
