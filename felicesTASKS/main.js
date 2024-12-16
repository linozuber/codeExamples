function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
  $("#mds").removeClass("hidden");
}

function drop(ev) {
  ev.preventDefault();
  if ($("#"+ev.target.id).hasClass("list")){
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
    var cardid = data;
    var listid = $("#"+data).parent().attr("value");
    var datastr = 'card-id='+cardid+'&list-id='+listid;
    $.ajax({
        url : "logic/updatelist.php",
        type: "POST",
        data : datastr,
        success: function(data, textStatus, jqXHR)
        {
          //alert(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert("an error occured:");
          alert(data);
        }
    });
  }else if ($("#"+ev.target.id).hasClass("card")){
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
    var cardid = data;
    var parentid = $("#"+data).parent().attr("id");
    var datastr = 'card-id='+cardid+'&parent-id='+parentid;
    $.ajax({
        url : "logic/updateparent.php",
        type: "POST",
        data : datastr,
        success: function(data, textStatus, jqXHR)
        {
          //alert(parentid);
          //alert(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert("an error occured:");
          alert(data);
        }
    });
  }
}

function mdsDrop(ev) {
  ev.preventDefault();
  $("#mds").addClass("hidden");
  if ($("#"+ev.target.id).hasClass("mds-field")){
    var data = ev.dataTransfer.getData("text");
    var idtodropon = "l"+$("#"+ev.target.id).attr("value");
    document.getElementById(idtodropon).appendChild(document.getElementById(data));
    var cardid = data;
    var listid = $("#"+cardid).parent().attr("value");
    var datastr = 'card-id='+cardid+'&list-id='+listid;
    $.ajax({
        url : "logic/updatelist.php",
        type: "POST",
        data : datastr,
        success: function(data, textStatus, jqXHR)
        {
          //alert(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert("an error occured:");
          alert(data);
        }
    });
  }
}
function globalMouseUp(){
  $("#mds").addClass("hidden");
}

$("input[type=checkbox]").change(function(){
  var card = $(this).parent().parent();
  var done = 0;
  if(card.hasClass("done")){
    card.removeClass("done");
  }else{
    card.addClass("done");
    done = 1;
  }
  var datastr = "card-id="+card.attr("id")+"&card-done="+done;
  $.ajax({
      url : "logic/updatedone.php",
      type: "POST",
      data : datastr,
      success: function(data, textStatus, jqXHR)
      {
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert("an error occured:");
        alert(data);
      }
  });
});

$(".btn-close").click(function(){
  var toClose = $(this).attr("value");
  $("#"+toClose).addClass("hidden");
});

$(".board-share").click(function(){
  $("#share-card-bg").removeClass("hidden");
});

$(".board-edit").click(function(){
  $("#edit-list-bg").removeClass("hidden");
});

$(".task-archive").click(function(){
  $("#archive-bg").removeClass("hidden");
});

$(".task-delete").click(function(){
  $("#delete-card-bg").removeClass("hidden");
  var card = $(this).parent().parent();
  $("#delete-card input#delete-card-id").attr("value", card.attr("id"));
});

$(".delete-archive").click(function(){
  $("#delete-archive-bg").removeClass("hidden");
});

$(".archive-task").click(function(){
  $("#archive-card-bg").removeClass("hidden");
  var card = $(this).parent().parent();
  $("#archive-card input#archive-card-id").attr("value", card.attr("id"));
});

$(".revert-task").click(function(){
  $("#revert-card-bg").removeClass("hidden");
  var card = $(this).parent().parent();
  $("#revert-card input#revert-card-id").attr("value", card.attr("id"));
});

$(".task-edit").click(function(){
  $("#edit-card-bg").removeClass("hidden");
  var card = $(this).parent().parent();
  var name = card.children("header").children(".card-name").text();
  var descr = card.children(".card-descr").text();
  var color = card.attr("data-color");
  $(".selected").removeClass("selected");
  $(".pick-color."+color).addClass("selected");
  $("#edit-card input#edit-card-name").attr("value", name);
  $("#edit-card textarea#edit-card-descr").text(descr);
  $("#edit-card input#edit-card-color").attr("value", color);
  $("#edit-card input#edit-card-id").attr("value", card.attr("id"));
});

$(".btn-new-task").click(function(){
  $("#create-card-bg").removeClass("hidden");
  $("#create-card-color").attr("value", "light");
  $(".selected").removeClass("selected");
  $(".pick-color.light").addClass("selected");
});

$(".pick-color").click(function(){
  if ($(this).hasClass("selected")){
  }else{
    $(this).parent().children(".selected").removeClass("selected");
    $(this).addClass("selected");
    $(this).parent().next(".card-color").attr("value", $(this).attr("value"));
  }
});

$(document).keyup(function(e) {
     if (e.key === "Escape") {  // escape key maps to keycode `27`
       $(".pop-up-bg").addClass("hidden");
    }
});
