<!DOCTYPE html>
<html>
<head>
    <title>Weather Alert</title>
</head>
<body>
<h1>Weather Alert for {{ $alert->city }}</h1>
<p>There is a high chance of precipitation ({{ $alert->threshold_precipitation }}mm) or high UV index ({{ $alert->threshold_uv }}).</p>
<p>Stay safe!</p>
</body>
</html>
