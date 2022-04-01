<?php

/***********************************
* Application: Educational Chatbot Design Tool
* File: config.inc.php
* Created By: James Henderson
* Date: 25/05/2021
***********************************/

// Initial config values for error reporting criteria
ini_set('error_reporting', -1);
/*ini_set('display_errors', 1);*/
ini_set('html_errors', 1);

$config['protocol'] = 'https://';
$config['university_name'] = 'The University of Nottingham';
$config['university_base_url'] = $config['university_url'] = $config['protocol'].'www.nottingham.ac.uk';
$config['school_url'] = $config['protocol'].'www.nottingham.ac.uk/healthsciences';
$config['school_name'] = 'School of Health Sciences';
$config['project_acronym'] = 'CEPEH';
$config['project_name'] = 'Chatbots Enhance Personalised European Healthcare Curricula';
$config['application_name'] = 'Educational Chatbot Design Tool';
$config['application_version'] = '0.3.10';
$config['last_update'] = '17th Feb 2022';
$config['base_url'] = $config['protocol'].'www.nottingham.ac.uk/~ntzjh/cepeh/chatbot-design';
//$config['base_url'] = '';
$config['developer'] = 'James Henderson';
$config['date_created'] = '25th May 2021';
$config['date_format'] = 'd/m/Y (H:i)';

// An array of admin users for the system
$config['admin_user'] = array(
	array("James", "Henderson"),
	array("Stathis", "Konstantinidis"),
	array("Matthew", "Pears")
	);

/*
$config['admin_email'] = 'Ketan.Mehta1@nottingham.ac.uk';
$config['admin_tel'] = '0115 823 0800';
*/

// A simple function to output an alert style message
function alertMsg($msg) {
	echo "<script type='text/javascript'>alert('Alert message: " . $msg . "');</script>";
}

function consoleMsg($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);
    echo "<script>console.log('Debug message: " . $output . "');</script>";
}


/*
for ($x = 0; $x < $arrlength; $x++) {
	if ( ($admin[$x][$y]) === ($_SESSION['firstname']) && ($admin[$x][$z]) === ($_SESSION['surname']) ) {
		// Admin user - show admin menu;
		$style = "";
		break;
	}
	else {
		// Non-admin user - hide admin menu;
		$style = "style='display:none;'";
		break;
	}
}
*/



?>
