<?php

function showWelcomeMessage(){
  if (isset($_GET["msg"])){
    $msg = $_GET["msg"];
    switch ($msg) {
      case 'welcome':
        echo '
        <div id="msg" class="card light p-2">
          <a href="index.php?board='.$_GET["board"].'" class="btn btn-close btn-sm fr red" value="msg">x</a>
          <h3 class="mb-1">Willkommen bei FELICES TASKS.</h3>
          <p class="mb-1">Du bist hier auf einem neuen Board. Erstelle Tasks und organisiere deine kleinen Projekte ganz easy und ohne Login.</p>
          <p class="mb-1"><b>Wichtig</b> ist nur, dass du auf den Board <b>keinenfalls</b> sensiblen / persönlichen Daten erfasst, da es öffentlich ist, und dass du dir den Link zu deinem Board als Lesezeichen einrichtest / speicherst.</p>
        </div>';
        break;
      default:
        break;
    }
  }
}

function generateEditorCard($_id, $_name, $_descr, $_color, $_done, $_child_cards){
  $_checked = "";
  $_done_class ="";
  $_trash_icon = "trash_white.png";
  $_archive_icon = "archive_white.png";
  $_pen_icon = "pen_white.png";
  if ($_done == true){
    $_checked = "checked";
    $_done_class ="done";
  }
  if ($_color == "light"){
    $_trash_icon = "trash.png";
    $_pen_icon = "pen.png";
    $_archive_icon = "archive.png";
  }
  echo'
  <div class="card task '.$_color.' '.$_done_class.'" data-color="'.$_color.'" id ="'.$_id.'" draggable="true" ondragstart="drag(event)" ondrop="drop(event)" ondragover="allowDrop(event)">
    <header>
      <input type="checkbox" '.$_checked.'>
      <h3 class="card-name">'.$_name.'</h3>
    </header>
    <p class="card-descr mb-1">'.$_descr.'</p>
    <div class="card-icons">
      <img class="interact task-delete ml-1" src="media/'.$_trash_icon.'" alt="delete" width="14px">
      <img class="interact archive-task ml-1" src="media/'.$_archive_icon.'" alt="archive" width="16px">
      <img class="interact task-edit ml-1" src="media/'.$_pen_icon.'" alt="settings" width="16px">
    </div>
    <div class="child-cards">';
    if ($_child_cards != NULL){
      foreach ($_child_cards as $row_child_card) {
        generateEditorCard($row_child_card["id"], $row_child_card["name"], $row_child_card["descr"], $row_child_card["color"], $row_child_card["done"], NULL);
      }
    }
    echo'</div>
  </div>
  ';
}
function generateEditorCardArchived($_id, $_name, $_descr, $_color, $_done){
  $_checked = "";
  $_done_class ="";
  $_trash_icon = "trash_white.png";
  $_revert_icon = "revert_white.png";
  if ($_done == true){
    $_checked = "checked";
    $_done_class ="done";
  }
  if ($_color == "light"){
    $_trash_icon = "trash.png";
    $_revert_icon = "revert.png";
  }
  echo'
  <div class="card '.$_color.' '.$_done_class.'" data-color="'.$_color.'" id ="'.$_id.'" draggable="true" ondragstart="drag(event)">
    <header>
      <input type="checkbox" '.$_checked.'>
      <h3 class="card-name">'.$_name.'</h3>
    </header>
    <p class="card-descr">'.$_descr.'</p>
    <div class="card-icons">
      <img class="interact task-delete ml-1" src="media/'.$_trash_icon.'" alt="delete" width="14px">
      <img class="interact revert-task ml-1" src="media/'.$_revert_icon.'" alt="revert" width="14px">
    </div>
  </div>
  ';
}
function generateVisitorCard($_id, $_name, $_descr, $_color, $_done){
  $_checked = "";
  $_done_class ="";
  if ($_done == true){
    $_checked = "checked";
    $_done_class ="done";
  }
  echo'
  <div class="card task '.$_color.' '.$_done_class.'" data-color="'.$_color.'" id ="'.$_id.'">
    <header>
      <h3 class="card-name">'.$_name.'<input type="checkbox" '.$_checked.' disabled></h3>
    </header>
    <p class="card-descr">'.$_descr.'</p>
  </div>
  ';
}

?>
