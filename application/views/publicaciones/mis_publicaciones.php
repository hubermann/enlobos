<div class="row">
	<div class="col-lg-12">
		<h3>Mis publicaciones  | <a class="btn btn-default" href="<?php echo base_url('publicaciones/nueva'); ?>" role="button"><i class="fa fa-plus fa-lg"></i> Nueva</a></h3>
		<?php  
			if($publicaciones){
				foreach ($publicaciones as $publicacion) {
					
					$publicacion_estado = "<span class=\" estado_publicacion success\">Activo</span>";

					if($publicacion->finalizado==1){ $publicacion_estado = "<span class=\"estado_publicacion error\">Finalizado</span>";}

					echo '
					<div class="panel panel-default">

						<div class="panel-body">
						<a href="'.base_url($publicacion->slug.'/'.$publicacion->id).'" ><h2>'.$publicacion->titulo.' </h2></a>
							
							<p>Estado: '.$publicacion_estado.'</p>
							<p>'.$publicacion->descripcion_corta.'</p>
						</div>
						
						<div class="panel-footer">
							<a class="btn btn-default" href="'.base_url('publicaciones/editar/'.$publicacion->id).'" role="button"><i class="fa fa-edit fa-lg"></i> Editar</a>
							<a class="btn btn-default" href="'.base_url($publicacion->slug.'/'.$publicacion->id).'" role="button"><i class="fa fa-chain fa-lg"></i> Ver detalle</a>
							<a class="btn btn-default" href="'.base_url('publicaciones/eliminar/'.$publicacion->id).'" role="button"><i class="fa fa-trash fa-lg"></i> Eliminar</a>
						</div>

					</div>
					';
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

