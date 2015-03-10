var canvas, ctx, xMin, xMax, yMin, yMax, drawScale;
var geojson;
var labelFlag=0;

//Attributes
var labels=[];
var popupCreated=0;

$(document).ready(function(){


	console.log('Document Loaded ');
	$.post('./andhra.json','',function(response){         
		load(response);
	});
});


function load(response){
	geojson = response;
	//console.log(geojson);

	canvas = document.getElementById("map");
	ctx = canvas.getContext('2D');

	loadJson(geojson);
	traverseFeatures(geojson.features,'draw');     
	labelsFill();
	traverseLabels(geojson.features);
	//labelsPrint();
};

function labelsFill(){
	var count=0;
	for (var k in geojson.features[0].properties){
		if (typeof geojson.features[0].properties[k] !== 'function') {
			labels[count++]=k;
		}
	}
}

function labelsPrint(){
	for(var j=0;j<labels.length;j++){
		console.log(labels[j]);
	}
}

function loadJson(geojson){
	//console.log("Asynchronous file loading");
	//console.log("geoJson "+ geojson);
	canvas = document.getElementById('map');
	ctx = canvas.getContext('2d');  
	ctx.strokeStyle = "#000000";  
	ctx.fillStyle = "#FFA500";


	//traverse the features to get the bounding box 
	traverseFeatures(geojson.features,'bbox');


	//calculate width and height of data.  divide canvas by data dimensions to get a suitable scale
	xScale = canvas.width/Math.abs(xMax-xMin);
	yScale = canvas.height/Math.abs(yMax-yMin);


	//calculate a vertical and horiz scale to fit the data to the canvas.  
	//pick the smaller scale of the two for the rendering
	drawScale = xScale<yScale ? xScale : yScale;


	//traverse the features again to draw 


}




//Pseudo Code.
/*
   traverseLabels(features){
   for(each feature){
   Check for feature type 
   Calculate coordiantes(centreX, centreY) of each feature.         
   append cX, cY to properties and copy it to label 
   }
   }




   getCentre(coords, type){
   if(type==Point){
   centre.x = coords.x;
   centre.y = coords.y;
   return centres;
   }
   else if(type == LineString || MultiPoint){
   if there are n points, take n/2 as label coords 
   return centres;
   }
   else if(type="Polygon" or "MultiLineString"){
   var p_minx, p_maxx, p_miny, p_maxy;
   for(each point in polygon){
   var x=coords[i];
   var y=coords[i];
   xMin = xMin<x?xMin:x;
   xMax = xMax>x?xMax:x;
   yMin = yMin<y?yMin:y;
   yMax = yMax>y?yMax:y;
   cx = xmin+xmax/2;
   cy = ymin+ymax/2;
   return point;
   }
   MultiPolygon}
   else if (type="MultiPolygon"){
//Get For each polygon.        
}
}




//We have properties with their centers. Draw Labels


*/
// Coords, geomtype=feature[i].geometry.type


var getCenter = function(coords,geomtype){
	var centerX=0, centerY=0;
	//Compute X,Y


	//Point
	if(geomtype=="Point"){
		console.log("In labels, Point feature");
		centerX = coords[0][0];
		centerY = coords[0][1];
	}
	//LineString
	else if(geomtype=="LineString"){
		console.log("In lables, LineString feature");
		console.log("LineString Coords"+ coords[0].length);
		for(var i=0;i<coords[0].length;i++){
			var obj=coords[0][i];
			centerX += parseFloat(obj[0]);
			centerY += parseFloat(obj[1]);
		}
		centerX /= coords[0].length;
		centerY /= coords[0].length;
	}
	//Polygon
	else if(geomtype="Polygon"){
		var pMinx, pMaxx,pMiny, pMaxy; 
		for(var i=0;i<coords[0].length;i++){
			var obj=coords[0][i];
			pMinx = pMinx<obj[0]?pMinx:obj[0];
			pMaxx = pMaxx>obj[0]?pMaxx:obj[0];
			pMiny = pMiny<obj[1]?pMiny:obj[1];
			pMaxy = pMaxy>obj[1]?pMaxy:obj[1];
		}
		centerX = (pMinx + pMaxx)/2;
		centerY = (pMiny + pMaxy)/2;
	}
	//MultiPoint
	else if(geomtype=="MultiPoint"){
		console.log("In labels, MultiPoint feature");
		for(var i=0;i<coords[0].length;i++){
			var obj=coords[0][i];
			centerX += parseFloat(obj[0]);
			centerY += parseFloat(obj[1]);
		}
		centerX /= coords[0].length;
		centerY /= coords[0].length;
	}
	//MultiLineString
	else if(geomtype=="MultiLineString"){
		console.log("In labels, MultiLineString feature");
		var pMinx, pMaxx,pMiny, pMaxy; 
		for(var i=0;i<coords[0].length;i++){
			var obj=coords[0][i];
			pMinx = pMinx<obj[0]?pMinx:obj[0];
			pMaxx = pMaxx>obj[0]?pMaxx:obj[0];
			pMiny = pMiny<obj[1]?pMiny:obj[1];
			pMaxy = pMaxy>obj[1]?pMaxy:obj[1];
		}
		centerX = (pMinx + pMaxx)/2;
		centerY = (pMiny + pMaxy)/2;
	}
	//MultiPolygon
	else if(geomtype=="MultiPolygon"){
		console.log("In labels, MultiPolygon feature");
	}
	return [centerX,centerY];
}


