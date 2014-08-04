Feature: Documentation
    In order to understand how to use the API
    As a consumer
    I need to be able to view the documentation

Scenario: Testing that the API responds
    When I call "/hello"
    Then I get a "200" response
    And the response is "hello"
