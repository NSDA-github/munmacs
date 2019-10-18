const router = new require("express").Router();
const client = require("../db").con;
const config = require("../config");

router.post("/api/resetcountries", (req, res) => {
  const { adminPass } = req.body;
  if (config.adminPass === adminPass) {
    var msg = [];
    const droptable = "DELETE FROM country;";
    const insert = "INSERT INTO country (country_name) VALUES ?";
    const values = [
      ["USA"],
      ["Russia"],
      ["People's Republic of China"],
      ["Kazakhstan"],
      ["Turkey"],
      ["Germany"],
      ["United Kingdom"]
    ];
    client.query(droptable, (err, result) => {
      if (err) {
        console.log(err);
        res.status(500);
        res.send({ apiurl: req.url, msg: "Internal Error 500" });
      }
      msg.push("Number of records deleted: " + result.affectedRows);
      console.log("Number of records deleted: " + result.affectedRows);
    });
    client.query(insert, [values], (err, result) => {
      if (err) {
        console.log(err);
        res.status(500);
        res.send({ apiurl: req.url, msg: "Internal Error 500" });
      }
      msg.push("Number of records inserted: " + result.affectedRows);
      res.send({ apiurl: req.url, msg });
      console.log("Number of records inserted: " + result.affectedRows);
    });
  } else {
    res.send({ apiurl: req.url, msg: "Admin password wrong" });
  }
});

router.post("/api/availablecountries", (req, res) => {
  const sql = "SELECT country_name FROM country WHERE available=1";
  client.query(sql, (err, result) => {
    if (err) {
      console.log(err);
      res.status(500);
      res.send({ msg: "Internal Error 500", result: null });
    }
    res.send({ apiurl: req.url, msg: "ok", result });
  });
});

module.exports = router;
