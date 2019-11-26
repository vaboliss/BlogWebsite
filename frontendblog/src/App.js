import React from "react";
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link,
  Redirect,
  useHistory,
  useLocation
} from "react-router-dom";

import Nav from "../src/components/Nav";
import MainPage from "../src/components/MainPage";
import LoginPage from "../src/components/LoginPage";
import RegisterPage from "../src/components/RegisterPage";
import BlogPage from "../src/components/BlogPage";

import "./App.css";

function App() {
  return (
    <Router>
      <div>
        <Nav />
        <Switch>
          <Route path="/">
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
