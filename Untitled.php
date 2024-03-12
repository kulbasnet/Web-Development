<html> 
    <head>
        <style>
            table {
              font-family: arial, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }
            
            td, th {
              border: 1px solid #dddddd;
              text-align: left;
              padding: 8px;
            }
            
            tr:nth-child(even) {
              background-color: #dddddd;
            }
        </style>
    </head>
<!-- create table to display the weather of past 7 days -->
<table>
        <tr>
            <th>City</th>
            <th>Temperature</th>
            <th>Humidity</th>
            <th>WindSpeed</th>
            <th>Pressure</th>
            <th>weather_date</th>
        </tr>
        <?php
            // fetch historical data from the database
            $query = "SELECT * FROM weather ORDER BY weather_time DESC";
            $result = $mysql->query($query);
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr >
            <td><?php echo $row['cityname']; ?></td>
            
            <td><?php echo $row['Weather_temperature'];?>°C</td>
            
            <td><?php echo $row['Humidity']; ?>%</td>
            
            <td><?php echo $row['Weather_wind']; ?>km/h</td>
            
            <td><?php echo $row['Pressure']; ?>Hpa</td>
            
            <td><?php echo date('Y-m-d', strtotime($row['weather_time'])); ?></td>
        </tr>
        <?php } ?>
    </table>
  </div>
  <script src="kulbhushanbasnet_2332953.js" defer></script>
  </html>