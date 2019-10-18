import React, { useEffect } from "react";
import queryString from "query-string";

const ResetCountries = ({ reset, location }) => {
  useEffect(() => {
    const values = queryString.parse(location.search);
    reset(values.adminPass);
  }, [location.search, reset]);
  return <div></div>;
};

export default ResetCountries;
