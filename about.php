<?php

$page_title = 'About';
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

		<!-- Begin page content -->
		<main class="flex-shrink-0">
		  <div class="container p-2">
		    <h1 class="mt-4">About</h1>
		    <p class="lead">A brief description of the application and overview of the wider project. Full project site available at <a href="https://cepeh.eu/" target="_blank">https://cepeh.eu/</a></p>

				<?php include('includes/logos.inc.php'); ?>

				<p>
				The CEPEH Erasmus+ strategic partnership has provided opportunities co-create open access chatbots utilising artificial intelligence (in the form of natural language processing) promoting innovative practices in digital era. The chatbots created by the partners support current curricula and foster open education.
				</p>
				<p>
				In short, this application, dubbed the "Educational Chatbot Crowd-based Co-creation Tool", has been developed to assist with the design process for co-creating an educational chatbot. Usually, members of the project partnership would use the ASPIRE (Aims, Storyboarding, Population, Implementation, Release, Evaluation) framework to support the underpinning pedagogical approaches of developing such a resource. However, the typical participatory workshops during the 'Storyboarding' phase seemed to encounter unforeseen barriers to the brainstorming of the pedagogical input required to support using chatbot technology for learning. These barriers and lack of initial quality input led to the idea of a supporting application to help streamline the chatbot design process and, specifically, aid participants to think more freely about their learning experiences as opposed to the mechanisms of the chatbot.
				</p>

				<img class="rounded mx-auto d-block mb-5" src="img/E4CT-Architecture.png" alt="Tool Architecture" height="750px">

		  </div>
		</main>

	<?php include('includes/footer.inc.php'); ?>

  </body>
</html>
