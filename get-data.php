<?php

  $kd = $_GET['kd'];
  $id = $_GET['id'];

  include('includes/db_connect/db_connect.inc.php');

  $sql_get_chatbot_intents = "SELECT example_1, example_2, example_3, example_4, example_5, example_6, example_7, example_8, example_9, example_10,
  example_11, example_12, example_13, example_14, example_15, example_16, example_17, example_18, example_19, example_20,	example_21, example_22,
  example_23, example_24, example_25, example_26, example_27, example_28, example_29, example_30 FROM intent WHERE chatbot_id = '$id' AND keyword = '$kd'";

  $sql_get_chatbot_responses = "SELECT example_1, example_2, example_3, example_4, example_5, example_6, example_7, example_8, example_9, example_10,
  example_11, example_12, example_13, example_14, example_15, example_16, example_17, example_18, example_19, example_20,	example_21, example_22,
  example_23, example_24, example_25, example_26, example_27, example_28, example_29, example_30 FROM response WHERE chatbot_id = '$id' AND keyword = '$kd'";

  $chatbot_intents = mysqli_query($con_app, $sql_get_chatbot_intents);
  $chatbot_responses = mysqli_query($con_app, $sql_get_chatbot_responses);

  echo '
	<div class="row">
	<div class="col-md-6"><!-- border border-success p-4 rounded-3 -->
	<h3>You say:</h3>';

  while($row = mysqli_fetch_array($chatbot_intents)) {
    /*
    for ($x = 1; $x <= $y; $x++) {
      echo "<p>" . $row['example_' . $x . ''] . "</p>";
    }*/
    echo "<p>" . $row['example_1'] . "</p>"; echo "<p>" . $row['example_2'] . "</p>"; echo "<p>" . $row['example_3'] . "</p>"; echo "<p>" . $row['example_4'] . "</p>";
    echo "<p>" . $row['example_5'] . "</p>"; echo "<p>" . $row['example_6'] . "</p>"; echo "<p>" . $row['example_7'] . "</p>"; echo "<p>" . $row['example_8'] . "</p>";
    echo "<p>" . $row['example_9'] . "</p>"; echo "<p>" . $row['example_10'] . "</p>"; echo "<p>" . $row['example_11'] . "</p>"; echo "<p>" . $row['example_12'] . "</p>";
    echo "<p>" . $row['example_13'] . "</p>"; echo "<p>" . $row['example_14'] . "</p>"; echo "<p>" . $row['example_15'] . "</p>"; echo "<p>" . $row['example_16'] . "</p>";
    echo "<p>" . $row['example_17'] . "</p>"; echo "<p>" . $row['example_18'] . "</p>"; echo "<p>" . $row['example_19'] . "</p>"; echo "<p>" . $row['example_20'] . "</p>";
    echo "<p>" . $row['example_21'] . "</p>"; echo "<p>" . $row['example_22'] . "</p>"; echo "<p>" . $row['example_23'] . "</p>"; echo "<p>" . $row['example_24'] . "</p>";
    echo "<p>" . $row['example_25'] . "</p>"; echo "<p>" . $row['example_26'] . "</p>"; echo "<p>" . $row['example_27'] . "</p>"; echo "<p>" . $row['example_28'] . "</p>";
    echo "<p>" . $row['example_29'] . "</p>"; echo "<p>" . $row['example_30'] . "</p>";
  }

  echo '
  </div>
	<div class="col-md-6"><!-- bg-light border border-secondary p-4 rounded-3 -->
	<h3>Chatbot says:</h3>';

  while($row = mysqli_fetch_array($chatbot_responses)) {
    /*
    $rows[] = $row;
    $y = count($rows);
    for ($x = 1; $x <= $y; $x++) {
      echo "<p>" . $row['example_' . $x . ''] . "</p>";
    }
    */
    echo "<p>" . $row['example_1'] . "</p>"; echo "<p>" . $row['example_2'] . "</p>"; echo "<p>" . $row['example_3'] . "</p>"; echo "<p>" . $row['example_4'] . "</p>";
    echo "<p>" . $row['example_5'] . "</p>"; echo "<p>" . $row['example_6'] . "</p>"; echo "<p>" . $row['example_7'] . "</p>"; echo "<p>" . $row['example_8'] . "</p>";
    echo "<p>" . $row['example_9'] . "</p>"; echo "<p>" . $row['example_10'] . "</p>"; echo "<p>" . $row['example_11'] . "</p>"; echo "<p>" . $row['example_12'] . "</p>";
    echo "<p>" . $row['example_13'] . "</p>"; echo "<p>" . $row['example_14'] . "</p>"; echo "<p>" . $row['example_15'] . "</p>"; echo "<p>" . $row['example_16'] . "</p>";
    echo "<p>" . $row['example_17'] . "</p>"; echo "<p>" . $row['example_18'] . "</p>"; echo "<p>" . $row['example_19'] . "</p>"; echo "<p>" . $row['example_20'] . "</p>";
    echo "<p>" . $row['example_21'] . "</p>"; echo "<p>" . $row['example_22'] . "</p>"; echo "<p>" . $row['example_23'] . "</p>"; echo "<p>" . $row['example_24'] . "</p>";
    echo "<p>" . $row['example_25'] . "</p>"; echo "<p>" . $row['example_26'] . "</p>"; echo "<p>" . $row['example_27'] . "</p>"; echo "<p>" . $row['example_28'] . "</p>";
    echo "<p>" . $row['example_29'] . "</p>"; echo "<p>" . $row['example_30'] . "</p>";
  }

  echo '
  </div>
  </div>';

mysqli_close($con_app);

?>
