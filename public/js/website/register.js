const failTooltipMsg = "Data retrieval failed";
const loadingTooltipMsg = "Data is being loaded. Please, wait";

function legalfix() {
  if (!$("#legal").valid()) {
    $(".form-check-label").after($("label#legal-error"));
  }
}

function disableForm() {
  $("#country").next().addClass("disabled");
  $("#continue").addClass("disabled");
  $("#continue").attr("disabled", true);
  $("#submit").addClass("disabled");
  $("#submit").attr("disabled", true);
  $(".button-wrapper").tooltip("enable");
}

function enableForm() {
  $("#submit").removeClass("disabled");
  $("#submit").removeAttr("disabled");
  $("#country").next().removeClass("disabled");
  $("#continue").removeClass("disabled");
  $("#continue").removeAttr("disabled", true);
  $(".button-wrapper").tooltip("disable");
}

function tooltipAlert() {
  $(".button-wrapper").tooltip("dispose");
  $(".button-wrapper").tooltip({
    trigger: "hover",
    title: failTooltipMsg,
  });
}

function getAvailableCountries(reserved = 0) {
  data = Array(3);
  data[0] = Object({ name: "topic", value: $("#topic").val() });
  data[1] = Object({ name: "reserved", value: reserved });
  return $.ajax({
    type: "POST",
    url: "/api/countries",
    data: data,
    dataType: "json",
    success: function (data) {
      if (data.success) {
        console.log(data.countries);
        if (reserved == 0) {
          $("#country").empty();
          data.countries.map(function (country) {
            $("#country").append(
              `<option value=${country[0]}>${country[1]}</option>`
            );
          });
          $("#country").selectpicker("refresh");
        } else {
          $("#desiredcountry").empty();
          $("#desiredcountry").append(`<option value="">None</option>`);
          data.countries.map(function (country) {
            $("#desiredcountry").append(
              `<option value=${country[0]}>${country[1]}</option>`
            );
          });
          $("#desiredcountry").selectpicker("refresh");
        }
      } else {
        reportError(data);
      }
    },
    error: function (data) {
      reportError(data);
    },
  });
}

