<?php
    include ('mysql.php');
    include ('printResult.php');
    // This function print the last update from the Weather Station
    function showLastUpdate(){
        echo "Today is " . date("Y/m/d");
        echo " The time is " . date("h:i:sa");
        echo "<br />";
        $result = mysqli_query(connect(),"Select *From Data Where Date = CURRENT_DATE && Minute(WeatherStation.Data.Time)=00 Order by Time");
        $resultNOW = mysqli_query(connect(),"Select * From Data WHERE Hour(Time)=HOUR(Current_TIME) && Minute(Time)=MINUTE(Current_Time)-1");
        $recordNOW = mysqli_fetch_array($resultNOW);
        echo "Last update: Temperature: ".$recordNOW[1]." C Humidity: ".$recordNOW[2]."% at ".$recordNOW[4]." of ".$recordNOW[3];
        echo "<table border='1'>
        <tr>
        <th>ID</th>
        <th>Temperature</th>
        <th>Humidity</th>
        <th>Data</th>
        <th>Time</th>
        </tr>";
        
        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['ID'] . "</td>";
            echo "<td>" . $row['Temperature'] . "</td>";
            echo "<td>" . $row['Humidity'] . "</td>";
            echo "<td>" . $row['Date'] . "</td>";
            echo "<td>" . $row['Time'] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    }
    // This function print the Max and Min value of Today
    function showMaxMin(){
        $resultMax = mysqli_query(connect(),"Select Temperature, Time From Data Where Temperature = (Select Max(Temperature) From Data WHERE Date = Current_Date()) GROUP BY (Temperature) ");
        
        echo "<table border='1'>
        <tr>
        <th>Temperature Max</th>
        <th>Time</th>
        </tr>";
        
        while($row = mysqli_fetch_array($resultMax)) {
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[1] . "</td>";
            echo "</tr>";
        }
        
        $resultMin = mysqli_query(connect(),"Select Temperature, Time From Data Where Temperature = (Select Min(Temperature) From Data WHERE Date = Current_Date())GROUP BY (Temperature) ");
        
        echo "<table border='1'>
        <tr>
        <th>Temperature Min</th>
        <th>Time</th>
        </tr>";
        
        while($row = mysqli_fetch_array($resultMin)) {
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[1] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    }
    function showStatisticsPerDay(){
        $result = mysqli_query(connect(),"Select Max(Temperature),Min(Temperature), Max(Humidity), Min(Humidity), Date From Data Group by date ");
        echo "<table border='1'>
        <tr>
        <th>Max Temperature</th>
        <th>Min Temperature</th>
        <th>Max Humidity</th>
        <th>Min Humidity</th>
        <th>Date</th>
        </tr>";
        printFullResult($result);
        echo "</table>";
    }
    function requestValuesByDay(){
        $date = $_POST['dateSETTED'];
        $result = mysqli_query(connect(),"Select *From Data Where Date ='{$date}'&& Minute(Time) LIKE '%0%'  Order by Time");
        echo "<table border='1'>
        <tr>
        <th>ID</th>
        <th>Temperature</th>
        <th>Humidity</th>
        <th>Date</th>
        <th>Time</th>
        </tr>";
        
        printFullResult($result);
        
        echo "</table>";
    }
?>