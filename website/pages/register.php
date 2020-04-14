<div class="container">
    <div class="form-container">
        <h1 style="padding-top: 30px;">Delegate Registration Form</h1>
        <h6 class="card-subtitle mb-2 text-muted">
            Registration is open for everyone. <br />
            Please consider planning your arrival to the event.
        </h6>
        <form action="../app/register/index.php" id="need-validation">
            <div class="personalinfo dissolve active">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">First Name <span class="attention">*</span> <br />
                        </label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Nursultan" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="surname">Last Name <span class="attention">*</span><br />
                        </label>
                        <input name="surname" type="text" class="form-control" id="surname" placeholder="Nazarbayev" required />
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="email">Email <span class="attention">*</span><br />
                        </label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="youremail@example.com" required />
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="confirmemail">Confirm email <span class="attention">*</span><br />
                        </label>
                        <input name="confirmemail" type="text" class="form-control" id="confirmemail" placeholder="youremail@example.com" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="institution">School/College/Usniversity
                            <span class="attention">*</span></label>
                        <input name="institution" type="text" class="form-control" id="institution" placeholder="NIS PhM Uralsk" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Phone Number <span class="attention">*</span></label>
                        <input name="phone" type="tel" class="form-control" id="phone" placeholder="+77777777777" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="role">Role <span class="attention">*</span></label>
                        <select name="role" class="custom-select" id="role" required>
                            <option value="schoolstudent">School Student</option>
                            <option value="student">Undergraduate/Graduate</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="form-row" id="schoolstudentfield">
                            <div class="form-group col-md-6">
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
                            <div class="form-group col-md-6">
                                <label for="gradeletter">Grade Letter</label>
                                <input name="gradeletter" type="text" class="form-control" id="gradeletter" placeholder="H" />
                            </div>
                        </div>
                        <div class="form-row" id="teacherfield">
                            <div class="form-group teacherfield col-md-12">
                                <label for="subject">Subject You Teach</label>
                                <input name="subject" type="text" class="form-control" id="subject" placeholder="Global Perspectives and Project Work" />
                            </div>
                        </div>
                        <div class="form-row" id="studentfield">
                            <div class="form-group studentfield col-md-12">
                                <label for="subject">Your Major</label>
                                <input name="major" type="text" class="form-control" id="major" placeholder="Computer Science" />
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
                                        <a href="#">Privacy Policy</a>
                                        and
                                        <a href="#">Terms of Use</a>
                                    </label>
                                </div>
                                <br />
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
                        <label for="country">Country</label>
                        <select name="country" class="form-control" id="country">
                        </select>
                    </div>
                    <div style="width: 100%; padding: 0.5rem;">
                        <div class="button-wrapper" tabindex="0" style="float: right;">
                            <button type="submit" style="float: right;" id="submit" class="btn btn-md btn-primary">
                                Submit
                            </button>
                        </div>
                        <button type="button" class="btn btn-secondary" id="back" style="float: right; margin-right: 1rem;">
                            Back
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <img src="/imgs/countries.jpg" style="height: 50vh; width: 100%;" class="img-fluid" alt="Responsive image" />
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
                review your application. Have nice day!
            </div>
            <div class="modal-footer">
                <button id="complete" type="button" class="btn btn-primary">
                    Understood
                </button>
            </div>
        </div>
    </div>
</div>