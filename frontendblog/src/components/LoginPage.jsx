import React, { Component } from "react";
import { Form, Container, Button } from "react-bootstrap";
import "../App.css";

class LoginPage extends Component {
  render() {
    return (
      <Container className="fluid w-25 border mt-5 Qe">
        <Form className="text-center">
          <Form.Group controlId="formBasicEmail">
            <Form.Label>Email adress</Form.Label>
            <Form.Control type="email" placeholder="Enter email" required />
          </Form.Group>
          <Form.Group controlId="formBasicPassword">
            <Form.Label>Password</Form.Label>
            <Form.Control
              type="password"
              placeholder="Enter password"
              required
            />
          </Form.Group>
          <div>
            <Button className="mt-3" variant="dark" type="submit">
              Login
            </Button>
          </div>
        </Form>
      </Container>
    );
  }
}

export default LoginPage;
