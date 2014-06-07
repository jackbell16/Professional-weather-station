<?php
    // This function print 5 element
    function printFullResult($result){
        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[1] . "</td>";
            echo "<td>" . $row[2] . "</td>";
            echo "<td>" . $row[3] . "</td>";
            echo "<td>" . $row[4] . "</td>";
            echo "</tr>";
        }
    }
?>