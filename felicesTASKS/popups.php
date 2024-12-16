<div id="edit-card-bg" class="pop-up-bg hidden">
  <div id="edit-card" class="card light pop-up">
    <form action="logic/update.php" method="post" autocomplete="off">
      <header class="mb-1">
        <button type="reset" class="fr btn red btn-sm btn-close" value="edit-card-bg">x</button>
        <input id="edit-card-name" class="p-1" type="text" value="" placeholder="Kartentitel" name="card-name">
      </header>
      <textarea id="edit-card-descr" class="p-1" name="card-descr" placeholder="Beschreibung der Karte."></textarea>
      <ul id="color-picker" class="mb-1 mt-1">
        <li class="pick-color btn light outline p-1" value="light"></li>
        <li class="pick-color btn dark outline p-1" value="dark"></li>
        <li class="pick-color btn red outline p-1" value="red"></li>
        <li class="pick-color btn orange outline p-1" value="orange"></li>
        <li class="pick-color btn yellow outline p-1" value="yellow"></li>
        <li class="pick-color btn green outline p-1" value="green"></li>
        <li class="pick-color btn blue outline p-1" value="blue"></li>
      </ul>
      <input id="edit-card-color" class="hidden card-color" type="text" value="" name="card-color">
      <input id="edit-card-id" class="hidden" type="text" value="" name="card-id">
      <input id="edit-card-board" class="hidden card-color" type="text" value="<?php echo $board_id; ?>" name="board-id">
      <button type="submit" class="btn green btn-safe" value="edit-card-bg">speichern</button>
      <button type="reset" class="btn dark btn-close" value="edit-card-bg">abbrechen</button>
    </form>
  </div>
</div>
<div id="create-card-bg" class="pop-up-bg hidden">
  <div id="create-card" class="card light pop-up">
    <form action="logic/create.php" method="post" autocomplete="off">
      <header class="mb-1">
        <button type="reset" class="fr btn red btn-sm btn-close" value="create-card-bg">x</button>
        <input id="create-card-name" class="p-1" type="text" value="" placeholder="Kartentitel" name="card-name" autocomplete="off">
      </header>
      <textarea id="create-card-descr" class="p-1" name="card-descr" placeholder="Beschreibung der Karte."></textarea>
      <ul id="color-picker" class="mb-1 mt-1">
        <li class="pick-color btn light outline p-1" value="light"></li>
        <li class="pick-color btn dark outline p-1" value="dark"></li>
        <li class="pick-color btn red outline p-1" value="red"></li>
        <li class="pick-color btn orange outline p-1" value="orange"></li>
        <li class="pick-color btn yellow outline p-1" value="yellow"></li>
        <li class="pick-color btn green outline p-1" value="green"></li>
        <li class="pick-color btn blue outline p-1" value="blue"></li>
      </ul>
      <input id="create-card-color" class="hidden card-color" type="text" value="" name="card-color">
      <input id="create-card-board" class="hidden card-color" type="text" value="<?php echo $board_id; ?>" name="board-id">
      <button type="submit" class="btn green btn-create" value="create-card-bg">erstellen</button>
      <button type="reset" class="btn dark btn-close" value="create-card-bg">abbrechen</button>
    </form>
  </div>
</div>
<div id="delete-card-bg" class="pop-up-bg hidden">
  <div id="delete-card" class="card light pop-up">
    <form action="logic/delete.php" method="post" autocomplete="off">
      <header class="mb-1">
        <button type="reset" class="fr btn red btn-sm btn-close" value="delete-card-bg">x</button>
        <h3>Du bist dabei einen Task unwiederruflich zu löschen.</h3>
      </header>
      <input id="delete-card-id" class="hidden card-id" type="text" value="" name="card-id">
      <input id="delete-card-board" class="hidden card-color" type="text" value="<?php echo $board_id; ?>" name="board-id">
      <button type="submit" class="btn red btn-delete" value="delete-card-bg">löschen</button>
      <button type="reset" class="btn dark btn-close" value="delete-card-bg">abbrechen</button>
    </form>
  </div>
