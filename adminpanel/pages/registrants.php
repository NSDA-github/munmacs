<div class="col-10 ml-auto nav-pad">
  <div class="tab-content" id="tabContent" style="padding-top: 30px; padding-left: 30px;">
    <div class="tab-pane fade" id="tab-panel" role="tabpanel">
      <h1>Registrants</h1>
      <div class="row mb-5">
        <div class="col-8">
          <div class="table-scroll mb-3">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th style="width: 20px;" scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Surname</th>
                  <th scope="col">Topic</th>
                  <th scope="col">Country</th>
                  <th style="width: 95px;" scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="registrants-table"></tbody>
            </table>
          </div>
        </div>
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
        </div>
      </div>
      <div id="registrant-info">
        <table class="table-borderless col-8 table-sm mb-4">
          <thead>
            <th style="width: 175px;"></th>
            <th></th>
          </thead>
          <tbody>
            <tr>
              <th>Name:</th>
              <td id="name">N/A</td>
            </tr>
            <tr>
              <th>Surname:</th>
              <td id="surname">N/A</td>
            </tr>
            <tr>
              <th>Registration Datetime:</th>
              <td id="time">N/A</td>
            </tr>
            <tr>
              <th></th>
              <td></td>
            </tr>
            <tr>
              <th>Institution:</th>
              <td id="institution">N/A</td>
            </tr>
            <tr>
              <th>Email:</th>
              <td id="email">N/A</td>
            </tr>
            <tr>
              <th>Phone:</th>
              <td id="phone">N/A</td>
            </tr>
            <tr>
              <th></th>
              <td id="name"></td>
            </tr>
            <tr>
              <th>Country:</th>
              <td id="country">N/A</td>
            </tr>
          </tbody>
        </table>
        <button class="btn btn-danger" value="deny" onclick="confirmApproval(value)">
          Deny
        </button>
        <button class="btn btn-success" value="foreign" onclick="confirmApproval(value)">
          Approve as foreign
        </button>
        <button class="btn btn-success" value="local" onclick="confirmApproval(value)">
          Approve as local
        </button>
      </div>
    </div>
    <div class="modal fade" id="confirm" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">
              Please Confirm Your Action
            </h5>
          </div>
          <div id="confirm-text" class="modal-body"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" autofocus>
              Cancel
            </button>
            <button id="confirm-btn" value="" onclick="handleApproval(value)" type="button" class="btn btn-primary">
              Confirm
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>