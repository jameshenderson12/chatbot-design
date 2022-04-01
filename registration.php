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
  			$('#fn-msg').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Please enter your first name.");
  			fn.style.border="1px solid #C33";
  			fn.focus();
  			return false;
  		}
  		// Validate the surname input
  		var sn = document.forms["registrationForm"]["surname"];
  		if (sn.value == null || sn.value == "") {
  			$('#sn-msg').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Please enter your last name.");
  		  sn.style.border="1px solid #C33";
  			sn.focus();
  			return false;
  		}
      // Validate the username input
      var un = document.forms["registrationForm"]["username"];
      var unmsg = document.getElementById("un-msg");
      if ((un.value == null) || (un.value == "") || ($('#un-msg').html() != "") ) {
        $('#un-msg').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Please enter a username.");
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
  			$('#em-msg').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Please enter a valid email address.");
  		  y.style.border="1px solid #C33";
  			y.focus();
  			return false;
  		}
      // Validate the world cup winner input
  		var xd3 = document.getElementById("user_type");
  		var yd3 = document.getElementById("user_type").options;
  			if (yd3[xd3.selectedIndex].index == "0") {
  				$('#ut-msg').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Please specify your role.");
  				xd3.style.border="1px solid #C33";
  				xd3.focus();
  				return false;
  			}
  		// Validate the location input
  		var xd1 = document.getElementById("location");
  		var yd1 = document.getElementById("location").options;
  			if (yd1[xd1.selectedIndex].index == "0") {
  				$('#lo-msg').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Please specify your location.");
  				xd1.style.border="1px solid #C33";
  				xd1.focus();
  				return false;
  			}
        // Validate the password input
      var pwd1 = document.forms["registrationForm"]["password"];
      var pwd2 = document.forms["registrationForm"]["password2"];
        if(pwd1.value != "" && pwd1.value == pwd2.value) {
          if(!checkPassword(pwd1.value)) {
          $('#pass1-msg').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Must be >= 6 mix of lower, UPPER and number.");
          pwd1.focus();
          return false;
          }
        } else {
          $('#pass1-msg').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Must be >= 6 mix of lower, UPPER and number.");
          pwd1.focus();
          return false;
        }
        /*return true;*/
  		// Validate the disclaimer checkbox input
  		var dc = document.forms["registrationForm"]["disclaimer"];
  		if (!dc.checked) {
  			$('#dc-msg').html("<<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> You must agree to the site privacy terms.");
  			dc.focus();
  			return false;
  		}
      else {
        $('#dc-msg').html("");
      }
  	}

  	// Turn the name fields red if not input (onBlur - focus leaving the field)
  	function validateFirstName() {
  		var x = document.getElementById("firstname");
  		if (x.value == null || x.value == "") {
        $('#fn-msg').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Please enter your first name.");
        x.style.border="1px solid #C33";
  			return false;
  		}
  		else {
        x.style.border = "1px solid #090";
        $('#fn-msg').html("");
      }
    }

    function validateLastName() {
  		var x = document.getElementById("surname");
  		if (x.value == null || x.value == "") {
        $('#sn-msg').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Please enter your last name.");
        x.style.border="1px solid #C33";
  			return false;
  		}
  		else {
        x.style.border = "1px solid #090";
        $('#sn-msg').html("");
      }
  	}

    function validateUsername() {
  		var x = document.getElementById("username");
  		if (x.value == null || x.value == "") {
        $('#un-msg').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Please enter a username.");
        x.style.border="1px solid #C33";
  			return false;
  		}
  		else {
        x.style.border = "1px solid #090";
        $('#sn-msg').html("");
      }
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
        $('#pass1-msg').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Must be >= 6 mix of lower, UPPER and number.");
  			return false;
  		}
  		else {
        x.style.border="1px solid #090";
        $('#pass1-msg').html("");
      }
  	}

  	// Turn the confirm password field red if not input correct (onBlur - focus leaving the field)
  	function validatePassword2() {
  		var x = document.getElementById("password2");
  		var y = document.getElementById("password");
  		if ((x.value == null) || (x.value == "") || (!checkPassword(x.value)) || (x.value != y.value)) {
  			x.style.border="1px solid #C33";
        $('#pass2-msg').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Does not match previous. Try again.");
  			return false;
  		}
  		else {
        x.style.border="1px solid #090";
        $('#pass2-msg').html("");
      }
  	}

  	// Turn the email field red if not input correct (onBlur - focus leaving the field)
  	function validateEmail() {
  		var x = document.getElementById("email").value;
  		var y = document.getElementById("email");
  		var atpos = x.indexOf("@");
  		var dotpos = x.lastIndexOf(".");
  		if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
        $('#em-msg').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Please enter a valid email address.");
  			y.style.border="1px solid #C33";
  			return false;
  		}
  		else
  		{
  			y.style.border="1px solid #090";
        $('#em-msg').html("");
  		}
  	}

  	// Turn the dropdown fields red if no selection made (onBlur - focus leaving the field)
  	function validateUserType() {
  		var x = document.getElementById("user_type");
  		var y = document.getElementById("user_type").options;

  		if (y[x.selectedIndex].index == 0) {
        $('#ut-msg').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Please specify your role.");
  			x.style.border="1px solid #C33";
  			return false;
  		}
  		else if (x.selectedIndex > 0) {
  			x.style.border="1px solid #090";
        $('#ut-msg').html("");
  		}
  		else {
  			x.style.border="1px solid #C33";
  		}
  	}

    function validateLocation() {
  		var x = document.getElementById("location");
  		var y = document.getElementById("location").options;

  		if (y[x.selectedIndex].index == 0) {
        $('#lo-msg').html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Please specify your location.");
  			x.style.border="1px solid #C33";
  			return false;
  		}
  		else if (x.selectedIndex > 0) {
  			x.style.border="1px solid #090";
        $('#lo-msg').html("");
  		}
  		else {
  			x.style.border="1px solid #C33";
  		}
  	}

    function validateDisclaimer() {
      var dc = document.getElementById("disclaimer");
      if (!dc.checked) {
        $('#dc-msg').html("You must agree to the site privacy terms.");
        dc.focus();
        return false;
      }
      else {
        $('#dc-msg').html("");
      }
    }

  	// Reset all guidance borders to original colour
  	function resetBorders() {
  		var x = document.getElementById("registrationForm");
  		$("button").removeClass("highlight");
  		for (var i = 0; i < x.length; i++) {
  			x.elements[i].style.border="1px solid #CCC";
        $(".additional-info").html("");
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
  						$('#un-msg').html("Sorry, this username is already taken.");
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
      	<form id="registrationForm" name="registrationForm" method="post" action="includes/register.php"> <!-- onSubmit="return validateFullForm()"-->
          <div class="row mb-3">
            <div class="col-md">
            	<div class="form-floating">
                  <input name="firstname" id="firstname" class="form-control" placeholder="First name" type="text" onBlur="return validateFirstName();">
                  <label for="firstname">First name</label>
              </div>
              <span id="fn-msg" class="additional-info"></span>
            </div>
            <div class="col-md">
              <div class="form-floating">
                  <input name="surname" id="surname" class="form-control" placeholder="Last name" type="text" onBlur="return validateLastName();">
                  <label for="surname">Last name</label>
              </div>
              <span id="sn-msg" class="additional-info"></span>
            </div>
          </div>
            <div class="row mb-3">
              <div class="col-md">
                <div class="form-floating">
                    <input name="username" id="username" class="form-control" placeholder="Username" type="text" onBlur="return validateUsername();">
                    <label for="username">Username</label>
                </div>
                <span id="un-msg" class="additional-info"></span>
              </div>
              <div class="col-md">
                <div class="form-floating">
                    <input name="email" id="email" class="form-control" placeholder="Email address" type="email" onBlur="return validateEmail();">
                    <label for="email">Email</label>
                </div>
                <span id="em-msg" class="additional-info"></span>
              </div>
            </div>
            <div class="row mb-3">
              <!-- User Type -->
              <div class="col-md">
                <div class="form-floating">
  			             <select name="user_type" class="form-select" id="user_type" aria-label="Select user type" onBlur="return validateUserType();" />
  				               <option selected="selected" disabled class="text-primary">Select your user type</option>
          				       <option value="Academic">Academic</option>
                         <option value="Learner">Learner</option>
                         <option value="Learning Technologist">Learning Technologist</option>
                         <option value="Observer">Observer</option>
                         <option value="Researcher">Researcher</option>
                         <option value="Software Developer">Software Developer</option>
                         <option value="Subject Expert">Subject Expert</option>
                         <option value="Student">Student</option>
  	        	        </select>
                      <label for="user_type">User Type</label>
                  </div>
                  <span id="ut-msg" class="additional-info"></span>
              </div>

              <!-- Location -->
              <div class="col-md">
                <div class="form-floating">
  			             <select name="location" class="form-select" id="location" aria-label="Select location" onBlur="return validateLocation();" />
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
                  <span id="lo-msg" class="additional-info"></span>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md">
                <div class="form-floating">
                      <input name="password" id="password" class="form-control" placeholder="Create password" type="password" onBlur="return validatePassword();" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" onchange="form.password2.pattern = this.value;">
                      <label for="password">Create Password</label>
                </div>
                <span id="pass1-msg" class="additional-info"></span>
              </div>
              <div class="col-md">
                <div class="form-floating">
                    <input name="password2" class="form-control" id="password2" placeholder="Repeat password" type="password" onBlur="return validatePassword2();" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
                    <label for="password2">Repeat Password</label>
                </div>
                <span id="pass2-msg" class="additional-info"></span>
              </div>
            </div>
            <!-- Disclaimer -->
            <div class="form-check col-sm-12">
              <input class="form-check-input" type="checkbox" id="disclaimer" name="disclaimer" value="disclaimer">
              <label class="form-check-label" for="disclaimer">
                By registering an account, I acknowledge and accept the <!--<a href="" data-toggle="modal" data-target="#HHterms">terms and conditions</a>--> associated <a href="https://www.nottingham.ac.uk/utilities/privacy/privacy.aspx" target="_blank">Privacy Policy</a> terms.
              </label>
            </div>
            <span id="dc-msg" class="additional-info"></span>
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
