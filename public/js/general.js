var registrantsList;
var selectedRegistrant;
var selectedTopic = 0;

function reportError(data) {
  try {
    if (typeof data.responseJSON != "undefined") {
      if (typeof data.responseJSON.error != "undefined")
        alert(data.responseJSON.msg + "\n" + data.responseJSON.error);
      else alert(data.responseJSON.msg);
    } else {
      if (data.error != null) alert(data.msg + "\n" + data.error);
      else alert(data.msg);
    }
  } catch (error) {
    console.log(data);
  }
  console.log(data);
}

$(document).ready(function () {
  $("#tab-panel").tab("show");
});

function viewButton(id) {
  return `
      <button
        onclick="handleView(value)"
        value="${id}"
        class="btn btn-primary btn-sm"
      >
        View Details
      </button>
      `;
}

function getTopics(options = Object({ update: false })) {
  data = Array(1);
  return $.ajax({
    type: "POST",
    url: "/api/topics",
    data: data,
    dataType: "json",
    success: function (data) {
      if (data.success) {
        data.topics.map(function (topic) {
          $("#topic").append(`<option value=${topic[0]}>${topic[1]}</option>`);
        });
        if (options.update == true) updateRegistrants();
      } else {
        reportError(data);
      }
    },
    error: function (data) {
      reportError(data);
    },
  });
}

function getRegistrants(searchText = "") {
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

  if (searchText != "")
    data.push(Object({ name: "search", value: searchText }));
  console.log(data);
  return $.ajax({
    type: "POST",
    url: "/api/registrants",
    data: data,
    dataType: "json",
    success: function (data) {
      console.log(data);
      if (data.success) {
        registrantsList = data.registrants;
      } else {
        reportError(data);
      }
    },

    error: function (data) {
      reportError(data);
    },
  });
}

function updateRegistrants(searchText = "") {
  $.when(getRegistrants(searchText)).done(function () {
    $("#registrants-table").empty();
    appendTableData();
  });
}

function checkID(registrant) {
  return registrant["registrant_id"] == this;
}
