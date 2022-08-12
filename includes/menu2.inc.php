<header>
  <!-- Learner/Student -->
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
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-4">
        <li class="nav-item <?= ($active_page == 'home') ? 'active':''; ?>">
          <a class="nav-link" href="home.php"><i class="bi bi-house-fill"></i> Home</a>
        </li>
        <li class="nav-item <?= ($active_page == 'about') ? 'active':''; ?>">
          <a class="nav-link" href="about.php"><i class="bi bi-question-diamond-fill"></i> About</a>
        </li>
				<li class="nav-item <?= ($active_page == 'privacy') ? 'active':''; ?>">
          <a class="nav-link" href="privacy.php"><i class="bi bi-shield-lock-fill"></i></i> Privacy</a>
        </li>
				<li class="nav-item dropdown <?= (($active_page == 'new') || ($active_page == 'edit') || ($active_page == 'delete')) ? 'active':''; ?>">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTasks" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="bi bi-chat-right-text-fill"></i> Chatbots
					</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownTasks">
            <li><h6 class="dropdown-header">Chatbot Data</h6></li>
            <li><a class="dropdown-item" href="view-chatbot.php"><i class="bi bi-eye"></i> View</a></li>
						<!--<li><a class="dropdown-item" href="verify.php"><i class="bi bi-pass"></i> Verify</a></li><!--<i class="bi bi-ui-checks"></i>-->
            <li><hr class="dropdown-divider"></li>
            <li><h6 class="dropdown-header">Chatbot Instances</h6></li>
						<!--<li><a class="dropdown-item" href="new.php"><i class="bi bi-plus-circle"></i> New</a></li>-->
						<li><a class="dropdown-item" href="edit.php"><i class="bi bi-pencil"></i> Edit</a></li>
						<!--<li><a class="dropdown-item" href="delete.php"><i class="bi bi-trash3"></i> Delete</a></li>-->
					</ul>
				</li>
      </ul>

				<div class="bg-dark text-light m-2"><i class="bi bi-person"></i> <?php printf("%s %s (%s)", $_SESSION["firstname"], $_SESSION["surname"], $_SESSION["username"]) ?></div>
				<a href="includes/logout.inc.php" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right"></i> Log out</a>
			</div>

    </div>
  </div>
</nav>
</header>
