<?php

session_start();

	// Sanitize incoming username and password
	$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

	include 'db_connect/db_connect.inc.php';

	$stmt = mysqli_prepare($con_app, "SELECT id FROM user WHERE username = ? and password = md5(?)");

	// Bind the input parameters to the prepared statement
	mysqli_stmt_bind_param($stmt, "ss", $username, $password);

	// Execute the query
	mysqli_stmt_execute($stmt);

	// Store the result so we can determine how many rows have been returned
	mysqli_stmt_store_result($stmt);

	if (mysqli_stmt_num_rows($stmt) == 1) {

		// Bind the returned user ID to the $id variable
		mysqli_stmt_bind_result($stmt, $id);
		mysqli_stmt_fetch($stmt);

		// Update the account's last_login
		$stmt = mysqli_prepare($con_app, "UPDATE user SET last_login = NOW() WHERE id = ?");
		mysqli_stmt_bind_param($stmt, "d", $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_free_result($stmt);

		// Retrieve the corresponding login information into session variables
		$stmt = mysqli_prepare($con_app, "SELECT id, firstname, surname, username, email, user_type_id, password FROM user WHERE id = ?");
		mysqli_stmt_bind_param($stmt, "d", $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $id, $firstname, $surname, $username, $email, $user_type_id, $password);
		mysqli_stmt_fetch($stmt);
		// Assign user session variables
		$_SESSION['id'] = $id;
		$_SESSION['firstname'] = $firstname;
		$_SESSION['surname'] = $surname;
		$_SESSION['username'] = $username;
		$_SESSION['email'] = $email;
		$_SESSION['user_type_id'] = $user_type_id;
		$_SESSION['password'] = $password;
		$_SESSION['login'] = "1";

		// Redirect the user to the successful page
		header('Location: ../home.php');
		exit;
	}
	else {
		$_SESSION['login'] = "";
		// Redirect the user to the 'unsuccessful' page
		header('Location: ../index.php');
		exit;
	}

	// Close statement and connection
	mysqli_stmt_close($stmt);

	// Close database connection
	mysqli_close($con_app);
?>




<?php

// LDAP and AD Settings

/*
session_start();
// Unset any error message received on log in attempt
session_unset();
/* Cookie for remember me option
if($_POST['remember']) {
	$year = time() + 31536000;
	setcookie('suacidb_remember_me', $_POST['username'], $year);
}
elseif(!$_POST['remember']) {
	if(isset($_COOKIE['suacidb_remember_me'])) {
		$past = time() - 100;
		setcookie('suacidb_remember_me', $past);
	}
}
*/

// LDAP and AD Settings
//=====================
//$ldapserver = "ldaps://ildap.nottingham.ac.uk";
//$ldapattrs = array("displayname", "department", "useraccountcontrol", "memberof");
//$username = $_POST['username'];
//$password = $_POST['password'];
/*
$adserver = "ad.nottingham.ac.uk";
$adattrs = array("sn", "displayname", "department", "useraccountcontrol", "memberof", "forename", "surname");
$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$debug = false;
$department = "Health Sciences";

// Try LDAP connection
$ldap = ldap_connect($adserver);

if($ldap){
	//echo "<br>LDAP connected ok...";
	$ldaprdn = 'ad' . "\\" . $username;
	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
	ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
	$bind = @ldap_bind($ldap, $ldaprdn, $password);

	if ($bind) {
		//$filter="(sAMAccountName=$username)";
		//$result = ldap_search($ldap,"OU=University,DC=intdir,DC=nottingham,DC=ac,DC=uk",$filter, $ldapattrs);
		$filter="(cn=$username)";
		//$filter="(&(cn=$username)(department=$department))";
		$result = ldap_search($ldap,"OU=Users,OU=university,DC=ad,DC=nottingham,DC=ac,DC=uk",$filter, $adattrs);
		//$result = ldap_search($ldap,"CN=UoN-Staff-Health-Sciences,OU=Staff,OU=Groups,DC=ad,DC=nottingham,DC=ac,DC=uk",$filter, $adattrs);
		ldap_sort($ldap,$result,"sn");
		$info = ldap_get_entries($ldap, $result);

		// Check if in debug mode
		if ($debug) {
			echo "<h3>Debug Information</h3>";
			echo $info["count"]." entries returned\n";
			for ($i=0; $i<$info["count"]; $i++) {
				if($info['count'] == 0) {
					echo "<p>No LDAP record found.</p>";
				}
				if($info['count'] == 1) {
					echo "<p>LDAP record for: <strong> ". $info[$i]["displayname"][0] ."</strong></p>\n";
					echo '<pre>';
					print_r($info);
					echo '</pre>';
				}
				if($info['count'] > 1) {
					echo "<p>Multiple LDAP records found.</p>";
					break;
				}
			}
		}
		else {
			// Assign user session variables
			//$_SESSION['id'] = $id;
			$_SESSION['username'] = $username;
			//$_SESSION['password'] = $password;
			$_SESSION['name'] = $info[0]["displayname"][0];
			//$_SESSION['n'] = $info[0]["forename"][0];
			$_SESSION['login'] = "1";
			// Redirect the user to the successful page
			header('Location: ../home.php');
			exit;
		}
		@ldap_close($ldap);
	}
	else {
		echo "<h3>Unsuccessful Login Attempt</h3>Your username or password is incorrect or not recognised!";
		$_SESSION['login'] = "";
		$_SESSION['errorMsg'] = "<div class='alert alert-danger alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		<span class='glyphicon glyphicon-cross'></span> Incorrect username or password.</div>";
		// Redirect the user to the 'unsuccessful' page
		header('Location: ../index.php');
		exit;
	}
}
else {
	echo "<h3>Unsuccessful Login Attempt</h3>Could not connect to the LDAP server!";
}
*/
?>
