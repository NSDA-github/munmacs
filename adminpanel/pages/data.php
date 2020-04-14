<div class="col-10 ml-auto nav-pad">
  <div class="tab-content" id="tabContent" style="padding-top: 30px; padding-left: 30px;">
    <div class="tab-pane fade" id="tab-panel" role="tabpanel">
      <h1>Data Export</h1>
      <div class="row">
        <div class="col-4">
          <strong><label style="font-size: 1.5rem;">Data Filter Options:</label></strong>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <label class="input-group-text" for="orderby">Order By:</label>
            </div>
            <select onchange="updateRegistrants()" class="custom-select" style="width:200px" name="orderby" id="orderby">
              <option value="name">Name</option>
              <option value="surname" selected>Surname</option>
              <option value="country">Country</option>
              <option value="time">Registration Time</option>
              <option value="approvedtime">Approval Time</option>
            </select>
          </div>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <label class="input-group-text" for="topic">Topic:</label>
            </div>
            <select onchange="updateRegistrants()" class="custom-select" style="width:200px" name="topic" id="topic">
              <option value="">All</option>
            </select>
          </div>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <label class="input-group-text" for="local">Local:</label>
            </div>
            <select onchange="updateRegistrants()" class="custom-select" style="width:200px" name="local" id="local">
              <option value="">Any</option>
              <option value="1">Local</option>
              <option value="0">Foreign</option>
            </select>
          </div>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <label class="input-group-text" for="approved-select">State:</label>
            </div>
            <select onchange="updateRegistrants()" class="custom-select" style="width:200px" name="approved-select" id="approved-select">
              <option value="">Any</option>
              <option value="1">Approved</option>
              <option value="0">Under Review</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="has-attended">Presence:</label>
            </div>
            <select onchange="updateRegistrants()" class="custom-select" style="width:200px" name="has-attended" id="has-attended">
              <option value="">Any</option>
              <option value="-1">Undefined</option>
              <option value="1">Attended</option>
              <option value="0">Was absent</option>
            </select>
          </div>
          <div class="form-group">
            <button id="download" class="btn btn-primary" onclick="download()">Download Data</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>