<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>UDE Exchange Programs in SEA</title>
	<!--<link rel="icon" type="image/png" href="screenshots/UDE-icon.png">-->
	
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css"> 

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <!-- <link href="css/progress-bar.css" rel="stylesheet"> -->
    <link href="css/bootstrap-stepper.css" rel="stylesheet">

	<!--jQuery CDN-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

	<!-- jsPDF CDN -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.3/jspdf.plugin.autotable.min.js"></script>

	<!-- Bootstrap stepper -->
	<link href="css/progress-bar.css" rel="stylesheet">

  </head>
  <body>
 

	<style>
		.image {
			float: left;
			padding-top: 7px;
			padding-bottom: 5px;
			height: auto;
			margin-right: 25px;
			<!--background-color: #003D76;-->
			
		}
		
		.navi {
			padding-top: 7px;
		}

	</style>

  
  <nav class="navbar navbar-inverse navbar-static-top">
	  <div class="container"  style="background-color:#003D76; color: white">
		<div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
			<a class="navbar-brand image" href="http://www.uni-due.de" target="_blank"><img src="screenshots/UDE-Logo.png"></a> <!-- NEU -->
			<a class="navbar-brand" href="index.php"><font size="5"><i class="glyphicon glyphicon-globe logo"></i> Südostasien</font></a>
			<!--<a class="navbar-brand" href="index.php"><img src="screenshots/UDE-Logo.png" alt="Test"></img></a>-->
			<!--echo '<img src="screenshots/UDE-Logo.png" alt="Test">';-->
		</div>
        <?php if(!is_checked_in()): ?>
		<div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" action="login.php" method="post">
			<table class="login" role="presentation">
				<tbody>
					<tr>
						<td>							
							<div class="input-group">
								<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
								<input class="form-control" placeholder="E-Mail" name="email" type="email" required>								
							</div>
						</td>
						<td><input class="form-control" placeholder="Passwort" name="passwort" type="password" value="" required></td>
						<td><button type="submit" class="btn btn-success">Login</button></td>
						<td><a class="btn btn-primary" href="register.php" role="button">Registrieren</a></td>
					</tr>
					<tr>
						<td><label style="margin-bottom: 0px; font-weight: normal;"><input type="checkbox" name="angemeldet_bleiben" value="remember-me" title="Angemeldet bleiben"  checked="checked" style="margin: 0; vertical-align: middle;" /> <small>Angemeldet bleiben</small></label></td>
						<td><small><a href="passwortvergessen.php">Passwort vergessen</a></small></td>
						<td></td>
					</tr>					
				</tbody>
			</table>		
          </form>  

        </div><!--/.navbar-collapse -->
        <?php else: ?>
        <div id="navbar" class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-right navi" >
			<li><a href="status.php"><i class="glyphicon glyphicon-info-sign"></i> Status</a></li>
			<li><a href="application.php"><i class="glyphicon glyphicon-edit"></i> Bewerbung</a></li>
			<!-- <li><a href="internalCourses.php"><i class="glyphicon glyphicon-file"></i> Fächerwahlliste</a></li> -->
			<li><a href="test_auswahl.php"><i class="glyphicon glyphicon-check"></i> Fächerwahlliste</a></li>
			<!-- <li><a href="upload.php"><i class="glyphicon glyphicon-paperclip"></i> Dateiupload</a></li> -->
			<!-- <li><a href="internal.php"><i class="glyphicon glyphicon-send"></i> Bewerbung</a></li>        -->
            <li><a href="settings.php"><i class="glyphicon glyphicon-cog"></i> Setup</a></li>
            <li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
          </ul>   
        </div><!--/.navbar-collapse -->
        <?php endif; ?>
		
      </div>
		<!--<a class="image" href="http://www.uni-due.de" target="_blank"><img src="screenshots/UDE-Logo.png"></a> <!-- NEU -->
    </nav>