</div>
<div id="archive-card-bg" class="pop-up-bg hidden">
  <div id="archive-card" class="card light pop-up">
    <form action="logic/archivetask.php" method="post" autocomplete="off">
      <header class="mb-1">
        <button type="reset" class="fr btn red btn-sm btn-close" value="archive-card-bg">x</button>
        <h3>Du bist dabei einen Task zu archivieren</h3>
      </header>
      <div>
        <input id="archive-card-id" class="hidden card-id" type="text" value="" name="card-id">
        <input id="archive-card-list" class="hidden" type="text" value="5" name="list-id">
        <input id="archive-card-board" class="hidden" type="text" value="<?php echo $board_id; ?>" name="board-id">
      </div>
      <button type="submit" class="btn yellow btn-delete" value="archive-card-bg">archivieren</button>
      <button type="reset" class="btn dark btn-close" value="archive-card-bg">abbrechen</button>
    </form>
  </div>
</div>
<div id="revert-card-bg" class="pop-up-bg hidden">
  <div id="revert-card" class="card light pop-up">
    <form action="logic/archivetask.php" method="post" autocomplete="off">
      <header class="mb-1">
        <button type="reset" class="fr btn red btn-sm btn-close" value="revert-card-bg">x</button>
        <h3>Du bist dabei einen Task wieder herzustellen.</h3>
      </header>
      <div>
        <input id="revert-card-id" class="hidden card-id" type="text" value="" name="card-id">
        <input id="revert-card-list" class="hidden" type="text" value="0" name="list-id">
        <input id="revert-card-board" class="hidden" type="text" value="<?php echo $board_id; ?>" name="board-id">
      </div>
      <button type="submit" class="btn yellow btn-delete" value="revert-card-bg">wiederherstellen</button>
      <button type="reset" class="btn dark btn-close" value="revert-card-bg">abbrechen</button>
    </form>
  </div>
</div>
<div id="delete-archive-bg" class="pop-up-bg hidden">
  <div id="delete-archive" class="card light pop-up">
    <form action="logic/deletearchive.php" method="post" autocomplete="off">
      <header class="mb-1">
        <button type="reset" class="fr btn red btn-sm btn-close" value="delete-archive-bg">x</button>
        <h3>Du bist dabei alle archivierten Tasks unwiederruflich zu löschen.</h3>
      </header>
      <input id="delete-archive-id" class="hidden list-id" type="text" value="5" name="list-id">
      <input id="delete-archive-board" class="hidden" type="text" value="<?php echo $board_id; ?>" name="board-id">
      <button type="submit" class="btn red btn-delete" value="delete-archive-bg">alle löschen</button>
      <button type="reset" class="btn dark btn-close" value="delete-archive-bg">abbrechen</button>
    </form>
  </div>
</div>
<div id="share-card-bg" class="pop-up-bg hidden">
  <div id="share-card" class="card light pop-up">
    <form action="logic/delete.php" method="post" autocomplete="off">
      <header class="mb-2">
        <button type="reset" class="fr btn red btn-sm btn-close" value="share-card-bg">x</button>
        <h3>Du kannst die Links zu deinem Board teilen.</h3>
      </header>
      <div>
        <h4>Empfänger kann Bearbeiten</h4>
        <input class="mb-2 p-1" type="text" value="https://tasks.felices.ch?board=<?php echo $board['id']; ?>" disabled>
        <h4>Empfänger kann Anschauen</h4>
        <input class="mb-2 p-1" type="text" value="https://tasks.felices.ch?visit=<?php echo $board['visitId']; ?>" disabled>
      </div>
      <button type="reset" class="btn dark btn-close" value="share-card-bg">ok</button>
    </form>
  </div>
</div>
<div id="edit-list-bg" class="pop-up-bg hidden">
  <div id="edit-list" class="card light pop-up">
    <form action="logic/updatelisttitles.php" method="post" autocomplete="off">
      <header class="mb-1">
        <button type="reset" class="fr btn red btn-sm btn-close" value="edit-list-bg">x</button>
        <h3>Passe die Listentitel an.</h3>
        <input class="hidden" type="text" value="<?php echo $board_id;?>" name="board-id">
      </header>
      <div class="mb-1">
        <input class="p-1" type="text" value="<?php echo $board['list0'];?>" name="list0">
      </div>
      <div class="mb-1">
        <input class="p-1" type="text" value="<?php echo $board['list1'];?>" name="list1">
      </div>
      <div class="mb-1">
        <input class="p-1" type="text" value="<?php echo $board['list2'];?>" name="list2">
      </div>
      <div class="mb-1">
        <input class="p-1" type="text" value="<?php echo $board['list3'];?>" name="list3">
      </div>
      <button type="submit" class="btn green" value="edit-list-bg">speichern</button>
      <button type="reset" class="btn dark btn-close" value="edit-list-bg">abbrechen</button>
    </form>
  </div>
</div>
