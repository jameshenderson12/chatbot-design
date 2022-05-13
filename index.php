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
         session_destroy();
       }
      ?>
      </div>

      <div class="card bg-light">
      <article class="card-body mx-auto w-25">
       <form action="includes/login.inc.php" method="post">


         <h1 class="h3 mb-3 mt-3 fw-normal">Please log in</h1>

         <div class="form-floating mb-3">
           <input class="form-control" id="username" name="username" placeholder="Username">
           <label for="username">Username</label>
         </div>
         <div class="form-floating">
           <input type="password" class="form-control" id="password" name="password" placeholder="Password">
           <label for="password">Password</label>
         </div>

         <div class="row my-4">
           <button class="col me-1 ms-3 btn btn-lg btn-primary" type="submit"><i class="fa fa-sign-in" aria-hidden="true"></i> Log in</button>
           <a href="registration.php" class="col ms-1 me-3 btn btn-lg btn-outline-secondary"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a>
        </div>

          <a href="forgot.php">Forgot your password?</a>

       </form>
     </article>
   </div>

     <div class="my-5 text-muted">Copyright © 2021 CEPEH Project</div>

    <?php include('includes/logos.inc.php'); ?>

   </div><!--.container-->

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  </body>
</html>
