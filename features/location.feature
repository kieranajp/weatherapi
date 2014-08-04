Feature: Location
	In order to accurately determine my location
	As an API consumer
	I need to be able to look up the latitude and longitude of a place


Scenario: Find the latitude and longitude of a named place
	When I call "/location/erlangen"
	Then I get a "200" response
	And the response is a JSON object
	And the response is an array of places
	And the array length is "1"
	And the first item in the array has the properties:
		"""
		lat
		lon
		"""
	And the latitude is "49.5896744"
	And the longitude is "11.0119611"
