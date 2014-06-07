<html>
<body>
<h1> Welcome to the Weather Station</h1>
</body>
</h1>

<?php
    include 'weatherRequest.php';
     showLastUpdate();
    ?>
<html>
<body bgcolor="#00BFFF">
<h4> The today high and low values</h4>
<?php
    showMaxMin();
    ?>
<BR>
<A HREF="value.php"> Statistic's value of the Weather's value </A>
<BR>
<A HREF="date.php"> Weather's value of the past day' </A>
<BR>
<div id="sidebar">
<input type="button" value="Reload Page" onClick="window.location.reload()">
<!--<h2>Today's forecast</h2>'
 Inizio codice ilMeteo.it
<iframe width="500" height="510" scrolling="no" frameborder="no" noresize="noresize" src="http://www.ilmeteo.it/box/previsioni.php?citta=7835&type=tri1&width=500&ico=1&lang=ita&days=6&font=Arial&fontsize=12&bg=FFFFFF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=1773C2"></iframe>
Fine codice ilMeteo.it -->
<h2>Weather's forecast next days</h2>
<!-- Inizio codice ilMeteo.it -->
<iframe width="450" height="326" scrolling="no" frameborder="no" noresize="noresize" src="http://www.ilmeteo.it/box/previsioni.php?citta=7835&type=day2&width=450&ico=swf1&lang=ita&days=5&font=Arial&fontsize=12&bg=FFFFFF&fg=000000&bgtitle=0099FF&fgtitle=FFFFFF&bgtab=F0F0F0&fglink=1773C2"></iframe>
<!-- Fine codice ilMeteo.it -->
</div><!--#sidebar-->
</body>
</html>