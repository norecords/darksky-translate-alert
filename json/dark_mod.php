<?php
/*
 * Darksky Alert Translator
 * Written by Olivier Colle
 *  --> https://github.com/norecords/darksky-translate-alert
 * Licence GNU GPLv3 - Copyright 2019 meteo.correns.org
 * Thanks to olpayras for translation help
 * Thanks to prolabs for the wonderfull weewx skin he made
 *  --> https://github.com/poblabs/weewx-belchertown
 */

// Belchertown root uri
$uri = '/var/www/html/weewx';

// Alert translation array
$darkAlertTitle = array(
	"Moderate Thunderstorm Warning",      // Vigilance jaune orages
	"Severe Thunderstorm Warning",        // Vigilance orange orages
	"Extreme Thunderstorm Warning",       // Vigilance rouge orages
	"Moderate Rain-flood Warning",        // Vigilance jaune pluie
	"Severe Rain-flood Warning",          // Vigilance orange pluie
	"Extreme Rain-flood Warning",         // Vigilance rouge pluie
	"Moderate Flooding Warning",          // Vigilance jaune inondation
	"Severe Flooding Warning",            // Vigilance orange inondation
	"Extreme Flooding Warning",           // Vigilance rouge inondation
	"Moderate Wind Warning",              // Vigilance jaune vent violent
	"Severe Wind Warning",                // Vigilance orange vent violent
	"Extreme Wind Warning",               // Vigilance rouge vent violent
	"Moderate High-temperature Warning",  // Vigilance jaune canicule
	"Severe High-temperature Warning",    // Vigilance orange canicule
	"Extreme High-temperature Warning",   // Vigilance rouge canicule
	"Moderate Coastalevent Warning",      // Vigilance jaune vagues-submersion
	"Severe Coastalevent Warning",        // Vigilance orange vagues-submersion
	"Extreme Coastalevent Warning"        // Vigilance rouge vagues-submersion
);
$tranAlertTitle = array(
	"Vigilance jaune orages",
	"Vigilance orange orages",
	"Vigilance rouge orages",
	"Vigilance jaune pluie",
	"Vigilance orange pluie",
	"Vigilance rouge pluie",
	"Vigilance jaune inondation",
	"Vigilance orange inondation",
	"Vigilance rouge inondation",
	"Vigilance jaune vent violent",
	"Vigilance orange vent violent",
	"Vigilance rouge vent violent",
	"Vigilance jaune canicule",
	"Vigilance orange canicule",
	"Vigilance rouge canicule",
	"Vigilance jaune vagues-submersion",
	"Vigilance orange vagues-submersion",
	"Vigilance rouge vagues-submersion"
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

// Set header
header('Content-Type: application/json;charset=UTF-8');
// echo the modified json
echo json_encode($json_data);

?>
