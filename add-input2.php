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

$_SESSION['intentExample_1'] = $_POST['intentExample_1'];	$_SESSION['intentExample_2'] = $_POST['intentExample_2']; $_SESSION['intentExample_3'] = $_POST['intentExample_3'];	$_SESSION['intentExample_4'] = $_POST['intentExample_4'];	$_SESSION['intentExample_5'] = $_POST['intentExample_5'];
$_SESSION['intentExample_6'] = $_POST['intentExample_6']; $_SESSION['intentExample_7'] = $_POST['intentExample_7']; $_SESSION['intentExample_8'] = $_POST['intentExample_8'];	$_SESSION['intentExample_9'] = $_POST['intentExample_9'];	$_SESSION['intentExample_10'] = $_POST['intentExample_10'];
$_SESSION['intentExample_11'] = $_POST['intentExample_11']; $_SESSION['intentExample_12'] = $_POST['intentExample_12']; $_SESSION['intentExample_13'] = $_POST['intentExample_13'];	$_SESSION['intentExample_14'] = $_POST['intentExample_14'];	$_SESSION['intentExample_15'] = $_POST['intentExample_15'];
$_SESSION['intentExample_16'] = $_POST['intentExample_16']; $_SESSION['intentExample_17'] = $_POST['intentExample_17']; $_SESSION['intentExample_18'] = $_POST['intentExample_18'];	$_SESSION['intentExample_19'] = $_POST['intentExample_19'];	$_SESSION['intentExample_20'] = $_POST['intentExample_20'];
$_SESSION['intentExample_21'] = $_POST['intentExample_21']; $_SESSION['intentExample_22'] = $_POST['intentExample_22']; $_SESSION['intentExample_23'] = $_POST['intentExample_23'];	$_SESSION['intentExample_24'] = $_POST['intentExample_24'];	$_SESSION['intentExample_25'] = $_POST['intentExample_25'];
$_SESSION['intentExample_26'] = $_POST['intentExample_26']; $_SESSION['intentExample_27'] = $_POST['intentExample_27']; $_SESSION['intentExample_28'] = $_POST['intentExample_28'];	$_SESSION['intentExample_29'] = $_POST['intentExample_29'];	$_SESSION['intentExample_30'] = $_POST['intentExample_30'];
$_SESSION['keyword'] = strtolower(TRIM($_POST['keyword']));
$chatbot_id = $_GET['cid'];

?>

<!-- Custom styles for this template -->
<link href="css/sticky-footer-navbar.css" rel="stylesheet">

<style>
table {
	font-size: 0.9rem;
}

