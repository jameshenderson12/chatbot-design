<?php

// Display or hide admin menus
	if ($_SESSION['access_level'] == 9) {
		// Admin user - show admin menu;
		$style = "";
	}
	else {
		// Non-admin user - hide admin menu;
		$style = "style='display:none;'";
	}

?>

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
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-4">
        <li class="nav-item <?= ($active_page == 'home') ? 'active':''; ?>">
          <a class="nav-link" href="home.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
        </li>
        <li class="nav-item <?= ($active_page == 'about') ? 'active':''; ?>">
          <a class="nav-link" href="about.php"><i class="fa fa-info-circle" aria-hidden="true"></i> About</a>
        </li>
				<li class="nav-item <?= ($active_page == 'privacy') ? 'active':''; ?>">
          <a class="nav-link" href="privacy.php"><i class="fa fa-user-secret" aria-hidden="true"></i> Privacy</a>
        </li>


<!-- DROPDOWN GENERIC
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Link
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
						<li><a class="dropdown-item" href="#">Action</a></li>
						<li><a class="dropdown-item" href="#">Another action</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="#">Something else here</a></li>
					</ul>
				</li>
			-->

				<li class="nav-item dropdown <?= (($active_page == 'new') || ($active_page == 'edit') || ($active_page == 'delete')) ? 'active':''; ?>" <?php echo $style;?>>
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTasks" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-commenting" aria-hidden="true"></i> Chatbots
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdownTasks">
						<li><h6 class="dropdown-header">Chatbot instances</h6></li>
						<li><a class="dropdown-item" href="new.php"><i class="fa fa-plus-square" aria-hidden="true"></i> New</a></li>
						<li><a class="dropdown-item" href="edit.php"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a></li>
						<li><a class="dropdown-item" href="delete.php"><i class="fa fa-minus-square" aria-hidden="true"></i> Delete</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="#">Something else here</a></li>
					</ul>
				</li>

				<li id="admin_options" class="nav-item dropdown <?= (($active_page == 'overview') || ($active_page == 'report-users')) ? 'active':''; ?>" <?php echo $style;?>>
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAdmin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-cubes" aria-hidden="true"></i> Administration
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownAdmin">
						<li><h6 class="dropdown-header">General</h6></li>
            <li class="<?= ($active_page == 'overview') ? 'active':''; ?>"><a class="dropdown-item" href="overview.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Overview</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
						<li class="dropdown-header">Reports</li>
            <li><a class="dropdown-item" href="report-users.php"><i class="fa fa-users" aria-hidden="true"></i> Users</a></li>
          </ul>
        </li>

        <!--<li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>-->
      </ul>

				<div class="bg-dark text-light m-2"><?php printf("%s %s (%s)", $_SESSION["firstname"], $_SESSION["surname"], ($_SESSION["username"])) ?></div>
				<a href="includes/logout.inc.php" class="btn btn-outline-light btn-sm"><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</a>
			</div>

    </div>
  </div>
</nav>
</header>
