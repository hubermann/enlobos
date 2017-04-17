<div class="row">
	<div class="col-lg-12">
	
		
		<?php  



		if($avatar != ""){
			
			$img_user = '<img src="'.base_url('images-usuarios/'.$avatar).'" alt="image '.$nickname.'" class="img-responsive" >';
		}else{
			$img_user = "";
		}
		echo '
		
		<div class="row">
		<div class="col-md-3">
			'.$img_user.'
		</div>
		<div class="col-md-9">
			<h2>'.$nickname.'</h2>
			<p>'.$profile.'</p>

		</div>
	</div>

	<div class="row">
	<h3>Publicaciones de  '.$nickname.'</h3>

		';

			if($publicaciones){
				foreach ($publicaciones as $publicacion) {
					
					echo '<a href="'.base_url($publicacion->slug.'/'.$publicacion->id).'" ><h2>'.$publicacion->titulo.'</h2></a>
					<p>'.$publicacion->descripcion_corta.'</p>
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
	
	</div><!-- end row publcaiones -->

	</div>
</div>

