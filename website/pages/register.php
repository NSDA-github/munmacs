<div class="container">
  <div class="form-container">
    <h1 style="padding-top: 30px;">Delegate Registration Form</h1>
    <h6 class="card-subtitle mb-2 text-muted">
      Registration is open for everyone. <br />
      Please consider creating a <a target="_blank" href="https://discord.com/register">Discord account</a>
    </h6>
    <form action="../app/register/index.php" id="need-validation">
      <div class="personalinfo dissolve active">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="name">First Name <span class="attention">*</span> <br />
            </label>
            <input name="name" type="text" class="form-control" id="name" required />
          </div>
          <div class="form-group col-md-6">
            <label for="surname">Last Name <span class="attention">*</span><br />
            </label>
            <input name="surname" type="text" class="form-control" id="surname" required />
          </div>
          <div class="form-group col-md-6">
            <label for="email">Email <span class="attention">*</span><br />
            </label>
            <input name="email" type="email" class="form-control" id="email" required />
          </div>
          <div class="form-group col-md-6">
            <label for="confirmemail">Confirm email <span class="attention">*</span><br />
            </label>
            <input name="confirmemail" type="text" class="form-control" id="confirmemail" required />
          </div>
          <div class="col-md-6">
            <div class="form-row">
              <div class="form-group col-12"><label for="institution">School/College/University
                  <span class="attention">*</span></label>
                <input name="institution" type="text" class="form-control" id="institution" required />
              </div>
              <div class="form-group col-lg-6">
                <label for="occupation">Occupation <span class="attention">*</span></label>
                <select name="occupation" class="custom-select" id="occupation" required>
                  <option value="schoolstudent">School Student</option>
                  <option value="student">Undergraduate/Graduate</option>
                  <option value="teacher">Teacher</option>
                </select>
              </div>
              <div class="col-lg-6">
                <div class="form-row" id="schoolstudentfield">
                  <div class="form-group col-6">
                    <label for="grade">Grade</label>
                    <select name="grade" class="custom-select" id="grade">
                      <option value=""></option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </select>
                  </div>
                  <div class="form-group col-6">
                    <label for="gradeletter">Grade Letter</label>
                    <input name="gradeletter" type="text" class="form-control" id="gradeletter" />
                  </div>
                </div>
                <div class="form-row" id="teacherfield">
                  <div class="form-group teacherfield col-md-12">
                    <label for="subject">Subject You Teach</label>
                    <input name="subject" type="text" class="form-control" id="subject" />
                  </div>
                </div>
                <div class="form-row" id="studentfield">
                  <div class="form-group studentfield col-md-12">
                    <label for="subject">Your Major</label>
                    <input name="major" type="text" class="form-control" id="major" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-row">
              <div class="form-group col-12"><label for="residence">Country of Residence
                  <span class="attention">*</span></label>
                <select name="residence" class="form-control" id="residence">
                  <option value="1">Afghanistan</option>
                  <option value="2">Albania</option>
                  <option value="3">Algeria</option>
                  <option value="4">Andorra</option>
                  <option value="5">Angola</option>
                  <option value="6">Antigua and Barbuda</option>
                  <option value="7">Argentina</option>
                  <option value="8">Armenia</option>
                  <option value="9">Australia</option>
                  <option value="10">Austria</option>
                  <option value="11">Azerbaijan</option>
                  <option value="12">Bahamas</option>
                  <option value="13">Bahrain</option>
                  <option value="14">Bangladesh</option>
                  <option value="15">Barbados</option>
                  <option value="16">Belarus</option>
                  <option value="17">Belgium</option>
                  <option value="18">Belize</option>
                  <option value="19">Benin</option>
                  <option value="20">Bhutan</option>
                  <option value="21">Bolivia (Plurinational State of)</option>
                  <option value="22">Bosnia and Herzegovina</option>
                  <option value="23">Botswana</option>
                  <option value="24">Brazil</option>
                  <option value="25">Brunei Darussalam</option>
                  <option value="26">Bulgaria</option>
                  <option value="27">Burkina Faso</option>
                  <option value="28">Burundi</option>
                  <option value="29">Cabo Verde</option>
                  <option value="30">Cambodia</option>
                  <option value="31">Cameroon</option>
                  <option value="32">Canada</option>
                  <option value="33">Central African Republic</option>
                  <option value="34">Chad</option>
                  <option value="35">Chile</option>
                  <option value="36">China</option>
                  <option value="37">Colombia</option>
                  <option value="38">Comoros</option>
                  <option value="39">Congo</option>
                  <option value="40">Costa Rica</option>
                  <option value="41">Côte D'Ivoire</option>
                  <option value="42">Croatia</option>
                  <option value="43">Cuba</option>
                  <option value="44">Cyprus</option>
                  <option value="45">Czech Republic</option>
                  <option value="46">Democratic People's Republic of Korea</option>
                  <option value="47">Democratic Republic of the Congo</option>
                  <option value="48">Denmark</option>
                  <option value="49">Djibouti</option>
                  <option value="50">Dominica</option>
                  <option value="51">Dominican Republic</option>
                  <option value="52">Ecuador</option>
                  <option value="53">Egypt</option>
                  <option value="54">El Salvador</option>
                  <option value="55">Equatorial Guinea</option>
                  <option value="56">Eritrea</option>
                  <option value="57">Estonia</option>
                  <option value="58">Eswatini</option>
                  <option value="59">Ethiopia</option>
                  <option value="60">Fiji</option>
                  <option value="61">Finland</option>
                  <option value="62">France</option>
                  <option value="63">Gabon</option>
                  <option value="64">Gambia (Republic of The)</option>
                  <option value="65">Georgia</option>
                  <option value="66">Germany</option>
                  <option value="67">Ghana</option>
                  <option value="69">Grenada</option>
                  <option value="70">Guatemala</option>
                  <option value="71">Guinea</option>
                  <option value="72">Guinea Bissau</option>
                  <option value="73">Guyana</option>
                  <option value="74">Haiti</option>
                  <option value="75">Honduras</option>
                  <option value="76">Hungary</option>
                  <option value="77">Iceland</option>
                  <option value="78">India</option>
                  <option value="79">Indonesia</option>
                  <option value="80">Iran (Islamic Republic of)</option>
                  <option value="81">Iraq</option>
                  <option value="82">Ireland</option>
                  <option value="83">Israel</option>
                  <option value="84">Italy</option>
                  <option value="85">Jamaica</option>
                  <option value="86">Japan</option>
                  <option value="87">Jordan</option>
                  <option value="88">Kazakhstan</option>
                  <option value="89">Kenya</option>
                  <option value="90">Kiribati</option>
                  <option value="91">Kuwait</option>
                  <option value="92">Kyrgyzstan</option>
                  <option value="93">Lao People’s Democratic Republic</option>
                  <option value="94">Latvia</option>
                  <option value="95">Lebanon</option>
                  <option value="96">Lesotho</option>
                  <option value="97">Liberia</option>
                  <option value="98">Libya</option>
                  <option value="99">Liechtenstein</option>
                  <option value="100">Lithuania</option>
                  <option value="101">Luxembourg</option>
                  <option value="102">Madagascar</option>
                  <option value="103">Malawi</option>
                  <option value="104">Malaysia</option>
                  <option value="105">Maldives</option>
                  <option value="106">Mali</option>
                  <option value="107">Malta</option>
                  <option value="108">Marshall Islands</option>
                  <option value="109">Mauritania</option>
                  <option value="110">Mauritius</option>
                  <option value="111">Mexico</option>
                  <option value="112">Micronesia (Federated States of)</option>
                  <option value="113">Monaco</option>
                  <option value="114">Mongolia</option>
                  <option value="115">Montenegro</option>
                  <option value="116">Morocco</option>
                  <option value="117">Mozambique</option>
                  <option value="118">Myanmar</option>
                  <option value="119">Namibia</option>
                  <option value="120">Nauru</option>
                  <option value="121">Nepal</option>
                  <option value="122">Netherlands</option>
                  <option value="123">New Zealand</option>
                  <option value="124">Nicaragua</option>
                  <option value="125">Niger</option>
                  <option value="126">Nigeria</option>
                  <option value="127">North Macedonia</option>
                  <option value="128">Norway</option>
                  <option value="129">Oman</option>
                  <option value="130">Pakistan</option>
                  <option value="131">Palau</option>
                  <option value="132">Panama</option>
                  <option value="133">Papua New Guinea</option>
                  <option value="134">Paraguay</option>
                  <option value="135">Peru</option>
                  <option value="136">Philippines</option>
                  <option value="137">Poland</option>
                  <option value="138">Portugal</option>
                  <option value="139">Qatar</option>
                  <option value="140">Republic of Korea</option>
                  <option value="141">Republic of Moldova</option>
                  <option value="142">Romania</option>
                  <option value="143">Russian Federation</option>
                  <option value="144">Rwanda</option>
                  <option value="145">Saint Kitts and Nevis</option>
                  <option value="146">Saint Lucia</option>
                  <option value="147">Saint Vincent and the Grenadines</option>
                  <option value="148">Samoa</option>
                  <option value="149">San Marino</option>
                  <option value="150">Sao Tome and Principe</option>
                  <option value="151">Saudi Arabia</option>
                  <option value="152">Senegal</option>
                  <option value="153">Serbia</option>
                  <option value="154">Seychelles</option>
                  <option value="155">Sierra Leone</option>
                  <option value="156">Singapore</option>
                  <option value="157">Slovakia</option>
                  <option value="158">Slovenia</option>
                  <option value="159">Solomon Islands</option>
                  <option value="160">Somalia</option>
                  <option value="162">South Sudan</option>
                  <option value="163">Spain</option>
                  <option value="164">Sri Lanka</option>
                  <option value="165">Sudan</option>
                  <option value="166">Suriname</option>
                  <option value="167">Sweden</option>
                  <option value="168">Switzerland</option>
                  <option value="169">Syrian Arab Republic</option>
                  <option value="170">Tajikistan</option>
                  <option value="171">Thailand</option>
                  <option value="172">Timor-Leste</option>
                  <option value="173">Togo</option>
                  <option value="174">Tonga</option>
                  <option value="175">Trinidad and Tobago</option>
                  <option value="176">Tunisia</option>
                  <option value="177">Turkey</option>
                  <option value="178">Turkmenistan</option>
                  <option value="179">Tuvalu</option>
                  <option value="180">Uganda</option>
                  <option value="181">Ukraine</option>
                  <option value="182">United Arab Emirates</option>
                  <option value="183">United Kingdom of Great Britain and Northern Ireland</option>
                  <option value="184">United Republic of Tanzania</option>
                  <option value="185">United States of America</option>
                  <option value="186">Uruguay</option>
                  <option value="187">Uzbekistan</option>
                  <option value="188">Vanuatu</option>
                  <option value="189">Venezuela, Bolivarian Republic of</option>
                  <option value="190">Viet Nam</option>
                  <option value="191">Yemen</option>
                  <option value="192">Zambia</option>
                  <option value="193">Zimbabwe</option>
                </select>
              </div>
              <div class="form-group col-lg-6">
                <label for="phone">Phone Number</label>
                <input name="phone" type="tel" class="form-control" id="phone" placeholder="+xxxxxxxxxxx" />
              </div>
              <div class="form-group col-lg-6">
                <label for="discord">Discord Username</label>
                <input name="discord" type="text" class="form-control" id="discord" placeholder="username#1234" />
              </div>
            </div>

          </div>

          <div class="col-12">
            <div class="form-row">
              <div style="width: 100%; padding: 0.5rem;">
                <div class="form-check">
                  <input name="legal" class="form-check-input" type="checkbox" value="agree" id="legal" required />
                  <label class="form-check-label" for="legal">
                    <span class="attention">*</span>
                    I agree to
                    <a target="_blank" href="/privacypolicy">Privacy Policy</a>
                  </label>
                </div>
                <div class="button-wrapper" tabindex="0" style="float: right;">
                  <button type="submit" id="continue" class="btn btn-md btn-primary" onclick="legalfix();">
                    Continue
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="countryselect dissolve disabled">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="topic">Topic Preference
              <div id="spinner-topic-change" class="spinner-border spinner-border-sm text-primary mb-1" role="status" style="display: none;">
                <span class="sr-only"><i>Loading...</i></span>
              </div></label>
            <select name="topic" class="custom-select" id="topic"> </select>
          </div>
          <div class="form-group col-md-6">
            <label for="country">Country (Safe Option)</label>
            <select name="country" class="form-control" id="country">
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="desiredcountry">Desired Country</label>
            <p><small>You will be assigned to this country if it becomes available</small></p>
            <select name="desiredcountry" class="form-control" id="desiredcountry">
            </select>
          </div>
          <div class="form-group col-md-6 mb-5">
            <div id="interesttext-container" style="position:relative;">
              <label for="interesttext">Short Motivation Letter</label>
              <p><small>Write up to 400 <b>characters</b> to <b>briefly</b> explain why you chose these countries</small></p>
              <textarea name="interesttext" id="interesttext" class="form-control" aria-label="With textarea" rows="3"></textarea>
              <div style="position:absolute; bottom:-22px; right:5px; ">
                <small style="text-align:right;" id="char-count">0</small>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <div class="g-recaptcha" data-sitekey="6LdIq_oUAAAAAMGpld_BrSxbOzLJ16-Jb-gqtm8e"></div>
          </div>
          <div class="col-md-6">
            <div class="button-wrapper" tabindex="0" style="float: right;">
              <button type="submit" style="float: right;" id="submit" class="btn btn-md btn-primary">
                Submit
              </button>
            </div>
            <button type="button" class="btn btn-secondary" id="back" style="float: right; margin-right: 1rem;">
              Back
            </button>

          </div>

          <div style="width: 100%; padding: 0.5rem;">

          </div>
        </div>
      </div>
    </form>
  </div>
  <div id="img-countries">
  </div>
  <img src="/imgs/countries.jpg" class="img-fluid" alt="Responsive image" />
</div>
<div class="modal fade" id="registered" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          Registration Successful
        </h5>
      </div>
      <div class="modal-body">
        Thank you for the registration. We will contact you as soon as we
        review your application. Have a nice day!
      </div>
      <div class="modal-footer">
        <button id="complete" type="button" class="btn btn-primary">
          Understood
        </button>
      </div>
    </div>
  </div>
</div>