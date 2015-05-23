<?php
require_once('./../../utils/auth.php');
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./../../assets/css/font-awesome/css/font-awesome.css">
 <link rel="stylesheet" href="./../../assets/css/bootstrap.css">
 <link rel="stylesheet" href="./../../assets/css/spectrum.css">


 <script src="./../../assets/js/jquery-1.11.2.min.js"></script>
 <script src="./../../assets/js/bootstrap.js"></script>
 <script src="./../../assets/js/spectrum.js"></script>

 <style>
	.help-block{

		display:inline;
	}

.modal-dialog {
  width: 98%;
  height: 92%;
  padding: 0;
}

.modal-backdrop.in{
opacity:0;
}

 </style>


 <script> 

 var php_var = "uploads/<?php echo $_SESSION['SESS_MEMBER_ID']?>/<?php echo $_SESSION['SESS_MEMBER_ID']?>";
  
</script>

</head>

<body>

<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="line-height:32px;" href="#">SHAPEFILE VIEWER</a>
            </div>
            <!-- Collect../ the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

  		    <li><button href="#myModal" id="openBtn" data-toggle="modal" style="margin-top:13px;" class="btn btn-success" onclick="dialog();">Attribute Table</button></li>
                    </li>
		</ul>
   <form action="./upload.php" method="post" enctype="multipart/form-data">
		<ul class="nav navbar-nav pull-right">
                    <li>
  											<input style="margin-top:20px;" name="files[]" multiple="multiple" type="file" /><br />
                    </li>
                    <li>
                        <a><button class="btn btn-primary">UPLOAD</button></a>
</form>
                    </li>
                    <li>
   <form action="./../../utils/logout.php" method="post">
                        <a><button style="margin-top:16px; margin-left:100px;" class="btn btn-danger">LOGOUT</button></a>
</form>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div style="margin-top:90px;">

        <div class="row">
            <div class="col-lg-12 text-center">
            
		<div class="row">

		<div class="col-md-offset-1 col-md-3">
				<button title="Zoom in" class="btn btn-sm" onClick="_zoomIn()"><i class="fa fa-search-plus"></i></button>
				<button title="Zoom out" class="btn btn-sm" onClick="_zoomOut()"><i class="fa fa-search-minus"></i></button>
				<button title="Pan up" class="btn btn-sm" onClick="_panUp()" ><i class="fa fa-arrow-up"></i></button> 		
				<button title="Pan down" class="btn btn-sm" onClick="_panDown()"><i class="fa fa-arrow-down"></i></button> 		
				<button title="Pan right" class="btn btn-sm" onClick="_panRight()"><i class="fa fa-arrow-right"></i></button> 		
				<button title="Pan left" class="btn btn-sm" onClick="_panLeft()"><i class="fa fa-arrow-left"></i></button> 		
				<button title="Zoom full" onClick="_equalPosition()" class="btn btn-sm"><i class="fa fa-arrows-alt"></i></button>
		</div>
		<div class="col-md-2">
				<span class="help-block">Pen Stroke &nbsp;</span>
				<input title="Stroke color" type='button' id="stroke_color" ></input>	
				<button title="Penwidth increase" class="btn btn-sm" onClick="_penIncrease()"><i class="fa fa-plus"></i></button>
				<button title="Penwidth decrease" class="btn btn-sm" onClick="_penDecrease()"><i class="fa fa-minus"></i></button>
		</div>
		<div class="col-md-2">
				<span class="help-block">Fill Color &nbsp;</span>
				<input title="Fill color" type='button' id="fill_color" ></input>	
		</div>

		<div class="col-md-2">
		
				<span class="help-block">Label &nbsp;</span>
				<input title="Label color" type='button' id="label_color" ></input>	
				<button title="Label width increse " class="btn btn-sm" onClick="_labelSizeIncrease()"><i class="fa fa-plus"></i></button>
				<button title="Label width decrease" class="btn btn-sm" onClick="_labelSizeDecrease()"><i class="fa fa-minus"></i></button>
		
		</div>
		<div class="col-md-1">
				<select id="label" onchange="labelToggle();" class="labels form-control">
					<option>None</option>
				</select>
		</div>

	    </div>

		</div></br>
        <!-- /.row -->
			<?php 
				$file_name = "uploads/".$_SESSION['SESS_MEMBER_ID']."/".$_SESSION['SESS_MEMBER_ID'].".json";
				if(file_exists($file_name)){?>
     			<canvas  id="map" ondblclick="_zoomEvent(event)" width="1450" height="580"></canvas>
			<?php }else{ ?>
				</br></br>
				<div class="col-md-offset-3 col-md-6">	
					<img src="assets/img/file_upload.jpg">				
				</div>
	
			<?php }?>
    </div>

    <div style="margin-left:0px;">
    </div>

  

<div class="modal fade" id="myModal">
<div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h3 class="modal-title">Attribute Table</h3>
        </div>
        <div class="modal-body">
        
	      <table class="diag table table-striped">
		<thead class="diag-head"><tr class="diag-head-tr">

		</tr></thead>
		<tbody class="diag-body">
			

		</tbody>
		</table>

  
	</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
        </div>
				
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<footer>
<div class="container">
	<div class="row">
<div class="col-lg-10 col-lg-offset-1 text-center">
                <hr class="small">
                <p class="text-muted">Copyright &copy; Lsiviewer 2015</p>
</div>
</div>
</div>
</footer>
<script type="text/javascript" src="./assets/js/lsiviewer.js"></script>

</body>
</html>
