<!-- ######## SLIDERS ######## -->
<?php 
if( isset($sliders) ){
	$cantidad_sliders = 0;
	$items ="";
	$indicators="";
	foreach ($sliders as $slider) {
		$active = "";
		$item_active ="";
		if($cantidad_sliders ==0){ $active = 'class="active"'; $item_active = 'active';}
		
		$items .= '<div class="item '.$item_active.'" style="background-image: url('.base_url('images-sliders/'.$slider->filename).')">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="carousel-content centered">
                                    <h2 class="animation animated-item-1">'.$slider->titulo.'</h2>
                                    <p class="animation animated-item-2">'.$slider->frase.'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.item-->
                ';
		$indicators .= '<li data-target="#main-slider" data-slide-to="'.$cantidad_sliders.'" '.$active.'></li>
		';
		$cantidad_sliders++;
	}
}



?>
<section id="main-slider" class="no-margin">
    <div class="carousel slide wet-asphalt">
        <ol class="carousel-indicators">
            <?php echo $indicators; ?>
        </ol>
        <div class="carousel-inner">
            <?php echo $items; ?>
        </div><!--/.carousel-inner-->

    </div><!--/.carousel-->
    <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
        <i class="icon-angle-left"></i>
    </a>
    <a class="next hidden-xs" href="#main-slider" data-slide="next">
        <i class="icon-angle-right"></i>
    </a>
</section><!--/#main-slider-->

<!-- ######## FIN SLIDERS ######## -->



<section id="lugares">
  <div class="container">
    <div class="row">

      <div class="col-md-8">

      <?php  
      if($lugares){
      	foreach ($lugares as $lugar) {
      		$imagen = $this->imagenes_lugar->traer_una($lugar->id);
      		$nombre_imagen ="";
      		if( isset($imagen->filename) ){ $nombre_imagen = '<img class="img-responsive img-blog" src="'.base_url('images-lugares/'.$imagen->filename).'" width="100%" alt="" />';}
      		echo '
      		<div class="blog-item">
	          '.$nombre_imagen.'
	          <div class="blog-content">
	              <a href="'.base_url('turismo/'.$lugar->slug.'/'.$lugar->id).'"><h3>'.$lugar->nombre.'</h3></a>
	              <!-- <div class="entry-meta">
	                  <span><i class="icon-user"></i> <a href="#">John</a></span>
	                  <span><i class="icon-folder-close"></i> <a href="#">Bootstrap</a></span>
	                  <span><i class="icon-calendar"></i> Sept 16th, 2012</span>
	                  <span><i class="icon-comment"></i> <a href="blog-item.html#comments">3 Comments</a></span>
	              </div> -->
	              <p>'.$lugar->descripcion.'</p>
	              <a class="btn btn-default" href="'.base_url('turismo/'.$lugar->slug.'/'.$lugar->id).'">Conocer más <i class="icon-angle-right"></i></a>
	          </div>
	      </div><!--/.blog-item-->
	      ';
      	}
      }
      ?>

        


      </div><!-- end col-md-8 -->

      <div class="col-md-4">
        
        <div class="widget search">
            <form role="form">
                <div class="input-group">
                    <input type="text" class="form-control" autocomplete="off" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="button"><i class="icon-search"></i></button>
                    </span>
                </div>
            </form>
        </div>  <!-- end search -->



      </div><!-- end sidebar col-md-4 -->

    </div><!-- end row -->
  </div> <!-- end container -->

</section>