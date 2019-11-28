import React, { Component } from "react";
import { Form, Container, Button } from "react-bootstrap";

class RegisterPage extends Component {
  state = {};
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
          <Form.Group controlId="formBasicFirstName">
            <Form.Label>First Name</Form.Label>
            <Form.Control type="text" placeholder="First Name" required />
          </Form.Group>
          <Form.Group controlId="formBasicLastName">
            <Form.Label>Last Name</Form.Label>
            <Form.Control type="text" placeholder="Last Name" required />
          </Form.Group>
          <Button className="mt-3 w-50 mb-3" variant="dark" type="submit">
            Register
          </Button>
        </Form>
      </Container>
    );
  }
}

export default RegisterPage;
