<?php
$board_ids = [""];
$visit_ids = [""];
$boardAndVisit_ids = [""];
$visit_id = "";
$board_id = "";
$board = [];
$back_link_gets = "";

$sql = "SELECT id, visitId FROM boards";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    array_push($board_ids,$row["id"]);
    array_push($visit_ids,$row["visitId"]);
    array_push($boardAndVisit_ids,$row["id"]);
    array_push($boardAndVisit_ids,$row["visitId"]);

  }
} else {
  echo "0 boards found";
}

if (!isset($_GET["board"]) && !isset($_GET["visit"])){
  header("Location: index.php?visit=00000000");
}elseif (isset($_GET["board"])){
  $board_id = $_GET["board"];
  if (idIsUsedIn($board_id, $board_ids)){
    $sql = "SELECT * FROM boards WHERE id='$board_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        foreach($row as $key => $value){
          $board[$key] = $value;
        }
        //connecting to an editable already existing board
        //print_r($board);
        $back_link_gets = "board=".$board_id;
      }
    }else{
      echo "couldnt load data of <b>board id</b> tht is in use";
    }
    $date = date("Y-m-d");
    $sql = "UPDATE boards SET lastVisit='$date' WHERE id='$board_id'";
    if ($conn->query($sql) == true) {
    }else{
      echo "couldnt insert current time";
    }
  }elseif ($_GET["board"] == "newboard"){
    $board_id = generateBoardIdFor($boardAndVisit_ids);
    array_push($boardAndVisit_ids, $board_id);
    $visit_id = generateBoardIdFor($boardAndVisit_ids);

    $sql = "INSERT INTO boards (id, visitId, list0, list1, list2, list3) VALUES ('$board_id', '$visit_id', 'TASKS', 'GEPLANT', 'IN ARBEIT', 'ERLEDIGT')";

    if ($conn->query($sql) === TRUE) {
      //connecting to a newly created board
      header("Location: index.php?board=".$board_id."&msg=welcome");

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }else{
    header("Location: index.php");
  }
}elseif (isset($_GET["visit"])) {
  $visit_id = $_GET["visit"];
  if (idIsUsedIn($visit_id, $visit_ids)){
    $sql = "SELECT * FROM boards WHERE visitId='$visit_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        foreach($row as $key => $value){
          $board[$key] = $value;
        }
        $board_id = $board["id"];
        //connecting to only visit an already existing board
        //print_r($board);
        $back_link_gets = "visit=".$visit_id;
      }
    }else{
      echo "couldnt load data of <b>visit id</b> tht is in use";
    }
    $date = date("Y-m-d");
    $sql = "UPDATE boards SET lastVisit='$date' WHERE id='$board_id'";
    if ($conn->query($sql) == true) {
    }else{
      echo "couldnt insert current time";
    }
  }else{
    header("Location: index.php");
  }
}

function idIsUsedIn($_idToCheck, $_board_ids){
  foreach ($_board_ids as $_id){
    if ($_idToCheck == $_id){
      return true;
      break;
    }
  }
  return false;
}

function idIsValidIn($_idToCheck, $_board_ids){
  if (idIsUsedIn($_idToCheck, $_board_ids)){
    return false;
  }else{
    return true;
  }
}

function generateBoardIdFor($_board_ids){
  $generating = true;
  $_board_id = "";
  while ($generating){
    $_board_id = dechex(rand(pow(16,7), pow(16,9)));
    if (idIsValidIn($_board_id, $_board_ids)){
      $generating = false;
    }
  }
  return $_board_id;
}


?>
