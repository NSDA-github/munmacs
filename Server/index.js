var express = require("express");
const path = require("path");
const client = require("./db");

var app = express();
app.use(express.urlencoded({ extended: false }));
app.use(express.json());

app.use(require("./tools/router"));
app.use(require("./site/router"));
app.use(require("./user/router"));
app.use(require("./tools/router"));

module.exports = app;
