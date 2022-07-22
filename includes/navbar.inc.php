
<?php

if ($_SESSION['access_level'] == 1) {
	// Observer
	include('menu1.inc.php');
	consoleMsg('menu1');
}
else if ($_SESSION['access_level'] == 2) {
	// Learner/Student
	include('menu2.inc.php');
	consoleMsg('menu2');
}
else if ($_SESSION['access_level'] == 3) {
	// Academic/Subject Expert
	include('menu3.inc.php');
	consoleMsg('menu3');
}
else if ($_SESSION['access_level'] == 4) {
	// Learning Technologist/Research/Software Developer
	include('menu4.inc.php');
	consoleMsg('menu4');
}
else if ($_SESSION['access_level'] == 5) {
	// Admin
	include('menu5.inc.php');
	consoleMsg('menu5');
}
else {
	// Non-admin user - hide admin menu;
	include('menu0.inc.php');
	consoleMsg('menu0');
}

?>
