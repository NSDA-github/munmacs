var approved = 0;
nodesired = 1;

function appendTableData() {
  registrantsData["registrants"].map(function (registrant) {
    $("#registrants-table").append(
      `<tr>
        <th scope="row">${registrant["registrant_id"]}</th>
        <td>${registrant["name"]}</td>
        <td>${registrant["surname"]}</td>
        <td>${registrant["country"]}</td>
        <td>${registrant["relevancy"]}</td>
        <td>${
          registrant["discord"] == null ? "N/A" : registrant["discord"]
        }</td>
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
    fullinstitution =
      selectedRegistrant["institution"] +
      ` | <a target="_blank" rel="noopener noreferrer" href="https://2gis.kz/kazakhstan/search/${selectedRegistrant["institution"]}">View Map</a>` +
      (selectedRegistrant["occupation"] == "teacher"
        ? "<br>Teacher" +
          (selectedRegistrant["subject"] != null
            ? ": " + selectedRegistrant["subject"]
            : "")
        : selectedRegistrant["occupation"] == "student"
        ? "<br>Student" +
          (selectedRegistrant["major"] != null
            ? ": " + selectedRegistrant["major"]
            : "")
        : "<br>School Student" +
          (selectedRegistrant["grade"] != null
            ? ": " + selectedRegistrant["grade"]
            : "") +
          (selectedRegistrant["gradeletter"] != null
            ? " " + selectedRegistrant["gradeletter"]
            : ""));
    phonelink = `<a href="https://web.whatsapp.com/send?phone=${selectedRegistrant[
      "phone"
    ].substring(1)}" 
    target="_blank">${selectedRegistrant["phone"]}</a>`;
    $("#institution").html(fullinstitution);
    $("#email").html(
      `<a href="mailto:${selectedRegistrant["email"]}">${selectedRegistrant["email"]}</a>`
    );
    $("#phone").html(phonelink);
    $("#country").html(selectedRegistrant["country"]);
    $("#registrant-info").show();
  } else {
    $("#registrant-info").hide();
  }
}
