var approved = -1;

function appendTableData() {
  registrantsData["registrants"].map(function (registrant) {
    $("#registrants-table").append(
      `<tr onclick="handleView(${registrant["registrant_id"]})" >
        <th scope="row">${registrant["registrant_id"]}</th>
        <td>${registrant["name"]}</td>
        <td>${registrant["surname"]}</td>
        <td>${registrant["topic"]}</td>
        <td>${registrant["country"]}</td>
        <td>${
          registrant["countrydesired"] ? registrant["countrydesired"] : "N/A"
        }</td>
      </tr>`
    );
  });
}

$(document).ready(function (event) {
  $("#registrant-info").hide();
  $.when(getTopics()).done(updateRegistrants({ updateProgress: true }));

  $(".registrant-row").click(function () {
    console.log("haha");
  });
});

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

function handleApproval(action) {
  console.log(action);
  data = Array(2);
  data[0] = Object({ name: "action", value: action });
  data[1] = Object({
    name: "id",
    value: selectedRegistrant["registrant_id"],
  });
  $.ajax({
    type: "POST",
    url: "/api/approval",
    data: data,
    dataType: "json",
    success: function (data) {
      if (data.success) {
        console.log(data);
        updateRegistrants();
        handleView(0);
      } else {
        reportError(data);
      }
      $("#confirm").modal("hide");
    },

    error: function (data) {
      $("#confirm").modal("hide");
      reportError(data);
    },
  });
}
