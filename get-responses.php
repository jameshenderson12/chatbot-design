<?php

$kd = $_GET['kd'];
$id = $_GET['id'];

include('includes/db_connect/db_connect.inc.php');

$sql_get_chatbot_responses = "SELECT example_1, example_2, example_3, example_4, example_5, example_6, example_7, example_8, example_9, example_10, example_11, example_12, example_13, example_14, example_15, example_16, example_17, example_18, example_19, example_20, example_21, example_22, example_23, example_24, example_25, example_26, example_27, example_28, example_29, example_30 FROM response WHERE chatbot_id = '$id' AND keyword = '$kd'";

$chatbot_responses = mysqli_query($con_app, $sql_get_chatbot_responses);

if ($chatbot_responses) {
  echo '<h3>Chatbot says:</h3>';
  while($row = mysqli_fetch_array($chatbot_responses)) {
    $no_of_rows = 1;
    for ($i = 1; $i <= 30; $i++) {
      if (isset($row['example_'.$i.''])) {
        if (strlen($row['example_'.$i.'']) > 60) {
          $no_of_rows = 2;
        }
        if (strlen($row['example_'.$i.'']) > 120) {
          $no_of_rows = 3;
        }
        if (strlen($row['example_'.$i.'']) > 180) {
          $no_of_rows = 4;
        }
        if (strlen($row['example_'.$i.'']) > 240) {
          $no_of_rows = 5;
        }
        echo "<div class='input-group mb-3'><textarea readonly class='form-control' rows=\"$no_of_rows\" id=\"responseExample_$i\" name=\"responseExample_$i\" aria-label=\"Editable chatbot response $i\">" . $row['example_'.$i.''] . "</textarea><a href='javascript:void(0);' class='btn btn-outline-success' onclick='removeReadOnly(\"responseExample_$i\")'>Update</a></div>";
      }
      else {
        echo "";
      }
    }
  }
  echo '<button class="btn btn-primary" aria-label="Submit all updated intents"><i class="bi bi-save"></i> Save</button></div>';
}

mysqli_free_result($chatbot_responses);

mysqli_close($con_app);

?>
