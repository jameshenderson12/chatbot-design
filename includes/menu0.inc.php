	<header>
	<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark"><!--style="background-color: #e3f2fd;"-->
	  <div class="container">
			<a class="navbar-brand d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none mr-4" href="#">
				<img src="img/CEPEH-Logo.png" alt="CEPEH logo" height="48" class="d-inline-block align-text-top">
				Chatbot Design
			</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse text-end" id="navbarSupportedContent">

					<div class="bg-dark text-light m-2"><i class="bi bi-person"></i> <?php printf("%s %s (%s)", $_SESSION["firstname"], $_SESSION["surname"], $_SESSION["username"]) ?></div>
					<a href="includes/logout.inc.php" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right"></i> Log out</a>
				</div>

	    </div>
	  </div>
	</nav>
	</header>
