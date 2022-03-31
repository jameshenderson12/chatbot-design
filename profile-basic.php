<?php

$page_title = 'Profile';
$active_page = basename($_SERVER['PHP_SELF'], ".php");
// Start the session
session_start();
// Check that user should be logged in
if (!(isset($_SESSION['login']) && $_SESSION['login'] != "")) {
	header ("Location: index.php");
}
include('includes/config.inc.php');
include('includes/header.inc.php');
//include('includes/db_connect/db_connect.inc.php');
?>

  </head>
  <body>

<?php include('includes/main_nav.inc.php'); ?>         
    
<?php 
	 
// Disability (condition/illness) indexed array
$disability_affect[0] = "Vision (e.g. blindness or partial sight)";
$disability_affect[1] = "Hearing (e.g. deafness or partial hearing)";
$disability_affect[2] = "Mobility (e.g. walking short distances or climbing stairs)";
$disability_affect[3] = "Dexterity (e.g. lifting or carrying objects, using a keyboard)";
$disability_affect[4] = "Learning or understanding or concentrating";
$disability_affect[5] = "Memory";
$disability_affect[6] = "Mental health";
$disability_affect[7] = "Stamina or breathing or fatigue";
$disability_affect[8] = "Socially or behaviourally (e.g. associated with autism, attention deficit disorder or Aspergers' syndrome)";
$disability_affect[9] = "None of the above";
$disability_affect[10] = "Other (please specify)";
 
	  
	include('includes/db_connect/db_connect.inc.php');
	  
	if(isset($_GET['id'])){		
		// Set up variable to capture result of SQL query to retrieve data from database tables
		// WHERE id='".$_GET["id"]."'";
		$sql_get_profile_overview = "
		SELECT overview.id, overview.firstname, overview.lastname, overview.role, overview.description, overview.added, contact.town_or_city, contact.country, contact.email, contact.phone_mobile, contact.phone_other, contact.preference, notes.additional_notes
		FROM overview
		INNER JOIN contact ON overview.id = contact.id
		INNER JOIN notes ON overview.id = notes.id
		WHERE overview.id = '".$_GET["id"]."'
		";		
		$sql_get_profile_organisation = "SELECT * FROM organisation WHERE id = '".$_GET["id"]."'";		
		$sql_get_profile_area_interest = "SELECT * FROM area_interest WHERE id = '".$_GET["id"]."'";
		$sql_get_profile_work_interest = "SELECT * FROM work_interest WHERE id = '".$_GET["id"]."'";

/*		INNER JOIN area_interest ON overview.id = area_interest.id
		INNER JOIN work_interest ON overview.id = work_interest.id
		INNER JOIN organisation ON overview.id = organisation.id
*/
		
		$profile_overview = mysqli_fetch_assoc(mysqli_query($con_ro, $sql_get_profile_overview));
		$profile_organisation = mysqli_fetch_assoc(mysqli_query($con_ro, $sql_get_profile_organisation));
		$profile_area_interest = mysqli_fetch_assoc(mysqli_query($con_ro, $sql_get_profile_area_interest));
		$profile_work_interest = mysqli_fetch_assoc(mysqli_query($con_ro, $sql_get_profile_work_interest));
		$profile_divisional_affiliation = array_slice($profile_organisation, 5, 7);
		$profile_group_membership = array_slice($profile_organisation, 12, 5); //5		
		$profile_area_types = array_slice($profile_area_interest, 3, 28);
		$profile_work_types = array_slice($profile_work_interest, 3, 7);
		

		$firstname = ucfirst($profile_overview['firstname']);
		$lastname = ucfirst($profile_overview['lastname']);
		if (($firstname) && ($lastname)) {
			$initials = substr($firstname, 0, 1). "" . substr($lastname, 0, 1);	  
		}
		$role = $profile_overview['role'];
		$description = $profile_overview['description'];				
		$added = date("l jS \of F", strtotime($profile_overview['added']));
		$town_or_city = $profile_overview['town_or_city'];
		$country = $profile_overview['country'];
		$email = $profile_overview['email'];
		$phone_mobile = $profile_overview['phone_mobile'];
		$phone_other = $profile_overview['phone_other'];
		$preference = $profile_overview['preference'];
		$additional_notes = $profile_overview['additional_notes'];
		$group_membership_other = ucfirst($profile_organisation['group_membership_other']);
		$area_interest_other = ucfirst($profile_area_interest['other']);
		$work_requirements = ucfirst($profile_work_interest['requirements']);
		$start_date = date("d/m/Y", strtotime($profile_organisation['start_date']));
		$end_date = date("d/m/Y", strtotime($profile_organisation['end_date']));
		$university_username = $profile_organisation['university_username'];
		$casual_workers_scheme = $profile_organisation['casual_workers_scheme'];
		$payroll_id = $profile_organisation['payroll_id'];
		$assignment_id = $profile_organisation['assignment_id'];
		$assignment_id_start_date = date("d/m/Y", strtotime($profile_organisation['assignment_id_start_date']));
		$assignment_id_end_date = date("d/m/Y", strtotime($profile_organisation['assignment_id_end_date']));

	}
	else {
		//echo "<script type='text/javascript'>alert('No profiles found with this ID number!');</script>";
		header('Location: home.php'); 
	}
	  
	mysqli_close($con_ro);
