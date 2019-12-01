/*$.fn.textWidth = function(text, font) {
  if (!$.fn.textWidth.fakeEl)
    $.fn.textWidth.fakeEl = $("<span>")
      .hide()
      .appendTo(document.body);

  $.fn.textWidth.fakeEl
    .text(text || this.val() || this.text() || this.attr("placeholder"))
    .css("font", font || this.css("font"));

  return $.fn.textWidth.fakeEl.width();
};

$(".width-dynamic")
  .on("input", function() {
    var inputWidth = $(this).textWidth() + 5;
    $(this).css({
      width: inputWidth
    });
  })
  .trigger("input");

function inputWidth(elem, minW, maxW) {
  elem = $(this);
  console.log(elem);
}

var targetElem = $(".width-dynamic");

inputWidth(targetElem);*/

$(document).ready(function() {
  /* Botton Icon zoom ---------------------------------------------*/

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

  /*$(".icon-save").click(function() {
    var userId = $(this).val();
    var userFields = ".user-" + userId + "-field";
    $(userFields).prop("disabled", false);
  });*/
});
