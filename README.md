[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/GoogleTimezoneAPI/functions?utm_source=RapidAPIGitHub_GoogleTimezoneFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

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
| latitude | String| Required: latitude=-33.86, representing the latitude to look up.
| longitude | String| Required: longitude=-151.20, representing the longitude to look up.
| timestamp| String| Required: specifies the desired time as seconds since midnight, January 1, 1970 UTC. The Google Maps Time Zone API uses the timestamp to determine whether or not Daylight Savings should be applied. Times before 1970 can be expressed as negative values.
| language | String| Optional: The language in which to return results

## GoogleTimezoneAPI.getLocalTime
Method description

| Field    | Type  | Description
|----------|-------|----------
| apiKey   | credentials| Optional: Access token obtained from Google.com
| latitude | String| Required: latitude=-33.86, representing the latitude to look up.
| longitude | String| Required: longitude=-151.20, representing the longitude to look up.
| timestamp| String| A single header value is used to identify TTS language. For example: en-US

