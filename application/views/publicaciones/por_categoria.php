<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    
            <div id="imaginary_container"> 
              <form action="<?php echo base_url('buscar') ?>" method="get">
                <div class="input-group stylish-input-group">
                    <input type="text" class="form-control"  placeholder="Buscar" name="key">
                    <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>  
                    </span>
                </div>
              </form>
            </div> <!--  fin imaginary container -->

  </div>
  <div class="col-md-2"></div>
</div>




<div class="row">
	<div class="col-lg-12" id="publicaciones">
		<h3>Publicaciones  </h3>
		<?php  

	

			if($publicaciones){
				foreach ($publicaciones as $publicacion) {
					
        $categoria = $this->categoria_publicacion->traer_nombre($publicacion->categoria_id);
        $categoria_slug = $this->categoria_publicacion->traer_slug($publicacion->categoria_id);
        $provincias = $this->config->item('provincias_list');

        $ciudad = "";
        $provincia = "";
        if($publicacion->provincia_id != 0){$provincia = "Provincia: ".$provincias[$publicacion->provincia_id]; }
        if($publicacion->ciudad){$ciudad = " | Ciudad: ".$publicacion->ciudad; }



					echo '<a href="'.base_url($publicacion->slug.'/'.$publicacion->id).'" ><h2>'.$publicacion->titulo.'</h2></a>
					<p>'.$publicacion->descripcion_corta.'</p>
          <p>Categoria: <a href="'.base_url('/categoria/'.$categoria_slug.'/'.$publicacion->categoria_id).'">'.$categoria.'</a></p>
            <p>'.$provincia.' '.$ciudad.'</p>
					<p>'.$this->publicacion->time_elapsed_string($publicacion->created_at).'</p>
					<p>


					<a class="btn btn-default" href="'.base_url($publicacion->slug.'/'.$publicacion->id).'" role="button"><i class="fa fa-chain fa-lg"></i> Ver detalle</a>
					</p>
					<hr />';
				}
			}else{
				echo '<p>No hay publicaciones.</p>';
			}
		?>
		<ul class="pagination pagination-small pagination-centered">
			<?php echo $pagination_links;  ?>
		</ul>
	</div>
</div>

