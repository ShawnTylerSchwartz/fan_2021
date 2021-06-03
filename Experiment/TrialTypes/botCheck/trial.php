<?php
    /**
     * To use this trial type, use multiple entries in the Text column of the
     * procedure file to create the question and the possible responses.
     *
     * For example, if your text column contains:
     *     Which choice is best?|First|Second|Third
     * participants will have the choices "First", "Second", and "Third" for
     * the question "Which choice is best?"
     *
     * As usual, separate entries in the Text column are separated by the pipe
     * character |, which you can use by holding Shift and pressing the
     * backslash character \.  
     */
    $compTime = 5;                  // time in seconds to use for 'computer' timing
    
    $texts = explode('|', $text);
    foreach ($texts as &$t) {
        $t = trim($t);
    }
    unset($t);

    $cur_ans = $botans;
 ?>
    <style>
        label       { display: table-row; }
        label > div { display: table-cell; }
        .McOuter    { text-align: center; }
        .McInner    { display: inline-block; text-align: left; }
    </style>
    <div class="McOuter">
        <div class="McInner">
            <?php
                echo array_shift($texts);
                foreach ($texts as $txt) {
                    ?><label><div><input type="radio" name="Response_Botcheck" value="<?= $txt ?>" /></div><div><?= $txt ?></div></label><?php
                }
            ?>

            <input type="hidden" name="bot_ans_correct" id="bot_ans_correct" value="<?php echo $cur_ans;?>" />

            <div><input class="button button-trial-advance" id="FormSubmitButton" type="submit" value="Submit" /></div>
        </div>
    </div>
