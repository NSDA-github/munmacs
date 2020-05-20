<div class="col-10 ml-auto nav-pad">
  <div class="tab-content" id="tabContent" style="padding-top: 30px; padding-left: 30px;">
    <div class="tab-pane fade" id="tab-panel" role="tabpanel">
      <h1>Registrants Approval</h1>
      <div class="row mb-3">
        <div class="col-8">
          <div class="table-scroll mb-3">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th style="width: 20px;" scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Surname</th>
                  <th scope="col">Country</th>
                  <th scope="col">Relevancy</th>
                  <th scope="col">Discord</th>
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
              <label class="input-group-text" for="topic">Topic:</label>
            </div>
            <select onchange="updateRegistrants()" class="custom-select" style="width:200px" name="topic" id="topic">
            </select>
          </div>
          <div class="mb-4"></div>
          <form id="surname-search-form">
            <div class="input-group input-group-sm mb-3" style="width: 100%;">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Search By Surname</span>
              </div>
              <input type="text" class="form-control" name="surname-search" id="surname-search" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
              <div class="input-group-append">
                <button class="btn btn-secondary" type="submit" name="surname" id="surname-search-btn" onclick="search(name)">
                  Go
                </button>
              </div>
            </div>
          </form>
          <form id="discord-search-form">
            <div class="input-group input-group-sm mb-3" style="width: 100%;">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Search By Discord</span>
              </div>
              <input type="text" class="form-control" name="discord-search" id="discord-search" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
              <div class="input-group-append">
                <button class="btn btn-secondary" type="submit" name="discord" id="discord-search-btn" onclick="search(name)">
                  Go
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div id="registrant-info">
        <strong><label style="font-size: 1.5rem;" id="name"></label></strong>
        <strong><label style="font-size: 1.5rem;" id="surname"></label></strong>
        <table class="table-borderless col-8 table-sm mb-2">
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
        <form id="discord-edit-form">
          <div class="form-row mb-2">
            <div class="col-4">
              <div class="input-group" style="width: 100%;">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing">Discord ID:</span>
                </div>
                <input type="text" class="form-control" name="discordEdit" id="discordEdit" aria-label="Sizing example input" aria-describedby="inputGroup-sizing" pattern=".*#([0-9]){4}" />
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" name="discord-edit-btn" value="discordEdit" id="discord-edit-btn" onclick="confirmDiscordEdit(event, value)">
                    Edit Username
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" value="" id="interest-verification">
          <label class="form-check-label" for="defaultCheck1">
            Interest Verification | <button class="btn btn-sm btn-link" onclick="showInterestText()">View</button>
          </label>
        </div>
        <button class="btn btn-danger" value="absent" onclick="confirmCheckIn(value)">
          Absent
        </button>
        <button class="btn btn-success" value="attended" onclick="confirmCheckIn(value)">
          Attended
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
            <button id="confirm-btn" value="" onclick="handleAction(value)" type="button" class="btn btn-primary">
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