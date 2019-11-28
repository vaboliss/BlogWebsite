import React from "react";
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";

import Nav from "./components/Navigation";
import MainPage from "../src/components/MainPage";
import LoginPage from "../src/components/LoginPage";
import RegisterPage from "../src/components/RegisterPage";
import BlogPage from "../src/components/BlogPage";

function App() {
  return (
    <Router>
      <div>
        <Nav />
        <Switch>
          <Route exact path="/">
            <MainPage />
          </Route>
          <Route path="/login">
            <LoginPage />
          </Route>
          <Route path="/register">
            <RegisterPage />
          </Route>
          <Route path="/blog/:id">
            <BlogPage />
          </Route>
        </Switch>
      </div>
    </Router>
  );
}

export default App;
