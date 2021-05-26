<?php

$compTime = 5;  


$botcheck_range = array(2,3,4,5,6);
$correctArray=[];

foreach ($botcheck_range as $key => $value){  //create an array with all the responses (either 0 or 1) 
	$currentbot = $SESSION['Trials'][$value]['Response']['strictAcc'];
	array_push($correctArray, $currentbot);
}

var_dump($correctArray);



// Add together array for a single value (0-5)

$botcheck_sum = array_sum($correctArray)

// If the value is under under 4, then:

		echo "The questions you just answered were designed to test your attention as they are not difficult but rather require that you read the entire question. You must get all of the questions right to move on to the actual experiment. Unfortunately, you will not be receiving any compensation for your participation in this study. Please exit out of the browser. Thank you!"; ?>

		<div class="precache textright">
	        <input class="button button-trial-advance" id="FormSubmitButton" type="hidden" value="Next" />
	    </div>

<?php

// If the value is 4 or over, then:
		echo "Great job! You may now move on to the experiment"; 

?>
	<div class="precache textright">
		   <input class="button button-trial-advance" id="FormSubmitButton" type="submit" value="Next" />