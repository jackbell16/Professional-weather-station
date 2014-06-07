<html>
<body bgcolor="#00BFFF">
<h2> In this page you can view some statistics of the Weather's value</h2>

<?php
    include 'weatherRequest.php';
    showStatisticsPerDay();
?>
<BR>
<A HREF="weather.php"> Weather Station Home page </A>
<BR>
<input type="button" value="Reload Page" onClick="window.location.reload()">
</body>
</html>