function traverseLabels(features){
	for(var i=0;i<features.length;i++){
		var coords = features[i].geometry.coordinates;
		var geomtype = features[i].geometry.type;
		var centers = getCenter(coords,geomtype);
		// Put them into properties object and you're done.
		console.log("centers[0]="+centers[0]+ " centers[1]="+centers[1]);
		var props = features[i].properties;
		props["centerX"]=centers[0];
		props["centerY"]=centers[1];


	}
	for (var k in props){
		if (typeof props[k] !== 'function') {
			console.log("        Key is " + k + ", value is" + props[k]);
		}
	}
}




function traverseFeatures(features,action){
	ctx.clearRect(0,0,1450,700);
	for(var i=0; i<features.length; i++){
		var coords = features[i].geometry.coordinates;
		var geomtype =  features[i].geometry.type; 
		var props =  features[i].properties; 


		if(geomtype=="Polygon"){
			//Polygons have just one array of coordinates
			traverseCoordinates(coords[0],action);
			if(labelFlag==1){
				cx = props["centerX"];
				cy = props["centerY"];
				cx = (cx-xMin)*drawScale;
				cy = (yMax-cy)*drawScale;
				console.log("cx = "+cx +" cy = "+cy);
				ctx.font ="8pt Calibri";
				ctx.fillStyle = 'blue';
				ctx.fillText(props["DIST"], cx-15,cy);
			}
		}
		else if(geomtype=="Point"){
			//console.log("Point");
			var x = coords[0];
			var y = coords[1];
			console.log("xMin = "+xMin+"yMax = "+yMax);
			x = (x-xMin)*drawScale;
			y = (yMax-y)*drawScale;
			ctx.beginPath();
			ctx.rect(x,y,2,2);
			ctx.fill();
			ctx.stroke();
		}
		else if(geomtype=="LineString"){
			//console.log("Yo Bitch");
			//Polygons have just one array of coordinates
			traverseCoordinates(coords,action);
		}
		else if(geomtype=="MultiLineString"){
			//console.log("Yo Bitch");
			//Polygons have just one array of coordinates
			traverseCoordinates(coords[0],action);
		}
		else if(geomtype=="MultiPolygon"){
			//Multipolygons have several arrays of coordinates, so loop through those
			for(var k=0; k<coords.length; k++){ 
				traverseCoordinates(coords[k][0],action);
			}
		}
	}
}


//Adding Text
/*
   context.font ="30pt Calibri";
   context.fillStyle = 'blue';
   context.fillText("LSIViewer", 300,210);
   */


function traverseCoordinates(coordinates,action){
	for(var j=0; j<coordinates.length; j++){
		var x = coordinates[j][0];
		var y = coordinates[j][1];


		if(action == 'bbox'){
			xMin = xMin<x?xMin:x;
			xMax = xMax>x?xMax:x;
			yMin = yMin<y?yMin:y;
			yMax = yMax>y?yMax:y;
		}
		else if(action == 'draw'){
			x = (x-xMin)*drawScale;
			y = (yMax-y)*drawScale;
			if(j==0){
				//begin drawing on the first point
				ctx.beginPath();
				ctx.moveTo(x,y);
			}else{
				//continue drawing
				ctx.lineTo(x,y);
			}
		}
	}


	if(action == 'draw'){
		//close the fill and the stroke
		ctx.fillStyle = "#FFA500";
		ctx.stroke();
		ctx.fill();
	}
}



function labelToggle(){
	var labelButton =document.getElementById("label").value;
	if(labelButton==0){
		labelFlag=1;
		console.log(geojson);
		console.log("labelValue "+ labelButton );
		document.getElementById("label").value=1;
		traverseFeatures(geojson.features,'draw');        
	}
	else if(labelButton == 1){
		document.getElementById("label").value=0;
		console.log("labelValue "+ labelButton );
		labelFlag=0;
		traverseFeatures(geojson.features,'draw');        
	}
}

function attributeTable(){
	var attributeButton = document.getElementById("attr").value;
	console.log("Attribute Table Clicked");
	if(attributeButton == 0){
		document.getElementById("attr").value=1;
		//CreatePopup
		for(var i=0;i<geojson.features.length;i++){
			console.log
		}
	}
	else if(attributeButton == 0){
		document.getElementById("attr").value=0;
	}
}

function dialog(){
	var dialog = document.getElementById('window');
	if(document.getElementById('show').value == 0){
		console.log("Dialog show clicked");
		dialog.show();
		var tableValue = document.getElementById('attributes').value;
		if(popupCreated==0){
			var table = document.getElementById('attributes');
			var header = table.createTHead();
			var row = header.insertRow(0);   
			for(var i=0;i<labels.length;i++){
				var cell = row.insertCell(i);
				cell.innerHTML = "<b>"+labels[i]+"</b>";
			}
			var rowsCount = 1;
			//Fill Content in the table
			for(var i=0;i<geojson.features.length;i++){
			var row = table.insertRow(rowsCount++);   
				for(var j=0;j<labels.length;j++){	
					var cell = row.insertCell(j);
					cell.innerHTML = geojson.features[i].properties[labels[j]];
				}
			}
			popupCreated = 1;
		}
				};
				document.getElementById('exit').onclick = function() {
					dialog.close();
				};
	}
