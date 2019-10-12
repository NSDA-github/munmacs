const app = require("./index");
const config = require("./config");

const Dev = process.env.NODE_ENV !== "production";

app.listen(config.express.port, function() {
  console.log(
    `Node ${
      config.express.production ? "cluster worker " + process.pid : "dev server"
    }: listening on port ${config.express.port}`
  );
});
