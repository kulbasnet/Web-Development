<?php include("connection.php"); ?>

<?php
// Fetch historical data from the database
$query = "SELECT * FROM weather ORDER BY weather_time DESC";
$result = $mysql->query($query);
$dataArray = array();
while ($row = mysqli_fetch_assoc($result)) {
    $dataArray[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    
    <link rel="stylesheet" href="AnupDangi_2333319_ISA.CSS">
</head>
<body>
    <div class="main">
        <div class="play" style="text-align: center;">
            <form id="form" method="get" action="#">
                <input type="text" id="search" placeholder="Search your city" name="city">
                <input type="submit" id="submit" value="Search" name="search" onclick="updateWeatherData()">
            </form>      
        </div>   

        <div class="headings" id="create">       
            <h2 class="city"> City: <?php echo $cityname ?? ''; ?></h2>
            <h7 class="temp"> Temperature: <?php echo @$weather_temperature1 ?? ''; ?> °C</h7>
            <h7 class="humid">Humidity: <?php echo @$weather_humidity1 ?? ''; ?> %</h7>
            <h7 class="wind">WindSpeed: <?php echo @$weather_wind1 ?? ''; ?> km/h</h7> 
            <h7 class="pressure">Pressure: <?php echo @$pressure1 ?? ''; ?> Hpa</h7>
            <h7 class="date">Date: <?php echo @$weather_time1 ?? ''; ?> </h7>
        </div>
        
        <div class="history-box" id="create1">
            <h2 class="history-title">Historical data</h2>
            <table>
                <tr>
                    <th>City</th>
                    <th>Temperature</th>
                    <th>Humidity</th>
                    <th>WindSpeed</th>
                    <th>Pressure</th>
                    <th>weather_date</th>
                </tr>
                <?php foreach ($dataArray as $data) { ?>
                    <tr>
                        <td><?php echo $data['cityname']; ?></td>
                        <td><?php echo $data['Weather_temperature']; ?>°C</td>
                        <td><?php echo $data['Humidity']; ?>%</td>
                        <td><?php echo $data['Weather_wind']; ?>km/h</td>
                        <td><?php echo $data['Pressure']; ?>Hpa</td>
                        <td><?php echo date('Y-m-d', strtotime($data['weather_time'])); ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <script>
   // Function to store the searched city information in local storage
// Function to store the searched city information in local storage
function storeSearchedCity(cityData) {
  var searchedCities = localStorage.getItem('searchedCities');

  if (searchedCities) {
    searchedCities = JSON.parse(searchedCities);

    // Check if the city already exists in the storage
    var existingCityIndex = searchedCities.findIndex(function(city) {
      return city.city === cityData.city;
    });

    if (existingCityIndex !== -1) {
      // Update the existing city data
      searchedCities[existingCityIndex] = cityData;
    } else {
      // Add a new city entry
      searchedCities.push(cityData);
    }
  } else {
    // Create a new array with the city data
    searchedCities = [cityData];
  }

  localStorage.setItem('searchedCities', JSON.stringify(searchedCities));
}



// Function to handle form submission and update weather data
function updateWeatherData(event) {
  event.preventDefault();
  
  var form = document.getElementById('form');
  var cityInput = document.getElementById('search');
  var cityName = cityInput.value;
  
  // Make an AJAX request to fetch the weather data for the searched city
  // Replace this with your actual code to fetch the weather data
  var weatherData = {
    city: cityName,
    temperature: '<?php echo @$weather_temperature1 ?? ''; ?> °C',
    wind: '<?php echo @$weather_wind1 ?? ''; ?> km/h',
    pressure: '<?php echo @$pressure1 ?? ''; ?> Hpa',
    humidity: '<?php echo @$weather_humidity1 ?? ''; ?> %',
    time: '<?php echo @$weather_time1 ?? ''; ?>'
  };

  // Update the displayed weather data
  document.getElementById('create').innerHTML = `
    <h2 class="city"> City: ${weatherData.city}</h2>
    <h7 class="temp"> Temperature: ${weatherData.temperature}</h7>
    <h7 class="humid">Humidity: ${weatherData.humidity}</h7>
    <h7 class="wind">WindSpeed: ${weatherData.wind}</h7> 
    <h7 class="pressure">Pressure: ${weatherData.pressure}</h7>
    <h7 class="date">Date: ${weatherData.time}</h7>
  `;

  // Store the searched city data in local storage
  storeSearchedCity(weatherData);

  // Reset the form
  form.reset();
}

// Attach the updateWeatherData function to the form submit event
var form = document.getElementById('form');
form.addEventListener('submit', updateWeatherData);
</script>
</body>
</html>