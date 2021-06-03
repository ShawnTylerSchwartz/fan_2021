<?php

$compTime = 5;  


$botcheck_range = array(2,3,4,5,6);

// botcheck responses in order
$botcheck_responses = array();

// botcheck correct answers in order
$botcheck_answers = array();

// check how they did
$botcheck_scores = array();

foreach($botcheck_range as $key => $value) {
	array_push($botcheck_responses, $_SESSION['Trials'][$value]['Response']['Response_Botcheck']);

	array_push($botcheck_answers, $_SESSION['Trials'][$value]['Response']['bot_ans_correct']);
}

for($i = 0; $i < count($botcheck_range); $i++) {
	if($botcheck_responses[$i] == $botcheck_answers[$i]) {
		array_push($botcheck_scores, 1);
	} else {
		array_push($botcheck_scores, 0);
	}
}

$botcheck_total_score = array_sum($botcheck_scores);

if($botcheck_total_score < 4) {
	echo "<p style='color: red; font-weight: bolder;'>The questions you just answered were designed to test your attention as they are not difficult but rather require that you read the entire question. You must get all of the questions right to move on to the actual experiment. Unfortunately, you will not be receiving any compensation for your participation in this study. <u>Please exit out of the browser at this time.</u> Thank you!</p>";
} elseif($botcheck_total_score >= 4) {
	echo "<p style='color: green; font-weight: bolder;'>Great job! You may now move on to the experiment!</p>";
	
	// only show the 'next' button if they are approved to move on...
	echo "<div class='precache textright'>";
	echo "<input class='button button-trial-advance' id='FormSubmitButton' type='submit' value='Next' />";
}

?>