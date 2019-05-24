<?php
// Belchertown root uri
$uri = '/var/www/html/weewx';

// Alert translation array
$darkAlertTitle = array("Moderate Thunderstorm Warning", "Modarate Rain-flood Warning");
$tranAlertTitle = array("Alerte orage modéré.", "Alerte pluie modérée");

// Departement météo france
$dept = 83;

// Open original json file
$json_source = file_get_contents($uri . '/json/darksky_forecast.json');

// Decode json format
$json_data = json_decode($json_source, true);

// If an alert title exist try to translate it
if (isset($json_data['alerts'][0]['title'])) {
  // replace the title
  $json_data['alerts'][0]['title'] = str_replace($darkAlertTitle, $tranAlertTitle, $json_data['alerts'][0]['title']);
  // adapt alert url to your region if needed otherwise comment next line.
  $json_data['alerts'][0]['uri'] = $json_data['alerts'][0]['uri'] . 'Bulletin_sans.html?a=dept' . $dept . '&b=2&c=';
}

// Set header
header('Content-Type: application/json;charset=UTF-8');
// echo the modified json
echo json_encode($json_data);

?>
