<?php
    $compTime = 5;        // time in seconds to use for 'computer' timing


    $totalNumItems = 12;  // 12 trials per block

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

//May want to take out the counter:
    
    echo "<div style='border: 3px solid black; width: 50%' padding-top: 10px; padding-bottom: 10px;>";

    if($_SESSION['Position'] == 4) {
        $numItems = $totalNumItems;
        echo "<h4><strong>&nbsp;Trials remaining: " . $numItems . "</strong></h4>";
    } elseif($_SESSION['Position'] == 30) {
        $numItems = $totalNumItems;
        echo "<h4><strong>&nbsp;Trials remaining: " . $numItems . "</strong></h4>";
    } elseif($_SESSION['Position'] == 56) {
        $numItems = $totalNumItems;
        echo "<h4><strong>&nbsp;Trials remaining: " . $numItems . "</strong></h4>";
     } elseif($_SESSION['Position'] == 82) {
        $numItems = $totalNumItems;
        echo "<h4><strong>&nbsp;Trials remaining: " . $numItems . "</strong></h4>";
    } else {
        $numItems = $_SESSION['Trials'][$_SESSION['Position']-1]['Response']['numitemsremval'];
        echo "<h4><strong>&nbsp;Trials remaining: " . $numItems . "</strong></h4>";
    }

    echo "</div><br /><br />";

    
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
        .sideEffect span    {   font-size: 80%; }
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
            <?php
                echo $severity;
                if ($interaction !== '') {
                    // echo '<br><span>('.$interaction.')</span>';
                    echo $interaction;
                }
            ?>
        </div>
    </div>

    <div class="precache textright">
        <input class="button button-trial-advance" id="FormSubmitButton" type="submit" value="Next" />
    </div>



    <div class="textenter finalSubmit">
        <input type="hidden" name="numitemsremval" id="numitemsremval" value="<?php echo --$numItems; ?>">
    </div>
    

    <input class="hidden" name="Response" id="Response" type="text" value=""         />

    <input class="hidden" id="FormSubmitButton" type="submit" value="Submit"         />

   
