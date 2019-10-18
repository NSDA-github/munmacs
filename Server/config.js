var dotenv = require("dotenv");
var PRODUCTION = process.env.NODE_ENV === "production";

dotenv.config();

var config = module.exports;
console.log(process.env.MYSQL_PASSWORD);

config.adminPass = process.env.ADMIN_PASS;

config.express = {
  port: process.env.PORT || 3001,
  ip: "127.0.0.1",
  production: PRODUCTION
};

if (PRODUCTION)
  config.db = {
    connectionString: process.env.DATABASE_URL,
    ssl: true
  };
else
  config.db = {
    host: "localhost",
    user: "root",
    password: process.env.MYSQL_PASSWORD,
    database: process.env.DATABASE
  };
