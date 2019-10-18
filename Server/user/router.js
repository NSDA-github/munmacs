const router = new require("express").Router();
const bcrypt = require("bcrypt");
client = require("../db").con;
escapeSQL = require("../db").mysql.escape;
const signToken = require("../serverAuth").signToken;

router.post("/api/register/", (req, res) => {
  console.log("Registration Starts...");
  var {
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
  var usernameAvailable = true;
  var emailAvailable = true;
  var countryAvailable = true;
  var msg = [];
  var userID;
  var countryID;

  // COUNTRY
  var query =
    "SELECT * FROM country WHERE country_name = ? AND available = '1'";
  client.query(query, [country], (err, result) => {
    if (err) {
      console.log(err);
    }
    if (!result.length) {
      countryAvailable = false;
    } else {
      countryID = result[0].country_id;
    }

    // REGISTRATION AVAILABILITY
    query = "SELECT * FROM users WHERE username = ? OR email = ?";
    client.query(query, [username, email], (err, result) => {
      if (err) {
        console.log(err);
      }
      result.forEach(row => {
        if (row.username === username) {
          usernameAvailable = false;
        }
        if (row.email === email) {
          emailAvailable = false;
        }
      });

      // REGISTRATION
      console.log("Starting Registration Stage...");
      if (emailAvailable && usernameAvailable && countryAvailable) {
        // INSERT USER
        query =
          "INSERT INTO users \
              (username, email, password, first_name, last_name) VALUES (?)";
        password = bcrypt.hashSync(password, 10);
        client.query(
          query,
          [[username, email, password, firstName, lastName]],
          (err, result) => {
            if (err) {
              console.log(err);
            }
            msg.push(
              "[Users] Number of records inserted: " + result.affectedRows
            );

            // GET USER_ID
            query = "SELECT * FROM users WHERE username = ?";
            client.query(query, [username], (err, result) => {
              if (err) {
                console.log(err);
              }
              userID = result[0].user_id;

              // INSERT PARTICIPANT DETAILS
              query =
                "INSERT INTO participants \
                  (user_id, country_id, school, grade, grade_letter) VALUES (?)";
              client.query(
                query,
                [[userID, countryID, school, grade, gradeLetter]],
                (err, result) => {
                  if (err) {
                    console.log(err);
                  }
                  msg.push(
                    "[Participant] Number of records inserted: " +
                      result.affectedRows
                  );

                  // UPDATE COUNTRY AVAILABILITY
                  query =
                    "UPDATE country SET available = '0' WHERE country_id = ?";
                  client.query(query, [countryID], (err, result) => {
                    if (err) {
                      console.log(err);
                    }
                    msg.push(
                      "[Country] Number of records updated: " +
                        result.affectedRows
                    );
                    // RESPOND
                    res.send({
                      apiurl: req.url,
                      usernameAvailable,
                      emailAvailable,
                      countryAvailable,
                      msg
                    });
                  });
                }
              );
            });
          }
        );
      } else {
        console.log("Registration Denied");
        // RESPOND NEGATIVE
        res.send({
          apiurl: req.url,
          usernameAvailable,
          emailAvailable,
          countryAvailable,
          msg: "Register is not possible"
        });
      }
    });
  });
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
