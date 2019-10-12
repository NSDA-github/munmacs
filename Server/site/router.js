var router = new require("express").Router();
var path = require("path");
var PRODUCTION = process.env.NODE_ENV === "production";

if (PRODUCTION) {
  router.use(express.static(path.resolve(__dirname, "../../client/build")));
  router.get("*", function(req, res) {
    Response.sendFile(
      path.resolve(__dirname, "../../client/build", "index.html")
    );
  });
}

module.exports = router;
