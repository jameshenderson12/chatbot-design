<?php

$page_title = 'Login';

session_start();
// Include session Check
//include "includes/check_login.inc.php";
//print_r($_SESSION);
include('includes/config.inc.php');
include('includes/header.inc.php');

?>
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

  </head>
  <body>

    <div class="container text-center">

      <img src="img/CEPEH-Logo.png" alt="CEPEH project logo" width="200px" class="img-fluid center-block">
      <p class="lead text-center"><b>C</b>hatbots <b>E</b>nhance <b>P</b>ersonalised <b>E</b>uropean <b>H</b>ealthcare Curricula</p>
      <h2 class="text-center">Educational Chatbot Crowd-based Co-creation Tool</h2>

      <div id="message" class="mt-3">
       <?php
       if(!empty($_SESSION['errorMsg'])) {
         echo $_SESSION['errorMsg'];
       }
       if(!empty($_SESSION['logoutMsg'])) {
         echo $_SESSION['logoutMsg'];
       }
      ?>
      </div>

      <div class="card bg-light">
      <article class="card-body mx-auto w-25">

        <h1 class="h3 mb-3 mt-3 fw-normal">Forgot password?</h1>
        <p>Enter your email address.</p>
            <form id="forgotPassForm" name="forgotPassForm" class="form-horizontal" onSubmit="return false;">
                <!-- Email Address -->
                <div class="form-floating mb-3">
                  <input class="form-control" id="email" name="email" placeholder="Enter email address">
                  <label for="email">Email</label>
                </div>
                <p id="status"></p> <!-- placeholder for message -->

                <div class="row my-4">
                  <button id="forgotpassbtn" class="col me-1 ms-3 btn btn-lg btn-primary" type="submit" onclick="forgotPass();"><i class="fa fa-repeat" aria-hidden="true"></i> Reset</button>
                  <a href="index.php" class="col ms-1 me-3 btn btn-lg btn-outline-secondary"><i class="fa fa-sign-in" aria-hidden="true"></i> Log in</a>
               </div>

            </form>

        <div id="confirm-msg" style="display: none;">
            <h3>Now check your email inbox (junk/spam folder)</h3>
            <p>Please check your email inbox (including junk/spam folder) for an email containing a temporary password. Carefully follow the instructions within the email so you can log in to Hendy's Hunches again. You can then change your password from the home page to one of your own choice should you wish to.</p><p>You can now close this window.</p>
            <button type="button" class="btn btn-danger" onClick="windowClose()">Close Window</button>
        </div>

     </article>
   </div>

     <div class="my-5 text-muted">Copyright © 2021 CEPEH Project</div>

    <?php include('includes/logos.inc.php'); ?>

   </div><!--.container-->

  </body>
</html>



