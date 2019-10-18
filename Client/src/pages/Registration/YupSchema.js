import * as yup from "yup";

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
    .test("terms-accpeted", "Terms must be accepted", function(value) {
      return value === true;
    })
});

export default schema;
