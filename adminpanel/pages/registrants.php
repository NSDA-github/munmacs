<div class="col-10 ml-auto nav-pad">
  <div class="tab-content" id="tabContent" style="padding-top: 30px; padding-left: 30px;">
    <div class="tab-pane fade" id="tab-panel" role="tabpanel">
      <h1>Registrants</h1>
      <div class="row mb-3">
        <div class="col-8">
          <div class="table-scroll mb-3">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="width: 20px;" scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Surname</th>
                  <th scope="col">Topic</th>
                  <th scope="col">Country I</th>
                  <th scope="col">Country II</th>
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
              <option value="country">Country I</option>
              <option value="countrydesired">Country II</option>
              <option value="time">Registration Time</option>
            </select>
          </div>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <label class="input-group-text" for="topic">Topic:</label>
            </div>
            <select onchange="updateRegistrants({updateProgress: true})" class="custom-select" style="width:200px" name="topic" id="topic">
              <option value="">All</option>
            </select>
          </div>
          <label for="total-progress">Total Approval Progress</label>
          <div class="progress">
            <div id="total-progress" class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p><span id="totalapproved"></span> / <span id="totalnumber"></span></p>
          <label for="topic-progress">Approval Progress By Topic</label>
          <div class="progress">
            <div id="topic-progress" class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p><span id="totalapprovedbytopic"></span> / <span id="totalnumberbytopic"></span></p>
        </div>
      </div>
      <div id="registrant-info">
        <label>
          <strong style="font-size: 1.5rem;" id="name"></strong>
          <strong style="font-size: 1.5rem;" id="surname"></strong> <br>
          <small id="residence"></small>
        </label>
        <br>
        <button class="btn btn-sm btn-primary mb-4" onclick="showInterestText()">View Interest Text</button>
        <table class="table-borderless col-8 table-sm mb-5">
          <thead>
            <th>Event Info:</th>
            <th>Contacts:</th>
            <th>Institution:</th>
          </thead>
          <tbody>
            <tr>
              <td id="topicname">N/A</td>
              <td id="email">N/A</td>
              <td id="institution">N/A</td>
            </tr>
            <tr>
              <td id="country">N/A</td>
              <td id="phone">N/A</td>
              <td id="institution-details">N/A</td>
            </tr>
          </tbody>
        </table>
        <button class="btn btn-danger" value="deny" onclick="confirmApproval(value)">
          Deny Admission
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
    <div class="modal fade" id="interesttext-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabelinteresttext">
              Interest Text
            </h5>
          </div>
          <div id="interesttext" class="modal-body"></div>
          <div class="modal-footer">
            <button id="confirm-btn" type="button" class="btn btn-primary" data-dismiss="modal" autofocus>
              Ok
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>