<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home | LSIViewer</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/stylish-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./css/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>

    <!-- Navigation -->
	<?php if($_SESSION['SESS_MEMBER_ID']!=""){?>
   <a href="./../utils/logout.php"> <button style="margin-right:80px;margin-top:10px;position:fixed;z-index:1;right:0" href="#" class="btn btn-danger" >LOGOUT</button></a>
   <?php }?>

	 <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="#top">Lsiviewer</a>
            </li>
            <li>
                <a href="#top">Home</a>
            </li>
            <li>
                <a href="#about">About</a>
            </li>
 <?php if($_SESSION['SESS_MEMBER_ID']==""){?>
				<li>
					<a href="#login"> Login </a>
				</li>
<?php }?>
            <li>
                <a href="#services">Services</a>
            </li>
            <li>
                <a href="#contact">Contact</a>
            </li>
        </ul>
    </nav>

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <h1>Lsiviewer</h1>
            <h3>An online viewer for spatial vector data</h3>
            <br>
            <a href="#about" class="btn btn-dark btn-lg">Find Out More</a>
        </div>
    </header>

    <!-- About -->
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>LSIViewer: An online viewer for spatial vector data</h2>
                    <p class="lead">No operating system has built-in mechanism for viewing spatial data. One needs a geo spatial rendering package to visualize the data. Modern browsers are also not able to render vector maps even as they can render images(raster) even though the technology gives freedom. Web browsers are becoming a platform for different kinds of application. <a target="_blank" href="http://lsi.iiit.ac.in/lsi/lsiviewer">Lsiviewer</a> is an open source tool which renders vector data on modern browsers, which allows GIS users to see their maps without installing any software on their system.</p>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
 <?php if($_SESSION['SESS_MEMBER_ID']==""){?>	
	<section id="login" style="background:#f7f7f9;padding:60px;">

		<div  class="container">
	
		<div class="row">
			
			<div class="col-md-1">

				<button id="btn-login" class="btn btn-lg btn-default">Login</button>

			</div>
			<div class="col-md-1">
				
				<button id="btn-register" class="btn btn-lg btn-default">Register</button>

			</div>

		</div>

		</br></br>

		<div class="row" id="login-container">

			<div class="col-md-4">
<form id="loginForm" name="loginForm" method="post" action="/lsiviewer_prototype/tests/www/utils/login-exec.php">
					<div class="form-group">
						<label for="exampleName">Email</label>
						<input type="email" name="email" class="form-control" placeholder="Enter Email">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
					</div>
				<button type="submit" class="btn btn-success">Submit</button>
				</form>

				</div>
	
		</div>


	 <div class="row" id="register-container">

         <div class="col-md-4">
<form id="registerForm" name="registerForm" method="post" action="/lsiviewer_prototype/tests/www/utils/register-exec.php">
					<div class="form-group">
						<label for="exampleInputEmail1">First Name</label>
						<input type="name" name="fname"class="form-control"  placeholder="Enter Firstname">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Last Name</label>
						<input type="name" name="lname" class="form-control" placeholder="Enter Lastname">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Email id</label>
						<input type="email" name="login" class="form-control" placeholder="Enter Email">
					</div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Retype Password</label>
                  <input type="password" name="cpassword" class="form-control" id="exampleInputPassword1" placeholder="Retype Password">
               </div>
            <button type="submit"  class="btn btn-success">Submit</button>
            </form>

            </div>
   
      </div>

   </div>


	</div>

	</section>

	<?php }?>

    <!-- Services -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <section id="services" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 col-lg-offset-1">
                    <h2>Our Services</h2>
                    <hr class="small">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-cloud fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Visualize Shapefile(.shp)</strong>
                                </h4>
                                <p>Do you want to visualize the shapefile and analyze it?</p>
<form action="./../viewer/shp/index.php" method="POST">
				<input type="hidden" name="user_check1" value=1></input>
                                <input type="submit" href="#" class="btn btn-light" value="Learn More"></input>
</form>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-compass fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>WMS+Shapefile</strong>
                                </h4>
                                <p>You can view your shapefile on top of WMS layer</p>
                            </div>
                        </div>


                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-flask fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Compressed GML Files</strong>
                                </h4>
                                <p>Do you want to visualize your compressed gml?</p>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-shield fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Other Vector Files</strong>
                                </h4>
                                <p>Vector formats like kml, TIGER, GeoJSON</p>
                            </div>
                        </div>

                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>


    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h4><strong>Labs for Spatial Informatics</strong>
                    </h4>
			<p>B2-213, Vindhya Building<br>International Institute of Information Technology<br>Hyderabad, India</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-phone fa-fw"></i> (+91-40)2300 1967, 1969 <b>Ext.276</b></li>
                        <li><i class="fa fa-envelope-o fa-fw"></i>  <a href="mailto:name@example.com">spatial@iiit.ac.in</a>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a href="#"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="http://lsi.iiit.ac.in/"><i class="fa fa-dribbble fa-fw fa-3x"></i></a>
                        </li>
                    </ul>
                    <hr class="small">
                    <p class="text-muted">Copyright &copy; Lsiviewer 2014</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });

$(document).ready(function(){

	$('#register-container').hide();
	$('#btn-login').addClass('btn-primary');

	$("#btn-login").click(function(){

			$('#btn-login').addClass('btn-primary');
			$('#btn-register').removeClass('btn-primary');
			$('#login-container').show();
			$('#register-container').hide();

	});
	
	$("#btn-register").click(function(){

			$('#btn-register').addClass('btn-primary');
			$('#btn-login').removeClass('btn-primary');
			$('#login-container').hide();
			$('#register-container').show();

	});


});


    </script>


</body>

</html>
