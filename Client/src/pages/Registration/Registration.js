import React, { useState, useEffect } from "react";
import { Formik } from "formik";
import Form from "react-bootstrap/Form";
import InputGroup from "react-bootstrap/InputGroup";
import Button from "react-bootstrap/Button";
import Col from "react-bootstrap/Col";
import schema from "./YupSchema";

import CustomSelect from "../../components/CustomSelect";

const Registration = ({ getCountries }) => {
  const [selectedCountry, setSelectedCountry] = useState("");
  const [countries, setCountries] = useState([]);
  const [usernameAvailable, setUsernameAvailable] = useState(true);
  const [countryAvailable, setCountryAvailable] = useState(true);
  const [emailAvailable, setEmailAvailable] = useState(true);

  const register = async e => {
    console.log(e);
    const rawResponse = await fetch("/api/register/", {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json"
      },
      body: JSON.stringify(e)
    });
    const content = await rawResponse.json();
    if (!content.usernameAvailable) {
      setUsernameAvailable(false);
    }
    if (!content.emailAvailable) {
      setEmailAvailable(false);
    }
    if (!content.countryAvailable) {
      setCountryAvailable(false);
    }
    console.log(content);
  };

  useEffect(() => {
    async function fetchData() {
      const results = await getCountries();
      const arr = [];
      for (var i = 0; i < results.length; i++) {
        arr.push({
          value: results[i].country_name,
          label: results[i].country_name
        });
      }
      setCountries(arr);
    }
    fetchData();
  }, [getCountries]);

  const handleCountryChange = (selectedOption, values) => {
    values.country = selectedOption.value;
    setSelectedCountry(selectedOption);
    setCountryAvailable(true);
  };

  const handleUsernameChange = () => {
    setUsernameAvailable(true);
  };
  const handleEmailChange = () => {
    setEmailAvailable(true);
  };

  const submit = e => {
    register(e);
  };

  return (
    <Formik
      validationSchema={schema}
      onSubmit={submit}
      validateOnChange={false}
      initialValues={{
        grade: "12",
        gradeLetter: "A",
        firstName: "",
        lastName: "",
        username: "",
        password: "",
        password2: "",
        email: "",
        school: "",
        terms: false,
        country: ""
      }}
    >
      {({
        handleSubmit,
        handleChange,
        handleBlur,
        values,
        touched,
        isValid,
        errors
      }) => (
        <Form noValidate onSubmit={handleSubmit}>
          <Form.Row>
            <Form.Group as={Col} md="3" controlId="validationFormikUsername">
              <Form.Label>Username</Form.Label>
              <InputGroup>
                <InputGroup.Prepend>
                  <InputGroup.Text id="inputGroupPrepend">@</InputGroup.Text>
                </InputGroup.Prepend>
                <Form.Control
                  type="text"
                  placeholder="Username"
                  aria-describedby="inputGroupPrepend"
                  name="username"
                  value={values.username}
                  onChange={e => {
                    handleChange(e);
                    handleUsernameChange();
                  }}
                  isInvalid={!!errors.username || !usernameAvailable}
                />
                <Form.Control.Feedback type="invalid">
                  {usernameAvailable
                    ? errors.username
                    : "Username is not available"}
                </Form.Control.Feedback>
              </InputGroup>
            </Form.Group>
            <Form.Group as={Col} md="3" controlId="validationFormik01">
              <Form.Label>First name</Form.Label>
              <Form.Control
                type="text"
                name="firstName"
                placeholder="Steve"
                value={values.firstName}
                onChange={handleChange}
                isInvalid={!!errors.firstName}
              />
              <Form.Control.Feedback></Form.Control.Feedback>
              <Form.Control.Feedback type="invalid">
                {errors.firstName}
              </Form.Control.Feedback>
            </Form.Group>
            <Form.Group as={Col} md="3" controlId="validationFormik02">
              <Form.Label>Last name</Form.Label>
              <Form.Control
                type="text"
                name="lastName"
                placeholder="Jobs"
                value={values.lastName}
                onChange={handleChange}
                isInvalid={!!errors.lastName}
              />

              <Form.Control.Feedback></Form.Control.Feedback>
              <Form.Control.Feedback type="invalid">
                {errors.lastName}
              </Form.Control.Feedback>
            </Form.Group>
            <Form.Group as={Col} md="2" controlId="validationFormik03">
              <Form.Label>Grade</Form.Label>
              <Form.Control
                type="text"
                name="grade"
                value={values.grade}
                onChange={handleChange}
                as="select"
              >
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
              </Form.Control>
              <Form.Control.Feedback></Form.Control.Feedback>
            </Form.Group>
            <Form.Group as={Col} md="1" controlId="validationFormik04">
              <Form.Label>Grade Label</Form.Label>
              <Form.Control
                type="text"
                name="gradeLabel"
                value={values.gradeLetter}
                onChange={handleChange}
                as="select"
              >
                <option>A</option>
                <option>B</option>
                <option>C</option>
                <option>D</option>
                <option>E</option>
                <option>F</option>
              </Form.Control>
              <Form.Control.Feedback></Form.Control.Feedback>
            </Form.Group>
          </Form.Row>
          <Form.Row>
            <Form.Group as={Col} md="3" controlId="validationFormik05">
              <Form.Label>Password</Form.Label>
              <Form.Control
                type="password"
                placeholder="Password"
                name="password"
                value={values.password}
                onChange={handleChange}
                isInvalid={!!errors.password}
              />

              <Form.Control.Feedback type="invalid">
                {errors.password}
              </Form.Control.Feedback>
            </Form.Group>
            <Form.Group as={Col} md="3" controlId="validationFormik06">
              <Form.Label>Repeat the Password</Form.Label>
              <Form.Control
                type="password"
                placeholder="Password"
                name="password2"
                value={values.password2}
                onChange={handleChange}
                isInvalid={!!errors.password2}
              />
              <Form.Control.Feedback type="invalid">
                {errors.password2}
              </Form.Control.Feedback>
            </Form.Group>
            <Form.Group as={Col} md="3" controlId="validationFormik07">
              <Form.Label>Email</Form.Label>
              <Form.Control
                type="text"
                placeholder="someone@example.com"
                name="email"
                value={values.email}
                onChange={e => {
                  handleChange(e);
                  handleEmailChange();
                }}
                isInvalid={!!errors.email || !usernameAvailable}
              />
              <Form.Control.Feedback type="invalid">
                {usernameAvailable ? errors.email : "Email is not available"}
              </Form.Control.Feedback>
            </Form.Group>
            <Form.Group as={Col} md="3" controlId="validationFormik08">
              <Form.Label>School</Form.Label>
              <Form.Control
                type="text"
                placeholder="Example School in Somewhere"
                name="school"
                value={values.school}
                onChange={handleChange}
                isInvalid={!!errors.school}
              />
              <Form.Control.Feedback type="invalid">
                {errors.school}
              </Form.Control.Feedback>
            </Form.Group>
          </Form.Row>
          <Form.Row>
            <Form.Group as={Col} md="3" controlId="validationFormik09">
              <Form.Label>Country you represent</Form.Label>
              <CustomSelect
                name="country"
                onChange={selectedOption => {
                  handleCountryChange(selectedOption, values);
                  console.log("values", values.country);
                  handleChange();
                }}
                value={selectedCountry}
                isValid={!errors.country || countryAvailable}
                options={countries}
              />
              <p
                style={{
                  color: "#dc3545",
                  fontSize: "12.8px",
                  marginTop: "4px"
                }}
              >
                {countryAvailable
                  ? errors.country
                  : "Country is already unavailable"}
              </p>
            </Form.Group>
          </Form.Row>
          <Form.Group>
            <Form.Check
              required
              name="terms"
              label="Agree to terms and conditions"
              onChange={handleChange}
              isInvalid={!!errors.terms}
              feedback={errors.terms}
              id="validationFormik0"
            />
            <Form.Control.Feedback type="invalid">
              {errors.terms}
            </Form.Control.Feedback>
          </Form.Group>
          <Button type="submit">Submit form</Button>
        </Form>
      )}
    </Formik>
  );
};

export default Registration;
