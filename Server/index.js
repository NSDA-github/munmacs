var express = require("express");
const path = require("path");
const client = require("./db");

var app = express();
app.use(express.urlencoded({ extended: false }));
app.use(express.json());

app.use(require("./site/router"));
app.use(require("./user/router"));

module.exports = app;
