[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/GoogleTimezoneAPI/functions?utm_source=RapidAPIGitHub_GoogleTimezoneFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# GoogleTimezoneAPI Package
The Google Maps Time Zone API provides a simple interface to request the time zone for a location on the earth.
* Domain: [Google](http://google.com)
* Credentials: Use api key if you need more quota only.

## How to get credentials: 
0. If you need more quota make apiKey at [Google console](https://console.developers.google.com/flows/enableapi?apiid=timezone_backend&reusekey=true&pli=1)
 
## GoogleTimezoneAPI.getTimeZone
Returns time zone data for a point on the earth, specified by a latitude/longitude pair.

| Field    | Type  | Description
|----------|-------|----------
| location | String| latitude, longitude, representing the location to look up.
| timestamp| String| Specifies the desired time as seconds since midnight, January 1, 1970 UTC. The Google Maps Time Zone API uses the timestamp to determine whether or not Daylight Savings should be applied. Times before 1970 can be expressed as negative values.
| language | String| The language in which to return results
| apiKey   | String| Access token obtained from Google.com

## GoogleTimezoneAPI.getLocalTime
Returns the local time of a given location.

| Field    | Type  | Description
|----------|-------|----------
| location | String| latitude, longitude, representing the location to look up.
| timestamp| String| A single header value is used to identify TTS language. For example: en-US
| apiKey   | String| Access token obtained from Google.com

