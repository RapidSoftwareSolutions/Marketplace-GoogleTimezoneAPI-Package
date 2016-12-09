# GoogleTimezoneAPI Package
The Google Maps Time Zone API provides a simple interface to request the time zone for a location on the earth.
* Domain: google.com
* Credentials: optional

## How to get credentials: 
0. If you need more quota make apiKey at [Google console](https://console.developers.google.com/flows/enableapi?apiid=timezone_backend&reusekey=true&pli=1)
 
## GoogleTimezoneAPI.getTimeZone
Method description

| Field    | Type  | Description
|----------|-------|----------
| apiKey   | credentials| Optional: Access token obtained from Google.com
| location | String| Required: a comma-separated lat,lng tuple (eg. location=-33.86,151.20), representing the location to look up.
| timestamp| String| Required: specifies the desired time as seconds since midnight, January 1, 1970 UTC. The Google Maps Time Zone API uses the timestamp to determine whether or not Daylight Savings should be applied. Times before 1970 can be expressed as negative values.
| language | String| Optional: The language in which to return results

#### Request example
```json
{	"apiKey": "...",
	"location": "...",
	"timestamp": "...",
	"language": "..."
}
```

## GoogleTimezoneAPI.getLocalTime
Method description

| Field    | Type  | Description
|----------|-------|----------
| apiKey   | credentials| Optional: Access token obtained from Google.com
| location | String| Required: specifies the desired time as seconds since midnight, January 1, 1970 UTC. The Google Maps Time Zone API uses the timestamp to determine whether or not Daylight Savings should be applied. Times before 1970 can be expressed as negative values.
| timestamp| String| A single header value is used to identify TTS language. For example: en-US

#### Request example
```json
{	"apiKey": "...",
	"location": "...",
	"timestamp": "..."
}
```

