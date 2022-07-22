<?php

$page_title = 'View';
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


function showIntents(str) {
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
    xmlhttp.open("GET","get-intents.php?kd="+str+"&id="+id,true);
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

					/*$sql_get_chatbot_data = "SELECT DISTINCT intent.keyword, chatbot.name, intent.example_1, intent.example_2, intent.example_3, intent.example_4, intent.example_5, intent.example_6, intent.example_7, intent.example_8, intent.example_9, intent.example_10,
					intent.example_11, intent.example_12, intent.example_13, intent.example_14, intent.example_15, intent.example_16, intent.example_17, intent.example_18, intent.example_19, intent.example_20,
					intent.example_21, intent.example_22, intent.example_23, intent.example_24, intent.example_25, intent.example_26, intent.example_27, intent.example_28, intent.example_29, intent.example_30
					FROM (chatbot INNER JOIN intent ON chatbot.id = intent.chatbot_id)
					WHERE chatbot.id = 9 AND example_1 IS NOT NULL
					UNION
					SELECT DISTINCT response.keyword, chatbot.name, response.example_1, response.example_2, response.example_3, response.example_4, response.example_5, response.example_6, response.example_7, response.example_8, response.example_9, response.example_10,
					response.example_11, response.example_12, response.example_13, response.example_14, response.example_15, response.example_16, response.example_17, response.example_18, response.example_19, response.example_20,
					response.example_21, response.example_22, response.example_23, response.example_24, response.example_25, response.example_26, response.example_27, response.example_28, response.example_29, response.example_30
					FROM (chatbot INNER JOIN response ON chatbot.id = response.chatbot_id)
					WHERE chatbot.id = 9 AND example_1 IS NOT NULL;"

					$sql_get_chatbot_data = "SELECT DISTINCT intent.keyword, chatbot.name, intent.example_1, intent.example_2, intent.example_3, intent.example_4, intent.example_5, intent.example_6, intent.example_7, intent.example_8, intent.example_9, intent.example_10,
					intent.example_11, intent.example_12, intent.example_13, intent.example_14, intent.example_15, intent.example_16, intent.example_17, intent.example_18, intent.example_19, intent.example_20,
					intent.example_21, intent.example_22, intent.example_23, intent.example_24, intent.example_25, intent.example_26, intent.example_27, intent.example_28, intent.example_29, intent.example_30
					FROM (chatbot INNER JOIN intent ON chatbot.id = intent.chatbot_id)
					WHERE chatbot.id = $_GET[id] AND example_1 IS NOT NULL";
*/
					$sql_get_chatbot_data = "SELECT DISTINCT intent.keyword, chatbot.name FROM (chatbot INNER JOIN intent ON chatbot.id = intent.chatbot_id)
																	 WHERE chatbot.id = $_GET[id] AND example_1 IS NOT NULL";

/*
					SELECT chatbot.name, intent.*, response.*
					FROM ((chatbot
						INNER JOIN intent ON chatbot.id = intent.chatbot_id)
						INNER JOIN response ON chatbot.id = response.chatbot_id)
					WHERE chatbot.id = 1 IN (SELECT column_name
																	FROM information_schema.columns
																	WHERE
					    										table_name='intent'
					    										AND column_name LIKE 'example_%');


					SELECT DISTINCT keyword FROM intent
					IN (SELECT chatbot.name, intent.*, response.*
					FROM ((chatbot
						INNER JOIN intent ON chatbot.id = intent.chatbot_id)
						INNER JOIN response ON chatbot.id = response.chatbot_id)
					WHERE chatbot.id = 1);

					SELECT
    column_name
FROM
    information_schema.columns
WHERE
    table_name='intent'
    AND column_name LIKE 'example_%';
*/


				$chatbot_data = mysqli_query($con_app, $sql_get_chatbot_data);
				$sum_keywords = mysqli_num_rows($chatbot_data);

				while($row = mysqli_fetch_array($chatbot_data)) {
					$id = $row['id'];
					$name = $row['name'];
					$keywords[] = $row['keyword'];
				}

				echo "<p class='lead'>$name currently has $sum_keywords keyword(s) recorded.</p>";
				echo "<p>Select a keyword to view the associated intents and responses:</p>";
				//echo "<ul>";

				echo '
				<form>
				<select name="users" onchange="showIntents(this.value)">
				<option value="">Select a keyword:</option>';

				foreach($keywords as $keyword)
				{
					//echo "<li><a href='#$keyword' onclick='include('includes/action.inc.php'); getChatbotData($keyword);'>$keyword</a></li>";
					echo "<option value=" . $keyword . ">$keyword</option>";
				}

				echo '
				</select>
			</form>
			<br>
			<div id="txtHint"><b>Keyword info will be listed here...</b></div>';

?>


	</div>

	<?php include('includes/footer.inc.php'); ?>

  </body>
</html>
