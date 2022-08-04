<?php

$page_title = 'Home';
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

	<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg" id="hero">
      <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
        <h1 class="display-4 fw-bold lh-1">Welcome to the home of online chatbot design</h1>
        <!--<p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>-->
				<p class="lead">The primary purpose of this application is to serve as a tool to facilitate a crowd-based participatory approach to effective chatbot design. Established from CEPEH, the need for such a tool was derived from a lack of existing frameworks supporting pedagogical chatbot design.</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
					<!--
          <button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Primary</button>
          <button type="button" class="btn btn-outline-secondary btn-lg px-4">Default</button>
				-->
        </div>
      </div>
      <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
          <!--<img class="rounded-3" src="img/laptop-3781381.gif" alt="Participants during a storyboarding workshop" width="580">-->
					<img class="rounded-3" src="img/cyberbot-demo.gif" alt="Demonstration of a chatbot in action" width="480">
      </div>
    </div>

		<div class="row align-items-md-stretch mt-5 mb-3">
      <div class="col-md-7">
        <div class="h-100 p-5 text-dark bg-light border border-secondary rounded-3">
					<form method="post" action="home.php" id="searchFormBasic">
	          <h2>Find a chatbot to design</h2>
						<p>Enter any keywords below to find chatbots you can add data for.</p>
						<div class="input-group mb-3 p-5 bg-secondary">
						  <input type="search" id="searchTerm" name="searchTerm" class="form-control-lg input-group-lg col-md-9" placeholder="Enter any keywords..." aria-label="Search" aria-describedby="button-addon2">
						  <button class="btn btn-lg btn-primary" type="submit" name="submit" id="button-addon2"><i class="bi bi-search"></i> Search</button>
						</div>
					</form>
        </div>
      </div>
      <div class="col-md-5">
        <div class="h-100 p-5 bg-light border border-secondary rounded-3">
          <h2>Recently updated chatbots</h2>
					<p>A list of the latest 3 chatbots which have been updated.</p>
					<?php
							include('includes/db_connect/db_connect.inc.php');
							$sql_search = "SELECT * FROM chatbot ORDER BY last_updated DESC LIMIT 3";

							$result = mysqli_query($con_app, $sql_search);

							echo "<ul style='padding-left: 1.2em;'>";

							while($row = mysqli_fetch_array($result)){
								$cid = $row['id'];
								$name = $row['name'];
								$topic = $row['topic'];
								$author = $row['author'];
								$last_updated = date($config['date_format'], strtotime($row['last_updated']));

								echo "<li>$name ($topic) by $author<br><a href=\"add-input1.php?cid=$cid\" type='button' class='btn btn-sm btn-success'><i class='bi bi-plus'></i> Add detail</a></td><span class='badge bg-light text-dark '>Last updated: $last_updated</span></li>";
							}

							echo "</ul>";

							mysqli_close($con_app);
					?>
					<!--
          <p>Or, keep it light and add a border for some added definition to the boundaries of your content. Be sure to look under the hood at the source HTML here as we've adjusted the alignment and sizing of both column's content for equal-height.</p>
          <a href="add.php" class="btn btn-outline-secondary" type="button">Example button</a>
				-->
        </div>
      </div>
    </div>


		<?php
			if(isset($_POST['submit'])){
		  			if(preg_match("/^[  a-zA-Z]+/", $_POST['searchTerm'])){
						$search_term = $_POST['searchTerm'];

						include('includes/db_connect/db_connect.inc.php');

						$sql_search = "SELECT * FROM chatbot WHERE keywords LIKE '%" . $search_term .  "%' OR name LIKE '%" . $search_term ."%' OR topic LIKE '%" . $search_term ."%'";

						$result = mysqli_query($con_app, $sql_search);
						$no_of_results = mysqli_num_rows($result);

						if ($no_of_results > 0) {
							// Display a postive message to inform of search results found
							if ($no_of_results == 1) {
								echo "<div class='alert alert-success'>";
								echo "<h4 class='mx-5'>$no_of_results result found...</h4>";
							}
							else {
								echo "<div class='alert alert-success'>";
								echo "<h4 class='mx-5'>$no_of_results results found...</h4>";
							}

							echo "<div class='table-responsive mx-5'>";
							echo "<table class='table table-sm border border-secondary bg-light'>";
							echo "<thead>";
							echo "<tr>";
							echo "<th scope='col' class='col-md-3'>Chatbot Name</th>";
							echo "<th scope='col' class='col-md-4'>Topic</th>";
							echo "<th scope='col' class='col-md-3'>Author</th>";
							echo "<th scope='col' class='col-md-2'></th>";
							echo "</tr>";
							echo "</thead>";
							echo "<tbody>";

							while($row = mysqli_fetch_array($result)){
								$cid = $row['id'];
								$name = $row['name'];
								$topic = $row['topic'];
								$author = $row['author'];
								echo "<tr>";
								echo "<td>$name</td>";
								echo "<td>$topic</td>";
								echo "<td>$author</td>";
								echo "<td><a href=\"add-input1.php?cid=$cid\" type='button' class='btn btn-success'><i class='bi bi-plus'></i> Add detail</a></td>";
								echo "</tr>";
							}

						echo "</tbody>";
						echo "</table>";
						echo "</div>";
						echo "</div>";
						}

						else {
							echo "<div class='alert alert-danger'>No results found.</div>";
						}
					}
		  		else {
		  				echo "<div class='alert alert-secondary'>Please enter a search query.</div>";
		  		}
		  	}
				//mysqli_free_result($result);
				mysqli_close($con_app);
		?>

	</div><!-- .container -->

	<?php include('includes/footer.inc.php'); ?>

  </body>
</html>
