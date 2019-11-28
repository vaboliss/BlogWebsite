import React, { Component } from "react";
import { Nav, Navbar, Form, FormControl, Button } from "react-bootstrap";
import { NavLink } from "react-router-dom";

class Navigation extends Component {
  render() {
    return (
      <Navbar className="p-4" expand="lg" bg="info" variant="dark">
        <Navbar.Brand href="/">BlogXs</Navbar.Brand>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
          <Nav className="mr-auto">
            <NavLink
              className="ml-5 nav-link"
              to="/login"
              activeClassName="active"
            >
              Login
            </NavLink>
            <NavLink
              className="ml-5 mr-5 nav-link"
              to="/register"
              activeClassName="active"
            >
              Register
            </NavLink>
            <NavLink
              className="ml-5 nav-link"
              exact
              to="/"
              activeClassName="active"
            >
              Home
            </NavLink>
          </Nav>
          <Form inline>
            <FormControl
              type="text"
              placeholder="Blog name"
              className="mr-sm-2"
            />
            <Button variant="warning">Search</Button>
          </Form>
        </Navbar.Collapse>
      </Navbar>
    );
  }
}

export default Navigation;