$(document).ready(function () {
  var enteredPersonalInfo = false;
  var selectedTopic = "";
  $("#country").selectpicker({
    liveSearch: true,
    dropupAuto: false,
    size: 6,
  });
  $("#desiredcountry").selectpicker({
    liveSearch: true,
    dropupAuto: false,
    size: 6,
  });
  $(".button-wrapper").tooltip({
    trigger: "hover",
    title: loadingTooltipMsg,
  });
  $(".button-wrapper").tooltip("disable");
  $(".countryselect").hide();
  // Switch between roles fields
  {
    if ($("#role").val() === "student") {
      $("#teacherfield").hide();
      $("#studentfield").show();
      $("#schoolstudentfield").hide();
    } else if ($("#role").val() === "schoolstudent") {
      $("#teacherfield").hide();
      $("#studentfield").hide();
      $("#schoolstudentfield").show();
    } else {
      $("#teacherfield").show();
      $("#studentfield").hide();
      $("#schoolstudentfield").hide();
    }
    $("#role").on("change", function () {
      if ($("#role").val() === "student") {
        $("#teacherfield").hide();
        $("#studentfield").show();
        $("#schoolstudentfield").hide();
      } else if ($("#role").val() === "schoolstudent") {
        $("#teacherfield").hide();
        $("#studentfield").hide();
        $("#schoolstudentfield").show();
      } else {
        $("#teacherfield").show();
        $("#studentfield").hide();
        $("#schoolstudentfield").hide();
      }
    });
  }

  // Validation
  $.validator.addMethod(
    "regex",
    function (value, element, regexp) {
      var re = new XRegExp(regexp);
      return this.optional(element) || re.test(value);
    },
    "Please check your input"
  );
  $("#need-validation").validate({
    rules: {
      name: {
        regex: "^(([.'`\\-\\p{L}])+[ ]?)*$",
        minlength: 2,
        maxlength: 50,
      },
      surname: {
        regex: "^(([.'`\\-\\p{L}])+[ ]?)*$",
        minlength: 2,
        maxlength: 50,
      },
      institution: {
        regex: "^((['`.,№#\"\\-\\p{L}0-9])+[ ]?)*$",
        minlength: 5,
        maxlength: 255,
      },
      gradeletter: {
        regex: "^[\\p{Lu}]$",
      },
      phone: {
        regex: "^([\\+][0-9]{11})$",
      },
      discord: {
        regex: "^.*#[0-9]{4}$",
      },
      email: {
        email: true,
      },
      confirmemail: {
        equalTo: email,
      },
      subject: {
        maxlength: 40,
        regex: "^(([,.'`\"\\-\\p{L}])+[ ]?)*$",
      },
      major: {
        maxlength: 40,
        regex: "^(([,.'`\"\\-\\p{L}])+[ ]?)*$",
      },
    },
    messages: {
      name: {
        regex: "Use only letters, space and -'`. characters",
        required: "Please fill in your name",
      },
      surname: {
        regex: "Use only letters, space and -'`. characters",
        required: "Please fill in your surname",
      },
      institution: {
        regex: "Use only alphanumericals, space and -'`.,№# characters",
        required: "Required for statistical purposes",
      },
      gradeletter: {
        regex: "Use only one uppercase letter",
      },
      phone: {
        regex:
          'Must resemble <span style="color:blue"> +xxxxxxxxxxx </span> (+ and 11 digits) format',
        required: "Required to contact you",
      },
      discord: {
        regex:
          'Must resemble <span style="color:blue"> username#1234 </span> format',
      },
      email: {
        email:
          'Must resemble <span style="color:blue">name@domain.com</span> format',
        required: "Required to contact you",
      },
      confirmemail: {
        equalTo: "Please enter the same email again",
      },
      legal: {
        required: "This agreement is required",
      },
    },
    errorClass: "is-invalid",
  });

  // Topic Access
  disableForm();
  $.when(getTopics())
    .done(function () {
      $.when(getAvailableCountries())
        .done(function () {
          if ($("#country").children().length == 0) tooltipAlert();
          else
            $.when(getAvailableCountries(1))
              .done(function () {
                if ($("#desiredcountry").children().length == 0) {
                  $("#desiredcountry").append(
                    `<option value="">No Reserved Countries are Available</option>`
                  );
                  $("#desiredcountry").selectpicker("refresh");
                }
                enableForm();
              })
              .fail(function () {
                tooltipAlert();
              });
        })
        .fail(function () {
          tooltipAlert();
        });
    })
    .fail(function () {
      tooltipAlert();
    });

  // Topic Change and Countries Access
  $("#topic").on("change", function () {
    $("#spinner-topic-change").show();
    $("#country").empty();
    disableForm();
    $.when(getAvailableCountries())
      .done(function () {
        $.when(getAvailableCountries(1))
          .done(function () {
            if ($("#desiredcountry").children().length == 0) {
              $("#desiredcountry").append(
                `<option value="">No Reserved Countries are Available</option>`
              );
              $("#desiredcountry").selectpicker("refresh");
            }
            $("#spinner-topic-change").hide();
            enableForm();
          })
          .fail(function () {
            tooltipAlert();
          });
      })
      .fail(function () {
        tooltipAlert();
      });
  });

  // Extra functions and form submit
  $("#confirmemail").on("paste", function (event) {
    event.preventDefault();
  });

  $("#need-validation").on("submit", function (event) {
    event.preventDefault();
    if ($(this).valid() && enteredPersonalInfo == false) {
      enteredPersonalInfo = true;
      $(".personalinfo.dissolve").removeClass("active");
      $(".personalinfo.dissolve").addClass("disabled");
      setTimeout(function () {
        $(".personalinfo").hide();
        $(".countryselect").show();
        $(".countryselect.dissolve").removeClass("disabled");
        $(".countryselect.dissolve").addClass("active");
      }, 600);
    } else {
      if ($(this).valid()) {
        var data = $(this).serializeArray();
        console.log(data);
        $.ajax({
          type: "POST",
          url: "/api/register",
          data: data,
          dataType: "json",
          success: function (data) {
            console.log(data);
            if (data.success) {
              disableForm();
              $("#registered").modal({
                show: true,
              });
            }
          },
          error: function (data) {
            if (data.responseJSON.validity) {
              data.responseJSON.validity.map(function (elname) {
                if (elname == "country")
                  $(".dropdown-toggle.btn-light").eq(0).addClass("is-invalid");
                $("#" + elname).addClass("is-invalid");
              });
              alert(
                data.responseJSON.msg + "\nCheck the fields highlighted in red."
              );
            } else reportError(data);
          },
        });
      }
    }
  });

  $("#back").click(function () {
    if (enteredPersonalInfo == true) {
      enteredPersonalInfo = false;
      $(".countryselect.dissolve").removeClass("active");
      $(".countryselect.dissolve").addClass("disabled");
      setTimeout(function () {
        $(".countryselect").hide();
        $(".personalinfo").show();
        $(".personalinfo.dissolve").removeClass("disabled");
        $(".personalinfo.dissolve").addClass("active");
      }, 600);
    }
  });

  $("#complete").click(function () {
    window.location.replace("/");
  });
});
