<?php 
function formatText($line, $lineNr  = 0){

    $_SEPPARATOR = '; ';

    $symbolDict = array(
        "#### " => "<h5>;</h5>",
        "### " => "<h4>;</h4>",
        "## " => "<h3>;</h3>",
        "# " => "<h2>;</h2>",
        "- " => "<li>;</li>",
        "zit " => "<i>;</i>"
    );

    foreach($symbolDict as $key => $value){
        if (substr($line,0,strlen($key)) == $key){
            if (str_contains($value, ';')){
                $presuf = explode(';', $value);
                $prefix = $presuf[0];
                $suffix = $presuf[1];
                return(array($prefix.substr($line,strlen($key)).$suffix));
            }
        }
    }
    if (substr($line,0,6) == "enemy "){
        $line = str_replace("\n", '', $line);
        $blocks = explode($_SEPPARATOR, substr($line, 6));
        $name = $blocks[0];
        $hp = (int)$blocks[1];
        $returnValue = '<div class="enemy"><p class="enemy-name">'.$name.'</p>';
        $returnValue = $returnValue.'<div class="health-counter"><button onclick="calculateHp(event)" class="hp-calc" id="sub5-'.$lineNr.'" value="-5">-5</button>';
        $returnValue = $returnValue.'<button onclick="calculateHp(event)" class="hp-calc" id="add-'.$lineNr.'" value="-1">-1</button>';
        $returnValue = $returnValue.'<input disabled class="enemy-hp" id="hp-'.$lineNr.'" type="number" value="'.$hp.'"></input>';
        $returnValue = $returnValue.'<button onclick="calculateHp(event)" class="hp-calc" id="add-'.$lineNr.'" value="1">+1</button>';
        $returnValue = $returnValue.'<button onclick="calculateHp(event)" class="hp-calc" id="add5-'.$lineNr.'" value="5">+5</button></div>';
        for($i = 2; $i < sizeof($blocks); $i += 1){
            $returnValue = $returnValue.'<br>> '.$blocks[$i];
        }
        $returnValue = $returnValue.'</div>';

        return(array($returnValue));
    }
    elseif (substr($line,0,4) == "ref "){
        $line = str_replace(array("\n", "\r"), '', $line);
        $_articleName = str_replace(' ', '-', substr($line, 4));
        return(array_merge(loadArticle($_articleName)));

    }
    elseif (preg_match('/:.*?-.*?:/', $line) == 1){

        $returnValue = preg_replace('/:(.*?)-(.*?):/', '<a class="paragraph-link" href="article.php?name=$2">$1</a>', $line);

        return(array($returnValue));
    }

    return(array($line));
}
?>