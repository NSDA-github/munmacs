var approved = 0;

function appendTableData() {
  registrantsList.map(function (registrant) {
    $("#registrants-table").append(
      `<tr>
        <th scope="row">${registrant["registrant_id"]}</th>
        <td>${registrant["name"]}</td>
        <td>${registrant["surname"]}</td>
        <td>${registrant["topic"]}</td>
        <td>${registrant["country"]}</td>
        <td>${viewButton(registrant["registrant_id"])}</td>
      </tr>`
    );
  });
}

$(document).ready(function (event) {
  $("#registrant-info").hide();
  getTopics({ update: true });
});

function handleView(id) {
  if (id != 0) {
    registrant = registrantsList.find(checkID, id);
    selectedRegistrant = registrant;
    // If Server uses UTC timezone
    datetmp = new Date(registrant["time"].date);
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
    // date = new Date(registrant["time"].date);
    date = date.toLocaleString("ru-RU", {
      timeZone: "Asia/Oral",
    });
    $("#name").html(registrant["name"]);
    $("#surname").html(registrant["surname"]);
    $("#time").html(date);
    fullinstitution =
      registrant["institution"] +
      ` | <a target="_blank" rel="noopener noreferrer" href="https://2gis.kz/kazakhstan/search/${registrant["institution"]}">View Map</a>` +
      (registrant["occupation"] == "teacher"
        ? "<br>Teacher" +
          (registrant["subject"] != null ? ": " + registrant["subject"] : "")
        : registrant["occupation"] == "student"
        ? "<br>Student" +
          (registrant["major"] != null ? ": " + registrant["major"] : "")
        : "<br>School Student" +
          (registrant["grade"] != null ? ": " + registrant["grade"] : "") +
          (registrant["gradeletter"] != null
            ? " " + registrant["gradeletter"]
            : ""));
    $("#institution").html(fullinstitution);
    $("#email").html(
      `<a href="mailto:${registrant["email"]}">${registrant["email"]}</a>`
    );
    $("#phone").html(registrant["phone"]);
    $("#country").html(registrant["country"]);
    $("#registrant-info").show();
  } else {
    $("#registrant-info").hide();
  }
}

function confirmApproval(action) {
  $("#confirm").modal("show");
  $("#confirm-text").html(
    `Do you want to ${
      action == "local"
        ? "approve "
        : action == "foreign"
        ? "approve "
        : "deny "
    } ${selectedRegistrant["name"]} ${selectedRegistrant["surname"]} ${
      action == "local"
        ? "as a participant from host institution?"
        : action == "foreign"
        ? "as a participant from foreign institution?"
        : "?"
    }`
  );
  $("#confirm-btn").val(action);
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
