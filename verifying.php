<?php

$page_title = 'Verify';
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

<script>
function getLastNumber(url) {
    var matches = url.match(/\d+/g);
    return matches[matches.length - 1];
}

var url = document.location.href;
//console.log(getLastNumber(url));
var id = getLastNumber(url);


function editData(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","verify-data.php?kd="+str+"&id="+id,true);
    xmlhttp.send();
  }
}
</script>

  </head>
  <body class="d-flex flex-column h-100">

		<?php include('includes/navbar.inc.php'); ?>

			<div class="container p-2">

				<h1 class="mt-4">View chatbot data</h1>

				<?php

					include('includes/db_connect/db_connect.inc.php');

					$sql_get_chatbot_data = "SELECT DISTINCT intent.keyword, chatbot.name FROM (chatbot INNER JOIN intent ON chatbot.id = intent.chatbot_id)
																	 WHERE chatbot.id = $_GET[id] AND example_1 IS NOT NULL";

					$chatbot_data = mysqli_query($con_app, $sql_get_chatbot_data);
					$sum_keywords = mysqli_num_rows($chatbot_data);

					while($row = mysqli_fetch_array($chatbot_data)) {
						$id = $row['id'];
						$name = $row['name'];
						$keywords[] = $row['keyword'];
					}

					echo "<p class='lead'>$name currently has $sum_keywords keyword(s) recorded.</p>";
					echo "<p>Select a keyword to view the associated intents and responses:</p>";

					echo '
					<form class="col-md-6">
					<div class="input-group mb-3">
					<label class="input-group-text" for="keywords">Keywords</label>
					<select class="form-select" id="keywords" name="users" onchange="editData(this.value)" aria-lable="Select a keyword">
					<option value="">Choose...</option>';

					foreach($keywords as $keyword)
					{
						//echo "<li><a href='#$keyword' onclick='include('includes/action.inc.php'); getChatbotData($keyword);'>$keyword</a></li>";
						echo "<option value=" . $keyword . ">$keyword</option>";
					}

					echo '
					</select>
					</div>
				</form>
				<br>
				<div id="txtHint"><b>Keyword info will be listed here...</b></div>';
				?>

	</div>

	<?php include('includes/footer.inc.php'); ?>

  </body>
</html>
