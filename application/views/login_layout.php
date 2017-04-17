<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?php echo base_url('public_folder/css/normalize.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public_folder/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public_folder/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public_folder/css/main.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public_folder/css/front.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public_folder/css/fonts.css'); ?>">
        <link href='http://fonts.googleapis.com/css?family=Maven+Pro:400,500,700,900' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

        <script src="<?php echo base_url('public_folder/js/vendor/modernizr-2.6.2.min.js'); ?>"></script>
        <!-- jQuery 2.0.2
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
        <script charset="utf-8" src="<?php echo base_url('public_folder/js/vendor/jquery-1.11.0.min.js'); ?>">
        </script>

    </head>
<body>
    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

<div class="full-container aqua">
		<div class="row clearfix nomargin">

			<div class="container" id="topheader">
				<!--<ul id="tabs">
					<li class="active" id="tab1"><a href="<?php echo base_url('notas'); ?>">Notas</a></li>
					<li id="tab2"><a href="<?php echo base_url('encuentros'); ?>">Encuentros</a></li>
           
				</ul>-->

        
			</div>

		</div>
	</div>




<!-- MAIN CONTENT -->
<section class="container" id="fondoblanco">

  <!-- MENSAJES -->
    <div class="row">
      <div id="avisos" class="col-lg-12">

      <?php
      /* SI existe login*/


        if($this->session->flashdata('success')):
        echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>
        '.$this->session->flashdata('success').'</div>';
        endif;

        if($this->session->flashdata('warning')):
        echo '<div class="alert alert-warning"  role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>
        '.$this->session->flashdata('warning').'</div>';
        endif;

        if($this->session->flashdata('error')):
        echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>
        '.$this->session->flashdata('error').'</div>';
        endif;
      ?>

      </div>
    </div>
  <!-- FIN MENSAJES -->


	<?php if(isset($content)){$this->load->view($content);} ?>
</section>
<!-- END MAIN SECTION -->


</body>
<script src="http://comunidad-rh.com/public_folder/js/bootstrap.js"></script>
<script>

  window.setTimeout(function() { $(".alert-success").alert('close'); }, 4000);
  window.setTimeout(function() { $(".alert-warning").alert('close'); }, 4000);
  window.setTimeout(function() { $(".alert-danger").alert('close'); }, 4000);


</script>
</html>
