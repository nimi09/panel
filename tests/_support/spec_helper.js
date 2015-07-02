// ***********************************************
// This example spec_helper.js shows you how to
// create the custom command: 'login'.
//
// The spec_helper.js file is a great place to
// add reusable logic / custom commands which
// become usable in every single test file.
//
// You can read more about custom commands here:
// https://github.com/cypress-io/cypress/wiki/commands#customizing
// ***********************************************
//
Cypress.addParentCommand("login", function(email, password){
  var email    = email || "bastian"
  var password = password || "test"

  var command = Cypress.command({
    name: "login",
    message: [email, password],
    onConsole: function(){
      return {
        email: email,
        password: password
      }
    }
  })

  cy
    .visit("http://sandbox.getkirby.com/panel/#/", {log: false})
    .get("#form-field-username", {log: false}).type("bastian", {log: false})
    .get("#form-field-password", {log: false}).type("test", {log: false}).type("{enter}", {log: false})
    .get("header", {log: false}).contains("Dashboard", {log: false})
    .then(function(){
      command.snapshot().end()
    })
})