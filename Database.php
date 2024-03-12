<?php

$servername="localhost";
$database="watherapp";
$username="root";
$password="";
$conn = mysqli_connect($servername,$username,$password,$database);

if (!$conn){
  die("<b>Connection Failed: </b>".mysqli_connect_error());
}

$sql_for_data_ret = mysqli_query($conn, "SELECT * FROM weather_data_ ORDER BY weather_when DESC limit 1") or die(mysqli_error($conn));

$row = mysqli_fetch_object($sql_for_data_ret); 
echo json_encode($row);

date_default_timezone_set('Asia/Kathmandu');

$currentTime = time();
$weather_when=$row->weather_when;       
$diff = $currentTime - strtotime($weather_when);  
  if($diff > 1800){ 
    
    $url = "https://api.openweathermap.org/data/2.5/weather?q=Thimi&appid=ba69073a0acb654b0831d81a44f74c16&units=metric";
    $response = file_get_contents($url);
    $jsondata = json_decode($response);

  $currentTime = time();
  $weather_when=date("Y-m-d H:i:s");
  $temp = $jsondata->main->temp;
  $pressure = $jsondata->main->pressure;
  $wind = $jsondata->wind->speed;
  $humidity = $jsondata->main->humidity;
  $desc = $jsondata->weather[0]->description;
  $city=$jsondata->name;
  $icon=$jsondata->weather[0]->icon;


if(!mysqli_select_db($conn,"weatherapp")){
  mysqli_query($conn,"create database weatherapp");
  mysqli_select_db($conn,"weatherapp");
}

  $mysql_insert_qry = mysqli_query($conn, "INSERT INTO weather_data_(temperature, pressure, wind, humidity, description, city, icon, weather_when) VALUES ('$temp', $pressure, $wind, $humidity, '$desc', '$city', '$icon', '$weather_when')") or die(mysqli_error($conn));

}
?