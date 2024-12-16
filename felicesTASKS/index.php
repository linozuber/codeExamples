<?php
require 'logic/connect.php';
require 'logic/check_board.php';
require 'logic/main.php';
showWelcomeMessage();
?>
<!DOCTYPE HTML>
<html lang="de" class="board" onmouseup="globalMouseUp()">
<?php
require 'head.php';
?>
<body>
  <header id="header-desktop" class="yellow t-white mb-2">
    <h1 class="p-2">FELICES TASKS
      <a href="about.php?backlinkdata=<?php echo $back_link_gets; ?>" class="t-white fr">...</a>
      <?php
        if (!isset($_GET["visit"])){
          echo '
          <img class="interact fr board-share mr-1" src="media/share.png" alt"share" width="26px">
          <img class="interact fr board-edit mr-1" src="media/pen_white.png" alt"listen bearbeiten" width="28px">
          ';
        }
      ?>
      <img class="interact fr task-archive mr-1 " src="media/archive_white.png" alt"archiv öffnen" width="28px">
      <a class="fr mr-1" href="index.php?board=newboard">
        <img class="" src="media/plus.png" alt"neues Board" width="28px">
      </a>
    </h1>
  </header>
  <main>
    <?php
      for ($i = 0; $i < 4; $i++){
        echo'<div class="card list light" id="l'.$i.'" value="'.$i.'" ondrop="drop(event)" ondragover="allowDrop(event)">
          <header>
            <h3>'.$board["list".$i];
        if (!isset($_GET["visit"])){
          if ($i == 0){
            echo '<a href="#" class="btn btn-sm fr yellow btn-new-task"> + </a>';
          }
        }
        echo '</h3></header>';
        $sql = "SELECT * FROM cards WHERE columnId=$i AND parentId=-1 AND boardId='$board_id' ORDER BY color DESC, name";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
          while($row = $result->fetch_assoc()) {
            $crdId = $row["id"];
            $sql_child = "SELECT * FROM cards WHERE boardId='$board_id' AND parentId=$crdId ORDER BY color DESC, name";
            $result_child = $conn->query($sql_child);
            if ( $result_child!= false && $result_child->num_rows > 0 ) {
            // output data of each row
              $child_cards = [];
              while($row_child = $result_child->fetch_assoc()) {
                array_push($child_cards,$row_child);
              }
            } else {
              $child_cards = NULL;
            }
            if (isset($_GET["visit"])){
              generateVisitorCard($row["id"], $row["name"], $row["descr"], $row["color"], $row["done"], $child_cards);
            }else{
              generateEditorCard($row["id"], $row["name"], $row["descr"], $row["color"], $row["done"], $child_cards);
            }
          }
        } else {
        }
        echo '</div>';
      }

      if (!isset($_GET["visit"])){
        echo '
        <div id="mds-parent"  ondrop="mdsDrop(event)" ondragover="allowDrop(event)">
          <div id="mds" class="card yellow hidden">
            <div id="mds0" class="card light mds-field" value="0"><b>'.$board["list0"].'</b></div>
            <div id="mds1" class="card light mds-field" value="1"><b>'.$board["list1"].'</b></div>
            <div id="mds2" class="card light mds-field" value="2"><b>'.$board["list2"].'</b></div>
            <div id="mds3" class="card light mds-field" value="3"><b>'.$board["list3"].'</b></div>
          </div>
        </div>';
      }

      echo'<div id="archive-bg" class="pop-up-bg hidden">
        <div id="archive" class="pop-up card light" id="l5" value="5" ondrop="drop(event)" ondragover="allowDrop(event)">
          <header>
            <h3>Archiv
              <button type="reset" class="fr btn red btn-sm btn-close" value="archive-bg">x</button>';
              if (!isset($_GET["visit"])){echo '<img class="interact fr delete-archive mr-2" src="media/trash.png" alt"archiv löschen" width="18px">';}
              echo '</h3>
          </header>';

      $sql = "SELECT * FROM cards WHERE columnId=5 AND parentId=-1 AND boardId='$board_id' ORDER BY color DESC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
      // output data of each row
        while($row = $result->fetch_assoc()) {
          if (isset($_GET["visit"])){
            generateVisitorCard($row["id"], $row["name"], $row["descr"], $row["color"], $row["done"]);
          }else{
            generateEditorCardArchived($row["id"], $row["name"], $row["descr"], $row["color"], $row["done"]);
          }
        }
      } else {
      }
      echo '</div></div>';

    ?>
  </main>
<?php
  if (!isset($_GET["visit"])){
    require 'popups.php';
  }
?>
</body>
</html>
<script src="js/main.js"></script>
