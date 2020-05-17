var registrantsData;
var selectedRegistrant;
var selectedTopic = 0;
var nodesired = 0;

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

function getTopics(options = Object({ update: false, updateProgress: false })) {
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
        if (options.update == true) updateRegistrants({ updateProgress: true });
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
  if (nodesired) data.push(Object({ name: "nodesired", value: 1 }));

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
        registrantsData = data.registrants;
        console.log(registrantsData);
      } else {
        reportError(data);
      }
    },

    error: function (data) {
      reportError(data);
    },
  });
}

function updateRegistrants(
  options = Object({ searchText: "", updateProgress: false })
) {
  $.when(getRegistrants(options.searchText)).done(function () {
    $("#registrants-table").empty();
    appendTableData();
    if (options.updateProgress) {
      updateProgress();
    }
  });
}

function updateProgress() {
  var totalProgress;
  if (registrantsData["info"]["totalnumber"])
    totalProgress =
      (registrantsData["info"]["totalapproved"] /
        registrantsData["info"]["totalnumber"]) *
      100;
  else totalProgress = 0;
  $("#totalapproved").text(registrantsData["info"]["totalapproved"]);
  $("#totalnumber").text(registrantsData["info"]["totalnumber"]);

  const topic = $("#topic").val();
  var topicProgress;
  if (topic != "") {
    var index = registrantsData["info"]["topicid"].indexOf(Number(topic));
    console.log("HAHA " + index);
    if (registrantsData["info"]["totalnumberbytopic"][index])
      topicProgress =
        (registrantsData["info"]["totalapprovedbytopic"][index] /
          registrantsData["info"]["totalnumberbytopic"][index]) *
        100;
    else {
      topicProgress = 0;
    }
    $("#totalapprovedbytopic").text(
      registrantsData["info"]["totalapprovedbytopic"][index]
    );
    $("#totalnumberbytopic").text(
      registrantsData["info"]["totalnumberbytopic"][index]
    );
    $("#topic-progress").width(topicProgress + "%");
  } else {
    $("#totalapprovedbytopic").text(registrantsData["info"]["totalapproved"]);
    $("#totalnumberbytopic").text(registrantsData["info"]["totalnumber"]);
    $("#topic-progress").width(totalProgress + "%");
  }

  $("#total-progress").width(totalProgress + "%");
}

function checkID(registrant) {
  return registrant["registrant_id"] == this;
}
