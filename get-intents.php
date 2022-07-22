<?php

  $kd = $_GET['kd'];
  $id = $_GET['id'];

  echo "<p>ID for this chatbot: $id</p>";
  echo "<p>Keyword for this chatbot: $kd</p>";

  //include('includes/db_connect/db_connect.inc.php');

  $sql_get_chatbot_intents = "SELECT example_1, example_2, example_3, example_4, example_5, example_6, example_7, example_8, example_9, example_10,
  example_11, example_12, example_13, example_14, example_15, example_16, example_17, example_18, example_19, example_20,	example_21, example_22,
  example_23, example_24, example_25, example_26, example_27, example_28, example_29, example_30 FROM intent WHERE chatbot_id = $id AND keyword = $kd";

  $chatbot_intents = mysqli_query($con_app, $sql_get_chatbot_intents);

  echo '
	<div class="row">
	<div class="col-md-12">

		<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Intents</th>
					<th scope="col">Responses</th>
				</tr>
			</thead>
			<tbody>';

  while($row = mysqli_fetch_array($chatbot_intents)) {
    echo "<tr><td>" . $row['example_1'] . "</td></tr>";
    echo "<tr><td>" . $row['example_2'] . "</td></tr>";
    echo "<tr><td>" . $row['example_3'] . "</td></tr>";
    echo "<tr><td>" . $row['example_4'] . "</td></tr>";
    echo "<tr><td>" . $row['example_5'] . "</td></tr>";
    echo "<tr><td>" . $row['example_6'] . "</td></tr>";
  }

  echo '
    </tbody>
  </table>
  </div>
  </div>
  </div>';

mysqli_close($con_app);

?>
