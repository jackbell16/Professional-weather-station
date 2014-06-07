Select *
From WeatherStation.Data
Where Date = CURRENT_DATE && Minute(WeatherStation.Data.Time)=00
Order by Time