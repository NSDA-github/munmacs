import React from "react";
import { Router, Route } from "react-router";
import "bootstrap/dist/css/bootstrap.min.css";
import { createBrowserHistory } from "history";

import Registration from "./pages/Registration/";
import ResetCountries from "./tools/ResetCountries";

const history = createBrowserHistory();

const App = () => {
  const resetCountries = async adminPass => {
    const rawResponse = await fetch("/api/resetcountries", {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ adminPass })
    });
    const content = await rawResponse.json();
    console.log(content);
  };
  const availableCountries = async () => {
    const rawResponse = await fetch("api/availablecountries", {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json"
      },
      body: JSON.stringify({})
    });
    const content = await rawResponse.json();
    console.log(content);
    return content.result;
  };
  return (
    <Router history={history}>
      <div className="App">
        <Route exact path="/">
          <Registration getCountries={availableCountries} />
        </Route>
        <Route
          path="/resetcountries"
          render={props => <ResetCountries {...props} reset={resetCountries} />}
        />
      </div>
    </Router>
  );
};

export default App;