@media (max-width: 575.98px) {
	div h3 {
		display: none !important;
	}
	.container {
		border: none !important;
	}
	.card-title span {
		border: none !important;
	}
}
</style>

  </head>
  <body class="d-flex flex-column h-100">

		<?php include('includes/navbar.inc.php'); ?>

    <!-- Profile Information -->

				<div class="container p-2">
					<h1 class="mt-4">Adding conversation detail</h1>
					<p class="lead">Step 2. Here you will provide any anticipated responses you would expect from the chatbot given your input.</p>

					<?php

						include('includes/db_connect/db_connect.inc.php');

						$sql_get_chatbot = "SELECT * FROM chatbot	WHERE id = $chatbot_id";
						$result = mysqli_query($con_app, $sql_get_chatbot);

						while($row = mysqli_fetch_array($result)){
								$name = $row['name'];
								$topic = $row['topic'];
								$author = $row['author'];
								$last_updated_by = $row['last_updated_by'];
								$last_updated = $row['last_updated'];

								if (isset($row['last_updated'])) {
									$last_updated = date($config['date_format'], strtotime($row['last_updated']));
								}
								else {
									$last_updated = "Never";
								}
						}

						for ($x = 1; $x <= 30; $x++) {
							$example_x = "intentExample_$x";
							//debug_to_console($example_x);
							if (isset($_SESSION[$example_x])) {
								$example_x = $_SESSION[$example_x];
								$examples .= "'$example_x', ";
							}
						}
						$examples = rtrim($examples, ", ");
						$keyword = $_SESSION['keyword'];

							echo "<div class='card'>
										<div class='row g-0'>
    								<div class='col-md-2'>
      							<img src='img/bot-4878002_640.png' class='img-fluid rounded-start' alt='Chatbot giving responses'>
    								</div>
    								<div class='col-md-10'>
      							<div class='card-body'>
        						<h5 class='card-title mb-4' style='color: #5D70CD;'><span style='border: #9CB8FF 1px solid; border-radius: 10px; padding: 5px;'><i class='fa fa-commenting'></i> &quot;Can you help me form some suitable responses for you?&quot;</span></h5>
        						<p class='card-text'>$name is a chatbot on the topic of $topic.<br><small class='text-muted'>Last updated by $last_updated_by on $last_updated</small></p>
										<p>Your intention (keyword): <strong>$keyword</strong><br>Your examples of question/statement(s): $examples</p>";
										//print_r($examples_array);
							echo "</div>
    								</div>
  									</div>
										</div>";

					mysqli_close($con_app);
				?>

				</div>

				<div class="container bg-light border border-secondary mb-4">
					<form name="responseForm" method="post" action="add-input3.php?cid=<?php echo $chatbot_id; ?>" onsubmit="return validateForm()">
						<div class="row mb-3">
							<div class="col-md-6 bg-secondary text-light"><h3>Anticipated responses</h3></div>
							<div class="col-md-6 bg-secondary text-light"><h3>Examples</h3></div>
						</div>
						<div class="row mb-5">
							<div class="col-md-6">
								<label for="" class="form-label"><strong>3. Suggest the type(s) of response you would expect from the chatbot:</strong></label>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="statement" id="responseStatement" name="responseType[]">
										<label class="form-check-label" for="responseStatement">
											A simple statement
										</label>
									</div>
									<div class="form-check">
									  <input class="form-check-input" type="checkbox" value="image" id="responseImage" name="responseType[]">
									  <label class="form-check-label" for="responseImage">
									    An image
									  </label>
									</div>
									<div class="form-check">
									  <input class="form-check-input" type="checkbox" value="URL" id="responseURL" name="responseType[]">
									  <label class="form-check-label" for="responseURL">
									    A web link (URL)
									  </label>
									</div>
									<div class="form-check">
									  <input class="form-check-input" type="checkbox" value="buttons" id="responseButtons" name="responseType[]">
									  <label class="form-check-label" for="responseButtons">
									    A group of buttons offering a choice
									  </label>
									</div>
									<div class="form-check">
									  <input class="form-check-input" type="checkbox" value="question" id="responseQuestion" name="responseType[]">
									  <label class="form-check-label" for="responseQuestion">
									    A question to seek clarification of your intent
									  </label>
									</div>
									<div class="form-check">
									  <input class="form-check-input" type="checkbox" value="form" id="responseForm" name="responseType[]">
									  <label class="form-check-label" for="responseForm">
									    A form to capture specific user (learner) input
									  </label>
									</div>
								<!--<div id="emailHelp" class="form-text small">We'll never share your email with anyone else.</div>-->
							</div>
							<div class="col-md-6 bg-light">
								<table class="table table-sm table-bordered">
									<thead>
										<th width="65%">Explanation</th>
										<th width="35%">Specific examples</th>
									</thead>
									<tbody>
										<tr>
											<td>A simple statement is a plain text response to a user usually of one or more words/sentences.</td>
											<td><code>Great, let's carry on.</code></td>
										</tr>
										<tr>
											<td>An image includes the use of a graphic, diagram or photo to illustrate meaning to the user.</td>
											<td><img src="img/skin-screenshot.png" class="img-fluid" alt="Skin layers"></td>
										</tr>
										<tr>
											<td>A web link (URL) offers the user the chance to view related information in an external resource.</td>
											<td><code>Please see this journal article {...}.</code></td>
										</tr>
										<tr>
											<td>A group of buttons offer interactive choice that the user can select to guide the conversation.</td>
											<td><code>True/False<br>Yes/No</code></td>
										</tr>
										<tr>
											<td>A question to seek clarification may be useful to remove any potential ambiguity.</td>
											<td><code>Did you mean Windows the operating system?</code></td>
										</tr>
										<tr>
											<td>A form may be useful to capture appropriate user input for questionnaires and quizzes.</td>
											<td><code>How would you rate {...}?</code></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div><!--.row-->
						<div class="row mb-5">
							<div class="col-md-6">
								<label for="responseExample_1" class="form-label"><strong>4. Provide any variety of responses you would expect from the chatbot:</strong></label>

								<div class="field_wrapper form-group row">
									<div>
										<input type="text" name="responseExample_1" class="form-control" id="responseExample_1">
										<div id="emailHelp" class="form-text small">Add more or remove entries.</div>

										<a href="javascript:void(0);" class="add_button btn btn-sm btn-primary mb-2 mr-2"><i class="fa fa-plus"></i></a>
										<a href='javascript:void(0);' class='remove_button btn btn-sm btn-danger mb-2 mr-2 disabled'><i class='fa fa-minus'></i></a>
									</div>
								</div>

							</div>
							<div class="col-md-6 bg-light">
								<table class="table table-sm table-bordered">
									<thead>
										<th width="50%"># 5</th>
										<th width="50%"># 6</th>
									</thead>
									<tbody>
										<tr>
											<td><code>My name is HELMsBot501. Nice to meet you.</code></td>
											<td><code>In simple terms, a literature review is a piece of academic writing.</code></td>
										</tr>
										<tr>
											<td>Alternatives:
												<code>
													<br>My name is just A_Chatbot.
													<br>I'm a chatbot, I don't have a human name.
													<br>You can call me whatever you like as long as it is kind!
												</code>
											</td>
											<td>Alternatives:
												<code>
													<br>A literature review is a search and evaluation of the available literature in your given subject or chosen topic area.
													<br>Literature reviews include critical evaluations of the subject material.
													<br>A literature review establishes understanding of current research in a particular field before carrying out a new investigation.
												</code>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div><!--.row-->
						<div class="row mb-5">
							<div class="col-md-6">
							  <label for="" class="form-label"><strong>5. Any other notes or comments?</strong></label>
							  <textarea class="form-control" id="" placeholder="" rows="2"></textarea>
								<!--<div id="emailHelp" class="form-text small">Separate listed words with a comma.</div>-->
							</div>
							<div class="col-md-5 bg-light">
								<p class="p-0 m-0">
									<em></em>
								</p>
							</div>
						</div><!--.row-->
						<div class="row mb-5">
							<div class="col-md-6">
								<button class='btn btn-primary col-md-3' type="submit" name="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
								<button class="btn btn-outline-secondary col-md-2" type="Reset">Reset</button>
							</div>
							<div class="col-md-5 bg-light">
							</div>
						</div><!--.row-->
					</form>
				</div><!--.container-->

	</div>

	<?php include('includes/footer.inc.php'); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
			var maxField = 50; // Input fields increment limitation
			var addButton = $('.add_button'); // Add button selector
			var removeButton = $('.remove_button'); // Add button selector
			var wrapper = $('.field_wrapper'); // Input field wrapper
			var x = 1; // Initial field counter is 1

			// Once add button is clicked
			$(addButton).click(function(){
					// Check maximum number of input fields
					if(x < maxField){
							x++; // Increment field counter
							$(wrapper).append("<div><input type='text' name='responseExample_"+ x +"' class='form-control extra-input mb-2'/></div>"); // Add field html
							//<div><input type='text' name='example_"+ x +"' class='form-control'/><a href='javascript:void(0);' class='add_button btn btn-sm btn-primary mb-2 mr-2'><i class='fa fa-plus'></i></a> <a href='javascript:void(0);' class='remove_button btn btn-sm btn-danger mb-2 mr-2'><i class='fa fa-minus'></i></a></div>
					}
					if(x > 1) {
						$(removeButton).removeClass('disabled');
					}
			});

			$(removeButton).click(function(){
					x--; // Decrement field counter
					$('.extra-input:last').remove(); // Remove field html
					if(x == 1) {
						$(removeButton).addClass('disabled');
					}
			});

	/*    // Once remove button is clicked
			$(wrapper).on('click', '.remove_button', function(e){
					e.preventDefault();
					$(this).parent('div').remove(); // Remove field html
					x--; // Decrement field counter
			});*/
	});

	function validateForm() {
		let x = document.forms["responseForm"]["responseExample_1"].value;
		//let y = document.forms["responseForm"]["intent"].value;
		if ( (x == "") && ($('#validationMsg').length == 0) ) {
			$('#formContainer').append("<div id='validationMsg' class='alert alert-warning'>Please provide the required input before continuing.</div>");
			return false;
		}
	}

	function loadPage(pageURL) {
		window.location.href = pageURL;
	}

	</script>

	</body>
</html>
