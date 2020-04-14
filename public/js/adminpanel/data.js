//approved = 1;

$(document).ready(function () {
  getTopics();
});

function download() {
  $("#download").addClass("disabled");
  var data = [];
  data.push(Object({ name: "action", value: "get" }));
  if ($("#approved-select").val() != null && $("#approved-select").val() != "")
    data.push(Object({ name: "approved", value: $("#approved-select").val() }));
  else if (typeof approved != "undefined")
    data.push(Object({ name: "approved", value: approved }));
  if ($("#orderby").val() != null && $("#orderby").val() != "")
    data.push(Object({ name: "orderby", value: $("#orderby").val() }));
  if ($("#topic").val() != null && $("#topic").val() != "")
    data.push(Object({ name: "topic", value: $("#topic").val() }));
  if ($("#local").val() != null && $("#local").val() != "")
    data.push(Object({ name: "local", value: $("#local").val() }));
  if ($("#has-attended").val() != null && $("#has-attended").val() != "")
    data.push(Object({ name: "attended", value: $("#has-attended").val() }));
  console.log(data);
  $.ajax({
    type: "POST",
    url: "/api/data/prepare",
    data: data,
    dataType: "json",
    success: function (data) {
      if (data.success) {
        data.link;
        console.log(data);
        if (typeof downloadlink != "undefined") $("#downloadlink").remove();
        $("#tab-panel").append(data.link);
        $("a[data-auto-download]").each(function () {
          var $this = $(this);
          setTimeout(function () {
            window.location = $this.attr("href");
          }, 100);
        });
      } else {
        reportError(data);
      }
      $("#download").removeClass("disabled");
    },

    error: function (data) {
      reportError(data);
      $("#download").removeClass("disabled");
    },
  });
}
