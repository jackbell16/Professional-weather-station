

<?php
    function connect(){
        $IP ="IP";
        $username ="username";
        $password ="password";
        $DB = "WeatherStation";
        $con=mysqli_connect($IP,$username,$password,$DB);
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        return $con;
    }
    ?>