?>	

    <!-- Profile Information -->
    <div class="container">    	
     	<div class="row">
			<div class="col-md-3">
			 	<img id="profileImage" class="profile img-circle">				
			</div>
       		<div class="col-md-8">
       			<div class="page-header">
	        		<h1 class="profileHeading"><?php echo $firstname . " " . $lastname; ?></h1>
					<h2 class="profileSubHeading text-uppercase"><?php echo $role; ?></h2>
				</div>
				<p><?php echo $description; ?></p><br>
			</div>
		</div>     	
     	
     	<!-- Contact Information -->
     	<div class="row">
     		<div class="col-md-6">
     		<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h2 class="panel-title"><span class="glyphicon glyphicon-user"></span> Personal Details</h2>
				</div>
			  	<div class="panel-body">						  	
			  	<table class="table table-condensed table-striped table-responsive" style="padding: 0px; margin: 0px; border: none;">					
				<tr>
					<td>Email:</td>
					<td><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></td>
				</tr>				
				<tr>
					<td>Mobile Phone:</td>
					<td><?php echo $phone_mobile; ?></td>
				</tr>
				<tr>
					<td>Other Phone:</td>
					<td><?php echo $phone_other; ?></td>
				</tr>				
				<tr>
					<td>Address:</td>
					<td>[Private] <a href="mailto:<?php echo $config['admin_user'][1][3]; ?>?bcc=<?php echo $config['admin_user'][0][3]; ?>&subject=Request%20for%20Public%20Engagement%20Database%20Address&body=Dear%20Admin,%0D%0A%0D%0APlease%20can%20I%20request%20the%20address%20for%20public%20enagement%20member%20[MemberName]...%0D%0A%0D%0AKind%20Regards,%0D%0A[YourName]">[Ask admin for this]</a></td>
				</tr>				
				<tr>
					<td>City/Town:</td>
					<td><?php echo $town_or_city; ?><br></td>
				</tr>
				<tr>
					<td>Country:</td>
					<td><?php echo $country; ?></td>
				</tr>								
				<tr>
					<td>Contact Preference:</td>
					<td><?php echo $preference; ?></td>
				</tr>		  			  	
			  	</table>

			  	</div>
			</div>

     		<!-- Organisational Identity -->
     		<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h2 class="panel-title"><span class="glyphicon glyphicon-tower"></span> Organisational Identity</h2>
				</div>
			  	<div class="panel-body">			
			  	
			  	<table class="table table-condensed table-responsive" style="padding: 0px; margin: 0px; border: none;">
			  	<tr>
					<td>Start Date:</td>
					<td><?php echo $start_date; ?></td>
				</tr>
				<tr>
					<td>End Date:</td>
					<td><?php echo $end_date; ?></td>
				</tr>
				<tr>
					<td>Divisional Affiliations:</td>
					<td>
					<?php
						foreach ($profile_divisional_affiliation as $key => $value) {						
							if ($value == "Yes") {	
								switch ($key) {
									case "divisional_affiliation_MW":
										echo "Midwifery<br>";
										break;
									case "divisional_affiliation_NA":
										echo "Nursing (Adult)<br>";
										break;
									case "divisional_affiliation_NC":
										echo "Nursing (Child)<br>";
										break;
									case "divisional_affiliation_NL":
										echo "Nursing (Learning Disabilities)<br>";
										break;
									case "divisional_affiliation_NM":
										echo "Nursing (Mental Health)<br>";
										break;
									case "divisional_affiliation_PT":
										echo "Physiotherapy<br>";
										break;								
									case "divisional_affiliation_SR":
										echo "Sports Rehabilitation and Exercise Science<br>";
										break;
									default:
										echo "N/A";
								}
							}
						}
					?></td>
				</tr>				
				<tr>
					<td>Member of UoN Groups:</td>
					<td>
					<?php
						foreach ($profile_group_membership as $key => $value) {						
							if (($value == "Yes")) {
								switch ($key) {
									case "group_membership_GOV":
										echo "Governance<br>";
										break;
									case "group_membership_OGPE":
										echo "Overview Group for Public Engagement (OGPE)<br>";
										break;
									case "group_membership_PPG":
										echo "Public Participation Group (PPG)<br>";
										break;
									case "group_membership_PPI":
										echo "Public and Patient Involvement (PPI) Research<br>";
										break;
									default:
										echo "N/A";
								}
							}							
						}
						if (($group_membership_other != "No")) {
							echo $group_membership_other;
						}
						else { echo ""; }
						//echo "Your IP address is ".$_SERVER['SERVER_ADDR'];
					?></td>
				</tr>
				<tr>
					<td>University Username:</td>
					<td>
					<?php 
						if (($university_username != "")) {
							echo $university_username;
						}
						else {
							echo "N/A";
						}
					?></td>
				</tr>
				<tr>
					<td>Casual Workers Scheme:</td>
					<td><?php echo $casual_workers_scheme; ?></td>
				</tr>				
				<tr>
					<td>Payroll ID:</td>
					<td><?php echo $payroll_id; ?></td>
				</tr>
				<tr>
					<td>Assignment ID:</td>
					<td><?php echo $assignment_id; ?></td>
				</tr>
				<tr>
					<td>Assignment ID Start Date:</td>
					<td><?php echo $assignment_id_start_date; ?></td>
				</tr>
				<tr>
					<td>Assignment ID End Date:</td>
					<td><?php echo $assignment_id_end_date; ?></td>
				</tr>		  			  			  	
			  	</table>
			  	
			  	</div>
			</div>						
			</div>
    		
     		<div class="col-md-6">			
			<!-- Areas of Experience/Interest -->
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h2 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> Areas of Experience/Interest</h2>
				</div>
			  	<div class="panel-body">
			  		<ul>
					<?php
						foreach ($profile_area_types as $key => $value) {						
							if (($value == "Yes")) {							
								switch ($key) {
									case "area_of_interest_01":
										echo "<li>Addiction</li>";
										break;
									case "area_of_interest_02":
										echo "<li>Being a carer (as a family member or friend)</li>";
										break;
									case "area_of_interest_03":
										echo "<li>Cancer</li>";
										break;
									case "area_of_interest_04":
										echo "<li>Care and support at home</li>";
										break;
									case "area_of_interest_05":
										echo "<li>Care towards the end of life</li>";
										break;
									case "area_of_interest_06":
										echo "<li>Children's health</li>";
										break;								
									case "area_of_interest_07":
										echo "<li>Communication</li>";
										break;
									case "area_of_interest_08":
										echo "<li>Diversity and cultural issues</li>";
										break;
									case "area_of_interest_09":
										echo "<li>Emergency care</li>";
										break;
									case "area_of_interest_10":
										echo "<li>Ethics and philosophy of healthcare</li>";
										break;										
									case "area_of_interest_11":
										echo "<li>Healthcare in hospital</li>";
										break;
									case "area_of_interest_12":
										echo "<li>Homelessness</li>";
										break;
									case "area_of_interest_13":
										echo "<li>How people are involved with their own care and with health services</li>";
										break;
									case "area_of_interest_14":
										echo "<li>Innovations in healthcare</li>";
										break;
									case "area_of_interest_15":
										echo "<li>Learning disabilities</li>";
										break;
									case "area_of_interest_16":
										echo "<li>Living with long-term conditions (such as diabetes, heart or lung conditions, ME/CFS, etc.)</li>";
										break;
									case "area_of_interest_17":
										echo "<li>Mental health</li>";
										break;
									case "area_of_interest_18":
										echo "<li>Older people</li>";
										break;
									case "area_of_interest_19":
										echo "<li>Physical disabilities</li>";
										break;
									case "area_of_interest_20":
										echo "<li>Physiotherapy, physical activity, exercise or sports</li>";
										break;
									case "area_of_interest_21":
										echo "<li>Pregnancy and maternity care</li>";
										break;
									case "area_of_interest_22":
										echo "<li>Public health and health promotion</li>";
										break;
									case "area_of_interest_23":
										echo "<li>Research and how people are involved with research</li>";
										break;
									case "area_of_interest_24":
										echo "<li>Safety and safeguarding</li>";
										break;
									case "area_of_interest_25":
										echo "<li>Sexual health and sexuality</li>";
										break;
									case "area_of_interest_26":
										echo "<li>Substance misuse</li>";
										break;
									case "area_of_interest_27":
										echo "<li>Teenagers and young people</li>";
										break;									
								}
							}							
						}
						if (($area_interest_other != "")) {
							echo "<li>$area_interest_other</li>";
						}
					?>
					</ul>			  	
			  	</div>
			</div>
			
			<!-- Types of Work Interest -->
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h2 class="panel-title"><span class="glyphicon glyphicon-briefcase"></span> Types of Work Interested In</h2>
				</div>
			  	<div class="panel-body">
			  		<ul>
			  		<?php
						foreach ($profile_work_types as $key => $value) {						
							if ($value == "Yes") {	
								switch ($key) {
									case "type_of_work_01":
										echo "<li>Curriculum development</li>";
										break;
									case "type_of_work_02":
										echo "<li>Developing learning materials</li>";
										break;
									case "type_of_work_03":
										echo "<li>Giving feedback to students</li>";
										break;
									case "type_of_work_04":
										echo "<li>Interviewing potential students</li>";
										break;
									case "type_of_work_05":
										echo "<li>Meetings or committees</li>";
										break;
									case "type_of_work_06":
										echo "<li>Research</li>";
										break;								
									case "type_of_work_07":
										echo "<li>Speaking to or teaching students</li>";
										break;
									default:
										echo "<li>No types of work interest recorded</li>";
								}
							}
						}					
					?>
					</ul>
					<p>
					<?php 	
						if (($work_requirements != "")) {
							echo $work_requirements;
						}
					?>
					</p>
			  	</div>
			</div>
			
			<!-- Additional Requirements -->
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h2 class="panel-title"><span class="glyphicon glyphicon-info-sign"></span> Additional Information/Notes</h2>
				</div>
			  	<div class="panel-body">						  	
					<p>
					<?php 
						if (($additional_notes != "")) {
							echo $additional_notes;
						}
						else {
							echo "No additional notes for this profile.";
						}
					?>
					</p>
			  	</div>
			</div>
			<p class="small text-muted text-right">Added to the database on <?php echo $added; ?></p>								
			</div>    		    		     		
     		  		

		</div>   
     	   
    </div><!--.container-->

<?php include('includes/footer.inc.php'); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
    <script src="js/bootstrap.min.js"></script>	
    <script src="js/initial.js-master/initial.js"></script>
	<script>
		$('.profile').initial({charCount:2, name:"<?php echo $initials ?>", width:150, height:150});		
	</script>    
  </body>
</html>
