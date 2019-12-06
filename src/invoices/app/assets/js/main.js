
$(document).ready(function() {
  // aimation when move is over the icon, the icon will be zoomed
  $(".btn-icon")
    .mouseenter(function() {
      $(this)
        .children()
        .css("transform", "scale(" + 1.1 + ")");
    })
    .mouseleave(function() {
      $(this)
        .children()
        .css("transform", "scale(" + 1.0 + ")");
    });

  // when click on icon, enable to modify the fields of the table row
  $(".icon-modify").click(function() {
    var userId = $(this).val();
    var userFields = $(".user-" + userId + "-field");
    userFields.prop("disabled", function(i, v) {
      return !v;
    });
    userFields.each(function() {
      $(this).val($(this)[0].defaultValue);
    });
  });

  // enable to modify all the fields of the table
  $("#btn-modify-all").click(function(){
    $("input .input-table").prop("disabled",false);
  });
});