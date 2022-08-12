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
			<p class="lead">A simple privacy statement for all users' reference.</p>
			<div class="border border-secondary p-3 rounded-3">
				<h2 class="bg-secondary text-light p-1 text-center">Using Your Personal Information</h2>
				<h3 class="mt-2">Why does this application exist?</h3>
				<p>The creation of Educational Chatbot Crowd-based Co-creation Tool has been developed to assist with the design process for co-creating an educational chatbot.</p>
				<h3>What data do we collect?</h3>
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
				<h3>How do we collect your data?</h3>
				<p>We collect and process your data when you:</p>
					<ul>
						<li>Register as a user of this application</li>
						<li>Add or amend chatbot instances and/or chatbot data</li>
						<li>View this application (via your browser’s cookies)</li>
					</ul>
				<h3>How will we use your data?</h3>
				<p>We collect your data as part of research into the development of education processes as required by the <a href="https://cepeh.eu/" target="_blank">CEPEH project</a>. This research will allow us to understand and evaluate more about how chatbots can be developed for and used in educational contexts.</p>
				<h3>How do we store your data?</h3>
				<p>The University of Nottingham securely stores your data on its data hosting solutions based in Shropshire, England, UK.</p>
				<p>We will keep your data, as described in the 'What data do we collect?' section for the period of the University's data retention policy. Once this time period has expired, we will delete your data by perminently removing all your records from the application database.</p>
				<h3>What are cookies?</h3>
				<h3>What types of cookies do we use?</h3>
				<h3>How to manage your cookies</h3>
				<h3>What are your data protection rights?</h3>
				<p>Please refer to the University of Nottingham's <a href="https://www.nottingham.ac.uk/utilities/privacy/privacy.aspx" target="_blank">data protection information</a> for specific detail.</p>
				<h3>Privacy policies of other websites</h3>
				<h3>Changes to our privacy policy</h3>
				<h3>How to contact us</h3>
				<h3>How to contact the appropriate authorities</h3>


<p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p><p> </p>

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
