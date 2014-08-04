<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Behat context class.
 */
class FeatureContext implements SnippetAcceptingContext
{
    public $client;
    public $res;
    public $data;
    public $baseUrl;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context object.
     * You can also pass arbitrary arguments to the context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->baseUrl = $_ENV["BASE_URL"];
        $this->client = new GuzzleHttp\Client();
    }

    /**
     * @When I call :url
     */
    public function iCall($url)
    {
        $this->res = $this->client->get($this->baseUrl . $url);
    }

    /**
     * @Then I get a :status response
     */
    public function iGetAResponse($status)
    {
        if (empty($this->res->getBody())) {
            throw new \Exception("Did not get a response from the API");
        }

        if ($this->res->getStatusCode() != $status) {
            throw new \Exception(
                "Status code was not $status: " . $this->res->getStatusCode()
            );
        }
    }

    /**
     * @Then the response is :expected
     */
    public function theResponseIs($expected)
    {
        if ($this->res->getBody() != $expected) {
            throw new \Exception("Response was not $expected: " . $this->res->getBody());
        }
    }

    /**
     * @Then the response is a JSON object
     */
    public function theResponseIsAJsonObject()
    {
        $this->data = json_decode($this->res->getBody());

        if (empty($this->data)) {
            throw new \Exception("Response was not JSON\n" . $this->res);
        }
    }

    /**
     * @Then the response is an array of places
     */
    public function theResponseIsAnArrayOfPlaces()
    {
        if (!is_array($this->data)) {
            throw new \Exception("Response was not an array\n" . $this->res->getBody());
        }
    }

    /**
     * @Then the array length is :arg1
     */
    public function theArrayLengthIs($len)
    {
        if (count($this->data) != $len) {
            throw new \Exception("Array length was not $len\n" . $this->res->getBody());
        }
    }

    /**
     * @Then the first item in the array has the properties:
     */
    public function theFirstItemInTheArrayHasTheProperties(PyStringNode $string)
    {
        $lines = $string->getStrings();

        foreach ($lines as $line) {
            if (!property_exists($this->data[0], $line)) {
                throw new \Exception("Object did not have the property $line");
            }
        }
    }

    /**
     * @Then the latitude is :expected
     */
    public function theLatitudeIs($expected)
    {
        if ($this->data[0]->lat != $expected) {
            throw new \Exception("Latitude was not $expected\n" . $this->data[0]->lat);
        }
    }

    /**
     * @Then the longitude is :expected
     */
    public function theLongitudeIs($expected)
    {
        if ($this->data[0]->lon != $expected) {
            throw new \Exception("Latitude was not $expected\n" . $this->data[0]->lon);
        }
    }
}
