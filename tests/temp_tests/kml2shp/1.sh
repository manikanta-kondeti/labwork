#!/bin/bash
echo $HOME
for layer in "$(ogrinfo -ro -so andhra.kml | tail -n+3 | cut -d ' ' -f 2)"
do
	    ogr2ogr -f "GeoJSON" "./andhra_${layer}.json" andhra.kml "${layer}" 
done
