<html>
<body bgcolor="#00BFFF">
<h2> In this page you can view some statistics of the Weather's value</h2>
<h4> For example if you want to see the values of 1 May 2014 you will insert: 2014-05-01</h4>
<form action="date.php" method="post">
Date <input type="text" name="dateSETTED"/>
<input type ="submit" />
</form>

<?php
    include 'weatherRequest.php';
    requestValuesByDay();
?>
<BR>
<A HREF="weather.php"> Weather Station Home page </A>
<BR>
<input type="button" value="Reload Page" onClick="window.location.reload()">
</body>
</html>