<?php

function loadArticle($_name){
    require("connection.php");
    $sqlQuery = "SELECT * FROM article WHERE Name='".$_name."'";
    $result = $conn->query($sqlQuery);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $content = $row["Text"];
            $line = "";
            $lines = array();
            $returnHtml = array();

            array_push($returnHtml, '<h1>'.$row["Title"].'</h1>');

            //split content string in lines at \n symbol
            for($i = 0; $i < strlen($content); $i +=1){
                $char = $content[$i];
                //if($char != "\n"){
                    $line = $line.$char;
                //}
                if ($char == "\n" || $i == strlen($content)-1){
                    //$line = $line.'';
                    array_push($lines, $line);
                    $line="";
                }
            }
            //format line by line
            for($i = 0; $i < sizeof($lines); $i += 1){
                $_line = $lines[$i];
                $returnHtml = array_merge($returnHtml, formatText($_line, $i));
            }
        }
        return $returnHtml;
    }else{
        return array("This Article ".$_name." could not be loaded.");
    }
}

?>
