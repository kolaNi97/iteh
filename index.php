<?php 
require 'php/config.php'; ?>
<!DOCTYPE html>

<html>
  <head>
    <title>BookCorner</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="engine0/style.css" />
	<script type="text/javascript" src="engine0/jquery.js"></script>
	

</head>

  <body id="main_body">
  <?php
  if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
      ?>
       <div class="login">
      <h2 style='color: #fff';>Dobro došli <?php echo $_SESSION['username'] ?> !</h2>
    </div>
    <br>  
<?php
}
else{
        ?>
    <div class="login">
      <h3><a href="Ulaz/index.php">Log in <span class="glyphicon glyphicon-log-in"></span></a></h3>
    </div>
    <br>
    <?php

	
	 
}
?>
	<!-- Start WOWSlider.com BODY section --> <!-- add to the <body> of your page -->
	<div id="wowslider-container0">
	<div class="ws_images"><ul>
		
		<li><img src="data0/images/2.jpg" alt="" title="" id="wows0_1"/></li>
		<li><img src="data0/images/3.jpg" alt="" title="" id="wows0_2"/></li>
		<li><img src="data0/images/4.jpg" alt="" title="" id="wows0_3"/></li>
		<li><img src="data0/images/5.jpg" alt="" title="" id="wows0_4"/></li>
		<li><img src="data0/images/6.jpg" alt="" title="" id="wows0_5"/></li>
		<li><a href="http://wowslider.net"><img src="data0/images/7.jpg" alt="jquery slider" title="" id="wows0_6"/></a></li>
		<li><img src="data0/images/8.jpg" alt="" title="" id="wows0_7"/></li>
	</ul></div>
	<div class="ws_thumbs">
<div>
		
		<a href="#" title=""><img src="data0/tooltips/2.jpg" alt="" /></a>
		<a href="#" title=""><img src="data0/tooltips/3.jpg" alt="" /></a>
		<a href="#" title=""><img src="data0/tooltips/4.jpg" alt="" /></a>
		<a href="#" title=""><img src="data0/tooltips/5.jpg" alt="" /></a>
		<a href="#" title=""><img src="data0/tooltips/6.jpg" alt="" /></a>
		<a href="#" title=""><img src="data0/tooltips/7.jpg" alt="" /></a>
		<a href="#" title=""><img src="data0/tooltips/8.jpg" alt="" /></a>
	</div>
</div>
<div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.com">bootstrap carousel</a> by WOWSlider.com v8.7</div>
	<div class="ws_shadow"></div>
	</div>
	<script type="text/javascript" src="engine0/wowslider.js"></script>
	<script type="text/javascript" src="engine0/script.js"></script>
	<!-- End WOWSlider.com BODY section -->
	 <div class="home">
    <h1 ><a href="index2.php">Početna <span class="glyphicon glyphicon-home"></span></a></h1>
  </div>
<?php
  if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  	if($_SESSION['status']=='Admin'){
      ?>
      <div class="home">
    <h1 ><a href="index3.php">Admin panel <span class="glyphicon glyphicon-wrench"></span></a></h1>
  </div>
  	
       
<?php
}
}

?>
  



  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

  </body>
</html>
