const router = new require("express").Router();
const bcrypt = require("bcrypt");
client = require("../db");
const signToken = require("../serverAuth").signToken;

router.post("/api/register/", (req, res) => {
  const {
    username,
    password,
    email,
    school,
    grade,
    gradeLetter,
    firstName,
    lastName,
    country
  } = req.body;
  const user = req.body;
  //const hash = bcrypt.hashSync(password, 10);
});

router.post("/api/login/", (req, res) => {
  console.log(req.body);
  var {
    username,
    firstName,
    lastName,
    password,
    email,
    school,
    country,
    terms,
    grade,
    gradeLetter
  } = req.body;
  client.query(
    "SELECT * FROM users WHERE username = $1",
    [username],
    (err, data) => {
      if (err) {
        console.log(err.stack);
      } else {
        user = data.rows[0];
        if (user) {
          if (bcrypt.compareSync(password, user.password)) {
            delete user.password;
            signToken(user).then(token => {
              console.log(data);
              res.send({ ok: true, token, user });
            });
            console.log(
              JSON.stringify(`User token for ${username} is signed...`)
            );
          } else {
            res.status(401).send({ error: "Login or password is incorrect" });
          }
        } else
          res.status(401).send({ error: "Login or password is incorrect" });
      }
    }
  );
});

module.exports = router;
