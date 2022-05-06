<?php

$page_title = 'Export data';
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

			<h1 class="mt-4">Export data</h1>
			<p class="lead">Exporting the data to Rasa config files.</p>
      <p>You can find these files in the <strong><?php echo $config['base_dir']; ?></strong> directory.</p>

			<div class="row">
                <div class="col-6"><button id="export" class='btn btn-primary col-md-3' type="submit" name="submit"><i class="fa fa-database" aria-hidden="true"></i> Export</button>
                </div>
            </div>
            <div  class="row">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div id="exportMsg" class="form-text small"></div>
                </div>
			</div>

    </div><!--.container-->

		<?php include('includes/footer.inc.php'); ?>

		<script type="text/javascript">
			$(document).ready(function(){
					var export_button = $('#export');
			    $(export_button).click(function() {
			      jQuery.ajax({
							 type: "POST",
							 url: "includes/export.inc.php",
							 cache: false,
							 success: function(response){
									if(response == true) {
			            	$('#exportMsg').addClass("alert alert-success");
										$('#exportMsg').html("Exporting data succesful!");
									}
			            else {
			              $('#exportMsg').addClass("alert alert-danger");
										$('#exportMsg').html("Oh, no! Something went wrong.");
									}
							 }
						});
			    });
			});
		</script>

  </body>
</html>
