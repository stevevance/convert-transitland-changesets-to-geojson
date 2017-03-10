<?php
$fileInput = "/Users/stevevance/Sites/Transitland/GTFS/changesets/2974_switzerland.json";
$fileOutput = "/Users/stevevance/Sites/Transitland/GTFS/changesets/2974_switzerland.geojson";
$array_name = "changes";
$string = file_get_contents($fileInput);

$json = json_decode($string, true);
if($array_name):
	$array = $json[$array_name];
else:
	$array = $json;
endif;

// Create the base for GeoJSON
$geojson = [
	"type" => "FeatureCollection"
];
$features = [];

print_r($array);

// Iterate through each operator
foreach($array as $operator):
	$properties = $operator['operator'];
	$feature = [
		"geometry" => $properties['geometry'],
		"properties" => [
			"metro" 	=> $properties['metro'],
			"state"		=> $properties['state'],
			"country" 	=> $properties['country'],
			"state"		=> $properties['state'],
			"name"		=> $properties['name'],
			"shortName"	=> $properties['shortName'],
			"onestopId"	=> $properties['onestopId'],
			"website"	=> $properties['website'],
			"timezone"	=> $properties['timezone']
		]
	];
	$features[] = $feature;
endforeach;

$geojson['features'] = $features;

$geojson = json_encode($geojson);
file_put_contents($fileOutput, $geojson);

?>