<?php
    require 'dbconnection.php';

    $identifier = helper::FetchParam('identifier', '');
    
    // Start of the geojson
    $json = '{ "type": "FeatureCollection",';
    $json .= '    "features": [';

    if ($identifier != '')
    {
        $datapoints = helper::GetDatapoints($identifier, 'netheid');
        foreach ($datapoints as $key => $dp) {
            $json .= sprintf('{ "type": "Feature", "geometry": {"type": "Point", "coordinates": [%f,%f]}, "properties": {"title": "%s", "content": "%s"}},', $dp->longitude, $dp->latitude, $dp->number, $dp->varname);
        }
    }
    
    // Close the geojson
    // Remove last ,
    $json = rtrim($json, ",");
    $json .= ']}';

    echo $json;
