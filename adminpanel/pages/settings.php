<script>
  $(document).ready(function() {
    $("#submit-reset-countries").click(function() {
      event.preventDefault();

      var formData = $(this).closest("form").serializeArray();
      formData.push({
        name: this.name,
        value: this.value
      });

      $("#spinner-reset-countries").show();

      console.log(formData);

      $.ajax({
        type: "POST",
        url: "/api/reset/database",
        data: formData,
        dataType: "json",
        success: function(data) {
          if (data.success) {
            $("#spinner-reset-countries").hide();
            $("#success-reset-countries").show();
            setTimeout(() => {
              $("#success-reset-countries").hide();
            }, 2000);
          } else {
            reportError(data);
            $("#spinner-reset-countries").hide();
          }
        },
        error: function(data) {
          reportError(data);
          $("#spinner-reset-countries").hide();
        },
      });
    });
  });
</script>
<div class="col-10 ml-auto nav-pad">
  <div class="tab-content" id="tabContent" style="padding-top: 30px; padding-left: 30px;">
    <div class="tab-pane fade" id="tab-panel" role="tabpanel">
      <h1>Settings</h1>
      <br />
      <h3>Reset Database</h3>
      <form id="reset-countries">
        <div class="row">
          <div class="form-group col-2">
            <label for="password-reset-countries">Admin Password</label>
            <input class="form-control" type="password" name="password" id="password-reset-countries" required />
            <div id="spinner-reset-countries" class="spinner-border" role="status" style="display: none;">
              <span class="sr-only">Loading...</span>
            </div>
            <span id="success-reset-countries" class="badge badge-pill badge-success" style="display: none;">success</span>
          </div>
        </div>
        <button id="submit-reset-countries" class="btn btn-md btn-primary" type="submit">
          Reset
        </button>
      </form>
    </div>
  </div>
</div>