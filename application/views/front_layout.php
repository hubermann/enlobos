<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>

	<title>enlobos.com</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('public_folder/css/materialize.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('public_folder/css/styles.css'); ?>">
</head>
<body>
	
<!-- navbar -->
<div class="navbar-fixed">
  <nav class="white" role="navigation">
    <div class="nav-wrapper container-fluid">
      <a id="logo-container" href="#" class="brand-logo">enlobos.com</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="/">Tener un sitio web</a></li>
        <li><a href="vender-en-internet.html">Vender en internet</a></li>
        <li><a href="mejorar-mi-imagen.html">Mejorar mi imagen</a></li>
      </ul>
  
      <ul id="nav-mobile" class="side-nav">
        <li><a href="/">Tener un sitio web</a></li>
        <li><a href="vender-en-internet.html">Vender en internet</a></li>
        <li><a href="mejorar-mi-imagen.html">Mejorar mi imagen</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse">
        <i class="material-icons">reorder</i>
      </a>
    </div>
  </nav>
  </div>

<div class="container-fluid" id="main_section">
	<div class="row section">
		
		<?php $this->load->view($content); ?>

	</div>
</div>

<footer class="page-footer teal">
    <div class="container-fluid">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">enlobos.com | 2015</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container-fluid">
      © 2015 enlobos.com
      <p class="right">Desarrollado por <a class="grey-text text-lighten-4 " href="#!">BuenosWeb.com</a></p>
      </div>
    </div>
  </footer>




</body>
<script src="<?php echo base_url('public_folder/js/jquery.js'); ?>"></script>
<script src="<?php echo base_url('public_folder/js/materialize.min.js'); ?>"></script>
<script>
(function($){
  $(function(){

    $('.button-collapse').sideNav();

  }); // end of document ready
})(jQuery); // end of jQuery name space


$(document).ready(function(){
      $('.slider').slider({full_width: true});
});


</script>
</html>