var approved = 1;

function appendTableData() {
  registrantsList.map(function (registrant) {
    $("#registrants-table").append(
      `<tr>
      <th scope="row">${registrant["registrant_id"]}</th>
      <td>${registrant["name"]}</td>
      <td>${registrant["surname"]}</td>
      <td>${registrant["country"]}</td>
      <td>${
        registrant["local"]
          ? '<span style="color: green;">Yes<span>'
          : '<span style="color: black;">No<span>'
      }</td>
      <td>${viewButton(registrant["registrant_id"])}</td>
    </tr>`
    );
  });
}

function search() {
  console.log($("#search-text").val());
  updateRegistrants($("#search-text").val());
}

$(document).ready(function (event) {
  $("#registrant-info").hide();
  getTopics({ update: true });
  $("#search-form").submit(function (event) {
    event.preventDefault();
  });
});

function handleView(id) {
  if (id != 0) {
    registrant = registrantsList.find(checkID, id);
    selectedRegistrant = registrant;
    $("#name").html(registrant["name"]);
    $("#surname").html(registrant["surname"]);
    fullinstitution =
      registrant["institution"] +
      " | " +
      (registrant["occupation"] == "teacher"
        ? "Teacher"
        : registrant["occupation"] == "student"
        ? "Student"
        : "School Student");
    $("#institution").html(fullinstitution);
    $("#country").html(registrant["country"]);
    $("#registrant-info").show();
  } else {
    $("#registrant-info").hide();
  }
}

function confirmCheckIn(action) {
  $("#confirm").modal("show");
  $("#confirm-text").html(
    `Do you want to set ${selectedRegistrant["name"]} 
        ${selectedRegistrant["surname"]} to be
        "${action}"?`
  );
  $("#confirm-btn").val(action);
}

function handleCheckIn(action) {
  data = Array(2);
  data[0] = Object({ name: "action", value: action });
  data[1] = Object({
    name: "id",
    value: selectedRegistrant["registrant_id"],
  });
  $.ajax({
    type: "POST",
    url: "/api/checkin",
    data: data,
    dataType: "json",
    success: function (data) {
      if (data.success) {
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
