var config = require("./config");
var mysql = require("mysql");

var con = mysql.createConnection(config.db);

con.connect(function(err) {
  if (err) throw err;
  console.log("DB Connected!");
});

module.exports = con;
