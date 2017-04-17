<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <title>enlobos.com</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('public_folder/css/materialize.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('public_folder/css/styles.css'); ?>">


    <?php  

    if(!isset($meta_description)){
      echo '<meta name="description" content="Publicaciones de busquedas laborales | Trabajo-Ya.com ">';
    }else{
      echo $meta_description;
    }

    ?>

    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <?php 


    if(!isset($meta_title)){$meta_title = "";}
    
    if(empty($meta_title)){
      $meta_title ="Enlobos.com";
    } 
    echo '<title>'.$meta_title.'</title>';

    if(isset($og_info)){
      echo $og_info;
    }
    ?>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('public_folder/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
     <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,700italic,800,800italic,700,600italic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">

    <link href="<?php echo base_url('public_folder/css/frontend.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('public_folder/css/jquery.tagit.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('public_folder/css/tagit.ui-zendesk.css'); ?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-70815827-1', 'auto');
    ga('send', 'pageview');

  </script>

  <body>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5&appId=166338880103872";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

    

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url('/'); ?>">trabajo-ya.com</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            
            <?php  
            #echo '<li><a href="'.base_url('publicaciones').'">Publicaciones</a></li>';
            if($this->session->userdata('front_logged_in')){
           echo ' <li><a href="'.base_url('mis-publicaciones').'">Mis Publicaciones</a></li>';

            }
            ?>
           
            <!--
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
            -->
          </ul>
          <ul class="nav navbar-nav navbar-right">

            
      <?php

      //Si hay login de user muestro opciones de perfil y salir o sino muestro para loguearse o crear cuenta.

      if($this->session->userdata('front_logged_in')){
        
        $array_user = array();
        $array_user = $this->session->userdata('front_logged_in');
        
        $usuario_logged = $this->usuario->get_record( $array_user['id'] );

        $avatar_usuario = ' <i class="fa fa-user"></i> ';
        if($usuario_logged->filename!=""){$avatar_usuario = '<img src="'.base_url('images-usuarios/tn_'.$usuario_logged->filename).'" width="25" alt="Profile"/>';}
        echo '
        <li class="dropdown user user-menu" >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                '.$avatar_usuario.'
                <span>Hola, '.$usuario_logged->nombre.' <i class="caret"></i> </span>
            </a>
            <ul class="dropdown-menu">
               <li class="opcion_user"><a href="'.base_url('perfil-editar').'"><i class="fa fa-cog"></i> Editar mis datos</a></li>
               <li class="opcion_user"><a href="'.base_url('perfil-imagen').'"><i class="fa fa-picture-o"></i> Cambiar imagen</a></li>
               <li class="opcion_user"><a href="'.base_url('perfil-modificar-acceso').'"><i class="fa fa-shield"></i> Contraseña</a></li>
               <li class="opcion_user"><a href="'.base_url('desconectar').'"><i class="fa fa-times"></i> Cerrar Sesion</a></li>

            </ul>
        </li>';

      }else{
        echo '
        <li><a href="'.base_url('ingreso').'"><i class="fa fa-user"></i> Ingresar</a></li>
        <li><a href="'.base_url('registro').'"><i class="fa fa-sign-in"></i> Registrarme</a></li>';
      }
      ?>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    
      <!-- MENSAJES -->
      <div class="container">
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
    </div>
  <!-- FIN MENSAJES -->
    

    <div class="container">
      
      <?php if(isset($content)){$this->load->view($content);} ?>

    </div> <!-- /container -->
    
    <footer>
      <div class="container">
        <div class="row">
        <div class="col-lg-4 col-md-4 col-xs-12">
          <ul id="footer-links">
              <li><a href="<?php echo base_url('terminos-y-condiciones-de-uso'); ?>">Terminos y Condiciones</a></li>
              <li><a href="<?php echo base_url('sobre-trabajo-ya'); ?>">Sobre Trabajo-ya.com</a></li>
              
            </ul>
        </div>
          <div class="col-lg-4 col-md-4 col-xs-12">
            <ul>
              <li><a href="#">Preguntas frecuentes</a></li>
              <li><a href="<?php echo base_url('contacto'); ?>">Contacto</a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="crafted">
              Desarrollado por <a href="http://www.buenosweb.com">BuenosWeb.com </a>
            </div>
          </div>
          
        </div>

        <div class="row">
          <br>
        </div>
        
      </div>
      <div class="containerfluid" id="footer-gray-bar">
        
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script>
    /*!
     * IE10 viewport hack for Surface/desktop Windows 8 bug
     * Copyright 2014-2015 Twitter, Inc.
     * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
     */

    // See the Getting Started docs for more information:
    // http://getbootstrap.com/getting-started/#support-ie10-width

    (function () {
      'use strict';

      if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var msViewportStyle = document.createElement('style')
        msViewportStyle.appendChild(
          document.createTextNode(
            '@-ms-viewport{width:auto!important}'
          )
        )
        document.querySelector('head').appendChild(msViewportStyle)
      }

    })();
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo base_url('public_folder/js/bootstrap.js'); ?>"></script>
    <script>

      window.setTimeout(function() { $(".alert-success").alert('close'); }, 8000);
      window.setTimeout(function() { $(".alert-warning").alert('close'); }, 8000);
      window.setTimeout(function() { $(".alert-danger").alert('close'); }, 8000);


    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        
          });
    </script>


