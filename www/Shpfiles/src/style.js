function _zoomIn(){
	scaleCount *= 1.2;
	if(flagZoom !=0){
		flagZoom -= 1;
		render(shpFile.records,zoomX,zoomY);
	}
	else{
	flagZoom=0;
	zoomX = 725;
	zoomY = 300;
	render(shpFile.records,zoomX,zoomY);
	}
	console.log("testing zoom");
}
function _zoomOut()
{
	scaleCount/=1.2;
	if(flagZoom!=0){
		flagZoom -= 1;
		render(shpFile.records,zoomX,zoomY);
	}
	else{
		flagZoom=0;
		zoomX=725;
		zoomY=300;
		render(shpFile.records,zoomX,zoomY);
	}
	console.log("!!!!!!! In zoom Out x="+canvasX+" y="+canvasY);
}
function _zoomEvent(event)
{
	scaleCount *= 1.2;
	var canvasX = event.clientX;
	var canvasY = event.clientY;
	console.log("$Zoomed in x="+canvasX+" y="+canvasY);
	zoomX=canvasX-4;
	zoomY=canvasY-155;
	flagZoom += 1;
	render(shpFile.records,zoomX,zoomY);
}

function _panUp(){
	move_y=move_y-10;
	render(shpFile.records,zoomX,zoomY);
}
function _panDown(){
	move_y=move_y+10;
	render(shpFile.records,zoomX,zoomY);
}
function _panLeft(){
	move_x=move_x-10;
	render(shpFile.records,zoomX,zoomY);
}
function _panRight(){
	move_x=move_x+10;
	render(shpFile.records,zoomX,zoomY);
}

//For color changes 
function bgColorChange(){
	console.log("bgColor button clicked");
	var bgColorValue = document.getElementById('bgColorButton').value;
	bgColor = bgColorValue;
	console.log("bgColor button clicked with value: " + bgColorValue);
	render(shpFile.records, zoomX, zoomY);
}

function fillColorChange(){
	console.log("bgColor button clicked");
	var fillColorValue = document.getElementById('fillColorButton').value;
	fillColor = fillColorValue;
	console.log("bgColor button clicked with value: " + fillColorValue);
	render(shpFile.records, zoomX, zoomY);
}

//pen details
function _penIncrease(){
	console.log("pen Increase called");
	lWidth += 0.15;
	if(lWidth>=3){
		lWidth = 3;
	}
	render(shpFile.records,zoomX,zoomY);	
}


function _penDecrease(){
	lWidth -= 0.1;
	if (lWidth<=0.01){
		lWidth = 0.01;
	}
	render(shpFile.records,zoomX,zoomY);
	console.log("Decrease Called");
}

//Conversions

function _pngBtn(){
	console.log("png button clicked");
	var c = document.getElementById("map");
	var link = document.getElementById('pnghref');
	link.addEventListener('click', function(ev) {
		link.href = c.toDataURL();
		link.download = "mypainting.png";
	}, false);
}

/*
var dragged;
var dragStart;
canvas.addEventListener('mousedown',function(evt){
	lastX = evt.offsetX || (evt.pageX - canvas.offsetLeft);
	lastY = evt.offsetY || (evt.pageY - canvas.offsetTop);
	dragStart = ctx.transformedPoint(lastX,lastY);
	dragged = false;
},false);
canvas.addEventListener('mousemove',function(evt){
	lastX = evt.offsetX || (evt.pageX - canvas.offsetLeft);
	lastY = evt.offsetY || (evt.pageY - canvas.offsetTop);
	dragged = true;
	if (dragStart){
		var pt = ctx.transformedPoint(lastX,lastY);
		ctx.translate(pt.x-dragStart.x,pt.y-dragStart.y);
		render(shpFile.records, zoomX,zoomY);
	}
},false);
canvas.addEventListener('mouseup',function(evt){
	dragStart = null;
	if (!dragged) zoom(evt.shiftKey ? -1 : 1 );
},false);

var scaleFactor = 1.1;
var zoom = function(clicks){
	var pt = ctx.transformedPoint(lastX,lastY);
	ctx.translate(pt.x,pt.y);
	var factor = Math.pow(scaleFactor,clicks);
	ctx.scale(factor,factor);
	ctx.translate(-pt.x,-pt.y);
	redraw();
}

var handleScroll = function(evt){
	var delta = evt.wheelDelta ? evt.wheelDelta/40 : evt.detail ? -evt.detail : 0;
	if (delta) zoom(delta);
	return evt.preventDefault() && false;
};
canvas.addEventListener('DOMMouseScroll',handleScroll,false);
canvas.addEventListener('mousewheel',handleScroll,false);
*/
