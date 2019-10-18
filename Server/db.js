var config = require("./config");
var mysql = require("mysql");

var con = mysql.createConnection(config.db);
con.connect(function(err) {
  if (err) {
    console.error(err);
  }
});

module.exports = con;
