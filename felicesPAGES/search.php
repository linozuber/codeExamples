<?php 
include("head.php");
require("connection.php"); 
require("formatText.php");

if (array_key_exists("search", $_GET)){
    $sqlQuery = "SELECT * FROM article WHERE Name LIKE '%".$_GET["search"]."%' OR Text LIKE '%".$_GET["search"]."%'";
    $result = $conn->query($sqlQuery);
}

?>
<main>
    <form action="search.php" method="get">
        <input name="search" type="text" placeholder="nach etwas suchen" class="search-bar" ></input>
        <button type="submit" value="Submit">Suchen</button>
    </form>
    <?php         
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<div class="search-result">';
            echo '<a href="article.php?name='.str_replace(' ', '-', $row["Name"]).'"><h2>'.$row["Name"].'</h2>';
            echo '<p>'.substr($row["Text"], 0, 120).'...</p></a>';
            echo '</div>';
        }
    } 
    elseif (array_key_exists("search", $_GET)) {
         echo "Es wurden keine Suchergebnisse gefunden"; 
    }else{
        echo "Diese Seite existiert nicht. Eventuell hat Sie in der Vergangenheit existiert.";
    }
    ?>
</main>
</body>
</html>