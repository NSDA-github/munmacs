const jwt = require("jsonwebtoken");

const signToken = async user => {
  const token = jwt.sign(user, "secret");
  return token;
};

module.exports = {
  signToken
};
