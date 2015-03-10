# LSIViewer - Spatial Data Viewer


## STATUS

The *master* branch reflects our current 2.0.0 release. iPost 2.0.0 development will happen in the *develop* branch. The 2.0 release is not backwards compatible with the 1.x releases because we have totally restructured the API and the source code to position the product for additional future growth. Once you see all the new functionality that we have added and the simplier API design we think you will be very happy with the results.

## LINKS

* http://lsi.iiit.ac.in/lsiviewer 
* http://lsi.iiit.ac.in/lsiviewer/doc/index.html
* https://github.com/LSI-IIIT/lsiviewer


## INTRODUCTION

No operating system has built-in mechanism for viewing spatial data. One needs a geo spatial rendering package to visualize the data. Modern browsers are also not able to render vector maps even as they can render images(raster) even though the technology gives freedom. Web browsers are becoming a platform for different kinds of application. Lsiviewer is an open source tool which renders vector data on modern browsers, which allows GIS users to see their maps without installing any software on their system

This library contains following features:

* Viewing your shapefiles
* Pan your map 
* Zoom in/out 
* Change Fill color and Stroke color 
* Download it as .png
* Check your Attribute Table 
* Change stroke width
* Labelling and color change to the labels
* Increase label size

## REQUIREMENTS

* gdal/ogr2ogr tool
* php 
* Apache2 web server

## INSTALLATION

See online documentation: http://lsi.iiit.ac.in/lsiviewer/doc/

## COMPILATION


For Linux
	
	mkdir build
	cd build
	cmake -DWITH_DD=ON ..
	make
	sudo make install

Build with documentation (requires [Sphinx](http://sphinx-doc.org/))

	cmake -DWITH_DOC=ON -DWITH_DD=ON ..

Postgresql 9.1+

	createdb mydatabase
	psql mydatabase -c "create extension postgis"
	psql mydatabase -c "create extension pgrouting"

For older versions of postgresql

	createdb -T template1 template_postgis
	psql template_postgis -c "create language plpgsql"
	psql template_postgis -f /usr/share/postgresql/9.0/contrib/postgis-1.5/postgis.sql
	psql template_postgis -f /usr/share/postgresql/9.0/contrib/postgis-1.5/spatial_ref_sys.sql
	psql template_postgis -f /usr/share/postgresql/9.0/contrib/postgis_comments.sql

	createdb -T template_postgis template_pgrouting
	psql template_pgrouting -f /usr/share/postgresql/9.0/contrib/pgrouting-2.0/pgrouting.sql

	createdb -T template_pgrouting mydatabase


## USAGE

See online documentation: http://lsi.iiit.ac.in/lsiviewer


## LICENSE

* Will be added soon.
