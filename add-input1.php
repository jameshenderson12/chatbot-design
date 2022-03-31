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

?>

<!-- Custom styles for this template -->
<link href="css/sticky-footer-navbar.css" rel="stylesheet">

  </head>
  <body class="d-flex flex-column h-100">

		<?php include('includes/navbar.inc.php'); ?>

    <!-- Profile Information -->

				<div class="container p-2">
					<h1 class="mt-4">Adding conversation detail</h1>
					<p class="lead">Step 1. Here you will provide any questions or statements you would give the chatbot.</p>

					<?php

						include('includes/db_connect/db_connect.inc.php');

						$sql_get_chatbot_info = "SELECT * FROM chatbot WHERE id = $_GET[cid]";

						$chatbot_info = mysqli_query($con_app, $sql_get_chatbot_info);

						while($row = mysqli_fetch_array($chatbot_info)){
								$cid = $chatbot_id = $_SESSION['chatbot_id'] = $row['id'];
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

							echo "<div class='card'>
										<div class='row g-0'>
										<div class='col-md-2'>
										<img src='img/bot-4877999_640.png' class='img-fluid rounded-start' alt='Chatbot looking for queries'>
										</div>
										<div class='col-md-10'>
										<div class='card-body'>
										<h5 class='card-title mb-4' style='color: #3F7A49;'><span style='border: #61BA8D 1px solid; border-radius: 10px; padding: 5px;'><i class='fa fa-commenting'></i> &quot;Hi, I'm $name. Please give me a query...&quot;</span></h5>
										<p class='card-text'>$name is a chatbot on the topic of $topic.<br><small class='text-muted'>Last updated by $last_updated_by on $last_updated</small></p>
										</div>
										</div>
										</div>
										</div>";

					mysqli_close($con_app);
				?>

				</div>

				<div class="container bg-light border border-secondary mb-4" id="formContainer">
					<form name="intentForm" method="post" action="add-input2.php?cid=<?php echo $cid; ?>" onsubmit="return validateForm()">
						<div class="row mb-3">
							<div class="col-md-6 bg-secondary text-light"><h3>Your initial input</h3></div>
							<div class="col-md-6 bg-secondary text-light"><h3>Example(s)</h3></div>
						</div>
						<div class="row mb-5">
							<div class="col-md-6">
							  <label for="intentExample_1" class="form-label"><code>*</code><strong> 1. Enter a question or statement you would give the chatbot:</strong></label>
								<div class="field_wrapper form-group row">
									<div>
										<input type="text" name="intentExample_1" class="form-control" id="intentExample_1">
										<div id="intentMsg" class="form-text small">Add (or remove) alternative phrases.</div>

										<a href="javascript:void(0);" class="add_button btn btn-sm btn-primary mb-2 mr-2"><i class="fa fa-plus"></i></a>
										<a href='javascript:void(0);' class='remove_button btn btn-sm btn-danger mb-2 mr-2 disabled'><i class='fa fa-minus'></i></a>
									</div>
								</div>

							</div>
							<div class="col-md-6 bg-light">
								<table class="table table-sm table-bordered">
									<thead>
										<th width="50%"># 1</th>
										<th width="50%"># 2</th>
									</thead>
									<tbody>
										<tr>
											<td><code>What is your name?</code></td>
											<td><code>What is a literature review?</code></td>
										</tr>
										<tr>
											<td>Alternative phrases:
												<code>
													<br>May I know your name?
													<br>What do people call you?
													<br>Do you have a name for yourself?
												</code>
											</td>
											<td>Alternative phrases:
												<code>
													<br>Tell me about literature reviews.
													<br>Can I have information on literature reviews?
													<br>I need help with a literature review.
												</code>
											</td>
										</tr>
									</tbody>
								</table>

							</div>
						</div>

						<div class="row mb-5">
							<div class="col-md-6">
							  <label for="keyword" class="form-label"><code>*</code><strong> 2. Suggest a unique keyword to summarise this interaction:</strong></label>
							  <input type="text" name="keyword" class="form-control" id="keyword" placeholder="" pattern="^[a-zA-Z0-9_]*$">
								<div id="keywordMsg" class="form-text small"></div>
							</div>
							<div class="col-md-5 bg-light">
								<table class="table table-sm table-bordered">
									<thead>
										<th width="50%"># 3</th>
										<th width="50%"># 4</th>
									</thead>
									<tbody>
										<tr>
											<td><code>greet</code></td>
											<td><code>ask_litreview</code></td>
										</tr>
										<tr>
											<td>Alternatives:
												<code>
													<br>welcome
													<br>introduce
													<br>hello
												</code>
											</td>
											<td>Alternatives:
												<code>
													<br>enquire_litreview
													<br>litreview
													<br>about_litreview
												</code>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div><!--.row-->
						<div class="row mb-5">
							<div class="col-md-6">
								<button class='btn btn-primary col-md-3' type="submit" name="submit"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Continue</button>
								<button class="btn btn-outline-secondary col-md-3" type="Reset" onclick="javascript: $('#validationMsg').remove();"><i class="fa fa-repeat" aria-hidden="true"></i> Reset</button>

							</div>
							<div class="col-md-6 bg-light">
							</div>
						</div><!--.row-->
					</form>
				</div><!--.container-->


			<?php include('includes/footer.inc.php'); ?>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script type="text/javascript">
			$(document).ready(function(){
			    var maxField = 50; // Input fields increment limitation
			    var addButton = $('.add_button'); // Add button selector
					var removeButton = $('.remove_button'); // Add button selector
			    var wrapper = $('.field_wrapper'); // Input field wrapper
			    var x = 1; // Initial field counter is 1

					$('#keyword').keyup(keywordCheck);
					$('#keyword').addClass("incorrect");

			    // Once add button is clicked
			    $(addButton).click(function(){
			        // Check maximum number of input fields
			        if(x < maxField){
			            x++; // Increment field counter
 									$(wrapper).append("<div><input type='text' name='intentExample_"+ x +"' class='form-control extra-input mb-2'/></div>"); // Add field html
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

			});

			function validateForm() {
			  let x = document.forms["intentForm"]["intentExample_1"].value;
				let y = document.forms["intentForm"]["keyword"].value;
			  if ( ((x == "") || (y == "")) && ($('#validationMsg').length == 0) ) {
			    $('#formContainer').append("<div id='validationMsg' class='alert alert-warning'>Please provide the required input before continuing.</div>");
			    return false;
			  }
			}

			function loadPage(pageURL) {
				window.location.href = pageURL;
			}

			function disable() {
				$('#keyword').attr("readonly", true);
				$('#yesBtn').addClass("disabled");
				$('#noBtn').removeClass("disabled");
			}

			function enable() {
				$('#keyword').attr("readonly", false);
				$('#yesBtn').removeClass("disabled");
				$('#noBtn').addClass("disabled");
			}

			function containsWhitespace(str) {
				// Simple function to return 'true' if string contains space or 'false' otherwise
  			return /\s/.test(str);
			}

			function keywordCheck(){
				var keyword = $('#keyword').val();
				if (containsWhitespace(keyword)) {
					$('#keywordMsg').html("No spaces allowed. Separate any words with an underscore (_).");
					return;
				}
				if(keyword == "" || keyword.length < 4) {
					$('#keyword').removeClass("correct");
					$('#keyword').addClass("incorrect");
					$('#keyword').css('border', '1px #CCC solid');
					$('#keywordMsg').html("");
					//$('#tick').hide();
				}
				else {
					jQuery.ajax({
						 type: "POST",
						 url: "includes/intent-check.php",
						 data: 'keyword='+ keyword,
						 cache: false,
						 success: function(response){
							if(response == 1) {
								//$('#intent').css('border', '1px #C33 solid');
								$('#keyword').removeClass("correct");
								$('#keyword').addClass("incorrect");
								$('#keywordMsg').html("This keyword is already in use. Do you want to add to it? <button type='button' class='btn btn-sm btn-outline-secondary' onclick='disable()' id='yesBtn'>Yes</button> <button type='button' class='btn btn-sm btn-outline-secondary' onclick='enable()' id='noBtn'>No</button>");
							}
							else {
								//$('#intent').css('border', '1px #090 solid');
								$('#keyword').removeClass("incorrect");
								$('#keyword').addClass("correct");
								$('#keywordMsg').html("This keyword will be unique.");
							}
						}
					});
				}
			}

			</script>

	</body>
</html>
