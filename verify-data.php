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

  //$chatbot_intents = mysqli_query($con_app, $sql_get_chatbot_intents);

  if ($chatbot_intents = mysqli_query($con_app, $sql_get_chatbot_intents)) {
    echo '
    <div class="row">
    <div class="col-md-6"><!-- border border-success p-4 rounded-3 -->
    <h3>You say:</h3>';
    while($row = mysqli_fetch_array($chatbot_intents)) {
  		for ($i = 1; $i <= 30; $i++) {
  			if ($row[$i] == "") {
  				echo "";
  			}
  			else {
  				//echo '<textarea class="form-control" rows="'.$n.'" id="example_'.$i.'">' . $row['example_'.$i.''] . '</textarea><div class="float-right"><button class="btn btn-primary btn-sm" onclick="removeAttribute("example_'.$i.'", "readonly")" aria-label="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button><button class="btn btn-success btn-sm" aria-label="Submit"><i class="fa fa-check" aria-hidden="true"></i></button></div>';
  				echo "<div class='input-group mb-3'><textarea readonly class='form-control' rows='1' class='form-control' id=\"intentExample_$i\" name=\"intentExample_$i\" aria-label=\"Editable chatbot intent $i\">" . $row['example_'.$i.''] . "</textarea><a href='javascript:void(0);' class='btn btn-outline-success' onclick='removeReadOnly(\"intentExample_$i\")'>Update</a></div>";
  			}
  		}
    }
    mysqli_free_result($chatbot_intents);
    echo '
    <button class="btn btn-primary" aria-label="Submit all updated data"><i class="bi bi-save"></i> Save</button>
    </div>';
  }

  if ($chatbot_responses = mysqli_query($con_app, $sql_get_chatbot_responses)) {
    echo '
  	<div class="col-md-6"><!-- bg-light border border-secondary p-4 rounded-3 -->
  	<h3>Chatbot says:</h3>';
  	while($rowr = mysqli_fetch_array($chatbot_responses)) {
      echo 'Hello!';
  		for ($r = 1; $r <= 30; $r++) {
  			if ($rowr[$r] == "") {
  				echo "";
          echo "None";
  			}
  			else {
  				echo "<div class='input-group mb-3'><textarea readonly class='form-control' rows='1' class='form-control' id=\"responseExample_$r\" name=\"responseExample_$r\" aria-label=\"Editable chatbot response $r\">" . $row['example_'.$r.''] . "</textarea><a href='javascript:void(0);' class='btn btn-outline-success' onclick='removeReadOnly(\"responseExample_$r\")'>Update</a></div>";
          echo 'Some!';
  			}
  		}
    }
    mysqli_free_result($chatbot_responses);
  }
  else {
    echo "No responses";
  }

/*
  while($row = mysqli_fetch_array($chatbot_responses)) {
    /*
    $rows[] = $row;
    $y = count($rows);
    for ($x = 1; $x <= $y; $x++) {
      echo "<p> . $row['example_' . $x . ''] . "</p>";
    }
    echo "<textarea readonly class='form-control' rows='1'>" . $row['example_1'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_2'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_3'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_4'] . "</textarea>";
    echo "<textarea readonly class='form-control' rows='1'>" . $row['example_5'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_6'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_7'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_8'] . "</textarea>";
    echo "<textarea readonly class='form-control' rows='1'>" . $row['example_9'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_10'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_11'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_12'] . "</textarea>";
    echo "<textarea readonly class='form-control' rows='1'>" . $row['example_13'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_14'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_15'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_16'] . "</textarea>";
    echo "<textarea readonly class='form-control' rows='1'>" . $row['example_17'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_18'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_19'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_20'] . "</textarea>";
    echo "<textarea readonly class='form-control' rows='1'>" . $row['example_21'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_22'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_23'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_24'] . "</textarea>";
    echo "<textarea readonly class='form-control' rows='1'>" . $row['example_25'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_26'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_27'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_28'] . "</textarea>";
    echo "<textarea readonly class='form-control' rows='1'>" . $row['example_29'] . "</textarea>"; echo "<textarea readonly class='form-control' rows='1'>" . $row['example_30'] . "</textarea>";
  }
*/
  echo '
  </div>
  </div>';


  mysqli_free_result($chatbot_responses);

mysqli_close($con_app);

?>
