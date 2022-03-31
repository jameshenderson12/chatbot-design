<?php

$page_title = 'Privacy';
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

    <div class="container p-2">

			<h1 class="mt-4">Privacy Statement</h1>
			<p class="lead">A simple privacy statement for the reference of all users.</p>
			<div class="border border-secondary p-4 rounded-3">
				<h2>The Use of Personal Information <span class="badge bg-secondary">Work in progress</span></h2>
				<h3 class="mt-2">Why does this application exist?</h3>
				<p>The creation of Educational Chatbot Crowd-based Co-creation Tool has been developed to assist with the design process for co-creating an educational chatbot.</p>
				<h3>What data of mine is held in the database?</h3>
				<p>The data that is stored, as a requirement of being able to use this application, is as follows:</p>
				<ul>
					<li>First name</li>
					<li>Surname</li>
					<li>Username</li>
					<li>Email address</li>
					<li>Role [Academic|Student|Subject Expert|Admin]</li>
					<li>Location [Nation]</li>
					<li>Password [Hash]</li>
					<li>Date registered</li>
					<li>Date of last login</li>
				</ul>
				<p>No other personal data is collected to ensure minimal data collection necessary as per General Data Protection Regulation (GDPR) compliance.</p>
				<h3>How is non-personal data obtained?</h3>
				<p>Description TBC.</p>
				<!-- DESCRIBE FUNCTIONS ADD, EDIT, DELETE etc.
				<p>Upon signing up to the public engagement scheme, participants (profiles) are asked to complete a paper-based form to acquire their personal data. Some of the fields on this form marked <strong>PR</strong> and are considered private and confidential and not visible to staff searching the database for suitable profiles. This data is used for anonymous statistics reporting only. Examples could include providing a report to the School to show the current 1) % of participants aged 35-44 or 2) breakdown of participants' gender (the term 'self-described' will be used in instances where specified). In such circumstances where reporting is provided to the School, no individuals will be identifiable through any of the data provided by any protected characteristics (defined by the Equality Act 2010).</p>
				-->
				<h3>Confidentiality Notice</h3>
				<p>The Educational Chatbot Crowd-based Co-creation Tool has also been developed in compliance with the University of Nottingham's Data Protection Policy. An online copy of this policy can be found at the following: <a href="http://www.nottingham.ac.uk/governance/records-and-information-management/data-protection/data-protection-policy.aspx">http://www.nottingham.ac.uk/governance/records-and-information-management/data-protection/data-protection-policy.aspx</a></p>
			</div>
	  </div><!--.container-->

		<?php include('includes/footer.inc.php'); ?>

  </body>
</html>
