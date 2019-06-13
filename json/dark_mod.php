<?php
// Belchertown root uri
$uri = '/var/www/html/weewx';

// Alert translation array
$darkAlertTitle = array(
	"Moderate Thunderstorm Warning",
	"Moderate Rain-flood Warning",
	"Moderate Flooding Warning",
	"Moderate Wind Warning"
);
$tranAlertTitle = array(
	"Vigilance jaune orages",
	"Vigilance jaune pluie",
	"Vigilance jaune inondation",
	"Vigilance jaune vent violent"
);

// Departement météo france
$dept = 83;

// Open original json file
$json_source = file_get_contents($uri . '/json/darksky_forecast.json');

// Decode json format
$json_data = json_decode($json_source, true);

// If an alert title exist try to translate it
if (isset($json_data['alerts'][0]['title'])) {
  // Count number of alerts
  $arr_length = count($json_data['alerts']);
  for($i=0;$i<$arr_length;$i++) {
    // replace the title
    $json_data['alerts'][$i]['title'] = str_replace($darkAlertTitle, $tranAlertTitle, $json_data['alerts'][$i]['title']);
    // adapt alert url to your region if needed otherwise comment next line.
    $json_data['alerts'][$i]['uri'] = $json_data['alerts'][$i]['uri'] . 'Bulletin_sans.html?a=dept' . $dept . '&b=2&c=';
  }
}

//print_r($json_data['alerts']);

// Set header
header('Content-Type: application/json;charset=UTF-8');
// echo the modified json
echo json_encode($json_data);

?>