<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>

    <!-- The real deal -->
    <script src="<?php echo base_url('public_folder/js/tag-it.js'); ?>" type="text/javascript" charset="utf-8"></script>



    <script>
        $(function(){
            var sampleTags = ['c++', 'java', 'php', 'coldfusion', 'javascript', 'asp', 'ruby', 'python', 'c', 'scala', 'groovy', 'haskell', 'perl', 'erlang', 'apl', 'cobol', 'go', 'lua'];

            //-------------------------------
            // Minimal
            //-------------------------------
            $('#myTags').tagit();

            //-------------------------------
            // Single field
            //-------------------------------
            $('#singleFieldTags').tagit({
                availableTags: sampleTags,
                // This will make Tag-it submit a single form value, as a comma-delimited field.
                singleField: true,
                singleFieldNode: $('#mySingleField')
            });

          

        

            //-------------------------------
            // Tag events
            //-------------------------------
            var eventTags = $('#eventTags');

            var addEvent = function(text) {
                $('#events_container').append(text + '<br>');
            };

            eventTags.tagit({
                availableTags: sampleTags,
                beforeTagAdded: function(evt, ui) {
                    if (!ui.duringInitialization) {
                        addEvent('beforeTagAdded: ' + eventTags.tagit('tagLabel', ui.tag));
                    }
                },
                afterTagAdded: function(evt, ui) {
                    if (!ui.duringInitialization) {
                        addEvent('afterTagAdded: ' + eventTags.tagit('tagLabel', ui.tag));
                    }
                },
                beforeTagRemoved: function(evt, ui) {
                    addEvent('beforeTagRemoved: ' + eventTags.tagit('tagLabel', ui.tag));
                },
                afterTagRemoved: function(evt, ui) {
                    addEvent('afterTagRemoved: ' + eventTags.tagit('tagLabel', ui.tag));
                },
                onTagClicked: function(evt, ui) {
                    addEvent('onTagClicked: ' + eventTags.tagit('tagLabel', ui.tag));
                },
                onTagExists: function(evt, ui) {
                    addEvent('onTagExists: ' + eventTags.tagit('tagLabel', ui.existingTag));
                }
            });

            //-------------------------------
            // Read-only
            //-------------------------------
            $('#readOnlyTags').tagit({
                readOnly: true
            });

            //-------------------------------
            // Tag-it methods
            //-------------------------------
            $('#methodTags').tagit({
                availableTags: sampleTags
            });

            //-------------------------------
            // Allow spaces without quotes.
            //-------------------------------
            $('#allowSpacesTags').tagit({
                availableTags: sampleTags,
                allowSpaces: true
            });

            //-------------------------------
            // Remove confirmation
            //-------------------------------
            $('#removeConfirmationTags').tagit({
                availableTags: sampleTags,
                removeConfirmation: true
            });
            
        });
    </script>

    <script>
  $('#descripcion_corta').keypress(function(e) {
    var tval = $('#descripcion_corta').val(),
        tlength = tval.length,
        set = 200,
        remain = parseInt(set - tlength);
    $('#contador_limite').text(remain);
    if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
        $('#descripcion_corta').val((tval).substring(0, tlength - 1))
    }
})
</script>


  </body>
</html>