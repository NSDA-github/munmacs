var dotenv = require("dotenv");
var config = module.exports;
var PRODUCTION = process.env.NODE_ENV === "production";

dotenv.config();

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
    password: process.env.MYSQL_PASSWORD
  };
