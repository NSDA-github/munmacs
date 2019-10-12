const router = new require("express").Router();
const bcrypt = require("bcrypt");
client = require("../db");
const signToken = require("../serverAuth").signToken;

router.post("/api/register/", (req, res) => {
  console.log(req.body);
  const { username, password, email } = req.body;
  const hash = bcrypt.hashSync(password, 10);
  const date = new Date();
  client.query(
    "INSERT INTO users (username, email, password, created_on) VALUES($1, $2, $3, $4)",
    [username, email, hash, date],
    (err, data) => {
      if (err) {
        console.log(err.stack);
        res.send(JSON.stringify({ ok: false }));
      } else {
        console.log(data);
        res.send(JSON.stringify({ ok: true }));
      }
    }
  );
});

router.post("/api/login/", (req, res) => {
  console.log(req.body);
  var { username, password } = req.body;
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
