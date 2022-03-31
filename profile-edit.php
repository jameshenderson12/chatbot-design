<?php

$page_title = 'Edit';
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

  </head>
  <body>

<?php include('includes/main_nav.inc.php'); ?>
	  
	  
<?php 
	 	  
	include('includes/db_connect/db_connect.inc.php');
	  
	if(isset($_GET['id'])){
		
		$id = $_GET['id'];
		
		// Set up variables to capture result of SQL query to retrieve data from database tables		
		$sql_get_profile_overview = "SELECT * FROM overview WHERE id = $id";
		$sql_get_profile_contact = "SELECT * FROM contact WHERE id = $id";
		$sql_get_profile_disability = "SELECT * FROM disability WHERE id = $id";
		$sql_get_profile_notes = "SELECT * FROM notes WHERE id = $id";
		$sql_get_profile_organisation = "SELECT * FROM organisation WHERE id = $id";		
		$sql_get_profile_area_interest = "SELECT * FROM area_interest WHERE id = $id";
		$sql_get_profile_work_interest = "SELECT * FROM work_interest WHERE id = $id";

		$profile_overview = mysqli_fetch_assoc(mysqli_query($con_ro, $sql_get_profile_overview));
		$profile_disability = mysqli_fetch_assoc(mysqli_query($con_ro, $sql_get_profile_disability));		
		$profile_organisation = mysqli_fetch_assoc(mysqli_query($con_ro, $sql_get_profile_organisation));		
		$profile_contact = mysqli_fetch_assoc(mysqli_query($con_ro, $sql_get_profile_contact));				
		$profile_area_interest = mysqli_fetch_assoc(mysqli_query($con_ro, $sql_get_profile_area_interest));
		$profile_work_interest = mysqli_fetch_assoc(mysqli_query($con_ro, $sql_get_profile_work_interest));
		$profile_notes = mysqli_fetch_assoc(mysqli_query($con_ro, $sql_get_profile_notes));
		
		/*
		$profile_divisional_affiliation = array_slice($profile_organisation, 5, 7);
		$profile_group_membership = array_slice($profile_organisation, 12, 5); //5		
		$profile_area_types = array_slice($profile_area_interest, 3, 28);
		$profile_work_types = array_slice($profile_work_interest, 3, 7);
		*/
		
		/* PROFILE OVERVIEW */
		$firstname = ucfirst($profile_overview['firstname']);
		$lastname = ucfirst($profile_overview['lastname']);
		if (($firstname) && ($lastname)) {
			$initials = substr($firstname, 0, 1). "" . substr($lastname, 0, 1);	  
		}
		$role = $profile_overview['role'];
		$description = $profile_overview['description'];				
		$age_range = $profile_overview['age_range'];
		$ethnic_bg = $profile_overview['ethnic_background'];
		$gender = $profile_overview['gender'];
		$sexual_or = $profile_overview['sexual_orientation'];		
		$specific_gender = 'None';		
		if (($gender!=='Female') && ($gender!=='Male') && ($gender!=='Complicated') && ($gender!=='Undisclosed')) {
			$specific_gender = $gender;
		}
		if (($sexual_or!=='Bisexual') && ($sexual_or!=='Gay Man') && ($sexual_or!=='Gay Woman') && ($sexual_or!=='Heterosexual') && ($sexual_or!=='Undisclosed')) {
			$specific_sexual_or = $sexual_or;
		}
		$added = date("l jS \of F", strtotime($profile_overview['added']));		
				
		/* PROFILE DISABILITY */
		$has_condition = $profile_disability['has_condition_or_illness'];
		$affect_01 = $profile_disability['affect_01'];
		$affect_02 = $profile_disability['affect_02'];
		$affect_03 = $profile_disability['affect_03'];
		$affect_04 = $profile_disability['affect_04'];
		$affect_05 = $profile_disability['affect_05'];
		$affect_06 = $profile_disability['affect_06'];
		$affect_07 = $profile_disability['affect_07'];
		$affect_08 = $profile_disability['affect_08'];
		$affect_09 = $profile_disability['affect_09'];
		$affect_10 = $profile_disability['affect_10'];
		$affect_11 = $profile_disability['affect_11'];		
		$reduced_activities = $profile_disability['reduced_daily_activities'];
				
		/* PROFILE ORGANISATION */		
		$start_date = $profile_organisation['start_date'];
		$end_date = $profile_organisation['end_date'];
		$da_mw = $profile_organisation['divisional_affiliation_MW'];
		$da_na = $profile_organisation['divisional_affiliation_NA'];
		$da_nc = $profile_organisation['divisional_affiliation_NC'];
		$da_nl = $profile_organisation['divisional_affiliation_NL'];
		$da_nm = $profile_organisation['divisional_affiliation_NM'];
		$da_pt = $profile_organisation['divisional_affiliation_PT'];
		$da_sr = $profile_organisation['divisional_affiliation_SR'];		
		$group_gov = $profile_organisation['group_membership_GOV'];
		$group_ogpe = $profile_organisation['group_membership_OGPE'];
		$group_ppg = $profile_organisation['group_membership_PPG'];
		$group_ppi = $profile_organisation['group_membership_PPI'];
		$group_other = ucfirst($profile_organisation['group_membership_other']);
		$university_username = $profile_organisation['university_username'];
		$casual_workers_scheme = $profile_organisation['casual_workers_scheme'];
		$payroll_id = $profile_organisation['payroll_id'];
		$assignment_id = $profile_organisation['assignment_id'];
		$assignment_id_start_date = $profile_organisation['assignment_id_start_date'];
		$assignment_id_end_date = $profile_organisation['assignment_id_end_date'];
		
		/* PROFILE CONTACT */ 
		$address_line_01 = $profile_contact['address_line_01'];
		$address_line_02 = $profile_contact['address_line_02'];
		$address_line_03 = $profile_contact['address_line_03'];
		$town_or_city = $profile_contact['town_or_city'];
		$country = $profile_contact['country'];
		$postcode = $profile_contact['postcode'];
		$email = $profile_contact['email'];
		$phone_mobile = $profile_contact['phone_mobile'];
		$phone_other = $profile_contact['phone_other'];
		$preference = $profile_contact['preference'];
		
		/* PROFILE AREA INTEREST */
		$area_of_interest_01 = $profile_area_interest['area_of_interest_01'];
		$area_of_interest_02 = $profile_area_interest['area_of_interest_02'];
		$area_of_interest_03 = $profile_area_interest['area_of_interest_03'];
		$area_of_interest_04 = $profile_area_interest['area_of_interest_04'];
		$area_of_interest_05 = $profile_area_interest['area_of_interest_05'];
		$area_of_interest_06 = $profile_area_interest['area_of_interest_06'];
		$area_of_interest_07 = $profile_area_interest['area_of_interest_07'];
		$area_of_interest_08 = $profile_area_interest['area_of_interest_08'];
		$area_of_interest_09 = $profile_area_interest['area_of_interest_09'];
		$area_of_interest_10 = $profile_area_interest['area_of_interest_10'];
		$area_of_interest_11 = $profile_area_interest['area_of_interest_11'];
		$area_of_interest_12 = $profile_area_interest['area_of_interest_12'];
		$area_of_interest_13 = $profile_area_interest['area_of_interest_13'];
		$area_of_interest_14 = $profile_area_interest['area_of_interest_14'];
		$area_of_interest_15 = $profile_area_interest['area_of_interest_15'];
		$area_of_interest_16 = $profile_area_interest['area_of_interest_16'];
		$area_of_interest_17 = $profile_area_interest['area_of_interest_17'];
		$area_of_interest_18 = $profile_area_interest['area_of_interest_18'];
		$area_of_interest_19 = $profile_area_interest['area_of_interest_19'];
		$area_of_interest_20 = $profile_area_interest['area_of_interest_20'];
		$area_of_interest_21 = $profile_area_interest['area_of_interest_21'];
		$area_of_interest_22 = $profile_area_interest['area_of_interest_22'];
		$area_of_interest_23 = $profile_area_interest['area_of_interest_23'];
		$area_of_interest_24 = $profile_area_interest['area_of_interest_24'];
		$area_of_interest_25 = $profile_area_interest['area_of_interest_25'];
		$area_of_interest_26 = $profile_area_interest['area_of_interest_26'];
		$area_of_interest_27 = $profile_area_interest['area_of_interest_27'];
		$area_of_interest_other = ucfirst($profile_area_interest['other']);
		
		/* PROFILE WORK INTEREST */
		$type_of_work_01 = $profile_work_interest['type_of_work_01'];
		$type_of_work_02 = $profile_work_interest['type_of_work_02'];
		$type_of_work_03 = $profile_work_interest['type_of_work_03'];
		$type_of_work_04 = $profile_work_interest['type_of_work_04'];
		$type_of_work_05 = $profile_work_interest['type_of_work_05'];
		$type_of_work_06 = $profile_work_interest['type_of_work_06'];
		$type_of_work_07 = $profile_work_interest['type_of_work_07'];
		$type_of_work_requirements = ucfirst($profile_work_interest['requirements']);
		
		/* PROFILE NOTES */
		$additional_notes = $profile_notes['additional_notes'];

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
			<div class="col-md-12">				
       			<div class="page-header">
	        		<h1 class="profileHeading">Administration</h1>
					<h2 class="profileSubHeading text-uppercase">Edit an existing profile</h2>
				</div>
													
				<form class="form-horizontal form" method="post" action="update.php"><!-- VALIDATE!!-->
       			<!--<form id="registrationForm" name="registrationForm" class="form-horizontal" method="post" action="php/register.php" onSubmit="return validateFullForm()">-->
        			
        			<!-- Profile Overview -->
         			<h3 class="formSeperator">
					<input class="btn btn-xs" type="button" data-toggle="collapse" data-target="#collapse01" aria-expanded="true" aria-controls="collapse01" value="Hide">
         			Profile Overview 
         			</h3>         			
         			
         			<div class="collapse in" id="collapse01">
						<div class="form-group">
							<label for="profileId" class="col-sm-2 col-sm-offset-2 control-label">
							DB Identifier							
							</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="profileId" name="profileId" value="<?=$id?>" readonly>
							</div>
						</div>         															
						<div class="form-group">
							<label for="profileFirstName" class="col-sm-2 col-sm-offset-2 control-label">
							First Name
							<span class="text-danger">*</span>
							</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="profileFirstName" name="profileFirstName" value="<?=$firstname?>">
							</div>
						</div>         			
						<div class="form-group">
							<label for="profileLastName" class="col-sm-2 col-sm-offset-2 control-label">	
							Last Name
							<span class="text-danger">*</span>
							</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="profileLastName" name="profileLastName" value="<?=$lastname?>">
							</div>
						</div>						
						<div class="form-group">
							<label for="profileName" class="col-sm-2 col-sm-offset-2 control-label">
							Role
							<span class="text-danger">*</span>
							</label>
							<div class="col-sm-4">
								<select class="form-control dropdown" id="profileRole" name="profileRole">
									<option value="<?=$role?>" disabled selected hidden><?=$role?></option>
									<!--<optgroup label="Group">-->	  
									  <option value="Carer" <?=($role=='Carer')?'selected':'' ?>>Carer</option>								  
									  <option value="Patient" <?=($role=='Patient')?'selected':'' ?>>Patient</option>
									  <option value="Survivor" <?=($role=='Survivor')?'selected':'' ?>>Survivor</option>
									  <option value="Person with Lived Experience" <?=($role=='Person with Lived Experience')?'selected':'' ?>>Person with Lived Experience</option>
									  <option value="Service User" <?=($role=='Service User')?'selected':'' ?>>Service User</option>
									  <option value="Service User and Carer" <?=($role=='Service User and Carer')?'selected':'' ?>>Service User and Carer</option>
									  <option value="Unspecified" <?=($role=='Unspecified')?'selected':'' ?>>Unspecified</option>	  
								</select>
								<caption><code>Description of role that the profile identifies with.</code></caption>
							</div>
						</div>
						<div class="form-group">
							<label for="profileDescription" class="col-sm-2 col-sm-offset-2 control-label">Description</label>
							<div class="col-sm-7">
								<textarea class="form-control" id="profileDescription" name="profileDescription" rows="2"><?=$description?></textarea>
								<caption><code>What health experiences or background does the profile bring to working within the School?</code></caption>
							</div>
						</div>
						<div class="form-group">
							<label for="profileAgeRange" class="col-sm-2 col-sm-offset-2 control-label">
							Age Range
							<span class="text-danger">*</span>
							</label>
							<div class="col-sm-4">
								<select class="form-control dropdown" id="profileAgeRange" name="profileAgeRange">
									<option value="<?=$age_range?>" disabled selected hidden><?=$age_range?></option>
									  <option value="Under 18" <?=($age_range=='Under 18')?'selected':'' ?>>Under 18</option>
									  <option value="18-24" <?=($age_range=='18-24')?'selected':'' ?>>18-24</option>
									  <option value="25-34" <?=($age_range=='25-34')?'selected':'' ?>>25-34</option>								  
									  <option value="35-44" <?=($age_range=='35-44')?'selected':'' ?>>35-44</option>
									  <option value="45-54" <?=($age_range=='45-54')?'selected':'' ?>>45-54</option>
									  <option value="55-64" <?=($age_range=='55-64')?'selected':'' ?>>55-64</option>
									  <option value="65-74" <?=($age_range=='65-74')?'selected':'' ?>>65-74</option>
									  <option value="75+" <?=($age_range=='75+')?'selected':'' ?>>75+</option>
								</select>
								<caption><code>Profile's specified age range.</code></caption>
							</div>
						</div>
						<div class="form-group">
							<label for="profileEthnicity" class="col-sm-2 col-sm-offset-2 control-label">
							Ethnic Background
							<span class="text-danger">*</span>
							</label>
							<div class="col-sm-4">              		
								<select class="form-control dropdown" id="profileEthnicity" name="profileEthnicity">
									<option value="<?=$ethnic_bg?>" disabled selected hidden><?=$ethnic_bg?></option>
									<!-- Based on a combination of Best UX practices for requesting race/ethnicity at https://gist.github.com/ag14spirit/255ca96e7c6c2f0c3845e2ade14de245 and Ethnic group statistics by the Office for National Statistics at https://www.google.co.uk/url?sa=t&rct=j&q=&esrc=s&source=web&cd=3&ved=0ahUKEwit7IW9q_TUAhUjKcAKHWPrAb8QFgg1MAI&url=https%3A%2F%2Fwww.ons.gov.uk%2Fons%2Fguide-method%2Fmeasuring-equality%2Fequality%2Fmeasuring-equality--a-guide%2Fethnic-group-statistics--a-guide-for-the-collection-and-classification-of-ethnicity-data.pdf&usg=AFQjCNHWQ_OXxV2lQOH7HrLLYdZc40DtWA -->
									<!-- Also based on categories used by Nottingham City Council 2016 -->
									<!-- Change to "Gypsy or Irish Traveller" as suggested by J. Gosling 04/07/2017 -->
								  	<option value="Arab" <?=($ethnic_bg=='Arab')?'selected':'' ?>>Arab</option>	
									<option value="Asian Bangladeshi" <?=($ethnic_bg=='Asian Bangladeshi')?'selected':'' ?>>Asian Bangladeshi</option>
									<option value="Asian Chinese" <?=($ethnic_bg=='Asian Chinese')?'selected':'' ?>>Asian Chinese</option>
									<option value="Asian Indian" <?=($ethnic_bg=='Asian Indian')?'selected':'' ?>>Asian Indian</option>
									<option value="Asian Kashmiri" <?=($ethnic_bg=='Asian Kashmiri')?'selected':'' ?>>Asian Kashmiri</option>
									<option value="Asian Pakistani" <?=($ethnic_bg=='Asian Pakistani')?'selected':'' ?>>Asian Pakistani</option>		  
									<option value="Asian Other" <?=($ethnic_bg=='Asian Other')?'selected':'' ?>>Asian Other</option>		
									<option value="Black African" <?=($ethnic_bg=='Black African')?'selected':'' ?>>Black African</option>
									<option value="Black Caribbean" <?=($ethnic_bg=='Black Caribbean')?'selected':'' ?>>Black Caribbean</option>
									<option value="Black Other" <?=($ethnic_bg=='Black Other')?'selected':'' ?>>Black Other</option>
									<option value="White Gypsy, Roma or Traveller" <?=($ethnic_bg=='White Gypsy, Roma or Traveller')?'selected':'' ?>>Gypsy, Roma or Traveller</option>				
									<option value="Mixed White and Asian" <?=($ethnic_bg=='Mixed White and Asian')?'selected':'' ?>>Mixed White and Asian</option>
									<option value="Mixed White and Black African" <?=($ethnic_bg=='Mixed White and Black African')?'selected':'' ?>>Mixed White and Black African</option>
									<option value="Mixed White and Black Caribbean" <?=($ethnic_bg=='Mixed White and Black Caribbean')?'selected':'' ?>>Mixed White and Black Caribbean</option>
									<option value="Mixed Other" <?=($ethnic_bg=='Mixed Other')?'selected':'' ?>>Mixed Other</option>
									<option value="White English" <?=($ethnic_bg=='White English')?'selected':'' ?>>White English</option>
									<option value="White Northern Irish" <?=($ethnic_bg=='White Northern Irish')?'selected':'' ?>>White Northern Irish</option>
									<option value="White Irish" <?=($ethnic_bg=='White Irish')?'selected':'' ?>>White Irish</option>
									<option value="White Scottish" <?=($ethnic_bg=='White Scottish')?'selected':'' ?>>White Scottish</option>
									<option value="White Welsh" <?=($ethnic_bg=='White Welsh')?'selected':'' ?>>White Welsh</option>
									<option value="White Other" <?=($ethnic_bg=='White Other')?'selected':'' ?>>White Other</option>
								</select>
								<caption><code>To which racial or ethnic group(s) the profile identifies with.</code></caption>
							</div>
						</div>
						<div class="form-group">
							<label for="profileGender" class="col-sm-2 col-sm-offset-2 control-label">
							Gender
							<span class="text-danger">*</span>							
							</label>							
							<!-- Gender options as recommended by web professional, gender diversity resource and community blogger Sarah Dopp at http://www.sarahdopp.com/blog/2010/designing-a-better-drop-down-menu-for-gender -->
							<!-- Additional research includes taking into account the following two resources at https://ux.stackexchange.com/questions/25826/how-can-i-deal-with-diverse-gender-identities-in-user-profiles and http://www.totb.org.uk/forms -->
							<div class="col-sm-2">
								<div class="radio">
								  <label>
									<input type="radio" name="profileGender" id="genderFemale" value="Female" <?=($gender=='Female')?'checked':'' ?>>
									Female
								  </label>
								</div>
								<div class="radio">
								  <label>
									<input type="radio" name="profileGender" id="genderMale" value="Male" <?=($gender=='Male')?'checked':'' ?>>
									Male
								  </label>
								</div>
								<div class="radio">
								  <label>
									<input type="radio" name="profileGender" id="genderComplicated" value="Complicated" <?=($gender=='Complicated')?'checked':'' ?>>
									It's complicated
								  </label>
								</div>
							</div>
							<div class="col-sm-4">								
								<div class="radio">
								  <label>
									<input type="radio" name="profileGender" id="genderUndisclosed" value="Undisclosed" <?=($gender=='Undisclosed')?'checked':'' ?>>
									Prefer not to say
								  </label>
								</div>
							<div class="radio">
								  <label>
									<input type="radio" name="profileGender" id="genderSpecify" <?=(($gender!=='Female') && ($gender!=='Male') && ($gender!=='Complicated') && ($gender!=='Undisclosed'))?'checked':'' ?>>
									Prefer to self-describe 
								  </label>								  								  	
								</div>
								<input type="text" name="genderSpecific" id="genderSpecific" class="form-control" style="display: none" value="<?=$specific_gender?>">		
							</div>
							<div class="clearfix col-sm-12 col-sm-offset-4">
								<caption><code>To which gender the profile identifies with.</code></caption>
							</div>
						</div>
						<div class="form-group">
							<label for="profileSexualOrientation" class="col-sm-2 col-sm-offset-2 control-label">
							Sexual Orientation
							<span class="text-danger">*</span>							
							</label>							
							<!-- Gender options as recommended by web professional, gender diversity resource and community blogger Sarah Dopp at http://www.sarahdopp.com/blog/2010/designing-a-better-drop-down-menu-for-gender -->
							<!-- Additional research includes taking into account the following two resources at https://ux.stackexchange.com/questions/25826/how-can-i-deal-with-diverse-gender-identities-in-user-profiles and http://www.totb.org.uk/forms -->
							<div class="col-sm-2">
								<div class="radio">
								  <label>
									<input type="radio" name="profileSexualOrientation" id="sexualOrientationBisexual" value="Bisexual" <?=($sexual_or=='Bisexual')?'checked':'' ?>>
									Bisexual
								  </label>
								</div>
								<div class="radio">
								  <label>
									<input type="radio" name="profileSexualOrientation" id="sexualOrientationGayMan" value="Gay Man" <?=($sexual_or=='Gay Man')?'checked':'' ?>>
									Gay Man
								  </label>
								</div>
								<div class="radio">
								  <label>
									<input type="radio" name="profileSexualOrientation" id="sexualOrientationGayWoman" value="Gay Woman" <?=($sexual_or=='Gay Woman')?'checked':'' ?>>
									Gay Woman/Lesbian
								  </label>
								</div>
								<div class="radio">
								  <label>
									<input type="radio" name="profileSexualOrientation" id="sexualOrientationHeterosexual" value="Heterosexual" <?=($sexual_or=='Heterosexual')?'checked':'' ?>>
									Heterosexual/Straight
								  </label>
								</div>		
							</div>
							<div class="col-sm-4">								
								<div class="radio">
								  <label>
									<input type="radio" name="profileSexualOrientation" id="sexualOrientationUndisclosed" value="Undisclosed" <?=($sexual_or=='Undisclosed')?'checked':'' ?>>
									Prefer not to say
								  </label>
								</div>
							<div class="radio">
								  <label>
									<input type="radio" name="profileSexualOrientation" id="sexualOrientationSpecify" <?=(($sexual_or!=='Bisexual') && ($sexual_or!=='Gay Man') && ($sexual_or!=='Gay Woman') && ($sexual_or!=='Heterosexual') && ($sexual_or!=='Undisclosed'))?'checked':'' ?>>									  
									Prefer to self-describe
								  </label>								  								  	
								</div>
								<input type="text" name="sexualOrientationSpecific" id="sexualOrientationSpecific" class="form-control" style="display: none" value="<?=$specific_sexual_or?>">										
							</div>
							<div class="clearfix col-sm-12 col-sm-offset-4">
								<caption><code>To which sexual orientation the profile identifies with.</code></caption>
							</div>
						</div>
						<div class="form-group">
							<!-- Based on "Guidance note on asking questions on: disability" from the Scottish Government
							http://www.gov.scot/Resource/0039/00393542.pdf -->           				
							<label for="profileDisability" class="col-sm-2 col-sm-offset-2 control-label">Do you have a physical or mental health condition or illness lasting or expected to last 12 months or more?</label>							
							<div class="col-sm-2">
								<div class="radio">
								  <label>
									<input type="radio" name="profileDisability" id="disabilityYes" value="Yes" <?=($has_condition=='Yes')?'checked':'' ?>>
									Yes
								  </label>
								</div>
								<div class="radio">
								  <label>
									<input type="radio" name="profileDisability" id="disabilityNo" value="No" <?=($has_condition=='No')?'checked':'' ?>>
									No
								  </label>
								</div>
								<div class="radio">
								  <label>
									<input type="radio" name="profileDisability" id="disabilityUnsure" value="Unsure" <?=($has_condition=='Unsure')?'checked':'' ?>>
									Don't know
								  </label>
								</div>								
							</div>							
							<div class="col-sm-4">								
								<div class="radio">
								  <label>
									<input type="radio" name="profileDisability" id="disabilityUndisclosed" value="Undisclosed" <?=($has_condition=='Undisclosed')?'checked':'' ?>>
									Prefer not to say
								  </label>
								</div>
							</div>
						</div>
						<div class="form-group" id="disabilityAffect" style="display: none">
							<label for="profileDisabilityAffect" class="col-sm-2 col-sm-offset-2 control-label">Does this condition or illness affect you in any of the following areas?</label>
							<div class="col-sm-4">              		
								<div class="checkbox">
									<label>
									 	<input type="hidden" name="profileDisabilityAffect[0]" value="No" />
										<input id="da01" name="profileDisabilityAffect[0]" type="checkbox" value="Yes" <?=($affect_01=='Yes')?'checked':'' ?>> Vision (e.g. blindness or partial sight)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDisabilityAffect[1]" value="No" />
										<input id="da02" name="profileDisabilityAffect[1]" type="checkbox" value="Yes" <?=($affect_02=='Yes')?'checked':'' ?>> Hearing (e.g. deafness or partial hearing)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDisabilityAffect[2]" value="No" />
										<input id="da03" name="profileDisabilityAffect[2]" type="checkbox" value="Yes" <?=($affect_03=='Yes')?'checked':'' ?>> Mobility (e.g. walking short distances or climbing stairs)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDisabilityAffect[3]" value="No" />
										<input id="da04" name="profileDisabilityAffect[3]" type="checkbox" value="Yes" <?=($affect_04=='Yes')?'checked':'' ?>> Dexterity (e.g. lifting or carrying objects, using a keyboard)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDisabilityAffect[4]" value="No" />
										<input id="da05" name="profileDisabilityAffect[4]" type="checkbox" value="Yes" <?=($affect_05=='Yes')?'checked':'' ?>> Learning or understanding or concentrating
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDisabilityAffect[5]" value="No" />
										<input id="da06" name="profileDisabilityAffect[5]" type="checkbox" value="Yes" <?=($affect_06=='Yes')?'checked':'' ?>> Memory
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDisabilityAffect[6]" value="No" />
										<input id="da07" name="profileDisabilityAffect[6]" type="checkbox" value="Yes" <?=($affect_07=='Yes')?'checked':'' ?>> Mental health
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDisabilityAffect[7]" value="No" />
										<input id="da08" name="profileDisabilityAffect[7]" type="checkbox" value="Yes" <?=($affect_08=='Yes')?'checked':'' ?>> Stamina or breathing or fatigue
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDisabilityAffect[8]" value="No" />
										<input id="da09" name="profileDisabilityAffect[8]" type="checkbox" value="Yes" <?=($affect_09=='Yes')?'checked':'' ?>> Socially or behaviourally (e.g. associated with autism, attention deficit disorder or Aspergers' syndrome)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDisabilityAffect[9]" value="No" />
										<input id="da10" name="profileDisabilityAffect[9]" type="checkbox" value="Yes" <?=($affect_10=='Yes')?'checked':'' ?>> None of the above
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDisabilityAffect[10]" value="No" />
										<input id="disabilityAffectSpecify" name="profileDisabilityAffect[10]" type="checkbox" value="Yes" <?=($affect_11!='No')?'checked':'' ?>> Other (please specify)
									</label>
								</div>
								<input type="text" name="disabilityAffectSpecific" id="disabilityAffectSpecific" class="form-control" style="display: none" value="<?=($affect_11!='No')?$affect_11:'' ?>">		  									   
							</div>
						</div>          			          			
						<div class="form-group" id="disabilityActivity" style="display: none">
							<label for="profileDisabilityActivity" class="col-sm-2 col-sm-offset-2 control-label">Does your condition or illness reduce your ability to carry-out day-to-day activities?</label>
							<div class="col-sm-2">
								<div class="radio">
								  <label>
									<input type="radio" name="profileDisabilityActivity" id="disabilityActivityYesLot" value="Yes, a lot" <?=($reduced_activities=='Yes, a lot')?'checked':'' ?>>
									Yes, a lot
								  </label>
								</div> 
								<div class="radio">
								  <label>
									<input type="radio" name="profileDisabilityActivity" id="disabilityActivityYesLittle" value="Yes, a little" <?=($reduced_activities=='Yes, a little')?'checked':'' ?>>
									Yes, a little
								  </label>
								</div> 
								<div class="radio">
								  <label>
									<input type="radio" name="profileDisabilityActivity" id="disabilityActivityNo" value="Not at all" <?=($reduced_activities=='Not at all')?'checked':'' ?>>
									Not at all
								  </label>
								</div>								
							</div>
							<div class="col-sm-4">								
								<div class="radio">
								  <label>
									<input type="radio" name="profileDisabilityActivity" id="disabilityActivityUndisclosed" value="Undisclosed" <?=($reduced_activities=='Undisclosed')?'checked':'' ?>>
									Prefer not to say
								  </label>
								</div>
							</div>							
						</div>
					</div><!-- collapse -->
        			
        			<!-- ORGANISATIONAL IDENTITY -->
         			<h3 class="formSeperator">
					<input class="btn btn-xs" type="button" data-toggle="collapse" data-target="#collapse02" aria-expanded="true" aria-controls="collapse02" value="Hide">
         			Organisational Identity 
         			</h3>         			         			
         			<div class="collapse in" id="collapse02">
						<div class="form-group">          			
							<label for="profileStartDate" class="col-sm-2 col-sm-offset-2 control-label">
							Start Date
							<span class="text-danger">*</span>
							</label>
							<div class="col-sm-4">
								<input type="date" class="form-control" id="profileStartDate" name="profileStartDate" placeholder="dd/mm/yyyy" value="<?=$start_date?>">
								<caption><code>Enter involvement start date of profile.</code></caption>
							</div>
						</div>
						<div class="form-group">
							<label for="profileEndDate" class="col-sm-2 col-sm-offset-2 control-label">
							End Date            			
							</label>
							<div class="col-sm-4">
								<input type="date" class="form-control" id="profileEndDate" name="profileEndDate" placeholder="dd/mm/yyyy" value="<?=$end_date?>">
								<caption><code>Enter involvement end date of profile (if no longer part of scheme).</code></caption>
							</div>
						</div>         			
						<div class="form-group">
							<label for="profileDivisionalAffiliation" class="col-sm-2 col-sm-offset-2 control-label">Divisional Affiliation</label>
							<div class="col-sm-6">
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDivisionalAffiliation[0]" value="No" />
										<input id="shsdivmid" name="profileDivisionalAffiliation[0]" type="checkbox" value="Yes" <?=($da_mw=='Yes')?'checked':'' ?>> Midwifery
									</label>
								</div>    	        		
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDivisionalAffiliation[1]" value="No" />
										<input id="shsdivnad" name="profileDivisionalAffiliation[1]" type="checkbox" value="Yes" <?=($da_na=='Yes')?'checked':'' ?>> Nursing (Adult)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDivisionalAffiliation[2]" value="No" />
										<input id="shsdivnch" name="profileDivisionalAffiliation[2]" type="checkbox" value="Yes" <?=($da_nc=='Yes')?'checked':'' ?>> Nursing (Child)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDivisionalAffiliation[3]" value="No" />
										<input id="shsdivnld" name="profileDivisionalAffiliation[3]" type="checkbox" value="Yes" <?=($da_nl=='Yes')?'checked':'' ?>> Nursing (Learning Disabilities)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDivisionalAffiliation[4]" value="No" />
										<input id="shsdivnmh" name="profileDivisionalAffiliation[4]" type="checkbox" value="Yes" <?=($da_nm=='Yes')?'checked':'' ?>> Nursing (Mental Health)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDivisionalAffiliation[5]" value="No" />
										<input id="shsdivphy" name="profileDivisionalAffiliation[5]" type="checkbox" value="Yes" <?=($da_pt=='Yes')?'checked':'' ?>> Physiotherapy
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileDivisionalAffiliation[6]" value="No" />
										<input id="shsdivsrs" name="profileDivisionalAffiliation[6]" type="checkbox" value="Yes" <?=($da_sr=='Yes')?'checked':'' ?>> Sports Rehabilitation and Exercise Science
									</label>
								</div>           			
							</div>																
						</div>					
						<div class="form-group">
							<label for="profileGroups" class="col-sm-2 col-sm-offset-2 control-label">Member of University Groups</label>
							<div class="col-sm-4">
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileGroupMembership[0]" value="No" />
										<input id="groupgov" name="profileGroupMembership[0]" type="checkbox" value="Yes" <?=($group_gov=='Yes')?'checked':'' ?>> Governance
									</label>
								</div>							
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileGroupMembership[1]" value="No" />
										<input id="groupogpe" name="profileGroupMembership[1]" type="checkbox" value="Yes" <?=($group_ogpe=='Yes')?'checked':'' ?>> Overview Group for Public Engagement (OGPE)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileGroupMembership[2]" value="No" />
										<input id="groupppg" name="profileGroupMembership[2]" type="checkbox" value="Yes" <?=($group_ppg=='Yes')?'checked':'' ?>> Public Participation Group (PPG)
									</label>
								</div>  
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileGroupMembership[3]" value="No" />
										<input id="groupppi" name="profileGroupMembership[3]" type="checkbox" value="Yes" <?=($group_ppi=='Yes')?'checked':'' ?>> Public and Patient Involvement (PPI) Research
									</label>
								</div>			
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileGroupMembership[4]" value="No" />				
										<input id="groupSpecify" name="profileGroupMembership[4]" type="checkbox" value="Yes" <?=($group_other=='Yes')?'checked':'' ?>> Other (please specify)
									</label>
								</div>								
								<input type="text" name="groupSpecific" id="groupSpecific" class="form-control" style="display: none">
							</div>
						</div>
						<div class="form-group">
							<label for="profileUoNUsername" class="col-sm-2 col-sm-offset-2 control-label">University Username</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="profileUoNUsername" name="profileUoNUsername" value="<?=$university_username?>">
								<caption><code>Please enter UoN username (e.g. ntyabc).</code></caption>
							</div>
						</div>         			
						<div class="form-group">
							<label for="profileRegOnCWS" class="col-sm-2 col-sm-offset-2 control-label">Registered on Casual Workers Scheme?</label>
							<div class="col-sm-4">            			
								<label class="radio-inline">
									<input name="profileRegOnCWS" type="radio" value="Yes" <?=($casual_workers_scheme=='Yes')?'checked':'' ?>>
									Yes
								</label>
								<label class="radio-inline">
									<input name="profileRegOnCWS" type="radio" value="No" <?=($casual_workers_scheme=='No')?'checked':'' ?>>
									No
								</label>
							</div>
						</div>         			         			
						<div class="form-group">
							<label for="profilePayrollID" class="col-sm-2 col-sm-offset-2 control-label">
							Payroll ID
							<span class="text-danger">*</span>
							</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="profilePayrollID" name="profilePayrollID" value="<?=$payroll_id?>">
								<caption><code>Enter payroll ID of profile.</code></caption>
							</div>
						</div>          			
						<div class="form-group">
							<label for="profileAssignmentID" class="col-sm-2 col-sm-offset-2 control-label">
							Assignment ID
							<span class="text-danger">*</span>
							</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="profileAssignmentID" name="profileAssignmentID" value="<?=$assignment_id?>">
								<caption><code>Enter assignment ID of profile.</code></caption>
							</div>
						</div>
						<div class="form-group">
							<label for="profileAssignmentStartDate" class="col-sm-2 col-sm-offset-2 control-label">
							Assignment ID Start
							<span class="text-danger">*</span>
							</label>
							<div class="col-sm-4">
								<input type="date" class="form-control" id="profileAssignmentStartDate" name="profileAssignmentStartDate" placeholder="dd/mm/yyyy" value="<?=$assignment_id_start_date?>">
								<caption><code>Enter assignment start date of profile.</code></caption>
							</div>
						</div>
						<div class="form-group">
							<label for="profileAssignmentEndDate" class="col-sm-2 col-sm-offset-2 control-label">
							<!--<span class="glyphicon glyphicon-info-sign"></span>-->
							Assignment ID End
							<span class="text-danger">*</span>
							</label>
							<div class="col-sm-4">
								<input type="date" class="form-control" id="profileAssignmentEndDate" name="profileAssignmentEndDate" placeholder="dd/mm/yyyy" value="<?=$assignment_id_end_date?>">
								<caption><code>Enter assignment end date of profile.</code></caption>
							</div>
						</div>
         			</div><!-- collapse -->					
          			          			
          			<!-- CONTACT DETAILS -->          			
         			<h3 class="formSeperator">
					<input class="btn btn-xs" type="button" data-toggle="collapse" data-target="#collapse03" aria-expanded="true" aria-controls="collapse03" value="Hide">
         			Contact Details 
         			</h3>         			         			
         			<div class="collapse in" id="collapse03">          			          			
						<div class="form-group">
							<label for="profileAddress1" class="col-sm-2 col-sm-offset-2 control-label">
							Address Line 1
							<span class="text-danger">*</span>
							</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="profileAddress1" name="profileAddress1" value="<?=$address_line_01?>">
								<!--<caption><code>Please include a space where necessary.</code></caption>-->
							</div>
						</div>
						<div class="form-group">
							<label for="profileAddress2" class="col-sm-2 col-sm-offset-2 control-label">
							Address Line 2
							</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="profileAddress2" name="profileAddress2" value="<?=$address_line_02?>">
								<!--<caption><code>Please include a space where necessary.</code></caption>-->
							</div>
						</div>
						<div class="form-group">
							<label for="profileAddress3" class="col-sm-2 col-sm-offset-2 control-label">
							Address Line 3
							</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="profileAddress3" name="profileAddress3" value="<?=$address_line_03?>">
								<!--<caption><code>Please include a space where necessary.</code></caption>-->
							</div>
						</div>
						<div class="form-group">
							<label for="profileTown" class="col-sm-2 col-sm-offset-2 control-label">
							Town/City
							<span class="text-danger">*</span>
							</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="profileTown" name="profileTown" value="<?=$town_or_city?>">
								<!--<caption><code>Please include a space where necessary.</code></caption>-->
							</div>
						</div>
						<div class="form-group">
							<label for="profileCountry" class="col-sm-2 col-sm-offset-2 control-label">
							Country
							<span class="text-danger">*</span>
							</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="profileCountry" name="profileCountry" value="<?=$country?>">
								<!--<caption><code>Please include a space where necessary.</code></caption>-->
							</div>
						</div>																				          			
						<div class="form-group">
							<label for="profilePostcode" class="col-sm-2 col-sm-offset-2 control-label">
							Postcode
							<span class="text-danger">*</span>
							</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="profilePostcode" name="profilePostcode" value="<?=$postcode?>">
								<caption><code>Please include a space where necessary.</code></caption>
							</div>
						</div>
						<div class="form-group">
							<label for="profileEmail" class="col-sm-2 col-sm-offset-2 control-label">            			
							Email            			
							</label>
							<div class="col-sm-4">
								<input type="email" class="form-control" id="profileEmail" name="profileEmail" placeholder="e.g. serviceuserorcarer@example.com" aria-describedby="profileEmailStatus" value="<?=$email?>">
								<span class="glyphicon glyphicon-ok form-control-feedback hidden" aria-hidden="true"></span>
								<span id="profileEmailStatus" class="sr-only">(success)</span>
								<caption><code>Enter a valid email address.</code></caption>
							</div>
						</div>
						<div class="form-group">
							<label for="profileMob" class="col-sm-2 col-sm-offset-2 control-label">
							Mobile Phone #
							</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="profileMob" name="profileMob" value="<?=$phone_mobile?>">
								<caption><code>Please insert numbers without spaces.</code></caption>
							</div>
						</div>          			
						<div class="form-group">
							<label for="profilePhone" class="col-sm-2 col-sm-offset-2 control-label">
							Other Phone #
							</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="profilePhone" name="profilePhone" value="<?=$phone_other?>">
								<caption><code>Please insert numbers without spaces.</code></caption>
							</div>            			
						</div>          			
						<div class="form-group">
							<label for="profileContactPref" class="col-sm-2 col-sm-offset-2 control-label">
							Contact Preference
							<span class="text-danger">*</span>
							</label>
							<div class="col-sm-4">              		
								<select class="form-control dropdown" id="profileContactPref" name="profileContactPref">
									<option value="<?=$preference?>" disabled selected hidden><?=$preference?></option>
									<!--<optgroup label="Group">-->
									  <option value="Any" <?=($preference=='Any')?'selected':'' ?>>Any</option>								  
									  <option value="Email" <?=($preference=='Email')?'selected':'' ?>>Email</option>
									  <option value="Letter" <?=($preference=='Letter')?'selected':'' ?>>Letter by post</option>
									  <option value="Mobile" <?=($preference=='Mobile')?'selected':'' ?>>Mobile phone</option>
									  <option value="Other" <?=($preference=='Other')?'selected':'' ?>>Other phone</option>								  
								</select>
								<caption><code>Profile's preferred method of contact.</code></caption>
							</div>
						</div>
          			</div><!-- collapse -->    
          			
         			
         			<!-- AREAS OF INTEREST -->
					<h3 class="formSeperator">
					<input class="btn btn-xs" type="button" data-toggle="collapse" data-target="#collapse04" aria-expanded="true" aria-controls="collapse04" value="Hide">
         			Areas of Experience/Interest
         			</h3>         			         			
         			<div class="collapse in" id="collapse04">
						<div class="form-group">
							<label for="profileArea" class="col-sm-2 control-label">
							Area Interests
							<span class="text-danger">*</span>
							</label>
							<div class="col-sm-3">
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[0]" value="No" />
										<input id="area01" name="profileArea[0]" type="checkbox" value="Yes" <?=($area_of_interest_01=='Yes')?'checked':'' ?>> Addiction
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[1]" value="No" />
										<input id="area02" name="profileArea[1]" type="checkbox" value="Yes" <?=($area_of_interest_02=='Yes')?'checked':'' ?>> Being a carer (as a family member or friend)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[2]" value="No" />
										<input id="area03" name="profileArea[2]" type="checkbox" value="Yes" <?=($area_of_interest_03=='Yes')?'checked':'' ?>> Cancer
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[3]" value="No" />
										<input id="area04" name="profileArea[3]" type="checkbox" value="Yes" <?=($area_of_interest_04=='Yes')?'checked':'' ?>> Care and support at home
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[4]" value="No" />
										<input id="area05" name="profileArea[4]" type="checkbox" value="Yes" <?=($area_of_interest_05=='Yes')?'checked':'' ?>> Care towards the end of life
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[5]" value="No" />
										<input id="area06" name="profileArea[5]" type="checkbox" value="Yes" <?=($area_of_interest_06=='Yes')?'checked':'' ?>> Children's health
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[6]" value="No" />
										<input id="area07" name="profileArea[6]" type="checkbox" value="Yes" <?=($area_of_interest_07=='Yes')?'checked':'' ?>> Communication
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[7]" value="No" />
										<input id="area08" name="profileArea[7]" type="checkbox" value="Yes" <?=($area_of_interest_08=='Yes')?'checked':'' ?>> Diversity and cultural issues
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[8]" value="No" />
										<input id="area09" name="profileArea[8]" type="checkbox" value="Yes" <?=($area_of_interest_09=='Yes')?'checked':'' ?>> Emergency care
									</label>
								</div>														
							</div>
							<div class="col-sm-4">
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[9]" value="No" />
										<input id="area10" name="profileArea[9]" type="checkbox" value="Yes" <?=($area_of_interest_10=='Yes')?'checked':'' ?>> Ethics and philosophy of healthcare
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[10]" value="No" />
										<input id="area11" name="profileArea[10]" type="checkbox" value="Yes" <?=($area_of_interest_11=='Yes')?'checked':'' ?>> Healthcare in hospital
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[11]" value="No" />
										<input id="area12" name="profileArea[11]" type="checkbox" value="Yes" <?=($area_of_interest_12=='Yes')?'checked':'' ?>> Homelessness
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[12]" value="No" />
										<input id="area13" name="profileArea[12]" type="checkbox" value="Yes" <?=($area_of_interest_13=='Yes')?'checked':'' ?>> How people are involved with their own care and with health services
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[13]" value="No" />
										<input id="area14" name="profileArea[13]" type="checkbox" value="Yes" <?=($area_of_interest_14=='Yes')?'checked':'' ?>> Innovations in healthcare
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[14]" value="No" />
										<input id="area15" name="profileArea[14]" type="checkbox" value="Yes" <?=($area_of_interest_15=='Yes')?'checked':'' ?>> Learning disabilities
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[15]" value="No" />
										<input id="area16" name="profileArea[15]" type="checkbox" value="Yes" <?=($area_of_interest_16=='Yes')?'checked':'' ?>> Living with long-term conditions (such as diabetes, heart or lung conditions, ME/CFS, etc.)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[16]" value="No" />
										<input id="area17" name="profileArea[16]" type="checkbox" value="Yes" <?=($area_of_interest_17=='Yes')?'checked':'' ?>> Mental health
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[17]" value="No" />
										<input id="area18" name="profileArea[17]" type="checkbox" value="Yes" <?=($area_of_interest_18=='Yes')?'checked':'' ?>> Older people
									</label>
								</div>																						
							</div>
							<div class="col-sm-3">
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[18]" value="No" />
										<input id="area19" name="profileArea[18]" type="checkbox" value="Yes" <?=($area_of_interest_19=='Yes')?'checked':'' ?>> Physical disabilities
									</label>
								</div>					
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[19]" value="No" />
										<input id="area20" name="profileArea[19]" type="checkbox" value="Yes" <?=($area_of_interest_20=='Yes')?'checked':'' ?>> Physiotherapy, physical activity, exercise or sports
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[20]" value="No" />
										<input id="area21" name="profileArea[20]" type="checkbox" value="Yes" <?=($area_of_interest_21=='Yes')?'checked':'' ?>> Pregnancy and maternity care
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[21]" value="No" />
										<input id="area22" name="profileArea[21]" type="checkbox" value="Yes" <?=($area_of_interest_22=='Yes')?'checked':'' ?>> Public health and health promotion
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[22]" value="No" />
										<input id="area23" name="profileArea[22]" type="checkbox" value="Yes" <?=($area_of_interest_23=='Yes')?'checked':'' ?>> Research and how people are involved with research
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[23]" value="No" />
										<input id="area24" name="profileArea[23]" type="checkbox" value="Yes" <?=($area_of_interest_24=='Yes')?'checked':'' ?>> Safety and safeguarding
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[24]" value="No" />
										<input id="area25" name="profileArea[24]" type="checkbox" value="Yes" <?=($area_of_interest_25=='Yes')?'checked':'' ?>> Sexual health and sexuality
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[25]" value="No" />
										<input id="area26" name="profileArea[25]" type="checkbox" value="Yes" <?=($area_of_interest_26=='Yes')?'checked':'' ?>> Substance misuse
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileArea[26]" value="No" />
										<input id="area27" name="profileArea[26]" type="checkbox" value="Yes" <?=($area_of_interest_27=='Yes')?'checked':'' ?>> Teenagers and young people
									</label>
								</div>																					
							</div>
						</div>														
						<div class="form-group">
							<label for="profileAreaOther" class="col-sm-2 col-sm-offset-1 control-label">Other(s)</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="profileAreaOther" name="profileAreaOther" value="<?=$area_of_interest_other?>">
								<caption><code>Any other areas of knowledge/interest/life experience/expertise for the profile. Seperate multiple with commas.</code></caption>
							</div>																
						</div>
					</div><!-- collapse -->
					
					<!-- TYPES OF WORK INTERESTED IN SUPPORTING -->
					<h3 class="formSeperator">
					<input class="btn btn-xs" type="button" data-toggle="collapse" data-target="#collapse05" aria-expanded="true" aria-controls="collapse05" value="Hide">
         			Types of Work Interested in Supporting
         			</h3>         			         			
         			<div class="collapse in" id="collapse05">
						<div class="form-group">
							<label for="profileWorkType" class="col-sm-3 control-label">
							Work Interests
							<span class="text-danger">*</span>
							</label>		
							<div class="col-sm-3">
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileWorkType[0]" value="No" />
										<input id="worktype01" name="profileWorkType[0]" type="checkbox" value="Yes" <?=($type_of_work_01=='Yes')?'checked':'' ?>> Curriculum development
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileWorkType[1]" value="No" />
										<input id="worktype02" name="profileWorkType[1]" type="checkbox" value="Yes" <?=($type_of_work_02=='Yes')?'checked':'' ?>> Developing learning materials
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileWorkType[2]" value="No" />
										<input id="worktype03" name="profileWorkType[2]" type="checkbox" value="Yes" <?=($type_of_work_03=='Yes')?'checked':'' ?>> Giving feedback to students
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileWorkType[3]" value="No" />
										<input id="worktype4" name="profileWorkType[3]" type="checkbox" value="Yes" <?=($type_of_work_04=='Yes')?'checked':'' ?>> Interviewing potential students
									</label>
								</div>							
							</div>
							<div class="col-sm-3">
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileWorkType[4]" value="No" />
										<input id="worktype05" name="profileWorkType[4]" type="checkbox" value="Yes" <?=($type_of_work_05=='Yes')?'checked':'' ?>> Meetings or committees
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileWorkType[5]" value="No" />
										<input id="worktype06" name="profileWorkType[5]" type="checkbox" value="Yes" <?=($type_of_work_06=='Yes')?'checked':'' ?>> Research
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="hidden" name="profileWorkType[6]" value="No" />
										<input id="worktype07" name="profileWorkType[6]" type="checkbox" value="Yes" <?=($type_of_work_07=='Yes')?'checked':'' ?>> Speaking to or teaching students
									</label>
								</div>
							</div>
							<div class="col-sm-3">
							</div>						
						</div>
						<div class="form-group">
							<label for="profileRequirements" class="col-sm-3 control-label">
							Additional Requirements	            		
							</label>
							<div class="col-sm-8">
								<textarea class="form-control" id="profileRequirements" name="profileRequirements" rows="2"><?=$type_of_work_requirements?></textarea>
								<caption><code>Is there any other requirements of the profile in order to help them take part?</code></caption>
							</div>																
						</div>											
					</div><!-- collapse -->

					<!-- ADDITIONAL INFORMATION/NOTES -->
					<h3 class="formSeperator">
					<input class="btn btn-xs" type="button" data-toggle="collapse" data-target="#collapse06" aria-expanded="true" aria-controls="collapse06" value="Hide">
         			Additional Information/Notes
         			</h3>         			         			
         			<div class="collapse in" id="collapse06">
						<div class="form-group">
							<label for="profileNotes" class="col-sm-3 control-label">
							Notes	            		
							</label>
							<div class="col-sm-8">
								<textarea class="form-control" id="profileNotes" name="profileNotes" rows="3"><?=$additional_notes?></textarea>
								<caption><code>Is there any additional information or notes for this profile?</code></caption>
							</div>																
						</div>											
					</div><!-- collapse -->					
					
					<div class="text-center bg-info" style="padding: 50px;">
					<input type="submit" class="btn btn-primary" value="Update Profile">
					<!--<input type="reset" class="btn btn-default" value="Reset All Fields">-->
					</div>				
				</form>												
			</div><!--.col-md-12-->
		</div><!--.row-->     	     
   
    </div><!--.container-->

<?php include('includes/footer.inc.php'); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
    <script src="js/bootstrap.min.js"></script>
    <script>
		$(function() {
			// Handler for .ready() called
			updateGenderOptions();
			updateSexualOrientationOptions();
			updateDisabilityOptions();
			var genderOtherInput = $('#genderSpecific');
		   	var sexualOrientationOtherInput = $('#sexualOrientationSpecific');
			var disabilityAffectOtherInput = $('#disabilityAffectSpecific');
			genderOtherInput.change(function() {
				$('#genderSpecify').val(genderOtherInput.val());
		   	});
		   	sexualOrientationOtherInput.change(function() {
				$('#sexualOrientationSpecify').val(sexualOrientationOtherInput.val());
		   	});
			disabilityAffectOtherInput.change(function() {
				$('#disabilityAffectSpecify').val(disabilityAffectOtherInput.val());
			});
		});			
		
		$("input.btn-xs").click(function() {			
			if ($(this).hasClass("collapsed")) {
				$(this).val("Hide");
			} else {
				$(this).val("Show");
			}
		});
		
		$("input[name='profileGender']").change(function() {			
			updateGenderOptions();
		});
		
		$("input[name='profileSexualOrientation']").change(function() {			
			updateSexualOrientationOptions();
		});
				
		$("input[name='profileDisability']").change(function() {			
			updateDisabilityOptions();
		});
		
		$("input[name='profileDisabilityAffect[10]']").change(function() {
			updateDisabilityAffectOptions();
		});
		
		$("input[name='profileGroupMembership[4]']").change(function() {
			updateGroupOptions();
		});		
		
		function updateGenderOptions() {
			if ($('#genderSpecify').is(":checked")) {				
				$('#genderSpecific').show();
			}
			else {
				$('#genderSpecific').hide();
			}	
		}
		
		function updateSexualOrientationOptions() {
			if ($('#sexualOrientationSpecify').is(":checked")) {				
				$('#sexualOrientationSpecific').show();
			}
			else {
				$('#sexualOrientationSpecific').hide();
			}
		}
		
		function updateDisabilityOptions() {
			updateDisabilityAffectOptions();
			if ($('#disabilityYes').is(":checked")) {				
				$('#disabilityAffect, #disabilityActivity').show();
			}
			else {
				$('#disabilityAffect, #disabilityActivity').hide();
			}
		}
		
		function updateDisabilityAffectOptions() {
			if ($('#disabilityAffectSpecify').is(":checked")) {				
				$('#disabilityAffectSpecific').show();
			}
			else {
				$('#disabilityAffectSpecific').hide();
			}	
		}	
		
		function updateGroupOptions() {
			if ($('#groupSpecify').is(":checked")) {				
				$('#groupSpecific').show();
			}
			else {
				$('#groupSpecific').hide();
			}	
		}			
	</script>
  </body>
</html>