<?php

include 'config.inc.php';
include 'db_connect/db_connect.inc.php';

$chatbots = mysqli_query($con_app, "SELECT DISTINCT 'id', 'name','topic','keywords' FROM 'chatbot'");
$success = $sum = 0;

while($chatbot = mysqli_fetch_assoc($chatbots)) {
    $dir = $chatbot['name'];
    $id = $chatbot['id'];


    if(!mkdir("../export/data", 0777, true)) {
      print_r(error_get_last());
    }


    // create the dir if not exists
    //mkdir($config['base_dir']. "/" . $dir."/data", 0755, true);
    //mkdir("../export/data", 0777, true);

      $domain = fopen("../export/domain".$id.".yml", 'w') or die("Unable to open domain file!");
      $nlu = fopen("../export/data/nlu".$id".yml", 'w') or die("Unable to open nlu file!");


  //  mkdir("../export/data", 0755, true);
    //$domain = fopen($config['base_dir']. "/" . $dir."/domain.yml", 'w') or die("Unable to open domain file!");
  //  $domain = fopen("../export/domain.yml", 'w') or die("Unable to open domain file!");
  //  $nlu = fopen("../export/data/nlu.yml", 'w') or die("Unable to open nlu file!");
    //$nlu = fopen($config['base_dir']. "/" . $dir."/data/nlu.yml", 'w') or die("Unable to open nlu file!");

    $intents_query = mysqli_query($con_app, "SELECT 'keyword' AS 'intent','example_1','example_2','example_3','example_4','example_5','example_6','example_7','example_8','example_9','example_10', 'example_11','example_12','example_13','example_14','example_15','example_16','example_17','example_18','example_19','example_20', 'example_21','example_22','example_23','example_24','example_25','example_26','example_27','example_28','example_29','example_30' FROM 'intent' WHERE 'chatbot_id' = $id ORDER BY 'keyword'");

    $responses_query = mysqli_query($con_app, "SELECT 'type', 'keyword' AS 'utterance','example_1','example_2','example_3','example_4','example_5','example_6','example_7','example_8','example_9','example_10', 'example_11','example_12','example_13','example_14','example_15','example_16','example_17','example_18','example_19','example_20', 'example_21','example_22','example_23','example_24','example_25','example_26','example_27','example_28','example_29','example_30' FROM 'response' WHERE 'chatbot_id' = $id ORDER BY 'keyword'");

    $sum += ($intents_query->num_rows + $responses_query->num_rows);

    // Start writing nlu file
    fwrite($nlu, "version: '2.0'\nnlu:\n");
    $intents = [];
    $last_intent = "";
    while($intent = mysqli_fetch_assoc($intents_query)) {
        $arr = array_filter($intent, function($val){
            return $val != null;
        });
        array_push($intents, $arr['intent']);

        $examples = array_splice($arr, 1);
        // if the intent already exists, it just adds the rest of the examples
        if ($arr['intent'] == $last_intent) {
            foreach ($examples as $example) {
                fwrite($nlu, "    - " . $example . "\n");
            }
        }
        else {
            fwrite($nlu, "- intent: " . $arr['intent'] . "\n");
            fwrite($nlu, "  examples: |\n");
            foreach ($examples as $example) {
                fwrite($nlu, "    - " . $example . "\n");
            }
        }
        $last_intent = $arr['intent'];

        $success++;
    }

    // deleting duplicate intents
    $intents = array_unique($intents);

    // Start writing domain file, this part could be any configuration we want
    fwrite($domain, "version: '2.0'\nsession_config:\n  session_expiration_time: 60\n  carry_over_slots_to_new_session: true\nintents:\n");

    // Add the intents we gathered earlier
    foreach($intents as $intent) {
        fwrite($domain, "- " . $intent . "\n");
    }
    // Now the responses
    fwrite($domain, "responses:\n");

    $last_utterance = "";
    // Add the responses
    while ($response = mysqli_fetch_assoc($responses_query)) {
        $arr = array_filter($response, function($val){
            return $val != null;
        });

        $examples = array_splice($arr, 2);

        // if the response already exists, it just adds the rest of the responses in the same utterance
        if ($arr['utterance'] == $last_utterance) {
            foreach ($examples as $example) {
                fwrite($domain, "  - text: " . $example . "\n");
            }
        }
        else {
            fwrite($domain, "  utter_" . $arr['utterance'] . ":\n");
            foreach ($examples as $example) {
                fwrite($domain, "  - text: " . $example . "\n");
            }
        }
        $last_utterance = $arr['utterance'];
        $success++;
    }

    fclose($nlu);
    fclose($domain);
}

// if the sum of intents and responses equals to the count of each executed query, then presumably all files have been created OK
echo $success == $sum;

// Close database connection
mysqli_close($con_app);

?>
