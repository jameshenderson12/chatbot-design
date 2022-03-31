<?php

$page_title = 'Registration';

session_start();
// Include session Check
//include "includes/check_login.inc.php";
//print_r($_SESSION);
include('includes/config.inc.php');
include('includes/header.inc.php');

?>
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/registration.css" rel="stylesheet">


    <script type="text/javascript">

  	function flagIncorrect() {
  		$(this).addClass("incorrect");
  	}

  	function flagCorrect() {
  		$(this).addClass("correct");
  	}

  	function validateFullForm() {
  		// Validate the first name input
  		var fn = document.forms["registrationForm"]["firstname"];
  		if (fn.value == null || fn.value == "") {
  			alert("Please enter your first name.");
  			fn.style.border="1px solid #C33";
  			fn.focus();
  			return false;
  		}
  		// Validate the surname input
  		var sn = document.forms["registrationForm"]["surname"];
  		if (sn.value == null || sn.value == "") {
  			alert("Please enter your surname.");
  		    sn.style.border="1px solid #C33";
  			sn.focus();
  			return false;
  		}
      // Validate the username input
      var un = document.forms["registrationForm"]["username"];
      var unmsg = document.getElementById("un-msg");
      if ((un.value == null) || (un.value == "") || ($('#un-msg').html() != "") ) {
        alert("Please enter a unique username.");
        un.style.border="1px solid #C33";
        un.focus();
        return false;
      }
  		// Validate the email input
  		var x = document.forms["registrationForm"]["email"].value;
  		var y = document.forms["registrationForm"]["email"];
  		var atpos = x.indexOf("@");
  		var dotpos = x.lastIndexOf(".");
  		if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
  			alert("Please enter a valid email address.");
  		    y.style.border="1px solid #C33";
  			y.focus();
  			return false;
  		}
      // Validate the world cup winner input
  		var xd3 = document.getElementById("type");
  		var yd3 = document.getElementById("type").options;
  			if (yd3[xd3.selectedIndex].index == "0") {
  				alert("Please specify your user type.");
  				xd3.style.border="1px solid #C33";
  				xd3.focus();
  				return false;
  			}
  		// Validate the location input
  		var xd1 = document.getElementById("location");
  		var yd1 = document.getElementById("location").options;
  			if (yd1[xd1.selectedIndex].index == "0") {
  				alert("Please specify your location.");
  				xd1.style.border="1px solid #C33";
  				xd1.focus();
  				return false;
  			}
        // Validate the password input
      var pwd1 = document.forms["registrationForm"]["password"];
      var pwd2 = document.forms["registrationForm"]["password2"];
        if(pwd1.value != "" && pwd1.value == pwd2.value) {
          if(!checkPassword(pwd1.value)) {
          alert("The password you have entered is not valid.");
          pwd1.focus();
          return false;
          }
        } else {
          alert("Please check that you've entered and confirmed your password correctly.");
          pwd1.focus();
          return false;
        }
        /*return true;*/
  		// Validate the disclaimer checkbox input
  		var dc = document.forms["registrationForm"]["disclaimer"];
  		if (!dc.checked) {
  			alert("You must agree to the terms and conditions.");
  			dc.focus();
  			return false;
  		}
  	}
  	// Turn the name fields red if not input (onBlur - focus leaving the field)
  	function validateName(nameID) {
  		var x = document.getElementById(nameID);
  		if (x.value == null || x.value == "") {
  			x.style.border="1px solid #C33";
  			return false;
  		}
  		else x.style.border="1px solid #090";
  	}

  	function checkPassword(str) {
  	    var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
      	return re.test(str);
    	}

  	// Turn the password field red if not input correct (onBlur - focus leaving the field)
  	function validatePassword() {
  		var x = document.getElementById("password");
  		if ((x.value == null) || (x.value == "") || (!checkPassword(x.value))) {
  			x.style.border="1px solid #C33";
  			return false;
  		}
  		else x.style.border="1px solid #090";
  	}

  	// Turn the confirm password field red if not input correct (onBlur - focus leaving the field)
  	function validatePassword2() {
  		var x = document.getElementById("password2");
  		var y = document.getElementById("password");
  		if ((x.value == null) || (x.value == "") || (!checkPassword(x.value)) || (x.value != y.value)) {
  			x.style.border="1px solid #C33";
  			return false;
  		}
  		else x.style.border="1px solid #090";
  	}

  	// Turn the email field red if not input correct (onBlur - focus leaving the field)
  	function validateEmail() {
  		var x = document.getElementById("email").value;
  		var y = document.getElementById("email");
  		var atpos = x.indexOf("@");
  		var dotpos = x.lastIndexOf(".");
  		if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
  			y.style.border="1px solid #C33";
  			return false;
  		}
  		else
  		{
  			y.style.border="1px solid #090";
  		}
  	}

  	// Turn the dropdown fields red if no selection made (onBlur - focus leaving the field)
  	function validateDropDown(dropDownID) {
  		var x = document.getElementById(dropDownID);
  		var y = document.getElementById(dropDownID).options;

  		if (y[x.selectedIndex].index = 0) {
  			x.style.border="1px solid #C33";
  			return false;
  		}
  		else if (x.selectedIndex > 0) {
  			x.style.border="1px solid #090";
  		}
  		else {
  			x.style.border="1px solid #C33";
  		}
  	}

  	// Reset all guidance borders to original colour
  	function resetBorders() {
  		var x = document.getElementById("registrationForm");
  		$("button").removeClass("highlight");
  		for (var i = 0; i < x.length; i++) {
  			x.elements[i].style.border="1px solid #CCC";
  		}
  	}
  	</script>

    <script>
      $(document).ready(function(){
      	$('#username').keyup(username_check);
  		$('#username').addClass("incorrect");
      });

      function username_check(){
      	var username = $('#username').val();
      	if(username == "" || username.length < 4) {
  			$('#username').removeClass("correct");
      		$('#username').addClass("incorrect");
  			$('#username').css('border', '1px #CCC solid');
  			$('#un-msg').html("");
      		//$('#tick').hide();
  			}
  			else {
  				jQuery.ajax({
  				   type: "POST",
  				   url: "includes/username-check.php",
  				   data: 'username='+ username,
  				   cache: false,
  				   success: function(response){
  					if(response == 1) {
  						$('#username').css('border', '1px #C33 solid');
  						$('#username').removeClass("correct");
  						$('#username').addClass("incorrect");
  						$('#un-msg').html("Sorry but this username is already taken.");
  					}
  					else {
  						$('#username').css('border', '1px #090 solid');
  						$('#username').removeClass("incorrect");
  						$('#username').addClass("correct");
  						$('#un-msg').html("");
  					}
  			}
      	});
      	}
      }
      </script>

  </head>
  <body>

    <div class="container text-center">

      <img src="img/CEPEH-Logo.png" alt="CEPEH project logo" width="200px" class="img-fluid center-block">
      <p class="lead text-center"><b>C</b>hatbots <b>E</b>nhance <b>P</b>ersonalised <b>E</b>uropean <b>H</b>ealthcare Curricula</p>
      <h2 class="text-center">Educational Chatbot Crowdbased Co-Creation Tool</h2>

      <div id="message" class="mt-3">
       <?php
       if(!empty($_SESSION['errorMsg'])) {
         echo $_SESSION['errorMsg'];
       }
       if(!empty($_SESSION['logoutMsg'])) {
         echo $_SESSION['logoutMsg'];
         session_destroy();
       }
      ?>
      </div>

      <div class="card bg-light">
      <article class="card-body mx-auto">
      	<h1 class="h3 mb-3 mt-3 fw-normal">Register</h1>
      	<form id="registrationForm" name="registrationForm" method="post" action="includes/register.php" onSubmit="return validateFullForm()">
          <div class="row mb-3">
            <div class="col-md">
            	<div class="form-floating">
                  <input name="firstname" id="firstname" class="form-control" placeholder="First name" type="text" onBlur="return validateName('firstname');" required>
                  <label for="firstname">First name</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating">
                  <input name="surname" id="surname" class="form-control" placeholder="Last name" type="text" onBlur="return validateName('surname');" required>
                  <label for="surname">Last name</label>
              </div>
            </div>
          </div>
            <div class="row mb-3">
              <div class="col-md">
                <div class="form-floating">
                    <input name="username" id="username" class="form-control" placeholder="Username" type="text">
                    <label for="username">Username</label>
                </div>
                <span id="un-msg" class="additional-info"></span>
              </div>
              <div class="col-md">
                <div class="form-floating">
                    <input name="email" id="email" class="form-control" placeholder="Email address" type="email" onBlur="return validateEmail();" required>
                    <label for="email">Email</label>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <!-- User Type -->
              <div class="col-md">
                <div class="form-floating">
  			             <select name="user_type" class="form-select" id="user_type" aria-label="Select user type" onBlur="return validateDropDown('user_type');" />
  				               <option selected="selected" disabled class="text-primary">Select your user type</option>
          				          <?php
                              // Source file for extracting data
                              $file = 'text/select-user-type.txt';
                              $handle = @fopen($file, 'r');
                              if ($handle) {
                                 while (!feof($handle)) {
                                 $line = fgets($handle, 4096);
                                 $item = explode('\n', $line);
                                 echo '<option value="' . $item[0] . '">' . $item[0] . '</option>' . "\n";
                             }
                             fclose($handle);
                             }
                          ?>
  	        	        </select>
                      <label for="user_type">User Type</label>
                  </div>
              </div>

              <!-- Location -->
              <div class="col-md">
                <div class="form-floating">
  			             <select name="location" class="form-select" id="location" aria-label="Select location" onBlur="return validateDropDown('location');" />
  				               <option selected="selected" disabled class="text-primary">Select your location</option>
          				          <?php
                              // Source file for extracting data
                              $file = 'text/select-countries.txt';
                              $handle = @fopen($file, 'r');
                              if ($handle) {
                                 while (!feof($handle)) {
                                 $line = fgets($handle, 4096);
                                 $item = explode('\n', $line);
                                 echo '<option value="' . $item[0] . '">' . $item[0] . '</option>' . "\n";
                             }
                             fclose($handle);
                             }
                          ?>
  	        	        </select>
                      <label for="location">Location</label>
                  </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md">
                <div class="form-floating">
                      <input name="password" id="password" class="form-control" placeholder="Create password" type="password" onBlur="return validatePassword();" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" onchange="form.password2.pattern = this.value;">
                      <label for="password">Create Password</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating">
                    <input name="password2" class="form-control" id="password2" placeholder="Repeat password" type="password" onBlur="return validatePassword2();" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
                    <label for="password2">Repeat Password</label>
                </div>
              </div>
            </div>
            <!-- Disclaimer -->
            <div class="form-check col-sm-12">
              <input class="form-check-input" type="checkbox" id="disclaimer" name="disclaimer" value="disclaimer">
              <label class="form-check-label" for="disclaimer">
                By registering an account, I acknowledge and accept the <!--<a href="" data-toggle="modal" data-target="#HHterms">terms and conditions</a>--> associated <a href="https://www.nottingham.ac.uk/utilities/privacy/privacy.aspx" target="_blank">Privacy Policy</a> terms.
              </label>
            </div>
           <div class="row m-4">
                <button type="submit" class="col me-2 btn btn-lg btn-primary">Create Account</button>
                <button type="reset" class="col me-2 btn btn-lg btn-outline-secondary" onClick="resetBorders();">Reset All</button>
            </div>
          <p class="text-center">Already have an account? <a href="index.php">Log In</a> </p>
      </form>
      </article>
      </div>

     <div class="my-5 text-muted">Copyright © 2021 CEPEH Project</div>

    <?php include('includes/logos.inc.php'); ?>

   </div><!--.container-->

  </body>
</html>
