<?php
    $compTime = 5;        // time in seconds to use for 'computer' timing
    
    //create an array for shuffling side effect answers:

    $interaction_list = array("dry mouth", "itching", "cough", "trembling", "flushing", "fever", "fatigue", "bloating", "clumsiness", "nausea", "diarrhea", "arm pain");
    shuffle($interaction_list);

    $imageFilePath = dirname($_SESSION['Trial Types'][$trialType]['trial']) . '/bottle.jpg';
    $answers = explode('|', $answer);
    $cues = explode('|', $cue);
    
    if (isset($_SESSION['Drugs'][$cue])) {
        $drugs = $_SESSION['Drugs'][$cue];
    } else {
        $drugs = explode('|', $cue);
        shuffle($drugs);
        $_SESSION['Drugs'][$cue] = $drugs;
    }
    
    foreach ($drugs as &$drug) {
        if (show($drug) !== $drug) {
            $thisAnswer = '';
            foreach ($answers as $i => $answer) {
                if ($cues[$i] === $drug) {
                    $thisAnswer = $answer;
                }
            }
            $drug = '<div class="foodArea"> ' . show($drug) . '<div class="foodName">' . $thisAnswer . '</div></div>';
        } else {
            $len = strlen($drug);
            $str = '';
            $half = $len/2;
            $mid = floor($half);
            $leftStr = '';
            $rightStr = '';
            $centerStr = '';
            $rightCount = 0;
            
            for ($i=0; $i<$len; ++$i) {
                if ($i<$mid) {
                    $leftStr = '<span class="leftSkew">'.$leftStr.$drug[$i].'</span>';
                } elseif ($i+.5==$half) {
                    $centerStr = '<span class="centerSkew">'.$drug[$i].'</span>';
                } else {
                    ++$rightCount;
                    $rightStr = $rightStr.'<span class="rightSkew">'.$drug[$i];
                }
            }
            $rightStr .= str_repeat('</span>', $rightCount);
            $drug = $leftStr.$centerStr.$rightStr;
            
            $drug = '<div class="bottleArea"> <div class="drugName">' . $drug . '</div> <img src="' . $imageFilePath . '"> </div>';
        }
    }
?>
    <style>
        .imageArea      {   white-space: nowrap;   }
        .imageArea img  {   height: 350px;  width: 200px;  }
        .imageArea > div    {   display: inline-block;  }
        .bottleArea     {   width: 200px; position: relative; }
        .drugName       {   position: absolute; top: 140px; left: 0px; width: 100%;   text-align: center;   font-family: Arial; font-size: 200%; }
        .drugName span  {   display: inline-block;  }
        .divider        {   font-size: 300%;    vertical-align: top;    margin: 120px 40px;  }
        .sideEffect     {   font-size: 200%;    vertical-align: top;    margin-top: 132px;  text-align: center;  }
        .sideEffect select    {   font-size: 80%; }
        

        
        #FormSubmitButton:disabled  {   border: 1px solid #eaeaea;  }
        .foodArea img   {   height: initial; width: initial;    max-width: 350px;   max-height: 350px;  }
        .foodName   {   margin-top: 15px;   text-align: center; font-size: 120%; }
    </style>
    


    
    <div><?php echo $text; ?></div>
    
    <div class="imageArea">
        <?= $drugs[0] ?>
        <div class="divider">+</div>
        <?= $drugs[1] ?>
        <div class="divider">=</div>
        <div class="sideEffect">
            <select name="Response">
                <option disabled hidden selected></option>
                    <?php
                        for($ii = 0; $ii < count($interaction_list); $ii++) {
                            echo "<option>" . $interaction_list[$ii] . "</option>";
                        }
                    ?>
            </select>
        </div>
    </div>


    <div class="precache textright">
        <input class="button button-trial-advance" id="FormSubmitButton" type="submit" value="Submit" disabled />
    </div>
    
    
    
    <script>
        $("select[name='Response']").on("change", function() {
            $("#FormSubmitButton").prop("disabled", false);
        });
    </script>
