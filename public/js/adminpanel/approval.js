var approved = -1;
nodesired = 1;

function appendTableData() {
  registrantsData["registrants"].map(function (registrant) {
    $("#registrants-table").append(
      `<tr onclick="handleView(${registrant["registrant_id"]})">
        <th scope="row">${registrant["registrant_id"]}</th>
        <td>${registrant["name"]}</td>
        <td>${registrant["surname"]}</td>
        <td>${registrant["country"]}</td>
        <td>${registrant["relevancy"]}</td>
        <td>${
          registrant["discord"] == null ? "N/A" : registrant["discord"]
        }</td>
      </tr>`
    );
  });
}

$(document).ready(function (event) {
  $("#registrant-info").hide();
  $.when(getTopics()).done(function () {
    setTimeout(updateRegistrants(), 1000);
  });
});

function confirmDiscordEdit(event, action) {
  event.preventDefault();
  var validator = $("#discord-edit-form").validate({
    messages: {
      discordEdit: {
        pattern:
          'Must resemble <span style="color:blue"> username#1234 </span> format',
      },
    },
    onclick: false,
    focusInvalid: false,
    errorClass: "is-invalid",
    errorPlacement: function (error, element) {
      error.appendTo($("#discordEdit").parent().parent());
    },
  });
  if ($("#discord-edit-form").valid()) {
    $("#confirm").modal("show");
    $("#confirm-text").html(
      `Do you want to set Ind. ${selectedRegistrant["name"]}'s 
      Discord Username to ${$("#discordEdit").val()}?`
    );
    $("#confirm-btn").val(action);
  }
}

function confirmApproval(action) {
  $("#confirm").modal("show");
  $("#confirm-text").html(
    `Do you want to ${action} ${selectedRegistrant["name"]} ${selectedRegistrant["surname"]} application?`
  );
  $("#confirm-btn").val(action);
}

function handleView(id) {
  if (id != 0) {
    selectedRegistrant = registrantsData["registrants"].find(checkID, id);
    // If Server uses UTC timezone
    datetmp = new Date(selectedRegistrant["time"].date);
    date = new Date(
      Date.UTC(
        datetmp.getFullYear(),
        datetmp.getMonth(),
        datetmp.getDate(),
        datetmp.getHours(),
        datetmp.getMinutes(),
        datetmp.getSeconds(),
        datetmp.getMilliseconds()
      )
    );

    // If Server uses local timezone
    // date = new Date(selectedRegistrant["time"].date);
    date = date.toLocaleString("ru-RU", {
      timeZone: "Asia/Oral",
    });
    $("#name").html(selectedRegistrant["name"]);
    $("#surname").html(selectedRegistrant["surname"]);
    $("#time").html(date);
    countrydesired = selectedRegistrant["countrydesired"]
      ? " <b>OR</b> " + selectedRegistrant["countrydesired"]
      : "";
    institution =
      selectedRegistrant["institution"] +
      ` | <a target="_blank" rel="noopener noreferrer" href="https://2gis.kz/kazakhstan/search/${selectedRegistrant["institution"]}">View Map</a>`;
    institutionDetails =
      selectedRegistrant["occupation"] == "teacher"
        ? "Teacher" +
          (selectedRegistrant["subject"] != null
            ? ": " + selectedRegistrant["subject"]
            : "")
        : selectedRegistrant["occupation"] == "student"
        ? "Student" +
          (selectedRegistrant["major"] != null
            ? ": " + selectedRegistrant["major"]
            : "")
        : "School Student" +
          (selectedRegistrant["grade"] != null
            ? ": " + selectedRegistrant["grade"]
            : "") +
          (selectedRegistrant["gradeletter"] != null
            ? " " + selectedRegistrant["gradeletter"]
            : "");
    if (selectedRegistrant["phone"] != null)
      phonelink = `<a href="https://web.whatsapp.com/send?phone=${selectedRegistrant[
        "phone"
      ].substring(1)}" 
          target="_blank">${selectedRegistrant["phone"]}</a>`;
    else phonelink = "N/A";
    $("#residence").html("From " + selectedRegistrant["residence"]);
    $("#institution").html(institution);
    $("#institution-details").html(institutionDetails);
    $("#email").html(
      `<a href="mailto:${selectedRegistrant["email"]}">${selectedRegistrant["email"]}</a>`
    );
    $("#phone").html(phonelink);
    $("#discordEdit").val(selectedRegistrant["discord"]);
    $("#country").html(selectedRegistrant["country"] + countrydesired);
    $("#topicname").html(selectedRegistrant["topic"]);
    $("#registrant-info").show();
  } else {
    $("#registrant-info").hide();
  }
}
