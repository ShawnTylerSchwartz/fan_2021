<?php
	$compTime = 7;					// time in seconds to use for 'computer' timing
    if ($text === '') { $text = 'Please type the letter "b"'; }
    $texts = explode('|', $text);
    $mainText = array_shift($texts);
?>

    <div class="textcenter">
        <h3><?php echo $mainText; ?></h3>
        <?php
            foreach ($texts as $t) {
                echo '<p>' . $t . '</p>';
            }
        ?>
    </div>

    <div class="textcenter">
        <input name="JOL" type="text" value="" autocomplete="off" class="textcenter"/>
        <input class="button"  id="FormSubmitButton" type="submit" value="Submit"   />
    </div>
