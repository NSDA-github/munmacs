import React, { useState } from "react";
import { Formik } from "formik";
import { Form } from "react-bootstrap";
import InputGroup from "react-bootstrap/InputGroup";
import Button from "react-bootstrap/Button";
import Col from "react-bootstrap/Col";
import * as yup from "yup";

import CustomSelect from "../components/CustomSelect";

const Registration = () => {
  const [selectedCountry, setSelectedCountry] = useState("");

  const schema = yup.object({
    firstName: yup
      .string()
      .required()
      .min(2)
      .label("First name"),
    lastName: yup
      .string()
      .required()
      .min(2)
      .label("First name"),
    username: yup
      .string()
      .required()
      .min(3)
      .label("First name"),
    password: yup
      .string()
      .required()
      .matches(
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/,
        "Must Contain 8 Characters, One Uppercase, One Lowercase and One Number"
      )
      .label("Password"),
    password2: yup
      .string()
      .required()
      .test("passwords-match", "Passwords must match", function(value) {
        return this.parent.password === value;
      })
      .label("Password confirmation"),
    email: yup
      .string()
      .email()
      .required()
      .label("Email"),
    school: yup
      .string()
      .min(3)
      .required()
      .label("School"),
    country: yup
      .string()
      .required()
      .label("Country"),
    terms: yup
      .bool()
      .required()
      .label("Terms")
      .test("terms-accpeted", "Terms must be accepted", function() {
        return this.parent.test === true;
      })
  });

  const options = [
    { value: "chocolate", label: "Chocolate" },
    { value: "strawberry", label: "Strawberry" },
    { value: "vanilla", label: "Vanilla" }
  ];

  const handleCountryChange = (selectedOption, values) => {
    values.country = selectedOption.value;
    console.log(selectedOption);
    setSelectedCountry(selectedOption);
    console.log(selectedCountry);
  };

  const submit = async e => {
    console.log(e);
  };

  return (
    <Formik
      validationSchema={schema}
      onSubmit={submit}
      validateOnChange={false}
      initialValues={{
        grade: "12",
        gradeLabel: "A",
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
                  onChange={handleChange}
                  isInvalid={!!errors.username}
                />
                <Form.Control.Feedback type="invalid">
                  {errors.username}
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
                value={values.gradeLabel}
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
                onChange={handleChange}
                isInvalid={!!errors.email}
              />
              <Form.Control.Feedback type="invalid">
                {errors.email}
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
                isValid={!errors.country}
                options={options}
              />
              <p
                style={{
                  color: "#dc3545",
                  fontSize: "12.8px",
                  marginTop: "4px"
                }}
              >
                {errors.country}
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