<?php
/*
// Ajax calls this code to execute
include 'db_connect/db_connect.inc.php';
if(isset($_POST['email'])){
	$e = mysqli_real_escape_string($con_app, $_POST['email']);
	$sql = "SELECT id, username FROM user WHERE email='$e' LIMIT 1";
	$query = mysqli_query($con_app, $sql);
	$numrows = mysqli_num_rows($query);
	//echo $numrows;
	if($numrows > 0){
		while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			$id = $row["id"];
			$u = $row["username"];
		}
		$emailcut = substr($e, 0, 4);
		$randNum = rand(10000,99999);
		$tempPass = "$emailcut$randNum";
		$hashTempPass = md5($tempPass);
		$sql = "UPDATE user SET temp_pass='$hashTempPass' WHERE username='$u' LIMIT 1";
	    $query = mysqli_query($con_app, $sql);
		$to = "$e";
    $subject = "Reset password for Chatbot Co-Creation Tool";
    $from = 'james.henderson@nottingham.ac.uk';
    /*
    $message = "
    <!DOCTYPE html>
    <html>
    <head>
    <img src='https://www.nottingham.ac.uk/~ntzjh/cepeh/chatbot-design/img/CEPEH-Logo.png' alt='CEPEH logo' width='150px'>
    <title>Educational Chatbot Crowd-based Co-creation Tool</title>
    </head>
    <body>
    <h2>Educational Chatbot Crowd-based Co-creation Tool</h2>
    <h3>Password Reset</h3>
    <p>This is an automated message from Educational Chatbot Crowd-based Co-creation Tool. This will enable you to provide a specific chatbot with data and information to help inform its design and implementation.</p>

    <p>Use the temporary password and link below to access the site again. You can then change your password to one of your own choice from the menu.</p>
    <ol>
    <li>Note your username: <b>'.$u.'</b></li>
    <li>Note your temporary password: <b>'.$tempPass.'</b></li>
    <li><a href='http://www.hendyshunches.co.uk/forgot-password.php?u=".$u."&p=".$hashTempPass."'>Now click this link to apply temporary password and use these details to log in</a></li>
    </ol>
    <p>If you do not click the link in this email, no changes will be made to your account. In order to set your login password to the temporary password you must click the link above.</p>
    <p>Kind Regards,<br>The CEPEH Project Team (<a href='https://cepeh.eu'>https://cepeh.eu</a>)</p>
    </body>
    </html>
    ";
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // Additional email headers
    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();

    // Sending email
    if(mail($to, $subject, $message, $headers)){
      consoleMsg('Your mail has been sent successfully.');
    }
    else {
      consoleMsg('Unable to send email. Please try again.');
    }
?>

<?php
// Email link click executes this code
if(isset($_GET['u']) && isset($_GET['p'])){
	//$u = preg_replace('#[^a-z0-9]#i', '', $_GET['u']);
	//$temppasshash = preg_replace('#[^a-z0-9]#i', '', $_GET['p']);
	$u = $_GET['u'];
	$temppasshash = $_GET['p'];
	if(strlen($temppasshash) < 10){
		exit();
	}
	$sql = "SELECT id FROM user WHERE username='$u' AND temp_pass='$temppasshash' LIMIT 1";
	$query = mysqli_query($con_app, $sql);
	$numrows = mysqli_num_rows($query);
	if($numrows == 0){
		//header("location: message.php?msg=There is no match for that username with that temporary password in the system. We cannot proceed.");
		echo "There is no match for that username with that temporary password in the system. We cannot proceed.";
    	exit();
	}
  else {
	  $row = mysqli_fetch_row($query);
	  $id = $row[0];
	  $sql = "UPDATE user SET password='$temppasshash' WHERE id='$id' AND username='$u' LIMIT 1";
	  $query = mysqli_query($con_app, $sql);
	  $sql = "UPDATE user SET temp_pass='' WHERE username='$u' LIMIT 1";
	  $query = mysqli_query($con_app, $sql);
	  header("location: index.php");
    exit();
    }
}*/
?>


<script type="text/javascript">
	// Turn the email field red if not input correct (onBlur - focus leaving the field)
	function validateEmail() {
		var x = document.getElementById("email").value;
		var y = document.getElementById("email");
		var atpos = x.indexOf("@");
		var dotpos = x.lastIndexOf(".");
		if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
			y.style.border="1px solid red";
			return false;
		}
		else
		{
			y.style.border="1px solid green";
		}
	}

	// Reset all guidance borders to original colour
	function resetBorders() {
		var x = document.getElementById("registrationForm");
		for (var i = 0; i < x.length; i++) {
			x.elements[i].style.border="1px solid #CCC";
		}
	}

	function _(x){
		return document.getElementById(x);
	}

	function ajaxObj(meth, url) {
		var x = new XMLHttpRequest();
		x.open( meth, url, true );
		x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		return x;
	}

	function ajaxReturn(x){
		if(x.readyState == 4 && x.status == 200){
			return true;
		}
	}

	function forgotPass(){
		var e = _("email").value;
		if (e == ""){
			_("status").innerHTML = "Please type in your email address.";
		}
		else {
			//_("forgotpassbtn").style.display = "none";
			//_("status").innerHTML = 'Please wait ...';
			_("status").innerHTML = '<div class="spinner"></div>';
			var ajax = ajaxObj("POST", "forgot.php");
			ajax.onreadystatechange = function() {
				if(ajaxReturn(ajax) == true) {
					var response = ajax.responseText;
					//alert(response);
					if(response == "success"){
						//alert("Gotcha!");
						//_("forgotPassForm").innerHTML = '<h3>Step 2. Check your email inbox in a few minutes</h3><p>You can close this window or tab if you like.</p>';
						$("#forgotPassForm").hide();
						$("#confirm-msg").show();
					} else if (response == "no_exist"){
						_("status").innerHTML = "Sorry, that email address has not been registered.";
					} else if (response == "email_send_failed"){
						_("status").innerHTML = "Mail function failed to execute.";
					} else {
						_("status").innerHTML = "An unknown error occurred.";
					}
				}
			}
			ajax.send("e="+e);
		}
	}

	function windowClose() {
		window.open('','_parent','');
		window.close();
	}
</script>
