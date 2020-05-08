<div class="col-10 ml-auto nav-pad">
  <div class="tab-content" id="tabContent" style="padding-top: 30px; padding-left: 30px;">
    <div class="tab-pane fade" id="tab-panel" role="tabpanel">
      <h1>User Guide</h1>
      <h3>Index</h3>
      <div class="mb-3">
        <a href="#manual">User Manual</a> |
        <a href="#backup">Back Up Routine</a> |
        <a href="#cer">Common Error Guide</a> |
        <a href="#faq">FAQ</a> |
        <a href="#glossary">Glossary</a>
      </div>
      <h3 id="manual">User Manual</h3>
      <h5>Registrant approval</h5>
      <ol>
        <li>Go to “Registrants” tab of the admin panel by selecting it on the left sidebar.</li>
        <li>Select your preferred data filtering parameters at the right of the page.</li>
        <li>The table will be automatically updated where you can see and review each application. <br>
          Please, press the “View Details” button to see more details about the registrant and to <br>
          make your decision regarding the application.
        </li>
        <li>After reviewing the application, you have a choice to “Deny”, “Approve as local” <br>
          and “Approve as foreign”. Before each action, you will see the confirmation pop-up. <br>
          Please note that denied registrants data are permanently deleted.
        </li>
      </ol>
      <h5>Participant check-in</h5>
      <ol>
        <li>Go to “Approved Registrants” tab of the admin panel by selecting it on the left sidebar.</li>
        <li>Select your preferred data filtering parameters at the right of the page.</li>
        <li>If you want to quickly find the participant by surname, use the search field at the <br>
          bottom of filtering options.</li>
        <li>The table will be automatically updated where you can see and review each participant. <br>
          Please, press the “View Details” button to see more details about the participant and to <br>
          make your decision regarding the application.</li>
        <li>After selecting each participant, you have a choice to set them to be “Attended” or “Absent”.</li>
        <li>Remember that you can always resigned the attendance state by changing the Presence filter</li>
      </ol>
      <h5>Data Export</h5>
      <ol>
        <li>Go to “Data Export” tab of the admin panel by selecting it on the left sidebar</li>
        <li>Select your preferred data filtering parameters and press the Download button.</li>
        <li>The browser will automatically start download. If it did not, please, press the <br>
          Download Link created after pressing the button.</li>
      </ol>
      <h3 id="backup">Back Up Routine</h3>
      <p> There are two ways to back up data. First, through PhpMyAdmin, second is through <br>
        Data Export feature of the admin panel. <br> </p>
      <p>
        PhpMyAdmin data backup is performed twice before registration closure and once after <br>
        registration is closed. It is done by a developer who maintains the website through <br>
        PhpMyAdmin. The exported data is shared and sent to some organizers as well. Primary <br>
        backup is stored on the external hard drive of the developer and requires at least 3Mb <br>
        of extra space in total. Please contact the website maintainer to discuss the back upped <br>
      </p>
      <p>
        Organizers can also export data, but it is limited to .xlsx spreadsheet format exported <br>
        from ‘Data Export” page of the admin panel. It contains sufficient amount of information <br>
        to continue the registration and check-in process in case of total data loss and <br>
        failure. It is encouraged to export data once in a few days and save it to the computer, <br>
        as well as upload it to the cloud service. It is recommended to have about 10Mb of <br>
        extra space or at least 3Mb, because you may need to save more files each day, while <br>
        format of the .xlsx file can sometimes require more storage then exporting using SQL. <br>
      </p>
      <h3 id="cer">Common Error Guide</h3>
      <table class="table table-striped">
        <thead>
          <th>Error</th>
          <th>Solution</th>
        </thead>
        <tbody>
          <tr>
            <td>Internal Server Error
            </td>
            <td>Please contact the website maintainer. He will guide you to retrieve the full error message and then use this information to quickly fix the server’s internal error. In the meantime, wait until the functionality is fixed.
            </td>
          </tr>
          <tr>
            <td>Invalid User Request / Invalid Request / Bad User Request
            </td>
            <td>Please check for highlighted areas to see which input fields contain data that were not accepted by the server. If there are no highlighted areas, make sure that you are using modern browser and JavaScript functionality is turned on. If the error is persistent, please contact the website maintainer about the issue.
            </td>
          </tr>
          <tr>
            <td>Country is no longer available.
            </td>
            <td>While registering, someone might submit the application with the exact same country, but little bit earlier. In this case, country cannot be assigned. Please, select different country and repeat your attempt. If the error is persistent, please contact the website maintainer about the issue.
            </td>
          </tr>
        </tbody>
      </table>
      <h3 id="faq">Frequently Asked Questions</h3>
      <table class="table table-striped">
        <thead>
          <th>Error</th>
          <th>Solution</th>
        </thead>
        <tbody>
          <tr>
            <td>How I can get new credentials to access the admin panel?
            </td>
            <td>Please contact the website maintainer. They will verify your request and send you back your credentials.
            </td>
          </tr>
          <tr>
            <td>How I can change my password?
            </td>
            <td>At this stage of development, only website maintainer / database manager can change your password. Please contact them.
            </td>
          </tr>
          <tr>
            <td>Please, contact the website maintainer regarding your issue.
            </td>
            <td>What if I forgot the password?
            </td>
          </tr>
        </tbody>
      </table>
      <h3 id="glossary">Glossary</h3>
      • Topic – discussion topic for the event. Each topic is discussed in separate auditoriums. One country can be repeated in each topic (auditorium). <br>
      • Country – official United Nations member state which can be chosen by a registrant to represent it during the event.<br>
      • Admin Panel – workspace for organizers to access and modify the event database.<br>
      • Registrant – potential participant or registrant with an application which is currently under review.<br>
      • Participant – registrant with an approved application.<br>
      • Local registrant – registrant who is from the institution where the event is held.<br>
      • Foreign registrant – registrant who is from foreign institution where the event is not held.<br>
      • Student – Undergraduate/Graduate
    </div>
  </div>
</div>