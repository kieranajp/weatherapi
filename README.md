# Weather API Documentation

[![Build Status](https://travis-ci.org/kieranajp/weatherapi.png)](https://travis-ci.org/kieranajp/weatherapi)

## Location functions

### `GET /location/:search/`

Retrieves the latitude and longitude of a location by search term. Returns multiple results if the search term is ambiguous.

Example request:

```
GET /location/london/
```

Example response:

```json
{
	"results" : [
		{
			"address" : "London, UK",
			"location" : {
				"lat" : 51.5073509,
				"lng" : -0.1277583
			}
		},
		{
			"address" : "London, ON, Canada",
			"location" : {
				"lat" : 42.9869502,
				"lng" : -81.243177
			}
		},
		...
	]
}

```

## Weather functions

### `GET /weather/:latitude/:longitude/`

Returns weather data from [forecast.io](//forecast.io)

Example request:

```
GET /weather/51.5073509/-0.1277583/
```

Example response:

```json
{
	"currently" : {
	},

	"today" : {
	}
}
```
